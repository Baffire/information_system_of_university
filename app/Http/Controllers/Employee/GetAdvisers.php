<?php
/*
 * This Controller select all advisers of department from title_confirms table
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Title_confirm;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GetAdvisers extends Controller
{
    use CheckRole;

    public function getAdvisers(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where(['faculty_id' => $faculty_id])->get();

            //Get file.xlsx with titles and advisers
            if ($request->has('training_programs') && $request->has('year_of_admissions')) {

                $got_year_of_admissions = $request->year_of_admissions;
                $got_training_programs = $request->training_programs;

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $advisers = Title_confirm::where(['department_id' => $department_id, 'confirmation' => 1])->get();

                $i = 2;

                foreach ($got_training_programs as $got_training_program) {
                    foreach ($got_year_of_admissions as $got_year_of_admission) {
                        foreach ($advisers as $adviser) {
                            if ($adviser->student->training_program->id == $got_training_program && $adviser->student->year_of_admission == $got_year_of_admission) {

                                $student_name = $adviser->student->user->name;

                                if ($adviser->student->user->patronymic != null) {
                                    $student_patronymic = $adviser->student->user->patronymic;
                                } else {
                                    $student_patronymic = null;
                                }

                                $student_surname = $adviser->student->user->surname;

                                $teacher_name = $adviser->teacher->user->name;

                                if ($adviser->teacher->user->patronymic != null) {
                                    $teacher_patronymic = $adviser->teacher->user->patronymic;
                                } else {
                                    $teacher_patronymic = null;
                                }

                                $teacher_surname = $adviser->teacher->user->surname;

                                $student = $student_surname . ' ' . $student_name . ' ' . $student_patronymic;
                                $teacher = $teacher_surname . ' ' . $teacher_name . ' ' . $teacher_patronymic;

                                $sheet->setCellValue('A1', 'Образовательная программа');
                                $sheet->setCellValue('A' . $i, $adviser->student->training_program->name);

                                $sheet->setCellValue('B1', 'Год набора');
                                $sheet->setCellValue('B' . $i, $adviser->student->year_of_admission);

                                $sheet->setCellValue('C1', 'Студент');
                                $sheet->setCellValue('C' . $i, $student);

                                $sheet->setCellValue('D1', 'Руководитель');
                                $sheet->setCellValue('D' . $i, $teacher);

                                $sheet->setCellValue('E1', 'Тема выпускной квалификационной работы');
                                $sheet->setCellValue('E' . $i, $adviser->title->name);

                                $i++;
                            }
                        }
                    }

                }

                // redirect output to client browser
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="myfile.xls"');
                header('Cache-Control: max-age=0');

                $writer = IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save('php://output');

                $request->session();
                $request->session()->put('message', "Данные успешно получены");

                return redirect('/employee/advisers/get');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.getAdvisers', ['training_programs' => $training_programs, 'message' => $message]);

        } else {
            return redirect('/');
        }
    }
}
