<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Blog Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
  </head>
  <body>

<div class="container">
  <header class="py-3">
    <div class="row justify-content-center align-items-center ">
        <div class="col-6">
            <img src="{{asset('/images/logo.png')}}" alt="site_logo" class="img img-fluid">
        </div>
    </div>
  </header>

  <div class="main_menu by-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded" aria-label="Eleventh navbar example">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample09">
            <ul class="navbar-nav">
                <li class="nav-item mx-2">
                    <a class="nav-link active" aria-current="page" href="#">Acasa</a>
                  </li>
              <li class="nav-item mx-2">
                <a class="nav-link active" aria-current="page" href="#">Carti</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Despre mine</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item mx-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Fragmente</a>
                <ul class="dropdown-menu" aria-labelledby="dropdown09">
                  <li><a class="dropdown-item" href="#">Versuri</a></li>
                  <li><a class="dropdown-item" href="#">Proza</a></li>
                  <li><a class="dropdown-item" href="#">Daraveri politice</a></li>
                </ul>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Contact</a>
              </li>
            </ul>

          </div>
        </div>
      </nav>
  </div>
</div>

<main class="container mt-2">
    @yield('content')
</main>

<footer class="blog-footer">
  <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>



  </body>
</html>