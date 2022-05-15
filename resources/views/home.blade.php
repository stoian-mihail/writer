@extends('layouts.blog')

@section('content')
{{-- --}}
{{-- latest article --}}
<div class="row">
    <div class="col-9 p-4 p-md-5 mb-4 rounded ">
        <div class="row main-article-container bg-light rounded py-2 shadow">
            <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
            <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                efficiently about what’s most interesting in this post’s contents.</p>
            <p>Where does it come from?
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
                Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a
                Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the
                undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et
                Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the
                theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor
                sit amet..", comes from a line in section 1.10.32.

                The standard chu</p>
            <p class="lead mb-0">
                <a href="#" class="fw-bold">Continue reading...</a>
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
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Thumbnail</text>
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
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Thumbnail</text>
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
        @include('sidebar')
    </div>
</div>





@endsection
