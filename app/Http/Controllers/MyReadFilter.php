<?php
/*
 * This Controller read .xls files
 */

namespace App\Http\Controllers;

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        //  Read rows 1 to 100 and columns A to E only
        if ($row >= 1 && $row <= 100) {
            if (in_array($column,range('A','H'))) {
                return true;
            }
        }
        return false;
    }
}
