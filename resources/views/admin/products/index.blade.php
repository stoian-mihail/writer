@extends('layouts.admin')
@section('content')


<div class="content">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            <h1 class="text-underline">Lista carti:</h1>

            <div class="mt-5">
                @foreach ($posts as $post)
                <article>
                    <div class="row mt-2 text-left">
                        <div class="col-2 p-0">
                            <img src="{{$post->photos()->first()? $post->photos()->first()->thumbnail->file_url:''}}"
                                alt="post image" class="img-fluid">
                        </div>
                        <div class="col-6">
                            <a href="{{route('posts.show', $post)}}" class="text-primary">
                                <h2>{{$post->prod_name}}</h2>
                            </a>
                            <strong class="text-secondary">Data: {{$post->created_at}}</strong>
                        </div>
                        <div class="col-4 col-lg-2">
                            <div class="row w-100 m-0">
                                <a type="button" class="btn btn-primary w-100"
                                    href="{{route('admin.products.edit', ['product'=>$post])}}">Editeaza</a>
                            </div>
                            <div class="row m-0 mt-2">
                                <form action="{{route('admin.products.delete',$post->id)}}" class="delete_form w-100 p-0"
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
    @include('admin.deletemodal', ['object'=>'cartea'])
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
