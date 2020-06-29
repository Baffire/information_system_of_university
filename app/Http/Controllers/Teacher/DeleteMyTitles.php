<?php
/*Controller delete title on id if it has control == null and negative == null
 * */

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;

class DeleteMyTitles extends Controller
{
    use CheckRole;

    public function deleteMyTitles(Request $request, $id)
    {
        if ($this->checkRole()) {

            Title::where(['id' => $id])->delete();

            return redirect('/teacher/my_titles');
        } else {
            return redirect('/');
        }
    }
}
