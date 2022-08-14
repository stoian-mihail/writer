@extends('layouts.blog')
@section('content')


<div class="row justify-content-center bg-dark w-100 text-white breadcrumbs-bar py-2 m-0 mt-2">
    <div class="col-auto mx-auto">
        <h1 class="fw-light">Articole de blog</h1>
    </div>
</div>

<section class="text-center container">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($posts as $post)
        <div class="col">
            <a href="{{route('posts.show', ['post'=>$post])}}" class="blog-link">
                <article>
                    <div class="card shadow-sm post-card-container">
                        @if ($post->photo)
                        <img src="{{$post->photo->thumbnail->file_url}}" alt="" class="img-thumbnail-post">
                        @endif
                        <div class="card-body">
                            <h2 class="post-thumb-title">{{$post->title}}</h2>
                            <p class="card-text">
                                @if ($post->photo)
                                {!! Illuminate\Support\Str::limit(strip_tags($post->text),250)!!}
                                @else
                                {!! Illuminate\Support\Str::limit(strip_tags($post->text),500)!!}

                                @endif

                            </p>
                            {{-- <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Citeste</button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </article>
            </a>
        </div>
        @endforeach

    </div>

</section>




@endsection
