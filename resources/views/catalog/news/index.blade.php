@extends('layouts.blog')
@section('content')


<div class="row justify-content-center bg-dark w-100 text-white breadcrumbs-bar py-2 m-0 mt-2">
    <div class="col-auto mx-auto">
        <h1 class="fw-light">Evenimente</h1>
    </div>
</div>

<section class="text-center container">

    <div class="row">
        <div class="col">
        @foreach ($posts as $post)
      
            <a href="{{route('news.show', ['news'=>$post])}}" class="blog-link">
                {{-- <article> --}}

                    <div class="card mt-5">
                        <div class="row justify-content-center">
                            @if ($post->photo)
                            <div class="col-2">
                                <img src="{{$post->photo->thumbnail->file_url}}" alt="" class="img-thumbnail-post">
                            </div>
                            @endif
                            <div class="col-10">
                                <div class="row justify-content-center mt-2">
                                    <h2 class="post-thumb-title">{{$post->title}}</h2>
                                    <p class="card-text">
                                        @if ($post->photo)
                                        {!! Illuminate\Support\Str::limit(strip_tags($post->text),250)!!}
                                        @else
                                        {!! Illuminate\Support\Str::limit(strip_tags($post->text),500)!!}
        
                                        @endif
        
                                    </p>
                  
                                </div>
                            </div>
                        </div>
                    </div>

            
                {{-- </article> --}}
            </a>
        
        @endforeach
    </div>
    </div>

</section>




@endsection
