<?php

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CreateRoadmap extends Controller
{
    use CheckRole;

    public function createRoadmap(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $faculty_id = $item->faculty_id;
            }

            $degrees = Degree::all();
            $training_programs = Training_program::where(['faculty_id' => $faculty_id])->get();

            if ($request->has('degree') && $request->has('training_program') && $request->has('year_of_admission') && $request->has('file')) {

                $request->validate([
                    'degree' => 'required',
                    'training_program' => 'required',
                    'year_of_admission' => 'required',
                    'file' => 'required|file|mimes:xls,xlsx|bail',
                ]);

                $degree = $request->degree;
                $training_program = $request->training_program;
                $year_of_admission = $request->year_of_admission;

                $roadmaps = Roadmap::where(['training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->first();

                if (empty($roadmaps->id)) {
                    $path = $request->file('file')->store(
                        'public/roadmaps/' . $request->user()->id . '-' . date('d.m.Y')
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

                    for ($i = 2; $i < 100; $i++) {
                        $name = $spreadsheet->getActiveSheet()->getCell("A$i")->getValue();
                        $names[] = $name;
                    }

                    $start_dates = [];

                    for ($i = 2; $i < 100; $i++) {
                        $start_date = $spreadsheet->getActiveSheet()->getCell("B$i")->getFormattedValue();
                        $start_dates[] = $start_date;
                    }

                    $finish_dates = [];

                    for ($i = 2; $i < 100; $i++) {
                        $finish_date = $spreadsheet->getActiveSheet()->getCell("C$i")->getFormattedValue();
                        $finish_dates[] = $finish_date;
                    }

                    for ($i = 0; $i < count($names); $i++) {
                        if ($names[$i] != null) {

                            $roadmap = new Roadmap();

                            $roadmap->degree_id = $degree;
                            $roadmap->training_program_id = $training_program;
                            $roadmap->year_of_admission = $year_of_admission;
                            $roadmap->name = $names[$i];

                            if (!empty($start_dates[$i])) {

                                $roadmap->start_date = date('Y-m-d H:i:s', strtotime($start_dates[$i]));
                            } else {
                                $roadmap->start_date = null;
                            }

                            if (!empty($finish_dates[$i])) {
                                $roadmap->finish_date = date('Y-m-d H:i:s', strtotime($finish_dates[$i]));
                            } else {
                                $roadmap->finish_date = null;
                            }

                            $roadmap->save();

                            $control_types = Roadmap::where(['training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->get();
                            $studs = Student::where(['training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->get();

                            foreach ($studs as $stud) {

                                $degree_of_preparation = new Degree_of_preparation();

                                foreach ($control_types as $control_type) {

                                    $degree_of_preparation->student_id = $stud->id;
                                    $degree_of_preparation->roadmap_id = $control_type->id;

                                }

                                $degree_of_preparation->save();
                            }
                        } else {
                            break;
                        }
                    }

                    $request->session();
                    $request->session()->put('message', "Дорожная карта успешно добавлена");
                    $request->session()->put('status', "success");

                    return redirect('/employee/roadmap/create');

                } else {

                    $request->session();
                    $request->session()->put('message', "Дорожная карта уже существует");
                    $request->session()->put('status', "danger");

                    return redirect('/employee/roadmap/create');
                }
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.createRoadmap', ['degrees' => $degrees, 'training_programs' => $training_programs, 'message' => $message, 'status' => $status]);

        } else {

            return redirect('/');

        }
    }
}
