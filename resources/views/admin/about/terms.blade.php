@extends("layouts.admin")
@section("content")

@include('admin.forms.about.edit', ['post_type'=>'Termeni si conditii', 'route'=>'admin.save.terms'])

@endsection
