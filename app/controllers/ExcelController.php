<?php

class ExcelController extends BaseController {

  public function excelExport() {
    $get = Input::get();
    $cms = Cms::search($get);

    Excelexport::exportante($cms);
  }
}