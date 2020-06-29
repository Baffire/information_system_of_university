<?php

namespace App\Http\Controllers\Employee;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;
use App\Roadmap;
use Illuminate\Http\Request;

class EditProgress extends Controller
{
    use CheckRole;

    public function editProgress(Request $request, $id)
    {
        if ($this->checkRole()) {
            $roadmap_item = Roadmap::find($id);

            $degree_of_preparation = Degree_of_preparation::where(['roadmap_id' => $id])->get();

            if ($request->has("submit")) {
                if (!empty($request->except(['_token', 'submit']))) {

                    $checkboxes = $request->except(['_token', 'submit']);

                    foreach ($degree_of_preparation as $degree) {

                        if (isset($checkboxes[$degree->student_id])) {
                            if ($checkboxes[$degree->student_id] == 1) {

                                $degree->employee_confirm = 1;
                                $degree->employee_negative = null;
                                $degree->save();

                            } elseif ($checkboxes[$degree->student_id] == 0) {

                                $degree->employee_negative = 1;
                                $degree->employee_confirm = null;
                                $degree->save();

                            } else {

                                $degree->employee_negative = null;
                                $degree->employee_confirm = null;
                                $degree->save();
                            }
                        }


                    }
                }

                $roadmaps = Roadmap::where(['degree_id' => $roadmap_item->degree_id, 'training_program_id' => $roadmap_item->training_program_id, 'year_of_admission' => $roadmap_item->year_of_admission])->get();

                $request->session();
                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");
                $request->session()->put('roadmaps', $roadmaps);

                return redirect()->route('employee_progress_get');
            }

            return view('employee.editProgress', ['roadmap_item' => $roadmap_item, 'degree_of_preparation' => $degree_of_preparation]);

        } else {

            return redirect('/');

        }
    }
}
