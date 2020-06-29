<?php
/*
 * This Controller create a few teachers in teachers and users tables
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyReadFilter;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CreateTeachers extends Controller
{
    use CheckRole;

    public function createTeachers(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
                $faculty_name = $item->faculty->name;
            }

            if ($request->has('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xls,xlsx|bail',
                ]);

                $path = $request->file('file')->store(
                    'public/teachers/' . $request->user()->id . '-' . date('d.m.Y')
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

                //Get values from file
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

                $academic_degrees = [];

                for ($i = 2; $i < 32; $i++) {
                    $academic_degree = $spreadsheet->getActiveSheet()->getCell("D$i")->getValue();
                    $academic_degrees[] = $academic_degree;
                }

                $statuses = [];

                for ($i = 2; $i < 32; $i++) {
                    $status = $spreadsheet->getActiveSheet()->getCell("E$i")->getValue();
                    $statuses[] = $status;
                }

                $posts = [];

                for ($i = 2; $i < 32; $i++) {
                    $post = $spreadsheet->getActiveSheet()->getCell("F$i")->getValue();
                    $posts[] = $post;
                }

                $emails = [];

                for ($i = 2; $i < 32; $i++) {
                    $email = $spreadsheet->getActiveSheet()->getCell("G$i")->getValue();
                    $emails[] = $email;
                }

                $passwords = [];

                for ($i = 2; $i < 32; $i++) {
                    $password = $spreadsheet->getActiveSheet()->getCell("H$i")->getValue();
                    $passwords[] = $password;
                }

                //Write values in tables
                for ($i = 0; $i < 30; $i++) {
                    if ($names[$i] != null && $patronymics[$i] != null && $surnames[$i] != null && $emails[$i] != null && $passwords[$i] != null && $posts[$i] != null) {

                        $email = User::where('email', $emails[$i])->first();

                        if (empty($email->id)) {
                            $user = new User();

                            $user->name = $names[$i];
                            $user->patronymic = $patronymics[$i];
                            $user->surname = $surnames[$i];
                            $user->email = $emails[$i];
                            $user->role_id = 3;
                            $user->password = Hash::make($passwords[$i]);

                            $user->save();

                            $last_user = User::orderBy('id', 'desc')->first();

                            $teacher = new Teacher();

                            $teacher->user_id = $last_user->id;
                            $teacher->faculty_id = $faculty_id;
                            $teacher->department_id = $department_id;

                            if (!empty($academic_degrees[$i])) {
                                $teacher->academic_degree_id = $academic_degrees[$i];
                            }

                            if (!empty($statuses[$i])) {
                                $teacher->status_id = $statuses[$i];
                            }

                            $teacher->post_id = $posts[$i];
                            $teacher->role_id = 3;

                            $teacher->save();

                            $request->session();
                            $request->session()->put('message', "Пользователи успешно созданы");
                        }
                    } else {
                        break;
                    }
                }

                return redirect('employee/teachers/create');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.createTeachers', ['message' => $message, 'faculty_name' => $faculty_name]);
        } else {
            return redirect('/');
        }
    }
}
