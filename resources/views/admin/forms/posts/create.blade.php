<div class="row text-center mt-3">
    <h5>Adauga {{$post_type}}</h5>
</div>

<div class="row justify-content-center m-0">
    <div class="col-12 col-md-10" id="form-div">
        <form id="add_post_form" method='post' action='{{route("$route")}}' enctype="multipart/form-data">

            @csrf
            <div class="form-group mt-3">
                <label for="title">Titlu {{$post_type}}</label>
                <input type="text" class="form-control" required id="title" aria-describedby="title_help"
                       value="{{old('title')}}" placeholder="Scrie titlu {{$post_type}}" name='title'>
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
                            @if(old('volume_id')==$volume->id)
                        selected
                        @endif
                        value="{{$volume->id}}">{{$volume->prod_name}}</option>
                    @endforeach
                </select>
            </div>
            @endisset

            @if($post_type == 'eveniment')
            <div class="form-group mt-3">
                <label for="date">Data {{$post_type}} (optional)</label>
                <input type="text"  name='date' class="form-control" required id="date" aria-describedby="date_help"
                       value="{{old('date')}}" placeholder="Scrie data evenimentului">
                @error('date')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="location">Adresa {{$post_type}} (optional)</label>
                <input type="text"  name='location' class="form-control" required id="location" aria-describedby="location_help"
                       value="{{old('location')}}" placeholder="Scrie adresa evenimentului">
                @error('location')
                <p>{{ $message }}</p>
                @enderror
            </div>
            
            @endif
            @isset($categories)
            <div class="form-group mt-3">
                <label for="post_categories" class="me-2">Categorie {{$post_type}}:</label>
                <select name="category_id" class="form-control" required id="post_categories">
                    <option disabled selected>Alege categorie</option>
                    @foreach($categories as $category)
                    <option @if(old('category_id')==$category->id)
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
                          name='text'>{{ Request::old('text') }}</textarea>

            </div>
            @isset($tags)

            <div class="form-group mt-3">
                <label for="tags" class="me-2">Cuvinte cheie:</label>
                <select name="tags[]" class="form-control" id="tags" multiple="multiple" required>

                    @foreach($tags as $tag)
                    <option @if(old('tags')==$tag->name)
                        selected
                        @endif
                        value="{{$tag->name}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            @endisset


            <div class="form-group mt-3">
                <label for="post_meta_title">SEO: {{"<title>"}} tag (optional)</label>
                <input class="form-control" id="post_meta_title" aria-describedby="post_meta_title_help"
                       name='meta_title' type='text' value="{{old('meta_title')}}">
            </div>

            <div class="form-group mt-3">
                <label for="post_meta_description">Meta Desc (optional)</label>
                <textarea class="form-control" id="post_meta_description" aria-describedby="post_meta_description_help"
                          name='meta_description'>{{ Request::old('meta_description') }}</textarea>
                <small id="post_meta_description_help" class="form-text text-muted">Meta description (optional)</small>
            </div>
            <div class="form-group mt-3 pl-2">
                <div class="row m-0">Pune pe prima pagina</div>
                <label for="da">Da:</label>
                <input type="radio" id="da" name="is_main" value='1'>
                <br>
                <label for="nu">NU</label>
                <input type="radio" id="nu" name="is_main" value='0'>
            </div>

            @if (!isset($volumes))

            <div class="form-group mt-3">
                <strong>Imagine principala</strong>

                <div class="custom-file">
                    {{-- <input type="hidden" name="albumImage" value=""> --}}

                    <label class="custom-file-label form-label" for="albumImage[]">Alege fotografia</label>
                    <input type="file" class="custom-file-input form-control" multiple="multiple" id="albumImage"
                           onchange="previewFiles(this.files)" lang="ro" name="albumImage[]">

                </div>

                <div class="row m-0 justify-content-center" id="preview"></div>

            </div>

            @endif

            <div class="row m-0 justify-content-end mt-5 me-2">
                <input type='submit' name="submit_btn" class='btn btn-primary btn-lg col-auto'
                       value='Adauga {{$post_type}}'>
            </div>


        </form>
    </div>
</div>


<div class="row mt-3 justify-content-center m-0 ms-5 text-center"><strong>Indicatii: </strong></div>
<div class="row justify-content-center m-0 ms-5 text-start">
    <ol class="col-auto">
        <li>Dai click pe randul pe care vrei sa apara imaginea( preferabil intre 2 randuri de text)</li>
        <li>Dai click pe iconita de imagine din bara de unelte</li>
        <li>Deschizi un nou tab si mergi la vezi imagini si copiezi cu grija linkul de la imaginea dorita</li>
        <li>Dai paste acelui link unde scrie URL (in tabul image info)</li>
        <li>La width si height scrii cu mana: 100% </li>
        <li>Te duci la tabul de Advanced din meniul acesta si dai paste la "Stylesheet classes" la textul:
            photo_with_modal</li>
        <li>Apesi OK</li>
    </ol>

</div>