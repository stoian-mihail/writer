@extends('layouts.admin')
@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="content">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            <h1 class="text-underline">Evenimente</h1>

            <div class="mt-5">
                @foreach ($posts as $post)
                <article>
                    <div class="row mt-2 text-left">
                        <div class="col-2 p-0">
                            @if ($post->photo )
                            <img src="{{$post->photo->thumbnail->file_url}}" alt="post image" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-6">
                            <a href="{{route('news.show', $post)}}" class="text-primary">
                                <h2>{{$post->title}}</h2>
                            </a>
                            <strong class="text-secondary">Data: {{$post->created_at}}</strong>
                        </div>
                        <div class="col-4">
                            <div class="row">
                                <a type="button" class="btn btn-primary" href="{{route('admin.news.edit', ['news' =>$post])}}">Editeaza</a>
                             </div>
                            <div class="row mt-2">
                                <form action="{{route('admin.news.delete',$post->id)}}" class="delete_form" method="post"
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
    @include('admin.deletemodal', ['object'=>'articolul'])
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
