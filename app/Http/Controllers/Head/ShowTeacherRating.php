<?php
/*Controller show teachers rating
 * */

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title;
use App\Title_confirm;

class ShowTeacherRating extends Controller
{
    use CheckRole;

    public function showTeacherRating($id)
    {
        if ($this->checkRole()) {

            $teacher = Teacher::find($id);

            $title_requests_negative = Title::where(['teacher_id' => $id, 'negative' => 1])->count();
            $title_requests_confirm = Title::where(['teacher_id' => $id, 'control' => 1])->count();
            $title_requests_unknown = Title::where(['teacher_id' => $id, 'negative' => null, 'control' => null])->count();
            $title_requests_all = Title::where('teacher_id', $id)->count();

            $advisers_thesis_defense = Title_confirm::where(['teacher_id' => $id, 'confirmation' => 1, ['estimate', '!=', null]])->count();

            $advisers_thesis_defense_a = Title_confirm::where(['teacher_id' => $id, 'confirmation' => 1, 'estimate' => 'отлично'])->count();
            $advisers_thesis_defense_b = Title_confirm::where(['teacher_id' => $id, 'confirmation' => 1, 'estimate' => 'хорошо'])->count();
            $advisers_thesis_defense_c = Title_confirm::where(['teacher_id' => $id, 'confirmation' => 1, 'estimate' => 'удовлетнорительно'])->count();
            $advisers_thesis_defense_d = Title_confirm::where(['teacher_id' => $id, 'confirmation' => 1, 'estimate' => 'неудовлетворительно'])->count();

            $title_requests = Title::where('teacher_id', $id)->orderBy('created_at', 'desc')->paginate(3);

            return view('head.showTeacherRating',
                [
                    'teacher' => $teacher,
                    'title_requests' => $title_requests,
                    'title_requests_negative' => $title_requests_negative,
                    'title_requests_confirm' => $title_requests_confirm,
                    'title_requests_all' => $title_requests_all,
                    'title_requests_unknown' => $title_requests_unknown,
                    'advisers_thesis_defense' => $advisers_thesis_defense,
                    'advisers_thesis_defense_a' => $advisers_thesis_defense_a,
                    'advisers_thesis_defense_b' => $advisers_thesis_defense_b,
                    'advisers_thesis_defense_c' => $advisers_thesis_defense_c,
                    'advisers_thesis_defense_d' => $advisers_thesis_defense_d,
                ]
            );

        } else {
            return redirect('/');
        }
    }
}
