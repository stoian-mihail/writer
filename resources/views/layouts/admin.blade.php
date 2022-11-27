<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--
    <link href="{{ asset('/css/binshopsblog_admin_css.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/croppie.css') }}" rel="stylesheet">

    <script src="{{ asset('/js/jquery-3.4.1.min.js') }}" type="text/javascript"> </script>
    <script src="{{ asset('/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/croppie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <link href="{{ asset('/css/sidebars.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/select2.min.css')}}" rel="stylesheet" />

</head>

<body class="h-100">



    <main class="h-100">

        <div class='row h-100 m-0'>
            <div class="col-auto p-0">
                @include("layouts.sidebar2")
            </div>

            <div class='col main-content p-0'>
                <div class="row m-0 w-100">

                    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
                        <div class="container-fluid">

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#adminNavbar" aria-controls="adminNavbar"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="adminNavbar">
                                <ul class="navbar-nav ms-auto d-flex flex-row justify-content-end w-100">
                                    <li class="nav-item" style="margin-right:auto;">
                                        <a class="nav-link" href="{{ route('home') }}">Mergi la site </a>
                                    </li>

                                    <li class="nav-item w-25 me-5">
                                        <div class="row m-0">
                                            <form class="col-12 px-1 my-2 my-lg-0" id="search_form" action="{{route('admin.search.index')}}">
                                                <div class="row justify-content-center align-items-center">
                                                    <div class="col-sm-6 p-0 mr-1">
                                                        <input class="form-control" id="keywords" name="keywords" type="search" placeholder="Cauta" value="{{ !empty($search_criteria) ? $search_criteria['keywords'] : '' }}" aria-label="Cauta">
                                                    </div>
                                                    <div class="col-auto px-1 form-group my-1">
                                                        <select class="form-control px-1" id="search_category" name="search_category">
        
                                                            <option @if(!empty($search_criteria) && $search_criteria['search_category']=='Post' ) selected @endif value="Post">articole</option>
                                                            <option @if(!empty($search_criteria) && $search_criteria['search_category']=='Fragment' ) selected @endif value="Fragment">fragmente</option>
                                                            <option @if(!empty($search_criteria) && $search_criteria['search_category']=='News' ) selected @endif value="News">evenimente</option>
                                                            <option @if(!empty($search_criteria) && $search_criteria['search_category']=='Product' ) selected @endif value="Product">utilizatori</option>
                                                        </select>
                                                    </div>
                                                    <button class="col-auto btn btn-dark btn-outline-light my-2 my-sm-1" type="submit">Cauta</button>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </nav>

                </div>
                @if (isset($errors) && count($errors))
                <div class="alert alert-danger text-center">
                    <b>Sorry, but there was an error:</b>
                    <ul class='m-0'>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (Session::has('message'))
                    <div class="alert alert-info text-center mt-2">{{ Session::get('message') }}</div>
                @endif

                @yield('content')
            </div>
        </div>

    </main>

</body>
@yield('scripts')

</html>
