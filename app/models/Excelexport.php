<?php

class Excelexport extends Eloquent {

  public static function exportante($cms) {

    Excel::create('CMS-Records', function ($excel) use ($cms) {

      $excel->sheet('Records', function ($sheet) use ($cms) {

        $sheet->loadview('cms.results', ['records' => $cms]);

      });

    })->download('xls');

  }
}