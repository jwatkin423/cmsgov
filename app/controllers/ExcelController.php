<?php

class ExcelController extends BaseController {

  // Run export
  public function excelExport() {
    $get = Input::get();
    $cms = Cms::search($get);

    Excelexport::exportante($cms);
  }


  public function excelExportById() {
    $id = Input::get('id');
    $cms = Cms::find($id);

    Excelexport::exportanteById($cms);

  }

}