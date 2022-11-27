@extends('layouts.admin')
@section('content')

<div class="content container">
    <div class="row m-0 justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            <h1 class="text-underline">Lista evenimente</h1>
            <div class="row">
                @include('admin.components.filterBar')
            </div>

                @foreach ($posts as $post)
                @include('admin.components.postListItem', ['post'=>$post,'edit_route'=>'admin.news.edit' ,'delete_route'=>'admin.news.delete'])
                <hr>
                @endforeach
            </div>
        </div>
    </div>

    
    <div class="row m-0 mt-4 justify-content-center">{{ $posts->links() }}</div>
    @include('admin.deletemodal', ['object'=>'evenimentul'])
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
