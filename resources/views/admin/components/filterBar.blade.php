<div class="filter-bar my-3">
<form action="{{ route("$route") }}" method="get" id="filter_items" name="filter_items" enctype="multipart/form-data">

    <div class="row justify-content-start justify-content-sm-center align-items-center">
        
        <div class="col-auto">
            <div class="row m-0 justify-content-start justify-content-sm-center align-items-center">
                <div class="col-auto p-0">
                    <span class="text-secondary">Alege status:</span>
                </div>
                <div class="col-auto pl-1">
                    <div class="orderBtn">
                        <select form="filter_items" class="btn btn-light btn-sm order_by" name="status">
                            <option value="default" 
                            @if (isset($filter_criteria['status']) && $filter_criteria['status'] == 'default')
                                selected
                            @endif
                             >Toate</option>
                            <option value="1"  @if (isset($filter_criteria['status']) && $filter_criteria['status'] == '1') selected  @endif >Publicate</option>
                            <option value="0" @if (isset($filter_criteria['status']) && $filter_criteria['status'] == '0') selected  @endif>Drafturi</option>

                    
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="row m-0 justify-content-start justify-content-sm-center align-items-center">
                <div class="col-auto p-0">
                    <span class="text-secondary">Alege categoria:</span>
                </div>
                <div class="col-auto pl-1">
                    <div class="orderBtn">
                        <select form="filter_items" class="btn btn-light btn-sm order_by" name="category">
                            <option value="default" 
                         @if (isset($filter_criteria['category']) && $filter_criteria['category'] == 'default')
                            selected
                        @endif>Toate</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if (isset($filter_criteria['category']) && $filter_criteria['category'] == $category->id) selected  @endif>
                                {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
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
                        <select form="filter_items" class="btn btn-light btn-sm order_by" name="order_by">
                            <option value="default" selected>Alege criteriu</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="desc" ) selected
                                @endif value="desc">Cele mai noi</option>
                            <option class="select_order" @if(!empty($filter_criteria) &&
                                isset($filter_criteria['order_by']) && $filter_criteria['order_by']=="asc" ) selected
                                @endif value="asc">Cele mai vechi</option>
                        
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
<script src="{{ asset('/js/filterBar.js') }}" type="text/javascript"></script>
