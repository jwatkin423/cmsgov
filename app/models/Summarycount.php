<?php

class Summarycount extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'summarycount';

  protected $primaryKey = "sc_id";

  protected $fillable = array(
    'current_count'
  );

}