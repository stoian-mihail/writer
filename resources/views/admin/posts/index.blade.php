@extends('layouts.admin')
@section('content')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="content container">
    <div class="row m-0 justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            <h1 class="text-underline">Articole blog</h1>
            <div class="row">
                @include('admin.posts.filter_bar')
            </div>
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
                            <a href="{{route('posts.show', $post)}}" class="text-primary">
                                <h2>{{$post->title}}</h2>
                            </a>
                            <strong class="text-secondary">Data: {{$post->created_at}}</strong>
                        </div>
                        <div class="col-4 col-lg-2">
                            <div class="row w-100 m-0">
                                <a type="button" class="btn btn-primary w-100"
                                    href="{{route('admin.posts.edit', ['post'=>$post])}}">Editeaza</a>
                            </div>
                            <div class="row m-0 mt-2">
                                <form action="{{route('admin.posts.delete',$post->id)}}" class="delete_form w-100 p-0"
                                    method="post" id="delete_form{{$post->id}}" name="delete_form{{$post->id}}">
                                    <input type="hidden" value="{{$post->id}}">
                                    @csrf
                                    <button type="button" class="btn btn-danger w-100"
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
    <div class="row m-0 mt-4 justify-content-center">{{ $posts->links() }}</div>
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
<script src="{{ asset('/js/filterBar.js') }}" type="text/javascript"></script>

@endsection
