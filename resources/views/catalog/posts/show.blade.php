@extends('layouts.blog')
{{--
<link href="css/style_post.css" rel="stylesheet" /> --}}
@section('content')

<div class="row justify-content-center bg-dark w-100 text-white breadcrumbs-bar py-2 m-0">
    <div class="col-auto mx-auto">
        <h1 class="fw-light">{{$post->title}}</h1>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-9">

            <article>
                @if ($post->photo)
                <div class="post-photo-card row justify-content-center m-0 p-0">
                    <img class="img-fluid rounded post-photo shadow-lg p-0" src="{{ $post->photo->file_url}}"
                        alt="post image" />
                </div>

                @endif

                <!-- Post content-->
                <section class="my-5">
                    {!! nl2br($post->text) !!}
                </section>
                <footer>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Publicat la data {{$post->created_at}}</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light"
                        href="/articole?category={{$post->category->slug}}">{{$post->category->name}}</a>
                </footer>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <span>comment section </span>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-3">
            @include('sidebar', ['categories'=>$categories, 'books'=>$books])

        </div>
    </div>
</div>



@endsection
