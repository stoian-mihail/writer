@extends('layouts.blog')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-9 p-4 p-md-5 mb-4 rounded ">
            <div class="row main-article-container bg-light rounded py-2 shadow">
                <h1 class="display-4 fst-italic">{{$mainPost->title}}</h1>
                {{-- <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents.</p> --}}
                <p>{!! Illuminate\Support\Str::words($mainPost->text,100)!!}</p>
                <p class="lead mb-0">
                    <a href="{{$linkToMain}}" class="fw-bold">Citeste tot...</a>
                </p>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <article>
                        <div
                            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">World</strong>
                                <h3 class="mb-0">Featured post</h3>
                                <div class="mb-1 text-muted">Nov 12</div>
                                <p class="card-text mb-auto">This is a wider card with supporting text below
                                    as a
                                    natural lead-in to
                                    additional content.</p>
                                <a href="#" class="stretched-link">Continue reading</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img" width="200" height="250"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%"
                                        fill="#eceeef" dy=".3em">Thumbnail</text>
                                </svg>

                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-6">
                    <article>
                        <div
                            class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-success">Design</strong>
                                <h3 class="mb-0">Post title</h3>
                                <div class="mb-1 text-muted">Nov 11</div>
                                <p class="mb-auto">This is a wider card with supporting text below as a
                                    natural lead-in
                                    to additional
                                    content.</p>
                                <a href="#" class="stretched-link">Continue reading</a>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <svg class="bd-placeholder-img" width="200" height="250"
                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                    preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%"
                                        fill="#eceeef" dy=".3em">Thumbnail</text>
                                </svg>

                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="mt-5">
                <h2 class="text-center">
                    Cartile mele
                </h2>
                <div class="row justify-content-center">
                    <div class="col">
                        Carte 1
                    </div>
                    <div class="col">
                        Carte 2
                    </div>
                    <div class="col">
                        Carte3
                    </div>
                    <div class="col">
                        Carte 4
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="button btn btn-link">Vezi toate</button>
                </div>
            </div>
            <div class="mt-5 latest articles">
                <h2 class="text-center">
                    Ultimele articole
                </h2>
                <div class="row justify-content-center">
                    <div class="col">
                        Carte 1
                    </div>
                    <div class="col">
                        Carte 2
                    </div>
                    <div class="col">
                        Carte3
                    </div>
                    <div class="col">
                        Carte 4
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="button btn btn-link">Vezi toate</button>
                </div>
            </div>


        </div>
        <div class="col-3">
            <aside>
                <div class="row justify-content-center text-center">
                    <img src="{{asset('/images/mihail_soare.png')}}" class="img-fluid author_image_side" alt="">
                </div>
                <div class="position-sticky" style="top: 2rem;">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">Acesta sunt...</h4>
                        <p class="mb-0">
                            Sunt netemeinic în ceea ce scriu,<br>
                            sunt orbul fără soartă, mortul viu,<br>
                            zeroul nud și fără conștiință,<br>
                            sunt virgula de după pocăință,<br>
                            sunt talerul mai ușurel că pana,<br>
                            sunt recea pușcărie din Doftana,<br>
                            analfabetul gângav fără creier,<br>
                            vioara ruptă cu arcusu-n greier<br>
                            și sunt nedemnul fără preț la snop<br>
                            vomat de marea strânsă-ntr-un prosop,<br>
                            sunt profitor de aburi și de vise<br>
                            scuipate de omizi prin paraclise,<br>
                            sunt potlogar, tembel și derbedeu,<br>
                            sunt ce vreți voi, dar sunt și Dumnezeu…</p>
                    </div>

                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Citeste</div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                @foreach ($categories as $category)
                                <li><a href="#!">{{$category->name}}</a></li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Carti publicate</div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                @foreach ($books as $book)

                                <li>
                                    <div class="book-card">
                                        <a href="#!" class="book-title-side">
                                            <img src="{{$book->photos()->first()->thumbnail->file_url}}"
                                                class=" book-thumb rounded shadow product-thumb" alt="">
                                            <h5 class="mt-2">{{$book->prod_name}}</h5>
                                        </a>
                                    </div>
                                    <hr>
                                </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="p-4">
                        <h4 class="fst-italic">Ma gasiti si pe...</h4>
                        <ol class="list-unstyled">
                            <li><a href="#">Facebook</a></li>
                        </ol>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</div>




@endsection
