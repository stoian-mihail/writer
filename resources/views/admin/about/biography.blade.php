@extends("layouts.admin")
@section("content")

@include('admin.forms.about.edit', ['post_type'=>'Despre mine', 'route'=>'admin.save.about'])


@endsection
