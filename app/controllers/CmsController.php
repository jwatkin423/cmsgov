<?php

class CmsController extends BaseController {

  /*
  |--------------------------------------------------------------------------
  | Default Home Controller
  |--------------------------------------------------------------------------
  |
  | You may wish to use controllers instead of, or in addition to, Closure
  | based routes. That's great! Here is an example controller method to
  | get you started. To route to this controller, just add the route:
  |
  |	Route::get('/', 'HomeController@showWelcome');
  |
  */

  public function index() {
    $cms = Cms::limit(10)->get();

    if ($get = Input::get()) {
      $byDate = $get['by_date'] != '' ? $get['by_date'] : '';
      $monthYear = $get['month_year'] != '' ? $get['month_date'] : '';
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

}
