<?php
/*Controller allows edit confirm requests for title and adviser
 * */

namespace App\Http\Controllers\Head;

use App\Add_teacher;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title_confirm;
use Illuminate\Http\Request;

class EditAdvisers extends Controller
{
    use CheckRole;

    public function editAdvisers(Request $request, $id)
    {
        if ($this->checkRole()) {

            $title = Title_confirm::find($id);

            $teachers = Teacher::all();

            if ($request->has('name') && $request->has('description') && $request->has('software') && $request->has('software')) {

                if ($request->has('add_teacher')) {

                    $confirm_title_add_teacher = Add_teacher::where('title_confirm_id', $id)->first();

                    if ($request->add_teacher == 0) {
                        Add_teacher::where('title_confirm_id', $id)->delete();
                    } elseif (empty($confirm_title_add_teacher)) {
                        $add_teacher = new Add_teacher();

                        $add_teacher->title_confirm_id = $id;
                        $add_teacher->teacher_id = $request->add_teacher;

                        $add_teacher->save();
                    } else {
                        $confirm_title_add_teacher->title_confirm_id = $id;
                        $confirm_title_add_teacher->teacher_id = $request->add_teacher;

                        $confirm_title_add_teacher->save();
                    }
                }

                if ($request->has('confirm')) {
                    if ($request->confirmation == 1) {
                        $title->confirmation = $request->confirm;
                        $title->date_control = date('Y-m-d');
                        $title->negative = null;
                    } else {
                        $title->confirmation = null;
                        $title->date_control = null;
                        $title->negative = null;
                    }
                }

                if ($request->has('negative')) {
                    if ($request->negative == 1) {
                        $title->negative = $request->negative;
                        $title->confirmation = null;
                        $title->date_control = null;
                    } else {
                        $title->negative = null;
                    }
                }

                if ($request->has('order')) {
                    $title->order = $request->order;
                }


                $title->save();

                $request->session();
                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");

                return redirect('/head/advisers');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('head.editAdvisers', ['message' => $message, 'status' => $status, 'title' => $title, 'teachers' => $teachers]);
        } else {
            return redirect('/');
        }
    }
}
