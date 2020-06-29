<?php
/*Controller allows edit requests for title and adviser
 * */

namespace App\Http\Controllers\Head;

use App\Add_teacher;
use App\Adviser;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title;
use App\Title_confirm;
use Illuminate\Http\Request;

class EditConfirmAdvisers extends Controller
{
    use CheckRole;

    public function editConfirmAdvisers(Request $request, $id)
    {
        if ($this->checkRole()) {

            $title = Title_confirm::find($id);
            $title_edit = Title::find($title->title_id);

            $teachers = Teacher::all();

            if ($request->has('name') && $request->has('description') && $request->has('software') && $request->has('teacher')) {

                $request->validate([
                    'name' => 'required|string|max:255|bail',
                    'description' => 'required|string|bail',
                    'software' => 'required|string|bail',
                    'teacher' => 'required|integer|bail',
                    'estimate' => 'required_with_all:order_thesis_defense,date_thesis_defense',
                    'order_thesis_defense' => 'required_with_all:estimate,date_thesis_defense',
                ]);

                $title_edit->name = $request->name;
                $title_edit->description = $request->description;
                $title_edit->software = $request->software;

                $title_edit->save();

                if ($request->has('teacher')) {

                    if ($title->teacher_id != $request->teacher) {
                        //Edit old string in title_confirms table
                        $title->teacher_id = $request->teacher;

                        //Edit old string in advisers table
                        $adviser_old = Adviser::where(['title_id' => $title->title_id, 'confirmation' => 1])->first();
                        $adviser_old->confirmation = null;
                        $adviser_old->save();

                        //Create new string in advisers table
                        $adviser_new = new Adviser();

                        $adviser_new->teacher_id = $request->teacher;
                        $adviser_new->student_id = $title->student_id;
                        $adviser_new->title_id = $title->title_id;
                        $adviser_new->confirmation = 1;

                        $adviser_new->save();
                    }
                }

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
                    }
                }

                if ($request->has('negative')) {
                    if ($request->negative == 1) {
                        $title->negative = $request->negative;
                        $title->confirmation = null;
                        $title->date_control = null;
                    }
                }

                if ($request->has('order')) {
                    $title->order = $request->order;
                }

                if ($request->has('reorder')) {
                    $title->reorder = $request->reorder;
                }

                if ($request->has('estimate') && $request->has('date_thesis_defense') && $request->has('order_thesis_defense')) {
                    if (!empty($request->estimate) && !empty($request->date_thesis_defense) && !empty($request->order_thesis_defense)) {

                        $title->estimate = $request->estimate;
                        $title->order_thesis_defense = $request->order_thesis_defense;

                    } else {
                        $title->estimate = null;
                        $title->order_thesis_defense = null;
                    }
                }

                if ($request->has('date_thesis_defense')) {
                    if (!empty($request->date_thesis_defense)) {
                        $title->date_thesis_defense = date('Y-m-d H:i', strtotime($request->date_thesis_defense));
                    } else {
                        $title->date_thesis_defense = null;
                    }
                }

                $title->save();

                $request->session();
                $request->session()->put('message', "Редактирование успешно завершено");
                $request->session()->put('status', "success");

                return redirect()->route('head_advisers_confirm');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('head.editConfirmAdvisers', ['message' => $message, 'status' => $status, 'title' => $title, 'teachers' => $teachers]);
        } else {
            return redirect('/');
        }
    }
}
