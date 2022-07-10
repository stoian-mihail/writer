<?php

namespace App\Http\Controllers\Api;

use Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\storeImagesTrait;
use Illuminate\Support\Facades\Storage;

class CropPhotoController extends Controller
{
    use storeImagesTrait;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        //  a trebuit sa redenumesc fisierele dupa adaugare pentru ca altfel ramaneau cacheuite
        $input_data = $request->input();
        $photo = $input_data['photo_model']::with('post', 'thumbnail')->find($input_data['photo_id']);
        $post = $photo->post;

        $storage_folder = $post->storage_folder;
        Storage::deleteDirectory($storage_folder);

        $storage_folder_for_url = str_replace('public/', '', $storage_folder);

        $file_name = $post->uuid  . ".jpg";
        $new_file_name = Str::uuid()->toString().now()->format('Y-m-d-H-m-s');

        $file_name = $new_file_name.'.jpg';
        $photo->file_name = $file_name;
        $photo->file_url ="/storage/$storage_folder_for_url"."{$file_name}";

        $photo->save();


        $file =  $request->file('image');

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

        Storage::put("$storage_folder/{$file_name}", $fileResized->__toString());


        $thumb_name = $new_file_name.'-thumbnail'.'.jpg';

        // we also change the thumbnail

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
                Storage::put("$storage_folder/thumbnails/$thumb_name", $fileResized->__toString());
                $fileUrlThumb = "/storage/$storage_folder_for_url"."thumbnails/{$thumb_name}";

        $photoThumbnail = $photo->thumbnail;
        $photoThumbnail->file_url = $fileUrlThumb;
        $photoThumbnail->save();
    }
}
