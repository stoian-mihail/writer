<?php

namespace App\Http\Traits;

use App\Http\Traits\ConvertImageTrait;
use App\Models\PhotoThumbnail;
use Illuminate\Support\Facades\Storage;
use Auth;
use Image;

trait createThumbnailTrait
{
    use ConvertImageTrait;

    public function createThumbnail($file, $name, $base_directory)
    {
        $file_name = $name . '-thumbnail' . ".jpg";

        ob_start();
        $this->convertImage($file, null, 100);
        $file = ob_get_contents();
        ob_end_clean();

        $img = Image::make($file);

        $width = 600;
        $height = 600;
        if ($img->height() > $height || $img->width() > $width) {
            $img->height() > $img->width() ? $width = null : $height = null;
            $fileResized = $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
        } else {
            $fileResized = $img->encode('jpg');
        }
        Storage::put("public/$base_directory/thumbnails/{$file_name}", $fileResized->__toString());
        $fileUrl = "/storage/$base_directory/thumbnails/{$file_name}";

        $photoThumbnail = PhotoThumbnail::create([
            'file_name' => $file_name,
            'file_url' => $fileUrl,
        ]);


        return $photoThumbnail;
    }
}
