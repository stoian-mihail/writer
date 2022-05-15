<div class="row">
    <div class="col-md-12" id="form-div">
        <form id="add_post_form" method='post' action='{{route("admin.posts.store")}}' enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label for="title">Titlu articol</label>
                <input type="text" class="form-control" required id="title" aria-describedby="title_help"
                value="{{old('title')}}" placeholder="Scrie titlu articol"
                name='title'>
                @error('title')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="date" class="me-2">Categorie articol:</label>
                <select name="category_id" id="post_category">
                    <option disabled>Alege categorie</option>

                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="post_body">Text articol

                    (HTML)

                </label>
                <textarea style='min-height:600px;' required class="form-control" id="post_body"
                    aria-describedby="post_body_help" name='post_body'>{{ Request::old('post_body') }}</textarea>

            </div>


            <div class="form-group">
                <label for="post_meta_title">SEO: {{"<title>"}} tag (optional)</label>
                <input class="form-control" id="post_meta_title" aria-describedby="post_meta_title_help"
                    name='meta_title' type='text' value="{{old('meta_title')}}">
             </div>

            <div class="form-group">
                <label for="post_meta_description">Meta Desc (optional)</label>
                <textarea class="form-control" id="post_meta_description" aria-describedby="post_meta_description_help"
                    name='meta_description'>{{ Request::old('meta_description') }}</textarea>
                <small id="post_meta_description_help" class="form-text text-muted">Meta description (optional)</small>
            </div>
            <div class="form-group pl-2">
                <div class="row">Pune pe prima pagina</div>
                <label for="da">Da:</label>
                <input type="radio" id="da" name="is_main" value='1'>
                <br>
                <label for="nu">NU</label>
                <input type="radio" id="nu" name="is_main" value='0'>
             </div>
             {{-- <div class="form-group">
                <label for="date" class="me-2">Cuvinte cheie:</label>
                <input type="text" class="form-control" name="date" id="date" value="{{old('date')}}" placeholder="Scrie cuvinte cheie">
                </select>
            </div> --}}
             <div class="form-group">
                <strong>Imagin thumbnail</strong>

                <div class="custom-file">
                    {{-- <input type="hidden" name="albumImage" value=""> --}}

                    <input type="file" class="custom-file-input" multiple="multiple" id="albumImage"
                        onchange="previewFiles(this.files)" required
                        lang="eng" name="albumImage[]">
                    <label class="custom-file-label" for="albumImage[]">Alege fotografia</label>
                </div>
            </div>

            <div class="row justify-content-end my-5">
                <input type='submit' name="submit_btn" class='btn btn-primary' value='Adauga postare'>
            </div>
            <div class="row justify-content-center" id="preview"></div>

        </form>
    </div>
</div>

