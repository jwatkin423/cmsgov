<?php

class CmsController extends BaseController {


  // Detailed search
  public function index() {
    $cms = Cms::limit(10)->get();

    if ($get = Input::get()) {
      $byDate = $get['by_date'] != '' ? $get['by_date'] : '';
      $monthYear = $get['month_year'] != '' ? $get['month_year'] : '';
      $cmsAmount = $get['cms_amount'] != '' ? $get['cms_amount'] : '';
      $phyName = $get['phy_name'] != '' ? $get['phy_name'] : '';
      $limit = $get['limit'] != '' ? $get['limit'] : '';

      $cms = Cms::search($get);
    } else {
      $byDate = '';
      $monthYear = '';
      $cmsAmount = '';
      $phyName = '';
      $limit = 10;
    }

    return View::make('cms.index')
      ->with('by_date', $byDate)
      ->with('month_year', $monthYear)
      ->with('cms_amount', $cmsAmount)
      ->with('phy_name', $phyName)
      ->with('limit', $limit)
      ->with('title', 'List off Records')
      ->with('records', $cms);
  }

  // Search by typeahead
  public function search() {
    if ($post = Input::all()) {

      $cms = Cms::select('cms_phy_state', 'cms_phy_city','cms_phy_last_name', 'cms_id', 'cms_pub_date')
         ->where('cms_phy_last_name', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_first_name', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_hospital_id', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_hospital_name', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_address', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_address_two', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_city', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_state', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_zipcode', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_phy_country', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_payment_date', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_amount', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_payment_type', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_payment_category', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_year', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_pub_date', 'LIKE', '%' . $post['query'] . '%')
        ->orWhere('cms_recipient_type', 'LIKE', '%' . $post['query'] . '%')
        ->get();

      if ($cms != null){

        foreach ($cms as $cm) {
          $d[] = array(
            'id' => $cm['cms_id'],
            'doctor' => $cm['cms_phy_last_name'],
            'city' => $cm['cms_phy_city'],
            'pub_date' => $cm['cms_pub_date'],
            'state' => $cm['cms_phy_state']
          );
        }

        $s = json_encode($d);

        return Response::json($d);
      }

      return;
    }
  }

  // Single search
  public function single($id = null) {
    if ($id == null) {
      $id = Input::get('id');
    }

    $cms = Cms::find($id);

    return View::make('cms.display')
      ->with('id', $id)
      ->with('title', 'Single view')
      ->with('record', $cms);
  }

}
