@extends("layouts.admin")
@section("content")

@include('admin.forms.about.edit', ['post_type'=>'Politica de confidentialitate', 'route'=>'admin.save.confidentiality'])


@endsection
