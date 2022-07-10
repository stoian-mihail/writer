@extends('layouts.admin')

@section('content')
<div class="row m-0 d-flex flex-row w-100 justify-content-start">
    <h2>Adauga articol</h2>
</div>
<div class="row m-0 w-100 justify-content-start">
    <div class="col col-sm-10 col-lg-auto">

        <form action="{{route('post.store')}}" method="post" id="post_form" name="post_form" enctype="multipart/form-data">
            @csrf

            <input type="text" class="form-control" name="post_title" id="post_title" autofocus minlength="2" maxlength="60"
                required placeholder="Titlu articol" value="{{ old('post_title') }}">

            <textarea name="about" required class="form-control preserveLines mt-5" id="post_content"
            rows="25" maxlength="6000"
            placeholder="Continut articol"></textarea>


        </form>
    </div>
    <div class="col">
        <div class="row justify-content-start buttons_column">
            <div class="col-auto">
                <button id="cancel-post" class="btn btn-danger" type="button" name="cancel-post">Anuleaza</button>
            </div>

            <div class="col-auto">
                <input id="submit-post" class="btn btn-primary" type="submit" name="submit" value="Salveaza">
            </div>

        </div>
        <div class="row mt-5">
            <label class="col-12" for="tags" id="tags-label">Cuvinte cheie(tags):
            </label>
        </div>
        <div class="row w-100 mt-2">

            <div class="col-12">
                <input type="hidden" name="tags" value="">
                <select class="form-control" id="tags" name="tags[]" required multiple="multiple" value="">
                    @if (is_array(old('tags')))
                    @foreach (old('tags') as $tag)
                    <option value="{{ $tag }}" selected="selected">{{ $tag }}</option>
                    @endforeach
                    @else
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>

</div>

<script>
    $('#tags').select2({
        tags: true
        , placeholder: 'Alege cuvinte cheie'
        , maximumSelectionLength: 5
        , tokenSeparators: [',']
        , "language": {
            "noResults": function() {
                return "Scrie tagul si apasa enter!";
            }
        }
        , escapeMarkup: function(markup) {
            return markup;
        }
    });

</script>
@endsection
