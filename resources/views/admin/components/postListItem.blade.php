<article>
    <div class="row mt-2 text-left">
        <div class="col-2 p-0">
            @if ($post->photo )
            <img src="{{$post->photo->thumbnail->file_url}}" alt="post image" class="img-fluid">
            @endif
        </div>
        <div class="col-6">
            <div class="row">
                <a href="{{route('posts.show', $post)}}" class="text-primary">
                    <h2>{{$post->title}}</h2>
                </a>
            </div>
    
            @if ($post->volume)
            <div class="row">
                <strong class="text-secondary">Volumul: {{$post->volume->prod_name}} </strong>

            </div>
            @endif

            <strong class="text-secondary">Data: {{$post->created_at}}</strong>
        </div>
        <div class="col-4 col-lg-2">
            <div class="row w-100 m-0">
                <a type="button" class="btn btn-primary w-100"
                    href="{{route($edit_route, $post)}}">Editeaza</a>
            </div>
            <div class="row m-0 mt-2">
                <form action="{{route($delete_route, $post->id)}}" class="delete_form w-100 p-0"
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