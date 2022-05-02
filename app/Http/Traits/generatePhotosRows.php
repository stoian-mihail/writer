<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait generatePhotosRows
{

    public function generatePhotosRows($photos)
    {
        if ($photos->isNotEmpty()) {
            // this code calculates the rows composition based on the photo ratios
            $row_number = 0;
            $row_ratio = 0;
            $rows = array();
            $rowRatioArray = array(); // the total ratios of each row saved in an array
            foreach ($photos as $key => $photo) {
                // $photo = collect($photo);

                if (!Storage::exists(preg_replace('/storage/', 'public', $photo->file_url))) {
                    $photos->forget($key);
                } else {
                    if (($row_ratio + $photo->ratio) <= 6) { //we calculate if any more photos fit the row; 6 total ratio means 4x1.5 (normal photos)
                        $row_ratio += $photo->ratio; // we add the photo ratio to the total row ratio
                        $rows[$row_number][] = $photo; // we add the photo to the row array
                        $rowRatioArray[$row_number] = $row_ratio; // we save the ratio of the row in an array
                    } else { //we create a new row
                        $row_ratio = 0 + $photo->ratio; // we reset the row ratio value and start adding the new photo ratios
                        $row_number++;
                        $rows[$row_number][] = $photo;
                        $rowRatioArray[$row_number] = $row_ratio;
                    }
                }
            }

            // we check if there is just one element in the last row and we alter the ratio so that it doesn't become to big
            if (isset($rows[$row_number])) {
                $noElementsLastRow = count($rows[$row_number]);
                if ($noElementsLastRow == 1) {
                    $rowRatioArray[$row_number] = 4;
                }
            }
            $results['rows'] = $rows;
            $results['rowRatioArray'] = $rowRatioArray;
            return $results;
        } else {

            $results['rows'] = null;
            $results['rowRatioArray'] = null;
            return $results;
        }
    }
}
