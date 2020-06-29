<?php

namespace App\Http\Controllers\Employee;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;
use App\Roadmap;
use App\Student;
use Illuminate\Http\Request;

class CreateItemRoadmap extends Controller
{
    use CheckRole;

    public function createItemRoadmap(Request $request)
    {
        if ($this->checkRole()) {                    //Check role permission

            if ($request->has('name') && $request->has('start_date') && $request->has('finish_date')) {

                $request->validate([
                    'name' => 'required',
                    'start_date' => 'date',
                    'finish_date' => 'required|date',
                ]);

                $request->session();
                $old_roadmaps = $request->session()->get('roadmaps');

                foreach ($old_roadmaps as $old_roadmap) {

                    $degree_id = $old_roadmap->degree_id;
                    $training_program_id = $old_roadmap->training_program_id;
                    $year_of_admission = $old_roadmap->year_of_admission;
                }

                $roadmap_item = new Roadmap();

                $roadmap_item->degree_id = $degree_id;
                $roadmap_item->training_program_id = $training_program_id;
                $roadmap_item->year_of_admission = $year_of_admission;
                $roadmap_item->name = $request->name;
                $roadmap_item->start_date = date('Y-m-d H:i', strtotime($request->start_date));
                $roadmap_item->finish_date = date('Y-m-d H:i', strtotime($request->finish_date));

                $roadmap_item->save();

                $control_type = Roadmap::where(['training_program_id' => $training_program_id, 'year_of_admission' => $year_of_admission])->orderBy('created_at', 'desc')->first();
                $studs = Student::where(['training_program_id' => $training_program_id, 'year_of_admission' => $year_of_admission])->get();

                foreach ($studs as $stud) {

                    $degree_of_preparation = new Degree_of_preparation();

                    $degree_of_preparation->student_id = $stud->id;
                    $degree_of_preparation->roadmap_id = $control_type->id;

                    $degree_of_preparation->save();
                }

                $roadmaps = Roadmap::where([ 'degree_id' => $roadmap_item->degree_id, 'training_program_id' => $roadmap_item->training_program_id, 'year_of_admission' => $roadmap_item->year_of_admission ])->get();

                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");
                $request->session()->put('roadmaps', $roadmaps);

                return redirect()->route('employee_roadmap_get');

            }

            return view('employee.createItemRoadmap');

        } else {

            return redirect('/');

        }
    }
}
