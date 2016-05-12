<?php

class RefreshController extends BaseController {

  private static $selectString = 'record_id, covered_recipient_type, teaching_hospital_id, teaching_hospital_name, physician_profile_id, physician_first_name, physician_middle_name, physician_last_name, physician_name_suffix, recipient_primary_business_street_address_line1, recipient_primary_business_street_address_line2, recipient_city, recipient_state, recipient_zip_code, recipient_country, physician_license_state_code1, physician_primary_type, total_amount_of_payment_usdollars, date_of_payment, form_of_payment_or_transfer_of_value, nature_of_payment_or_transfer_of_value, program_year, payment_publication_date';

  public function refresh() {
    $createRows = array();
    $updateRows = array();
    $insertData = array();

    // Connection to cms.gov data
    $socrata = new Socrata();

    // previous count in the DB
    $previousCount = Summarycount::get()->first();

    // Get the count of the current numbers of records
    if ($count = $socrata->get('v3nw-usd7.json', array('$query' => "SELECT count(record_id)"))) {
      $count = array_shift($count);

      // Set the new count
      $newCount = intval($count['count_record_id']);

      // Save the new count to the DB
      $sc = Summarycount::where('sc_id', '=', "1")->first();
      $sc->current_count = $newCount;
      $sc->save();
    }

    // Process only 1000 at a time
    if ($previousCount->current_count == null || $previousCount->current_count == false) {
      $currentCount = 1;
    } else {
      $currentCount = $previousCount->current_count;
    }

    $offset = $currentCount + 1;

    $limit = $count['count_record_id'] - $previousCount->current_count;

    if ($limit > 1000) {
      $limit = 1000;
      $newSaveCount = $currentCount + $limit;

      $sc = Summarycount::where('sc_id', '=', "1")->first();
      $sc->current_count = $newSaveCount;
      $sc->save();

    }

    // Get the new records
    $data = $socrata->get('v3nw-usd7.json', array(
      '$limit' => $limit, '$offset' => $offset, '$select' => self::$selectString
    ));

    // Loop through each record to build array to insert into DB
    foreach ($data as $row) {
      $insertData[] = array(
        'cms_recipient_type' => isset($row['covered_recipient_type']) ? $row['covered_recipient_type'] : null,
        'cms_hospital_id' => isset($row['teaching_hospital_id']) ? $row['teaching_hospital_id'] : null,
        'cms_ext_id' => isset($row['record_id']) ? intval($row['record_id']) : null,
        'cms_hospital_name' => isset($row['teaching_hospital_name']) ? $row['teaching_hospital_name'] : null,
        'cms_phy_profile_id' => isset($row['physician_profile_id']) ? $row['physician_profile_id'] : null,
        'cms_phy_first_name' => isset($row['physician_first_name']) ? strtolower($row['physician_first_name']) : null,
        'cms_phy_middle_name' => isset($row['physician_middle_name']) ? strtolower($row['physician_middle_name']) : null,
        'cms_phy_last_name' => isset($row['physician_last_name']) ? strtolower($row['physician_last_name']) : null,
        'cms_phy_suffix_name' => isset($row['physician_name_suffix']) ? $row['physician_name_suffix'] : null,
        'cms_phy_address' => isset($row['recipient_primary_business_street_address_line1']) ? $row['recipient_primary_business_street_address_line1'] : null,
        'cms_phy_address_two' => isset($row['recipient_primary_business_street_address_line2']) ? $row['recipient_primary_business_street_address_line2'] : null,
        'cms_phy_city' => isset($row['recipient_city']) ? $row['recipient_city'] : null,
        'cms_phy_state' => isset($row['recipient_state']) ? $row['recipient_state'] : null,
        'cms_phy_zipcode' => isset($row['recipient_zip_code']) ? $row['recipient_zip_code'] : null,
        'cms_phy_country' => isset($row['recipient_country']) ? $row['recipient_country'] : null,
        'cms_phy_lics_code' => isset($row['physician_license_state_code1']) ? $row['physician_license_state_code1'] : null,
        'cms_phy_type' => isset($row['physician_primary_type']) ? $row['physician_primary_type'] : null,
        'cms_amount' => isset($row['total_amount_of_payment_usdollars']) ? $row['total_amount_of_payment_usdollars'] : null,
        'cms_payment_date' => isset($row['date_of_payment']) ? date('Y-m-d', strtotime($row['date_of_payment'])) : null,
        'cms_payment_type' => isset($row['form_of_payment_or_transfer_of_value']) ? $row['form_of_payment_or_transfer_of_value'] : null,
        'cms_payment_category' => isset($row['nature_of_payment_or_transfer_of_value']) ? $row['nature_of_payment_or_transfer_of_value'] : null,
        'cms_year' => isset($row['program_year']) ? $row['program_year'] : null,
        'cms_pub_date' => isset($row['payment_publication_date']) ? $row['payment_publication_date'] : null
      );

    }

    $totalCount = count($insertData);
    // Insert records into DB
    // Update if need be
    if ($totalCount > 0) {
      foreach ($insertData as $row) {
        if (Cms::where('cms_ext_id', '=', $row['cms_ext_id'])->exists()) {
          $cms = Cms::where('cms_ext_id', '=', $row['cms_ext_id'])->first();
          $cms->fill($row);
          if ($cms->save()) {
            $updateRows[] = $row['cms_ext_id'];
          }
        } else {
          $cmsSave = new Cms();
          $cmsSave->fill($row);
          if ($cmsSave->save()) {
            $createRows[] = $row['cms_ext_id'];
          }
        }

      }

      $saveCount = count($createRows);
      $updateCount = count($updateRows);

      $processedData['records'] = $insertData;

      // If not running in the command line, generete excel file
      if (!App::runningInConsole()) {
        Excelexport::exportante(array_shift($processedData));

        return View::make('refresh.index')->with('title', 'Refresh result')->with('total_count', $totalCount)->with('save_count', $saveCount)->with('update_count', $updateCount);

      } else {
        echo "Done running the refresh ({$saveCount} records were added | {$updateCount} records were updated)!" . PHP_EOL;
      }
    }

    // If no new records, return this view
    return View::make('refresh.index')->with('title', 'Refresh result')->with('total_count', 0)->with('save_count', 0)->with('update_count', 0);
  }

}
