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
        <aside>
            <div class="row justify-content-center text-center">
                <img src="{{asset('/storage/images/mihai_soare.png')}}" class="img-fluid author_image_side" alt="">
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-auto text-start">
                    <p><strong>Acesta sunt…</strong></p>
                    <p>Sunt netemeinic în ceea ce scriu,<br>
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
            </div>
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Customize this section to tell your visitors a little bit about your
                        publication, writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="#">March 2021</a></li>
                        <li><a href="#">February 2021</a></li>
                        <li><a href="#">January 2021</a></li>
                        <li><a href="#">December 2020</a></li>
                        <li><a href="#">November 2020</a></li>
                        <li><a href="#">October 2020</a></li>
                        <li><a href="#">September 2020</a></li>
                        <li><a href="#">August 2020</a></li>
                        <li><a href="#">July 2020</a></li>
                        <li><a href="#">June 2020</a></li>
                        <li><a href="#">May 2020</a></li>
                        <li><a href="#">April 2020</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </div>
        </aside>
    </div>
</div>





@endsection
