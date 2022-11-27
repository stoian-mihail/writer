<div class="row d-flex justify-content-center">
    <div class="col-sm-12 col-md-8" id="form-div">
        <div class="row text-center mb-5 mt-2">
            <h2>Editare volum</h2>
        </div>
        <form action="{{route('admin.products.store')}}" method="post" id="add_product_form" name="add_product_form" enctype="multipart/form-data">
            @csrf

            <div class="row form-group mt-3 d-flex justify-content-center">
                <label class="col-form-label col-sm-3" for="prod_name" id="prod_name_label">Nume: </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="prod_name" id="prod_name" placeholder="Titlu carte" value="{{ $post->prod_name }}" required>

                </div>
            </div>
            <div class="row form-group mt-3 d-flex justify-content-center">
                <label class="col-form-label col-sm-3" for="product_category" id="product_category_label">Categoria: </label>
                <div class="col-sm-9">
                    <div class="form-group">
                        <select class="form-control" id="product_category" name="product_category">
                            <option value="" disabled selected>Alege categoria</option>
                            @foreach($categories as $category )
                            <option @if($post->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="row form-group mt-3 d-flex justify-content-center">
                <label class="col-form-label col-sm-3" for="available_at" id="available_at_label">Disponibil la linkul: </label>
                <div class="col-sm-9">
                    <div class="form-group">
                        <input type="text" class="form-control" name="available_at" id="available_at" placeholder="Adauga link extern" value="{{ $post->available_at }}">

                    </div>
                </div>
            </div>

            <div class="row form-group mt-3 d-flex justify-content-center">
                <label class="col-form-label col-sm-3" for="prod_description" id="prod_description_label">Descriere: </label>
                <div class="col-sm-9">
                    <textarea name="prod_description" class="form-control" rows="15" id="prod_description" maxlength="6000" minlength="2" placeholder="Introdu detalii suplimentare" required>{{$post->prod_description}}</textarea>

                </div>
            </div>
            <div class="row form-group mt-3 align-items-center d-flex mt-3 justify-content-center">
                <label class="col-form-label col-sm-3" for="meta_title" id="meta_title_label">Meta titlu: </label>
                <div class="col-md-9">
                    <textarea name="meta_title" class="form-control" id="meta_title" maxlength="500" placeholder="Introdu meta titlu">{{ $post->meta_title }}</textarea>
                </div>
            </div>

            <div class="row form-group mt-3 align-items-center d-flex mt-3 justify-content-center">
                <label class="col-form-label col-sm-3" for="meta_title" id="meta_title_label">Meta descriere: </label>
                <div class="col-md-9">
                    <textarea name="meta_description" class="form-control" id="meta_description" maxlength="5000" placeholder="Introdu o meta descriere">{{ $post->meta_description }}</textarea>
                </div>
            </div>

            <div class="row form-group mt-3 justify-content-center justify-content-md-end">
                <div class="custom-file col-sm-8 col-md-6 p-0">
                    <input type="hidden" name="albumImage" value="">
                    <input type="file" onchange="previewFiles(this.files)" class="custom-file-input form-control" multiple="multiple" id="albumImage" lang="ro" name="albumImage[]">
                    <label id="file-label" class="custom-file-label" for="albumImage[]">Alege fotografii (max 12)</label>
                </div>
                <div class="col-10 col-sm-auto pl-0 pl-sm-1 submit-div">
                    <div class="row justify-content-center m-0 mt-1 mt-sm-0">
                        <input id="submit" class="btn btn-primary col-12" type="submit" name="submit" value="Salveaza modificarile">
                    </div>

                </div>
                <div class="col-2 col-sm-1 ml-sm-1 p-0 ">
                    <div class="spinner-border text-primary loadingPhotos" style="display:none;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </form>
        <div class="row justify-content-center">
            @foreach ($post->photos as $photo)
            <div class="existingThumbDiv" id={{'existingThumbNo'.$photo->id}} data-id="{{$photo->id}}">
                <img src="{{$photo->file_url}}" class="img-thumbnail" alt="">
                <div onclick="removeExistingImage(event)" class="close-icon-link">
                    <i class="material-icons close-icon">delete_forever</i>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row justify-content-center" id="preview"></div>

    </div>

</div>