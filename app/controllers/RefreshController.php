<?php

class RefreshController extends BaseController {

  private static $selectString = 'record_id, covered_recipient_type, teaching_hospital_id, teaching_hospital_name, physician_profile_id, physician_first_name, physician_middle_name, physician_last_name, physician_name_suffix, recipient_primary_business_street_address_line1, recipient_primary_business_street_address_line2, recipient_city, recipient_state, recipient_zip_code, recipient_country, physician_license_state_code1, physician_primary_type, total_amount_of_payment_usdollars, date_of_payment, form_of_payment_or_transfer_of_value, nature_of_payment_or_transfer_of_value, program_year, payment_publication_date';

  public function refresh() {
    $socrata = new Socrata();
    $count = $socrata->get('v3nw-usd7.json', array('$query' => "SELECT count(record_id)"));
    $count = array_shift($count);
    $offset = $count['count_record_id'] - 50;
    $limit = 50;
    $data = $socrata->get('v3nw-usd7.json', array('$limit' => $limit, '$offset' => $offset, '$select' => self::$selectString));

    foreach ($data as $row) {
      $insertdata[] = array(
        'cms_recipient_type' => isset($row['covered_recipient_type']) ? $row['covered_recipient_type'] : null,
        'cms_hospital_id' => isset($row['teaching_hospital_id']) ? $row['teaching_hospital_id'] : null,
        'cms_ext_id' => isset($row['record_id']) ? $row['record_id'] : null,
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

    $results = Cms::insert($insertdata);

    $countResults = count($insertdata);

    $processedData['records'] = $insertdata;

    if (!App::runningInConsole()) {
      Excelexport::exportante(array_shift($processedData));
    } else {
      echo "Done running the refresh ({$countResults} records were added)!" . PHP_EOL;
    }
    
  }

  public function search() {
    $socrata = new Socrata();
    $data = $socrata->get('v3nw-usd7.json', array('$limit' => 50));
    d($data);
  }

}