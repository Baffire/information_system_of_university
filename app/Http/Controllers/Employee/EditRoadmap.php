<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Roadmap;
use Illuminate\Http\Request;

class EditRoadmap extends Controller
{
    use CheckRole;

    public function editRoadmap(Request $request, $id)
    {
        if ($this->checkRole()) {
            $roadmap_item = Roadmap::find($id);

            if ($request->has('name') && $request->has('start_date') && $request->has('finish_date')) {

                $request->validate([
                    'name' => 'required',
                    'start_date' => 'date',
                    'finish_date' => 'required|date',
                ]);

                $roadmap_item->name = $request->name;
                $roadmap_item->start_date = date('Y-m-d H:i', strtotime($request->start_date));
                $roadmap_item->finish_date = date('Y-m-d H:i', strtotime($request->finish_date));

                $roadmap_item->save();

                $roadmaps = Roadmap::where(['degree_id' => $roadmap_item->degree_id, 'training_program_id' => $roadmap_item->training_program_id, 'year_of_admission' => $roadmap_item->year_of_admission])->get();

                $request->session();
                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");
                $request->session()->put('roadmaps', $roadmaps);

                return redirect()->route('employee_roadmap_get');

            }

            return view('employee.editRoadmap', ['roadmap_item' => $roadmap_item]);

        } else {

            return redirect('/');

        }
    }
}
