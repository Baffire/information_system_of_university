<?php
/*Controller edit title on id if it has control == null and negative == null
 * */

namespace App\Http\Controllers\Teacher;

use App\Degree;
use App\Http\Controllers\Controller;
use App\Title;
use App\Training_program;
use Illuminate\Http\Request;

class EditMyTitles extends Controller
{
    use CheckRole;

    public function editMyTitles(Request $request, $id)
    {
        if ($this->checkRole()) {

            $title = Title::find($id);
            $training_programs = Training_program::where('faculty_id', $title['faculty_id'])->get();
            $degrees = Degree::all();

            $training_program = Training_program::where('id', $title['training_program_id'])->first();
            $degree = Degree::where('id', $title['degree_id'])->first();

            if ($request->has('name') && $request->has('description') && $request->has('software') && $request->has('degree') && $request->has('training_program')) {

                $request->validate([
                    'name' => 'required|string|max:255|bail',
                    'description' => 'required|string|bail',
                    'software' => 'required|string|bail',
                    'training_program' => 'required|bail',
                    'degree' => 'required|bail',
                ]);

                $title->name = $request->name;
                $title->description = $request->description;
                $title->software = $request->software;

                $title->save();

                $request->session();
                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");

                return redirect()->route('teacher_my_titles');
            }

            return view('teacher.editTitle', ['title' => $title, 'training_programs' => $training_programs, 'degrees' => $degrees, 'training_program' => $training_program, 'degree' => $degree]);
        } else {
            return redirect('/');
        }
    }
}
