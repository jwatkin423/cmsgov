<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('cms', function ($table) {
      $table->increments('cms_id');
      $table->integer('cms_ext_id')->lenth(20)->unique();
      $table->string('cms_recipient_type', 100);
      $table->integer('cms_hospital_id')->length(6)->nullable();
      $table->integer('cms_hospital_name')->length(150)->nullable();
      $table->integer('cms_phy_profile_id')->length(10)->nullable();
      $table->string('cms_phy_first_name', 50);
      $table->string('cms_phy_middle_name', 50)->nullable();
      $table->string('cms_phy_last_name', 50);
      $table->string('cms_phy_suffix_name', 50)->nullable();
      $table->string('cms_phy_address', 50);
      $table->string('cms_phy_address_two', 50)->nullable();
      $table->string('cms_phy_city', 50);
      $table->string('cms_phy_state', 50);
      $table->string('cms_phy_zipcode', 9);
      $table->string('cms_phy_country', 50)->nullable();
      $table->string('cms_phy_lics_code', 100);
      $table->string('cms_phy_type', 100);
      $table->decimal('cms_amount', 15, 2);
      $table->date('cms_payment_date', 15, 2);
      $table->string('cms_payment_type', 75);
      $table->string('cms_payment_category', 75);
      $table->integer('cms_year')->length(4);
      $table->date('cms_pub_date', 10);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('cms');
  }

}
