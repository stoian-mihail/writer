<?php

namespace App\Http\Traits;

use Illuminate\Support\Carbon;

trait calculateScore
{

    public function calculateScore($photo, $userFavorites, $userFollowing, $oldest)
    {
        $score = 0;
        //score received from favorites
        foreach ($photo['tags'] as $tag) {
            if (in_array($tag['id'], $userFavorites)) {
                $score += 50;
            }
        }
        //score received from following
        if (in_array($photo['author_id'], $userFollowing)) {
            $score += 100;
        }
        if ($score == 0) {
            $randomNumber = mt_rand(0, 150);
            if ($randomNumber <= 10) {
                $currentDate = Carbon::now();
                $oldest = new Carbon($oldest);
                $photoDate = new Carbon($photo['created_at']);
                $date_score = (($photoDate->diffInMinutes($oldest)) * 10000) / ($currentDate->diffInMinutes($oldest));
                $score += $date_score;
            }
            return $score;
        }
        $currentDate = Carbon::now();
        $oldest = new Carbon($oldest);
        $photoDate = new Carbon($photo['created_at']);
        $date_score = (($photoDate->diffInMinutes($oldest)) * 10000) / ($currentDate->diffInMinutes($oldest));
        $score += $date_score;

        return $score;
    }
}
