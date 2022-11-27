@extends("layouts.admin")
@section("content")

@include('admin.forms.posts.create', ['route'=>'admin.fragments.store' , 'post_type'=>'fragment', 'volumes'=>$volumes])

@endsection
@section('scripts')
<script>

    $('#fragment_volumes').select2({ });

</script>


<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<script>
    if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.replace('text');
        }
</script>


@endsection
