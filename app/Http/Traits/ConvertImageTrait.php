<?php

namespace App\Http\Traits;


trait ConvertImageTrait
{

    public function convertImage($originalImage, $outputImage, $quality)
    {
        $ext = $originalImage->extension();

        if (preg_match('/jpg|jpeg/i', $ext)) {
            $imageTmp = imagecreatefromjpeg($originalImage);
        } else {
            if (preg_match('/png/i', $ext)) {
                $imageTmp = imagecreatefrompng($originalImage);
            } else {
                if (preg_match('/gif/i', $ext)) {
                    $imageTmp = imagecreatefromgif($originalImage);
                } else {
                    if (preg_match('/bmp/i', $ext)) {
                        $imageTmp = imagecreatefrombmp($originalImage);
                    } else {
                        return 0;
                    }
                }
            }
        }
        if ($ext == 'jpg' || $ext == 'jpeg') {
            $exif = exif_read_data($originalImage);

            if (isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                switch ($orientation) {
                    case 2:
                        imageflip($imageTmp, IMG_FLIP_HORIZONTAL);
                        break;
                    case 3:
                        $imageTmp = imagerotate($imageTmp, 180, 0);
                        break;
                    case 4:
                        imageflip($imageTmp, IMG_FLIP_VERTICAL);
                        break;
                    case 5:
                        $imageTmp = imagerotate($imageTmp, -90, 0);
                        imageflip($imageTmp, IMG_FLIP_HORIZONTAL);
                        break;
                    case 6:
                        $imageTmp = imagerotate($imageTmp, -90, 0);
                        break;
                    case 7:
                        $imageTmp = imagerotate($imageTmp, 90, 0);
                        imageflip($imageTmp, IMG_FLIP_HORIZONTAL);
                        break;
                    case 8:
                        $imageTmp = imagerotate($imageTmp, 90, 0);
                        break;
                }
            }
        }
        imagejpeg($imageTmp, $outputImage, $quality);
    }
}
