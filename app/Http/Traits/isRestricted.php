<?php

namespace App\Http\Traits;

use Auth;

trait isRestricted
{

    public function isRestricted()
    {
        $user = Auth::user();

        if ($user->user_status !== '1') {
            return true;
        } else {
            return false;
        }
    }
}
