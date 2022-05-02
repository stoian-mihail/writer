<div class="row">
    <div class="col-md-12" id="form-div">
        <form id="add_news_form" method='post' action='{{route("news.store")}}' enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label for="title">Nume eveniment</label>
                <input type="text" class="form-control" required id="title" aria-describedby="title_help"
                value="{{old('title')}}"
                name='title'>
                @error('title')
                <p>{{ $message }}</p>
                @enderror
            </div>


            <div class="form-group">
                <label for="news_body">Post Body
                    @if(config("binshopsblog.echo_html"))
                    (HTML)
                    @else
                    (Html will be escaped)
                    @endif

                </label>
                <textarea style='min-height:600px;' required class="form-control" id="news_body"
                    aria-describedby="news_body_help" name='news_body'>{{ Request::old('news_body') }}</textarea>

            </div>


            <div class="form-group">
                <label for="news_meta_title">SEO: {{"<title>"}} tag (optional)</label>
                <input class="form-control" id="news_meta_title" aria-describedby="news_meta_title_help"
                    name='meta_title' type='text' value="{{old('meta_title')}}">
             </div>

            <div class="form-group">
                <label for="news_meta_description">Meta Desc (optional)</label>
                <textarea class="form-control" id="news_meta_description" aria-describedby="news_meta_description_help"
                    name='meta_description'>{{ Request::old('meta_description') }}</textarea>
                <small id="news_meta_description_help" class="form-text text-muted">Meta description (optional)</small>
            </div>
            <div class="form-group">
                <label for="category_id" class="me-2">Categorie eveniment:</label>
                <select class="form-select" id="category_id" name="category_id" required aria-describedby="category_id_label">
                    <option value="">Alege categoria</option>

                    @foreach($categories as $key => $category)
                    <option value="{{$category->id}}"
                    @if(old('category_id') == $category->id)
                      selected
                    @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <strong>Imagini eveniment</strong>

                <div class="custom-file">
                    {{-- <input type="hidden" name="albumImage" value=""> --}}

                    <input type="file" class="custom-file-input" multiple="multiple" id="albumImage"
                        onchange="previewFiles(this.files)" required
                        lang="eng" name="albumImage[]">
                    <label class="custom-file-label" for="albumImage[]">Alege fotografia</label>
                </div>
            </div>

            <div class="row justify-content-end my-5">
                <input type='submit' name="submit_btn" class='btn btn-primary' value='Adauga eveniment'>
            </div>

        </form>
    </div>
</div>

