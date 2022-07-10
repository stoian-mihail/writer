<?php

namespace App\Http\Controllers;

// use App\Http\Traits\generatePhotosRows;
use Image;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use App\Http\Traits\seoUrlTrait;
use App\Http\Traits\storeImagesTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MultimediaController extends Controller
{
    use seoUrlTrait;
    use storeImagesTrait;
    // use generatePhotosRows;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Multimedia::latest()->paginate(50);
        return view('admin.multimedia.index', ['media' => $media,

    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.multimedia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input_data = $request->all();
        $validator = Validator::make($request->all(), [
            'albumImage' => ['array', 'required', 'max:12'],
            'albumImage.*' => ['mimes:jpg,jpeg,png,bmp', 'max:20000', 'required'],
        ]);
        if ($validator->passes()) {
            foreach ($input_data['albumImage'] as $key => $file) {
                if ($file->isValid()) {
                    $seo_title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $seo_title = $this->seoUrl($seo_title . now()->format("Y-m-d H:i:s.u"));
                    $file_name = $seo_title . "-" . $key . ".jpg";
                    // $thumb_name = $seo_title . "-" . $key;


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

                    Storage::put("public/media/images/{$file_name}", $fileResized->__toString());
                    $fileUrl = "/storage/media/images/{$file_name}";
                    Multimedia::create([
                        'file_name' => $file_name,
                        'file_url' => $fileUrl
                    ]);
                } else {
                    // Storage::deleteDirectory("public/media/images");
                    return response()->json([
                        'message' => 'S-a produs o eroare in timpul uploadarii! Verifica conexiunea si incearca din nou!',
                        'success' => false
                    ]);
                }
            }

            return response()->json([
                'message' => 'Fotografiile au fost adaugate',
                'success' => true
            ]);
        } else {
            return response()->json('error', $validator->error());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function show(Multimedia $multimedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function edit(Multimedia $multimedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multimedia $multimedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Multimedia  $multimedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $multimedia = Multimedia::find($id);
        Storage::delete("public/media/images/{$multimedia->file_name}");
        // Storage::delete("public/photos/thumbnails/{$photo->thumbnail->file_name}");
        $multimedia->delete();

        return redirect()->back();
    }
}
