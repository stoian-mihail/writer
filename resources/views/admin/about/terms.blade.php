@extends("layouts.admin")
@section("content")

    <h5>Termeni</h5>
    <div class="row">

        <div class="col-md-12" id="form-div">
            <form id="add_post_form" method='post' action='{{route("admin.save.terms")}}' enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label for="text">Text termeni

                        (HTML)

                    </label>
                    <textarea style='min-height:600px;' required class="form-control" id="text"
                        aria-describedby="text_help" name='text'>{{ $post }}</textarea>

                </div>


                <div class="row justify-content-end my-5">
                    <input type='submit' name="submit_btn" class='btn btn-primary' value='Salveaza modificarile'>
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
