<ul class="list-group">
    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('binshopsblog.admin.index') }}">Articole</a>

            </h6>

            <div class="list-group ">

                <a href='{{ route('binshopsblog.admin.index') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action @if(\Request::route()->getName() === 'binshopsblog.admin.index') active @endif  '><i
                            class="fa fa-th fa-fw"
                            aria-hidden="true"></i>
                   Toate articolele</a>
                <a href='{{ route('binshopsblog.admin.create_post') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.create_post') active @endif  '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Adauga articol</a>
            </div>
        </div>
    </li>


    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.news') }}">Evenimente</a>

            </h6>

            <div class="list-group ">
                <a href='{{ route('admin.news') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action '><i
                            class="fa  fa-fw fa-calendar" aria-hidden="true"></i>
                    Toate evenimentele</a>



                    <a href='{{ route('news.create') }}'
                    class='list-group-item list-group-color list-group-item list-group-color-action '><i
                             class="fa fa-plus fa-fw" aria-hidden="true"></i>
                     Adauga eveniment</a>

            </div>
        </div>
    </li>
    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.news') }}">Carti</a>

            </h6>

            <div class="list-group ">
                <a href='{{route('admin.products')}}'
                   class='list-group-item list-group-color list-group-item list-group-color-action '><i
                            class="fa  fa-fw fa-book" aria-hidden="true"></i>
                    Toate cartile</a>



                    <a href='{{route('product.create')}}'
                    class='list-group-item list-group-color list-group-item list-group-color-action '><i
                             class="fa fa-plus fa-fw" aria-hidden="true"></i>
                     Adauga carte</a>

            </div>
        </div>
    </li>


    <li class="list-group-item list-group-color  justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('binshopsblog.admin.categories.index') }}">Categorii</a>
                <span class="text-muted">(<?php
                    $postCount = \BinshopsBlog\Models\BinshopsCategory::count();
                    echo $postCount . " " . 'categorii';
                    ?>)</span>
            </h6>

            <div class="list-group ">
                <a href='{{ route('binshopsblog.admin.categories.index') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.categories.index') active @endif  '><i
                            class="fa fa-object-group fa-fw" aria-hidden="true"></i>
                    Toate categoriile</a>
                <a href='{{ route('binshopsblog.admin.categories.create_category') }}'
                   class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.categories.create_category') active @endif  '><i
                            class="fa fa-plus fa-fw" aria-hidden="true"></i>
                    Adauga categorie</a>
            </div>
        </div>

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


    @if(config("binshopsblog.image_upload_enabled"))
        <li class="list-group-item list-group-color  justify-content-between lh-condensed">
            <div>
                <h6 class="my-0"><a href="{{ route('binshopsblog.admin.images.upload') }}">Imagini</a></h6>

                <div class="list-group ">

                    <a href='{{ route('binshopsblog.admin.images.all') }}'
                       class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.images.all') active @endif  '><i
                                class="fa fa-picture-o fa-fw" aria-hidden="true"></i>
                        Vezi imaginile</a>

                    <a href='{{ route('binshopsblog.admin.images.upload') }}'
                       class='list-group-item list-group-color list-group-item list-group-color-action  @if(\Request::route()->getName() === 'binshopsblog.admin.images.upload') active @endif  '><i
                                class="fa fa-upload fa-fw" aria-hidden="true"></i>
                        Upload</a>
                </div>
            </div>
        </li>
    @endif
    <li class="list-group-item list-group-color justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><a href="{{ route('admin.news') }}">Setari</a>

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
