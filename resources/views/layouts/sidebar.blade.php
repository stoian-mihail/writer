<ul class="list-group">
    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('dashboard') }}">Articole</a>

            </h6>
            <div class="list-group ">

                <a href='{{ route('admin.posts.index') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action @if(\Request::route()->getName() === 'admin.posts.index') active @endif  '><i
                            class="fa fa-th fa-fw"
                            aria-hidden="true"></i>
                   Toate articolele</a>
                <a href='{{ route('admin.posts.create') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'admin.posts.create') active @endif  '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Adauga articol</a>
            </div>
        </div>
    </li>


    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.news.index') }}">Evenimente</a>

            </h6>

            <div class="list-group ">
                <a href='{{ route('admin.news.index') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action '><i
                            class="fa  fa-fw fa-calendar" aria-hidden="true"></i>
                    Toate evenimentele</a>



                    <a href='{{ route('admin.news.create') }}'
                    class='list-group-item list-group-color list-group-item list-group-color-action '><i
                             class="fa fa-plus fa-fw" aria-hidden="true"></i>
                     Adauga eveniment</a>

            </div>
        </div>
    </li>

    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.fragments.index') }}">Fragmente</a>

            </h6>

            <div class="list-group ">
                <a href='{{route('admin.fragments.index')}}'
                   class='list-group-item list-group-color list-group-item list-group-color-action '><i
                            class="fa  fa-fw fa-align-left" aria-hidden="true"></i>
                    Toate fragmentele</a>



                    <a href='{{route('admin.fragments.create')}}'
                    class='list-group-item list-group-color list-group-item list-group-color-action '><i
                             class="fa fa-plus fa-fw" aria-hidden="true"></i>
                     Adauga fragment</a>

            </div>
        </div>
    </li>
    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.products.index') }}">Carti</a>

            </h6>

            <div class="list-group ">
                <a href='{{route('admin.products.index')}}'
                   class='list-group-item list-group-color list-group-item list-group-color-action '><i
                            class="fa  fa-fw fa-book" aria-hidden="true"></i>
                    Toate cartile</a>



                    <a href='{{route('admin.products.create')}}'
                    class='list-group-item list-group-color list-group-item list-group-color-action '><i
                             class="fa fa-plus fa-fw" aria-hidden="true"></i>
                     Adauga carte</a>

            </div>
        </div>
    </li>


    <li class="list-group-item list-group-color  justify-content-between lh-condensed">


    </li>


    {{-- <li class="list-group-item list-group-color  justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('binshopsblog.admin.images.upload') }}">Languages</a></h6>

            <div class="list-group ">

                <a href='{{ route('binshopsblog.admin.languages.index') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.languages.index') active @endif  '><i
                            class="fa fa-language fa-fw" aria-hidden="true"></i>
                    All Languages</a>

                <a href='{{ route('binshopsblog.admin.languages.create_language') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.languages.create_language') active @endif  '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Add new Language</a>
            </div>
        </div>
    </li> --}}


        <li class="list-group-item list-group-color  justify-content-between lh-condensed">

        </li>
    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.news.index') }}">Setari</a>

            </h6>

            <div class="list-group ">
                <a href='#'
                   class='list-group-item list-group-color list-group-item list-group-color-action '><i
                            class="fa fa-address-card" aria-hidden="true"></i>
                    Despre mine</a>
                    <a href='#'
                    class='list-group-item list-group-color list-group-item list-group-color-action '><i
                             class="fa fa-user-secret" aria-hidden="true"></i>
                     Confidentialitate</a>
                     <a href='#'
                     class='list-group-item list-group-color list-group-item list-group-color-action '><i
                              class="fa fa-fw fa-list" aria-hidden="true"></i>
                      Termeni</a>
                      <a href='#'
                      class='list-group-item list-group-color list-group-item list-group-color-action '><i
                               class="fa fa-gear" aria-hidden="true"></i>
                       Diverse</a>
            </div>
        </div>
    </li>
</ul>
