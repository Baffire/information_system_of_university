<?php
/*Controller allows uploading titles into server and save its in titles table
 * */

namespace App\Http\Controllers\Teacher;

use App\Degree;
use App\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MyReadFilter;
use App\Teacher;
use App\Title;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CreateTitles extends Controller
{
    use CheckRole;
    use Notifications;

    public function createTitles(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $teacher = Teacher::where('user_id', $user_id)->first();

            $faculty_id = $teacher->faculty_id;
            $department_id = $teacher->department_id;
            $teacher_id = $teacher->id;

            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();
            $degrees = Degree::all();

            if ($request->has('file') && $request->has('training_program') && $request->has('degree')) {

                $request->validate([
                    'file' => 'required|file|mimes:xls,xlsx|bail',
                    'training_program' => 'required|bail',
                    'degree' => 'required|bail',
                ]);

                $path = $request->file('file')->store(
                    'public/titles/' . $request->user()->id . '-' . date('d.m.Y')
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

                $titles = [];

                for ($i = 2; $i < 10; $i++) {
                    $title = $spreadsheet->getActiveSheet()->getCell("A$i")->getValue();
                    $titles[] = $title;
                }

                $descriptions = [];

                for ($i = 2; $i < 10; $i++) {
                    $description = $spreadsheet->getActiveSheet()->getCell("B$i")->getValue();
                    $descriptions[] = $description;
                }

                $softwares = [];

                for ($i = 2; $i < 10; $i++) {
                    $software = $spreadsheet->getActiveSheet()->getCell("C$i")->getValue();
                    $softwares[] = $software;
                }

                for ($i = 0; $i < 9; $i++) {
                    if ($titles[$i] != null && $descriptions[$i] != null && $softwares[$i] != null) {

                        $title = Title::where('name', $titles[$i])->first();

                        if (empty($title->id)) {
                            $title = new Title();

                            $title->name = $titles[$i];
                            $title->faculty_id = $faculty_id;
                            $title->department_id = $department_id;
                            $title->teacher_id = $teacher_id;
                            $title->description = $descriptions[$i];
                            $title->software = $softwares[$i];
                            $title->training_program_id = $request->training_program;
                            $title->degree_id = $request->degree;

                            $title->save();
                        }
                    } else {
                        break;
                    }
                }

                $request->session();
                $request->session()->put('message', "Темы успешно добавлены");

                return redirect('/teacher/create_titles');
            }

            $notifications = $this->notifications();

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('teacher.createTitles', ['training_programs' => $training_programs, 'degrees' => $degrees, 'teacher' => $teacher, 'notifications' => $notifications, 'message' => $message]);
        } else {
            return redirect('/');
        }
    }
}
