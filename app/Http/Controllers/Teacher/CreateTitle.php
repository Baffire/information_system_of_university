<?php
/*Controller create one new title
 * */

namespace App\Http\Controllers\Teacher;

use App\Degree;
use App\Department;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTitle extends Controller
{
    use CheckRole;
    use Notifications;

    public function createTitle(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $teacher = Teacher::where('user_id', $user_id)->get();

            foreach ($teacher as $item) {
                $teacher_id = $item->id;
                $faculty_id = $item->faculty_id;
                $department_id = $item->department_id;
            }

            $department = Department::where('id', $department_id)->get();

            foreach ($department as $item) {
                $department_name = $item->name;
            }

            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();
            $degrees = Degree::all();

            if ($request->has('name') && $request->has('description') && $request->has('software') && $request->has('training_program') && $request->has('degree')) {

                $request->validate([
                    'name' => 'required|string|max:255|unique:App\Title,name|bail',
                    'description' => 'required|string|bail',
                    'software' => 'required|string|bail',
                    'training_program' => 'required|integer|bail',
                    'degree' => 'required|integer|bail',
                ]);

                $title = new Title;

                $title->name = $request->name;
                $title->faculty_id = $faculty_id;
                $title->department_id = $department_id;
                $title->teacher_id = $teacher_id;
                $title->description = $request->description;
                $title->software = $request->software;
                $title->training_program_id = $request->training_program;
                $title->degree_id = $request->degree;

                $title->save();

                $request->session();
                $request->session()->put('message', "Тема добавлена");
                $request->session()->put('status', "success");

                return redirect()->route('teacher_my_titles');
            }

            $notifications = $this->notifications();

            return view('teacher.createTitle', ['training_programs' => $training_programs, 'degrees' => $degrees, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
