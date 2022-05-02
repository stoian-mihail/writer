<?php

namespace App\Http\Traits;

use Auth;

trait BlockedList
{

    public function BlockedList()
    {
        $user = Auth::user();
        $blockedUsers = $user->isBlocking;
        $blockedByUsers = $user->isBlockedBy;
        $blackList = array();
        foreach ($blockedUsers as $blockedUser) {
            $blackList[] = $blockedUser->blocking_id;
        }
        foreach ($blockedByUsers as $blockedByUser) {
            $blackList[] = $blockedByUser->user_id;
        }
        return $blackList;
    }
}
