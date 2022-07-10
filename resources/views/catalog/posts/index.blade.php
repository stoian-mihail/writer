@extends('layouts.blog')
@section('content')

  <section class="text-center container">
    <div class="row">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Articole de blog</h1>

        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($posts as $post)


        <div class="col">
        <a href="{{route('posts.show', ['post'=>$post])}}" class="blog-link">
            <div class="card shadow-sm">
                @if ($post->photo)
                <img src="{{$post->photo->thumbnail->file_url}}" alt="" class="img-thumbnail-post">
                @endif
                <div class="card-body">
                  <h2>{{$post->title}}</h2>
                  <p class="card-text">
                    {{-- {!! nl2br($post->text) !!} --}}
                    {!! Illuminate\Support\Str::limit($post->text,200)!!}
                </p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Citeste</button>
                    </div>
                  </div>
                </div>
              </div>
        </a>

        </div>

        @endforeach

      </div>
    </div>
  </div>





@endsection
