@extends("layouts.admin")
@section('header')
{{-- <script src="{{ mix('/js/resize.js') }}" type="text/javascript"></script> --}}
@endsection('header')

@section("content")
   <div class="row justify-content-center mb-5">
    <h1>Imagini</h1>
    </div>
   @foreach($media as $key => $image)
   <div class="row mt-2">
       <div class="col-2"><img src="{{$image->file_url}}" class="img-fluid" alt="media image"></div>
       <div class="col-10 justify-content-center">
           <div class="row d-inline">
                <strong class="mr-5">Link imagine:</strong>
                <span>{{$image->file_url}}</span>
           </div>
           <div class="row justify-content-between mt-5">
               <div class="col-auto">
                  Data: {{ Carbon\Carbon::parse($image->created_at)->format('d-m-Y h:m')}}
               </div>
               <div class="col-auto">
                   <form action="{{route('admin.media.delete',$image->id)}}"
                   class="delete_form"
                   method="post" id="delete_form{{$image->id}}" name="delete_form{{$image->id}}">
                   <input type="hidden" value="{{$image->id}}">
                    @csrf
                   <button type="button" class="btn btn-danger" onclick="showModal({{$image->id}})">Sterge</button>
                </form>
               </div>
           </div>
       </div>
   </div>
   <hr>
   @endforeach
   <div class="row mt-4 justify-content-center">{{ $media->links() }}</div>

   @include('admin.deletemodal',['object'=>"imaginea"])



@endsection
@section('scripts')
<script>
function showModal(id) {
        console.log('a intrat');
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
