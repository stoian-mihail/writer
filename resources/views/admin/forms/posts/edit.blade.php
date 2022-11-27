
<div class="row m-0 justify-content-center">
    <div class="col-12 col-md-10" id="form-div">
        <div class="row text-center mt-3">
            <h5>Editeaza {{$post_type}}</h5>
        </div>
        
        <form id="add_post_form" method='post' action='{{route($route, $post)}}' enctype="multipart/form-data">

            @csrf
            <div class="form-group mt-3">
                <label for="title">Titlu {{$post_type}}</label>
                <input type="text" class="form-control" required id="title" aria-describedby="title_help" placeholder="Scrie titlu {{$post_type}}" name='title'
                     value="{{$post->title}}"> 
                @error('title')
                <p>{{ $message }}</p>
                @enderror
            </div>
            @isset($volumes)
            <div class="form-group">
                <label for="date" class="me-2">Volum fragment:</label>
                <select name="volume_id" class="form-control" required id="fragment_volumes">
                    <option disabled selected>Alege volum</option>
                    @foreach($volumes as $volume)
                    <option
                    @if($post->volume_id == $volume->id)
                       selected
                   @endif
                        value="{{$volume->id}}">{{$volume->prod_name}}</option>
                    @endforeach
                </select>
            </div>
            @endisset
            @isset($categories)
            <div class="form-group mt-3">
                <label for="date" class="me-2">Categorie {{$post_type}}:</label>
                <select name="category_id" class="form-control" required id="post_categories">
                    <option disabled selected>Alege categorie</option>
                    @foreach($categories as $category)
                    <option                    
                     @if($post->category_id == $category->id)
                      selected
                    @endif
                        value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

            </div>
            @endisset

            <div class="form-group mt-3">
                <label for="text">Text {{$post_type}}

                    (HTML)

                </label>
                <textarea style='min-height:600px;' required class="form-control" id="text" aria-describedby="text_help"
                          name='text'>{{ $post->text }}</textarea>

            </div>
            @isset($tags)

            <div class="form-group mt-3">
                <label for="tags" class="me-2">Cuvinte cheie:</label>
                <select class="form-control" id="tags" name="tags[]" required multiple="multiple" value="">
                </select>
            </div>
            @endisset


            <div class="form-group mt-3">
                <label for="post_meta_title">SEO: {{"<title>"}} tag (optional)</label>
                <input class="form-control" id="post_meta_title" aria-describedby="post_meta_title_help"
                       name='meta_title' type='text' value="{{$post->meta_title}}">
            </div>

            <div class="form-group mt-3">
                <label for="post_meta_description">Meta Desc (optional)</label>
                <textarea class="form-control" id="post_meta_description" aria-describedby="post_meta_description_help"
                          name='meta_description'>{{ $post->meta_description }}</textarea>
                <small id="post_meta_description_help" class="form-text text-muted">Meta description (optional)</small>
            </div>

             <div class="row mt-3">
                <div class="col-6">
                    <div class="form-group pl-2">
                        <div class="row m-0">Pune pe prima pagina</div>
                        <label for="da">Da:</label>
                        <input type="radio" id="da" name="is_main" value='1' @if($post->is_main)
                        checked
                        @endif
                        >
                        <br>
                        <label for="nu">NU</label>
                        <input type="radio" id="nu" name="is_main" value='0' 
                        @if(!$post->is_main)
                        checked
                        @endif
                        >
                    </div>
                </div>
                
                @if ($post->photo && !isset($volumes))
                    <div class="col-6 thumb_edit_container">
                        <div class="row justify-content-start">
                            <h5>Poza curenta:</h5>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-6">
                                <img src="{{ $post->photo->thumbnail->file_url}}" id="current_thumbnail" alt="event image"
                                    class="img-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary w-100"
                                            onclick="previewFile('{{$post->photo->file_url}}')">Editeaza</button>
                                    </div>
                                    <div class="col-12">

                                        <button type="button" class="btn btn-danger w-100"
                                            onclick="showModal({{ $post->photo->id}})">Sterge poza</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="form-group mt-3">
                <strong>Schimba thumbnail</strong>

                <div class="custom-file">
                    <input type="hidden" name="albumImage" value="">
                    <label class="custom-file-label form-label" for="albumImage[]" >Alege fotografiile</label>
                    <input type="file" class="custom-file-input form-control" multiple="multiple" id="albumImage"
                        onchange="previewFiles(this.files)" lang="eng" name="albumImage[]">
            
                </div>
            </div>
            <div class="row justify-content-center" id="preview"></div>

            <div class="row m-0 justify-content-end mt-5 me-2">
                <input type='submit' name="submit_btn" class='btn btn-primary btn-lg col-auto'
                       value='Salveaza {{$post_type}}'>
            </div>


        </form>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-auto">
        <!-- This is the modal -->
        <div class="modal" tabindex="-1" role="dialog" id="uploadimageModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0 pt-2">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="image-crop-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="mr-5">Regleaza cu ajutorul scrollului sau al barei</span>
                        <button type="button" onclick="removeFile()" class="btn btn-secondary"
                            data-dismiss="modal">Anuleaza</button>
                        <button id="cropresult" type="button" class="btn btn-success">Salveaza</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.deletemodal',['object'=>"imaginea"])