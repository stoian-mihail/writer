@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8 text-center">
            
            <h1 class="text-underline">Fragmente</h1>
            <div class="row">
                @include('admin.components.filterBar')
            </div>
            <div class="mt-5">
                @foreach ($posts as $post)
                @include('admin.components.postListItem', ['post'=>$post,'edit_route'=>'admin.fragments.edit' ,'delete_route'=>'admin.fragments.delete'])
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
