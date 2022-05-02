<?php

namespace App\Http\Traits;


trait generateAlbumRows
{
    public function generateAlbumRows($albums)
    {
        if ($albums) {
            $rows = array();
            $rowRatioArray = array();
            $ratioSumArray = array();
            $albumsNo = count($albums);
            $thumbnail = array();
            $results = array();
            $row_number = 0;
            //we pass through all albums first
            for ($i = 0; $i < $albumsNo; $i = $i + 2) {
                // we use a double for to generate each row so that it contains 2 albums => i=i+2. k<=i+1 make this possible
                for ($k = $i; $k <= $i + 1; $k++) {
                    if ($albums[$k]->photos->count() > 0) {

                        //here we add the first column of the row containing album thumbnails
                        $rows[$row_number][$k] = $albums[$k];
                        //here we generate the thumbnail structure
                        if ($albums[$k]->photos[0]->ratio > 1) {
                            $row_ratio = 0;
                            //here we add the first big photo as a row
                            $thumbnail[$k][0] = $albums[$k]->photos[0];
                            //here with create a row of the other photos
                            for ($j = 1; $j < sizeof($albums[$k]->photos); $j++) {
                                if (sizeof($albums[$k]->photos) > 2) {
                                    if (($row_ratio + $albums[$k]->photos[$j]->ratio) <= 4.5) {
                                        $thumbnail[$k][1][] = $albums[$k]->photos[$j];
                                        $row_ratio = $row_ratio + $albums[$k]->photos[$j]->ratio;
                                        $rowRatioArray[$k] = $row_ratio;
                                    } else {

                                        break;
                                    }
                                }
                            }
                        } else {
                            $col_ratio = 0;
                            $ratioSum = 0;
                            // here we add the first big photo as a column
                            $thumbnail[$k][0][0] = $albums[$k]->photos[0];
                            //here we generate the second column
                            for ($j = 1; $j < sizeof($albums[$k]->photos); $j++) {
                                if (($col_ratio + $albums[$k]->photos[$j]->ratio) <= 4) {
                                    $thumbnail[$k][0][1][] = $albums[$k]->photos[$j];
                                    $col_ratio = $col_ratio + 1 / $albums[$k]->photos[$j]->ratio;
                                    $rowRatioArray[$k] = $col_ratio;
                                    $ratioSum = $ratioSum + 1 / $albums[$k]->photos[$j]->ratio;
                                    $ratioSumArray[$k] = $ratioSum;
                                } else {

                                    break;
                                }
                            }
                        }
                    }
                    if ($k == $albumsNo - 1) {
                        break;
                    }
                }
                $row_number++;
            }
            $results['rows'] = $rows;
            $results['rowRatioArray'] = $rowRatioArray;
            $results['thumbnail'] = $thumbnail;
            $results['ratioSumArray'] = $ratioSumArray;
            return $results;
        }
    }
}
