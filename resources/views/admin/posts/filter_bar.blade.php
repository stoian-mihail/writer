<div class="filter-bar mt-3">
    <div class="row justify-content-start justify-content-sm-center align-items-center">
        <div class="col-auto mr-3">
            <div class="row m-0 justify-content-start justify-content-sm-center align-items-center">
                <div class="col-auto p-0">
                    <span class="text-secondary">
                        Filtreaza:
                    </span>
                </div>
                <div class="col-auto pl-1">
                    <form action="{{ $route }}" method="get" id="filter_items" name="filter_items"
                        enctype="multipart/form-data">
                        <div class="dropdown bg-light filterDisp">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="filterbtn"
                                aria-haspopup="true" aria-expanded="false">
                                <span id="filterbtn-text">Alege filtre</span>
                            </button>
                            <div class="dropdown-menu disp" aria-labelledby="filterbtn">
                                <div class="text-center">
                                    <strong>Disponibilitate</strong>
                                </div>
                                <hr class="m-0">
                                <fieldset id="prod_use">

                                    <div class="dropdown-item filter-item">
                                        <input type="checkbox" id="de_vanzare" class="item_disp" name="prod_use[]"
                                            @if(!empty($filter_criteria) && isset($filter_criteria['prod_use']) &&
                                            in_array('De vanzare', $filter_criteria['prod_use'])) checked @endif
                                            value="De vanzare">
                                        <label class="m-0" for="de_vanzare"> De vanzare</label class="m-0">
                                    </div>
                                    <div class="dropdown-item filter-item">
                                        <input type="checkbox" id="use2" class="item_disp" name="prod_use[]"
                                            @if(!empty($filter_criteria) && isset($filter_criteria['prod_use']) &&
                                            in_array('Nu este de vanzare', $filter_criteria['prod_use'])) checked @endif
                                            value="Nu este de vanzare">
                                        <label class="m-0" for="use2"> Nu este de vanzare</label class="m-0">
                                    </div>
                                    <div class="dropdown-item filter-item">
                                        <input type="checkbox" id="use3" class="item_disp" name="prod_use[]"
                                            @if(!empty($filter_criteria) && isset($filter_criteria['prod_use']) &&
                                            in_array('Doresc schimburi', $filter_criteria['prod_use'])) checked @endif
                                            value="Doresc schimburi">
                                        <label class="m-0" for="use3"> Doresc schimburi</label class="m-0">
                                    </div>
                                </fieldset>
                                <hr class="m-0">
                                <div class="text-center">
                                    <strong>Categorie</strong>
                                </div>
                                <fieldset id="category">
                                    @foreach ($categories as $key=>$category )
                                    <div class="dropdown-item filter-item">
                                        <input type="checkbox" id="categ{{ $key }}" @if(!empty($filter_criteria) &&
                                            isset($filter_criteria['category']) && in_array($category->id,
                                        $filter_criteria['category'])) checked @endif name="category[]" value="{{
                                        $category->id }}">
                                        <label class="m-0" for="categ{{ $key }}"> {{ $category->category_name }}</label
                                            class="m-0">
                                    </div>

                                    @endforeach
                                </fieldset>
                                <div class="dropdown-item d-flex row m-0 justify-content-center">
                                    <button id="sterge" onclick="removeFilters(event)"
                                        class="btn btn-danger col-auto mr-1 btn-sm" type="submit">Elimina</button>
                                    <button id="submitbtn" class="btn btn-primary col-6 btn-sm" type="submit">Aplica
                                        filtre</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="row m-0 justify-content-start justify-content-sm-center align-items-center">
                <div class="col-auto p-0">
                    <span class="text-secondary">Sorteaza:</span>
                </div>
                <div class="col-auto pl-1">
                    <div class="orderBtn">
                        <select form="filter_items" class="btn btn-light btn-sm" id="order_by" name="order_by">
                            <option value="default" selected>Alege criteriu</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="price_asc" )
                                selected @endif value="price_asc">Pret crescator</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="price_desc" )
                                selected @endif value="price_desc">Pret descrescator</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="latest" ) selected
                                @endif value="latest">Cele mai noi</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="oldest" ) selected
                                @endif value="oldest">Cele mai vechi</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="likes_asc" )
                                selected @endif value="likes_asc">Aprecieri crescator</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="likes_desc" )
                                selected @endif value="likes_desc">Aprecieri descrescator</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
