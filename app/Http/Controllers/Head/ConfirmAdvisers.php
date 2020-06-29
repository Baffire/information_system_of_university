<?php
/*Controller allows set status on advisers
 * */

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use App\Title_confirm;

class ConfirmAdvisers extends Controller
{
    use CheckRole;

    public function confirmAdvisers($confirm, $id)
    {
        if ($this->checkRole()) {

            $title = Title_confirm::find($id);

            if ($confirm == 1) {
                $title->confirmation = 1;
                $title->date_control = date('Y-m-d H:i:s');
            }

            if ($confirm == 0) {
                $title->negative = 1;
            }

            $title->save();

            return redirect('head/advisers');

        } else {
            return redirect('/');
        }
    }
}
