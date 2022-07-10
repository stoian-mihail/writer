@extends('layouts.admin')
@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="content">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            <h1 class="text-underline">Fragmente</h1>

            <div class="mt-5">
                @foreach ($posts as $post)
                <article>
                    <div class="row mt-2 text-left">
                        <div class="col-8">
                            <div class="row">
                                <a href="{{route('posts.show', $post)}}" class="text-primary">
                                    <h2>{{$post->title}}</h2>
                                </a>
                            </div>

                            <div class="row">
                                <strong class="text-secondary">Volumul: {{$post->volume->prod_name}} </strong>

                            </div>
                            <div class="row">
                                <strong class="text-secondary">Data: {{$post->created_at}}</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <a type="button" class="btn btn-primary " href="{{route('admin.fragments.edit', ['fragment'=>$post])}}">Editeaza</a>
                             </div>
                            <div class="row mt-2">
                                <form action="{{route('admin.fragments.delete',$post->id)}}" class="delete_form" method="post"
                                    id="delete_form{{$post->id}}" name="delete_form{{$post->id}}">
                                    <input type="hidden" value="{{$post->id}}">
                                    @csrf
                                    <button type="button" class="btn btn-danger"
                                        onclick="showModal({{$post->id}})">Sterge</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </article>
                <hr>
                @endforeach
            </div>


        </div>
    </div>
    @include('admin.deletemodal', ['object'=>'fragmentul'])
</div>
@endsection

@section('scripts')
<script>
function showModal(id) {
            $('#deletemodal').modal('show');
            var modalDialog = $(".modal-dialog");
            modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 3));
            $('#delete-item-button').attr('data-id',id)
        }



    function deleteItem(event){
        let target_id = event.currentTarget.dataset.id;
        console.log(event.currentTarget);
        console.log(target_id);
        $(`#delete_form${target_id}`).submit();

        }

       </script>
@endsection