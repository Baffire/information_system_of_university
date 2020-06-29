<?php
/*Controller allows download files from templates
 * */

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class DownloadTemplate extends Controller
{
    use CheckRole;

    public function downloadTemplate($name)
    {
        if ($this->checkRole()) {

            $dir_path = $_SERVER['DOCUMENT_ROOT'];
            $dir = str_replace('public', 'storage/app/public/templates/', $dir_path);
            $file = $dir . $name . '.xlsx';

            return response()->download($file);

        } else {
            return redirect('/');
        }
    }
}
