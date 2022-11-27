@extends("layouts.admin")
@section("content")


    <div class="row justify-content-center text-center mt-3">

        <div class="col-12 col-md-10" id="form-div">
            <h5>{{$post_type}}</h5>
            <form id="add_post_form" method='post' action='{{route("$route")}}' enctype="multipart/form-data">

                @csrf

                <div class="form-group mt-5">
                    <label for="text">Text

                        (HTML)

                    </label>
                    <textarea style='min-height:600px;' required class="form-control" id="text"
                        aria-describedby="text_help" name='text'>{{ $post }}</textarea>

                </div>

                <div class="row m-0 justify-content-end mt-5 me-2">
                    <input type='submit' name="submit_btn" class='btn btn-primary btn-lg col-auto'
                           value='Salveaza modificarile'>
                </div>


            </form>
        </div>
    </div>


@endsection
@section('scripts')


<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<script>
    if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.replace('text');
        }
</script>


@endsection
