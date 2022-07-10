<?php

namespace App\Http\Traits;

use Auth;
use Image;
use App\PhotoThumbnail;
use App\Http\Traits\ConvertImageTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\createThumbnailTrait;

trait storeImagesTrait
{
    use ConvertImageTrait;
    use createThumbnailTrait;

    public function storeImages($input_data, $model, $base_directory, $seo_title = null, $belongs_to){
        if(isset($input_data['albumImage'])){
            foreach ($input_data['albumImage'] as $key => $file) {
                if ($file->isValid()) {
                    $file_name = $seo_title . "-" . $key . ".jpg";
                    $thumb_name = $seo_title . "-" . $key;

                    $thumbnail = $this->createThumbnail($file, $thumb_name, $base_directory, $seo_title);

                    ob_start();
                    $this->convertImage($file, null, 100);
                    $file = ob_get_contents();
                    ob_end_clean();


                    $img = Image::make($file);

                    $width = 1920;
                    $height = 1920;
                    $ratio = $img->width() / $img->height();
                    $ratio = number_format($ratio, 2);
                    if ($img->height() > $height || $img->width() > $width) {
                        $img->height() > $img->width() ? $width = null : $height = null;
                        $fileResized = $img->resize($width, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        })->encode('jpg');
                    } else {
                        $fileResized = $img->encode('jpg');
                    }

                    Storage::put("public/$base_directory/$seo_title/{$file_name}", $fileResized->__toString());
                    $fileUrl = "/storage/$base_directory/$seo_title/{$file_name}";
                    $model_name = '\App\Models\\'.$model;

                    $photo = $model_name::create([
                        'file_name' => $file_name,
                        'file_url' => $fileUrl,
                        'thumbnail_id' => $thumbnail->id,
                        'belongs_id'=>$belongs_to->id
                    ]);
                } else {
                    Storage::deleteDirectory("public/$base_directory");
                    $belongs_to->delete();
                    return response()->json([
                        'message' => 'S-a produs o eroare in timpul uploadarii! Verifica conexiunea si incearca din nou!',
                        'success' => false
                    ]);
                }
            }
        }

    }
}
