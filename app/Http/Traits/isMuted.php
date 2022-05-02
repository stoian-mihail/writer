<?php

namespace App\Http\Traits;

use Auth;

trait isMuted
{

    public function isMuted()
    {
        $user = Auth::user();

        if ($user->muted == true) {
            return true;
        } else {
            return false;
        }
    }
}
