<div class="d-flex flex-column flex-shrink-0 px-3 text-white bg-dark" style="width: 280px;">
    <div class="row d-flex flex-row justify-content-center p-0 pt-2 align-items-center">
        <a href="{{ route('dashboard') }}" class="text-white text-decoration-none col-auto pt-2">
            <h2 class="m-0 p-0">Dashboard</h1>
        </a>
    </div>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">

        <li class="list-group-item justify-content-between text-white bg-dark">
            <h6 class="my-0"><a href="{{ route('admin.posts.index') }}" class="text-white">Articole</a>
            <div class="list-group bg-dark mt-1">
                <a href='{{ route('admin.posts.index') }}' class='text-white bg-dark list-group-item list-group-color-action
                    @if(\Request::route()->getName() === 'admin.posts.index') active @endif '><i
                            class="fa fa-th fa-fw"
                            aria-hidden="true"></i>
                   Toate articolele</a>
                <a href='{{ route('admin.posts.create') }}' class='text-white bg-dark list-group-item list-group-color-action
                     @if(\Request::route()->getName() === 'admin.posts.create') active @endif '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Adauga articol</a>
            </div>
        </li>

        <li class="list-group-item justify-content-between text-white bg-dark">
            <h6 class="my-0">
                <a href="{{ route('admin.news.index') }}" class="text-white">Evenimente</a>
            </h6>
            <div class="list-group bg-dark mt-1">
                        <a href='{{ route('admin.news.index') }}'
                            class='text-white bg-dark list-group-item list-group-color-action'><i
                                class="fa  fa-fw fa-calendar" aria-hidden="true"></i>
                            Toate evenimentele</a>
                        <a href='{{ route('admin.news.create') }}'
                            class='text-white bg-dark list-group-item list-group-color-action'>
                            <i class="fa fa-plus fa-fw" aria-hidden="true"></i>
                            Adauga eveniment</a>
            </div>
        </li>

        <li class="list-group-item justify-content-between text-white bg-dark">
            <div>
                <h6 class="my-0">
                    <a href="{{ route('admin.fragments.index') }}" class="text-white">Fragmente</a>
                </h6>
                <div class="list-group ">
                    <a href='{{route('admin.fragments.index')}}'
                        class='text-white bg-dark list-group-item list-group-color-action'><i
                            class="fa  fa-fw fa-align-left" aria-hidden="true"></i>
                        Toate fragmentele</a>
                    <a href='{{route('admin.fragments.create')}}'
                        class='text-white bg-dark list-group-item list-group-color-action'><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                        Adauga fragment</a>

                </div>
            </div>
        </li>

        <li class="list-group-item justify-content-between text-white bg-dark">
            <div>
                <h6 class="my-0">
                    <a href="{{ route('admin.products.index') }}" class="text-white">Carti</a>
                 </h6>

                <div class="list-group ">
                    <a href='{{route('admin.products.index')}}'
                        class='text-white bg-dark list-group-item list-group-color-action'><i
                            class="fa  fa-fw fa-book" aria-hidden="true"></i>
                        Toate cartile</a>
                    <a href='{{route('admin.products.create')}}'
                        class='text-white bg-dark list-group-item list-group-color-action'><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                        Adauga carte</a>

                </div>
            </div>
        </li>

        <li class="list-group-item justify-content-between text-white bg-dark">
            <div>
                <h6 class="my-0"><a href="{{ route('admin.media.index') }}" class="text-white">Imagini</a></h6>
                <div class="list-group ">
                    <a href='{{ route('admin.media.index') }}'
                        class='text-white bg-dark list-group-item list-group-color-action'><i
                            class="fa fa-picture-o fa-fw" aria-hidden="true"></i>
                        Vezi imaginile</a>

                    <a href='{{route('admin.media.create')}}'
                        class='text-white bg-dark list-group-item list-group-color-action'><i
                            class="fa fa-upload fa-fw" aria-hidden="true"></i>
                        Upload</a>
                </div>
            </div>
        </li>

        <li class="list-group-item justify-content-between text-white bg-dark">
            <div>
                <h6 class="my-0"><a href="{{ route('admin.news.index') }}" class="text-white">Setari</a></h6>

                <div class="list-group ">
                    <a href='{{ route('admin.about') }}'
                       class='text-white bg-dark list-group-item list-group-color-action'><i
                           class="fa fa-address-card" aria-hidden="true"></i>
                        Despre mine</a>
                    <a href='{{route('admin.confidentiality')}}'
                       class='text-white bg-dark list-group-item list-group-color-action'><i
                           class="fa fa-user-secret" aria-hidden="true"></i>
                        Confidentialitate</a>
                    <a href='{{route('admin.terms')}}'
                       class='text-white bg-dark list-group-item list-group-color-action'><i
                           class="fa fa-fw fa-list" aria-hidden="true"></i>
                        Termeni</a>
                    <a href='{{route('admin.show.change.password')}}'
                       class='text-white bg-dark list-group-item list-group-color-action'><i
                           class="fa fa-gear" aria-hidden="true"></i>
                        Setari</a>
                </div>
            </div>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
    <div class="b-example-divider"></div>
</div>
