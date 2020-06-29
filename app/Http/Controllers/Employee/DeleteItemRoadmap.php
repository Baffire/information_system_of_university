<?php

namespace App\Http\Controllers\Employee;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;
use App\Roadmap;
use Illuminate\Http\Request;

class DeleteItemRoadmap extends Controller
{
    use CheckRole;

    public function deleteItemRoadmap(Request $request, $id)
    {
        if ($this->checkRole()) {

            $roadmap_item = Roadmap::find($id);

            Degree_of_preparation::where('roadmap_id', $id)->delete();
            Roadmap::find($id)->delete();

            $roadmaps = Roadmap::where(['degree_id' => $roadmap_item->degree_id, 'training_program_id' => $roadmap_item->training_program_id, 'year_of_admission' => $roadmap_item->year_of_admission])->get();

            $request->session()->put('message', "Запись удалена");
            $request->session()->put('status', "success");
            $request->session()->put('roadmaps', $roadmaps);

            return redirect()->route('employee_roadmap_get');

        } else {

            return redirect('/');

        }
    }
}
