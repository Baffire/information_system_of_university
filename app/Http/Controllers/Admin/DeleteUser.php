<?php
/* The Controller delete one user on cascade
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DeleteUser extends Controller
{
    use CheckRole;

    public function deleteUser(Request $request, $id)
    {
        if ($this->checkRole()) {

            User::foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            return redirect('admin/users');
        } else {
            return redirect('/');
        }
    }
}
