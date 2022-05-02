<?php

namespace App\Http\Traits;

use Auth;

trait BlockedTrait
{

    public function isBlockingOrBlocked($id)
    {


        $user = Auth::user();
        $blockedUsers = $user->isBlocking;
        $blockedByUsers = $user->isBlockedBy;
        $blockedStatus = ['isBlocking' => false, 'isBlocked' => false];
        foreach ($blockedUsers as $blockedUser) {
            if ($blockedUser->blocking_id == $id) {
                $blockedStatus['isBlocking'] = true;
                return $blockedStatus;
            }
        }

        foreach ($blockedByUsers as $blockedByUser) {
            if ($blockedByUser->user_id == $id) {
                $blockedStatus['isBlocked'] = true;
                return $blockedStatus;
            }
        }
        return $blockedStatus;
    }
}
