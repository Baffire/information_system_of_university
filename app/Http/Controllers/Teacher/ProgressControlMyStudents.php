<?php
/*
 * This Controller setup value 1 in confirmation field in degree_of_preparations table
 */

namespace App\Http\Controllers\Teacher;

use App\Degree_of_preparation;
use App\Http\Controllers\Controller;

class ProgressControlMyStudents extends Controller
{
    use CheckRole;

    public function progressControlMyStudents($confirm, $id, $student_id)
    {
        if ($this->checkRole()) {
            $degree_of_preparation = Degree_of_preparation::find($id);

            if ($confirm == 1) {
                $degree_of_preparation->confirmation = 1;
            }

            if ($confirm == 0) {
                $degree_of_preparation->negative = 1;
            }

            $degree_of_preparation->save();

            return redirect("/teacher/my_students/progress/$student_id");
        } else {
            return redirect('/');
        }
    }
}
