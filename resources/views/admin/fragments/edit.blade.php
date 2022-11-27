@extends("layouts.admin")
@section("content")

@include('admin.forms.posts.edit', ['route'=>'admin.fragments.update' , 'post_type'=>'fragment', 'post'=>$post])

@endsection
@section('scripts')
<script>
    $('#post_categories').select2({ });

</script>


<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<script>
    if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.replace('text');
        }
</script>


@endsection
