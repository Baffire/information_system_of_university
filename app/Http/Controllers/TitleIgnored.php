<?php
/*
 * This Controller check requests from students to teachers on created date
 */

namespace App\Http\Controllers;

use App\Adviser;

class TitleIgnored extends Controller
{
    public function titleIgnored()
    {
        $titles = Adviser::all();

        foreach ($titles as $title) {
            $date_create = date('U', strtotime("$title->created_at + 2 day"));
            $today = date('U');
            if ( $today > $date_create && $title->confirmation == null && $title->negative == null && $title->ignored == null) {

                $title->ignored = 1;
                $title->save();

            }
        }
    }
}
