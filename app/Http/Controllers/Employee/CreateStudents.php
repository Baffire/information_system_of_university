<?php
/*
 * The Controller create  a few students in students and users tables
 */

namespace App\Http\Controllers\Employee;

use App\Degree;
use App\Degree_of_preparation;
use App\Employee;
use App\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyReadFilter;
use App\Roadmap;
use App\Student;
use App\Training_program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CreateStudents extends Controller
{
    use CheckRole;

    public function createStudents(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();
            $degrees = Degree::all();

            if ($request->has('training_program') && $request->has('degree') && $request->has('year_of_admission') && $request->has('file')) {

                $request->validate([
                    'training_program' => 'required|integer|bail',
                    'degree' => 'required|integer|bail',
                    'year_of_admission' => 'required|integer|bail',
                    'file' => 'required|file|mimes:xls,xlsx|bail',
                ]);

                $path = $request->file('file')->store(
                    'public/students/' . $request->user()->id . '-' . date('d.m.Y')
                );

                $file = new File();

                $file->path = $path;
                $file->user_id = $user_id;

                $file->save();

                $dir_path = $_SERVER['DOCUMENT_ROOT'];

                $dir = str_replace('public', 'storage/app/', $dir_path);

                // Get data from xlsx file and write it in tables
                $inputFileType = 'Xlsx';
                $inputFileName = $dir . $path;

                $filterSubset = new MyReadFilter();

                $reader = IOFactory::createReader($inputFileType);
                $reader->setReadFilter($filterSubset);
                $spreadsheet = $reader->load($inputFileName);

                $names = [];

                for ($i = 2; $i < 32; $i++) {
                    $name = $spreadsheet->getActiveSheet()->getCell("A$i")->getValue();
                    $names[] = $name;
                }

                $patronymics = [];

                for ($i = 2; $i < 32; $i++) {
                    $patronymic = $spreadsheet->getActiveSheet()->getCell("B$i")->getValue();
                    $patronymics[] = $patronymic;
                }

                $surnames = [];

                for ($i = 2; $i < 32; $i++) {
                    $surname = $spreadsheet->getActiveSheet()->getCell("C$i")->getValue();
                    $surnames[] = $surname;
                }

                $emails = [];

                for ($i = 2; $i < 32; $i++) {
                    $email = $spreadsheet->getActiveSheet()->getCell("D$i")->getValue();
                    $emails[] = $email;
                }

                $passwords = [];

                for ($i = 2; $i < 32; $i++) {
                    $password = $spreadsheet->getActiveSheet()->getCell("E$i")->getValue();
                    $passwords[] = $password;
                }

                for ($i = 0; $i < 30; $i++) {
                    if ($names[$i] != null && $patronymics[$i] != null && $surnames[$i] != null && $emails[$i] != null && $passwords[$i] != null) {

                        $email = User::where('email', $emails[$i])->first();

                        if (empty($email->id)) {
                            $user = new User();

                            $user->name = $names[$i];
                            $user->patronymic = $patronymics[$i];
                            $user->surname = $surnames[$i];
                            $user->email = $emails[$i];
                            $user->role_id = 2;
                            $user->password = Hash::make($passwords[$i]);

                            $user->save();

                            $last_user = User::orderBy('id', 'desc')->first();

                            $student = new Student();

                            $student->user_id = $last_user->id;
                            $student->faculty_id = $faculty_id;
                            $student->department_id = $department_id;
                            $student->training_program_id = $request->training_program;
                            $student->degree_id = $request->degree;
                            $student->year_of_admission = $request->year_of_admission;
                            $student->role_id = 2;

                            $student->save();

                            $control_types = Roadmap::where(['training_program_id' => $request->training_program, 'year_of_admission' => $request->year_of_admission])->get();
                            $last_student = Student::orderBy('id', 'desc')->first();

                            if (!empty($control_types)) {
                                foreach ($control_types as $control_type) {
                                    $degree_of_preparation = new Degree_of_preparation();

                                    $degree_of_preparation->student_id = $last_student->id;
                                    $degree_of_preparation->roadmap_id = $control_type->id;

                                    $degree_of_preparation->save();
                                }
                            }

                            $request->session();
                            $request->session()->put('message', "Пользователи успешно созданы");
                        }
                    } else {
                        break;
                    }
                }

                return redirect('/employee/students/create');

            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.createStudents', ['training_programs' => $training_programs, 'degrees' => $degrees, 'message' => $message]);
        } else {
            return redirect('/');
        }
    }
}
