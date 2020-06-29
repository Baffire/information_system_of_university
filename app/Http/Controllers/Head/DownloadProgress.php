<?php
/*
 * This Controller allow download students progress
 */

namespace App\Http\Controllers\Head;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DownloadProgress extends Controller
{
    use CheckRole;

    public function downloadProgress(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $students = $request->session()->get('students');

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $i = 2;
            $j = 67;

            foreach ($students as $stud) {

                $student_name = $stud->user->name;

                if ($stud->user->patronymic != null) {
                    $student_patronymic = $stud->user->patronymic;
                } else {
                    $student_patronymic = null;
                }

                $student_surname = $stud->user->surname;

                $student = $student_surname . ' ' . $student_name . ' ' . $student_patronymic;

                $char = strtoupper(chr($j));
                $sheet->setCellValue($char . '1', $student);

                $stud_id = $stud->id;
                $progress_stud = Degree_of_preparation::where('student_id', $stud_id)->get();

                foreach ($progress_stud as $progress) {
                    $sheet->setCellValue('A1', 'Наименование контроля');
                    $sheet->setCellValue('A' . $i, $progress->roadmap->name);

                    $sheet->setCellValue('B1', 'Образовательная программа');
                    $sheet->setCellValue('B' . $i, $progress->roadmap->training_program->name);

                    if ($progress->confirmation == 1) {
                        $sheet->setCellValue($char . $i, 'Преподаватель принял');
                    }

                    if ($progress->employee_confirm == 1) {
                        $sheet->setCellValue($char . $i, 'Сотрудник кафедры принял');
                    }

                    $i++;
                }

                $i = 2;
                $j++;
            }

            // redirect output to client browser
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="myfile.xls"');
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');

            return redirect()->route('head_progress_get');
        } else {
            return redirect('/');
        }
    }
}
