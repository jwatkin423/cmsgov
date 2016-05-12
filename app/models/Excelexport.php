<?php

class Excelexport extends Eloquent {

  // The actually export function

  public static function exportante($cms) {

    Excel::create('CMS-Records', function ($excel) use ($cms) {

      $excel->sheet('Records', function ($sheet) use ($cms) {

        $sheet->loadview('cms.exportresults', ['records' => $cms]);

      });

    })->download('xls');

  }
}