<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Cms extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'cms';

  protected $primaryKey = "cms_id";

  protected $fillable = array(
    'cms_recipient_type',
    'cms_ext_id',
    'cms_hospital_id',
    'cms_hospital_name',
    'cms_phy_profile_id',
    'cms_phy_first_name',
    'cms_phy_middle_name',
    'cms_phy_last_name',
    'cms_phy_suffix_name',
    'cms_phy_address',
    'cms_phy_address_two',
    'cms_phy_city',
    'cms_phy_state',
    'cms_phy_zipcode',
    'cms_phy_country',
    'cms_phy_lics_code',
    'cms_phy_type',
    'cms_amount',
    'cms_payment_date',
    'cms_payment_type',
    'cms_payment_category',
    'cms_year',
    'cms_pub_date'
  );

  // Make the physician name look nice
  public static function physName($firstName = null, $lastName = null, $suffix = null) {
    $name = $firstName == null ? '' : ucfirst($firstName);
    $name .= $lastName == null ? '' : ' ' . ucfirst($lastName);
    $name .= $suffix == null ? '' : ', ' . ucfirst(strtolower($suffix));

    return $name;
  }

  public static function search($get) {
    $query = Cms::select('cms_phy_first_name', 'cms_phy_last_name', 'cms_phy_suffix_name', 'cms_hospital_name', 'cms_amount', 'cms_payment_date');

    if ($get['month_year'] != '') {
      $startDate = date('Y-m-01', strtotime($get['month_year']));
      $endDate = date('Y-m-t', strtotime($startDate));
      $query = is_null($get['month_year']) ? $query : $query->where('cms_pub_date', '>=', $startDate)->where('cms_pub_date', '<=', $endDate);
    }

    if ($get['by_date'] != '') {
      $query = $query->where('cms_pub_date', '=', $get['by_date']);
    }

    $query = $get['cms_amount'] == '' ? $query : $query->where('cms_amount', '=', $get['cms_amount']);
    $query = $get['phy_name'] == '' ? $query : $query->where('cms_phy_last_name', 'like', $get['phy_name']);
    $query = $get['limit'] == '' ? $query : $query->limit($get['limit']);

    $cms = $query->get();

    /*$queries = DB::getQueryLog();
    $last_query = end($queries);*/

    return $cms;

  }

}
