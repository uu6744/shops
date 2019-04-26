<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class CeshiController extends Controller
{
    public function export()
    {
      $cellData = [
        ['id','姓名','年龄'],
        ['1001','张三','45'],
        ['1001','张三','45'],
        ['1001','张三','45'],
        ['1001','张三','45'],
        ['1001','张三','45'],
        ['1001','张三','45'],
      ];
      

      Excel::create('成员信息表', function($excel) use ($cellData){
        $excel->sheet('score',function($sheet) use($cellData) {
          $sheet->rows($cellData);
          // $sheet->protect('password');
          $sheet->protect('password', function(\PHPExcel_Worksheet_Protection $protection) {
            $protection->setSort(true);
        });
        });

    })->export('xls');



    }



  

}
