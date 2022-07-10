@extends("layouts.admin")
@section("content")

    <h5>Adauga fragment</h5>
    <div class="row">
        <div class="col-md-12" id="form-div">
            <form id="add_post_form" method='post' action='{{route("admin.fragments.store")}}' enctype="multipart/form-data">

                @csrf
                <div class="form-group">
                    <label for="title">Titlu fragment</label>
                    <input type="text" class="form-control" required id="title" aria-describedby="title_help"
                    value="{{old('title')}}" placeholder="Scrie titlu fragment"
                    name='title'>
                    @error('title')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date" class="me-2">Volum fragment:</label>
                    <select name="volume_id" class="form-control" required id="fragment_volumes">
                        <option disabled selected>Alege volum</option>
                        @foreach($volumes as $volume)
                        <option
                         @if(old('volume_id') == $volume->id)
                            selected
                         @endif
                            value="{{$volume->id}}">{{$volume->prod_name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="text">Text articol

                        (HTML)

                    </label>
                    <textarea style='min-height:600px;' required class="form-control" id="text"
                        aria-describedby="text_help" name='text'>{{ Request::old('text') }}</textarea>

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

                <div class="row justify-content-end my-5">
                    <input type='submit' name="submit_btn" class='btn btn-primary' value='Adauga fragment'>
                </div>

            </form>
        </div>
    </div>


    {{-- <div class="row mt-3 justify-content-center"><strong>Indicatii: </strong></div>
    <div class="row justify-content-center">
        <ol>
            <li>Dai click pe randul pe care vrei sa apara imaginea( preferabil intre 2 randuri de text)</li>
            <li>Dai click pe iconita de imagine din bara de unelte</li>
            <li>Deschizi un nou tab si mergi la vezi imagini si copiezi cu grija linkul de la imaginea dorita</li>
            <li>Dai paste acelui link unde scrie URL (in tabul image info)</li>
            <li>La width si height scrii cu mana: 100% </li>
            <li>Te duci la tabul de Advanced din meniul acesta si dai paste la "Stylesheet classes" la textul: photo_with_modal</li>
            <li>Apesi OK</li>
        </ol>

    </div> --}}
@endsection
@section('scripts')
<script>
    $('#post_categories').select2({
    //     // tags: true
    //    placeholder: 'Alege categorie'
    //     , maximumSelectionLength: 5
    //     , tokenSeparators: [',']
    //     , "language": {
    //         "noResults": function() {
    //             return "Scrie tagul si apasa enter!";
    //         }
    //     }
    //     , escapeMarkup: function(markup) {
    //         return markup;
    //     }
    });
    $('#fragment_volumes').select2({
    //     // tags: true
    //    placeholder: 'Alege categorie'
    //     , maximumSelectionLength: 5
    //     , tokenSeparators: [',']
    //     , "language": {
    //         "noResults": function() {
    //             return "Scrie tagul si apasa enter!";
    //         }
    //     }
    //     , escapeMarkup: function(markup) {
    //         return markup;
    //     }
    });

</script>


<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<script>
    if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.replace('text');
        }
</script>


@endsection
