<?php

namespace App\Http\Traits;

use Auth;

trait isActivated
{

    public function isActivated()
    {
        $user = Auth::user();

        if ($user->user_status != '0') {
            return true;
        } else {
            return false;
        }
    }
}
