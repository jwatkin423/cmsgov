<?php

class ExcelController extends BaseController {

  // Run export
  public function excelExport() {
    $get = Input::get();
    $cms = Cms::search($get);

    Excelexport::exportante($cms);
  }
}