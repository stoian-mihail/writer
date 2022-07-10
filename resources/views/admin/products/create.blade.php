@extends("layouts.admin")
@section('header')
<link href="/css/select2.min.css" rel="stylesheet" />
<script src="/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
@endsection('header')

@section ('content')
<div class="container" id="mainContainer">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 col-md-8" id="form-div">
            <form action="{{route('admin.products.store')}}" method="post" id="add_product_form" name="add_product_form" enctype="multipart/form-data">
                @csrf
                <div class="row form-group d-flex justify-content-center">
                    <label class="col-form-label col-sm-3" for="prod_name" id="prod_name_label">Nume: </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="prod_name" id="prod_name" placeholder="Titlu carte" value="{{ old('prod_name') }}" required>

                    </div>
                </div>
                <div class="row form-group d-flex justify-content-center">
                    <label class="col-form-label col-sm-3" for="product_category" id="product_category_label">Categoria: </label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control" id="product_category" name="product_category" value="{{ old('product_category') }}" required>
                                <option value="" disabled selected>Alege categoria</option>
                                @foreach($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row form-group d-flex justify-content-center">
                    <label class="col-form-label col-sm-3" for="available_at" id="available_at_label">Disponibil la linkul: </label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="available_at" id="available_at" placeholder="Adauga link extern" value="{{ old('available_at') }}">

                        </div>
                    </div>
                </div>

                <div class="row form-group d-flex justify-content-center">
                    <label class="col-form-label col-sm-3" for="prod_description" id="prod_description_label">Descriere: </label>
                    <div class="col-sm-9">
                        <textarea name="prod_description" class="form-control" rows="15" id="prod_description" maxlength="6000" minlength="2" placeholder="Introdu detalii suplimentare" required>{{Request::old('prod_description')}}</textarea>

                    </div>
                </div>
                <div class="row form-group align-items-center d-flex mt-3 justify-content-center">
                    <label class="col-form-label col-sm-3" for="meta_title" id="meta_title_label">Meta titlu: </label>
                    <div class="col-md-9">
                        <textarea name="meta_title" class="form-control" id="meta_title" maxlength="500" placeholder="Introdu meta titlu">{{ Request::old('meta_title') }}</textarea>
                    </div>
                </div>

                <div class="row form-group align-items-center d-flex mt-3 justify-content-center">
                    <label class="col-form-label col-sm-3" for="meta_title" id="meta_title_label">Meta descriere: </label>
                    <div class="col-md-9">
                        <textarea name="meta_description" class="form-control" id="meta_description" maxlength="5000" placeholder="Introdu o meta descriere">{{ Request::old('meta_description') }}</textarea>
                    </div>
                </div>

                <div class="row form-group justify-content-center justify-content-md-end">
                    <div class="custom-file col-sm-8 col-md-6 p-0">
                        <input type="hidden" name="albumImage" value="">
                        <input type="file" onchange="previewFiles(this.files)" class="custom-file-input" multiple="multiple" id="albumImage" lang="ro" name="albumImage[]" required>
                        <label id="file-label" class="custom-file-label" for="albumImage[]">Alege fotografii (max 12)</label>
                    </div>
                    <div class="col-10 col-sm-auto pl-0 pl-sm-1 submit-div">
                        <div class="row justify-content-center m-0 mt-1 mt-sm-0">
                            <input id="submit" class="btn btn-primary col-12" type="submit" name="submit" value="Adauga">
                        </div>

                    </div>
                    <div class="col-2 col-sm-1 ml-sm-1 p-0 ">
                        <div class="spinner-border text-primary loadingPhotos" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row justify-content-center" id="preview"></div>

        </div>

    </div>
</div>

@endsection('content')



@section('scripts')

<script>
    $('#product_category').select2({
    //     // tags: true
    //    placeholder: 'Alege categorie'
    //     , maximumSelectionLength: 5
    //     , tokenSeparators: [',']
    //     , "language": {
    //         "noResults": function() {
    //             return "Scrie tagul si apasa enter!";
    //         }
    //     }
    //     , escapeMarkup: function(markup) {
    //         return markup;
    //     }
    });



var albumFiles = [];
var fileMap = [];
var newFiles = [];
var fileNames = "";
var maxNumber = 11;
var tooBig = 0;
$(document).bind("ajaxSend", function () {
    $('#add_product_form').find('input, textarea, button, select').attr('disabled', 'disabled');
    $('.close-icon-link').hide();
    $('.loadingPhotos').show();

    createFlash('alert-primary', "Albumul se salveaza! Va rugam asteptati!");
}).bind("ajaxComplete", function () {
    removeFlash(".alert-primary-div");
    $('#add_product_form').find('input, textarea, button, select').prop("disabled", false);
    $('.close-icon-link').show();
    $('.loadingPhotos').hide();
});


$('#add_product_form').on('submit', function (e) {
    e.preventDefault();
    resetAlerts();
    let form = document.getElementById('add_product_form');
    let formData = new FormData(form);
    formData.delete('albumImage[]');
    var fileNumber = 0;
    for (let i = 0, len = albumFiles.length; i < len; i++) {
        if (fileNumber === maxNumber) {
            break;
        }
        if (albumFiles[i] instanceof File) {
            formData.append('albumImage[]', albumFiles[i]);
            let img = document.querySelector(`#${fileMap[i]} > img:first-of-type`);
            fileNumber++;
        }
    }
    $.ajax({
        method: 'post',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        enctype: 'multipart/form-data',
        url: " {{route('admin.products.store') }}",
        encode: true,
    })
        // using the done promise callback
        .done(function (data, textStatus, jqXHR) {
            if (data.success) {
                $('#add_product_form').trigger('reset');
                $("#tags").select2('val', 'All');
                formData.delete('albumImage[]');
                albumFiles = [];
                fileMap = [];
                newFiles = [];
                document.querySelector('#albumImage ~label').textContent = 'Alege fotografii';
                $('#preview').html('');
                createFlash('alert-success', data.message);
                $('.custom-file-input').prop('required', true);


            } else {
                if (data.message) {
                    createFlash('alert-danger', data.message);
                }
                $.each(data.error, function (key, value) {

                    let fieldName;
                    let allErrors = '';
                    if (key.includes('.')) {
                        let indexNumber = key.indexOf('.');
                        fieldName = key.slice(0, indexNumber);
                    } else {
                        fieldName = key;
                    }

                    let inputField = $(`#${fieldName}`);
                    inputField.addClass('is-invalid');
                    inputField.parent().append('<span class="invalid-feedback" role="alert"></span>');
                    $.each(value, function (i, val) {
                        allErrors += val + ' ';
                    });
                    inputField.parent().children().last().append(`<strong>${allErrors}</strong>`);

                    if ('ratio' === fieldName) {
                        createFlash('alert-danger', allErrors);
                    }

                });
            }
        })
        .fail(function (jqXHR, textStatus) {
            createFlash('alert-danger', textStatus);

        });
});


// this function is called when the user adds files in the file input

function previewFiles(files) {

    if (files.length > 0) {

        removeFlash('#flashmessage');
        resetFileAlerts();
        var preview = document.querySelector('#preview');
        // The newfiles array contains the newly selected files from the input; it is used so that we can add files multiple times
        newFiles = Array.from(files);
        //we save the number of existing files added in the albumFiles array so that we can name and map the newly added files
        let indexStart = albumFiles.length;
        albumFiles = albumFiles.concat(newFiles);
        generateFileNames(albumFiles);
        function readFiles(file, key, islast) {
            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|bmp)$/i.test(file.name)) {
                var reader = new FileReader();
                reader.addEventListener("loadstart", function () {
                    $('.loadingPhotos').show();
                    $('#submit').attr('disabled', 'disabled');
                });
                reader.addEventListener("loadend", function () {
                    if (islast) {
                        $('.loadingPhotos').hide();
                        if (tooBig == 0) {
                            $('#submit').prop("disabled", false);
                        }
                    }
                });


                reader.addEventListener("load", function () {
                    let thumbDiv = document.createElement('div');
                    thumbDiv.setAttribute('class', 'thumbDiv');
                    thumbDiv.setAttribute('id', `thumbNo${indexStart + key}`);
                    // map the position of each image in the albumImage array, according to the div id
                    fileMap[indexStart + key] = `thumbNo${indexStart + key}`;
                    var imgThumb = new Image();
                    imgThumb.title = file.name;
                    imgThumb.src = this.result;
                    imgThumb.setAttribute('class', 'img-thumbnail');
                    if (file.size / 1048576 > 20) {
                        thumbDiv.classList.add('img-too-big');
                        if (tooBig == 0) {
                            createFileFlash('alert-danger', 'Marimea maxima per fisier este de 20 Mb. Elimina fisierele prea mari!');
                        }
                        tooBig++;
                        $('#submit').attr('disabled', 'disabled');

                    }
                    preview.appendChild(thumbDiv);
                    thumbDiv.appendChild(imgThumb);
                    thumbDiv.innerHTML += '<div onclick="removeImage(event)" class="close-icon-link"><i class="\n\
                            material-icons close-icon">delete_forever</i></div>';
                }, false);
                reader.readAsDataURL(file);
            }
        }
        if (newFiles) {
            const iterator = newFiles.keys();
            let lastKey = newFiles.length - 1;
            for (const key of iterator) {
                if (key != lastKey) {
                    readFiles(newFiles[key], key, false);
                }
                else {
                    readFiles(newFiles[key], key, true);
                }
            }
        }
    } else {
        $('.custom-file-input').removeAttr('required');
    }
}

function removeImage(event) {
    let thumbDiv = event.target.parentElement.parentElement;
    const thumbId = thumbDiv.getAttribute('id');
    if (thumbDiv.classList.contains('img-too-big')) {
        tooBig--;
        if (tooBig == 0) {
            removeFlash('.alert-danger-div');
            $('#submit').prop("disabled", false);

        }
    }
    //find and replace the image in the albumFiles array with '' so that we can eliminate it when sending the request
    albumFiles.splice(fileMap.indexOf(thumbId), 1, '');
    thumbDiv.remove();

    let includesFiles = false;
    albumFiles.forEach(element => {
        let elementType = typeof element;
        if (elementType === 'object') {
            includesFiles = true;
            generateFileNames(albumFiles);
        }
    });
    // verify if there are files left, if not change the label to Alege fisier
    if (includesFiles === false) {
        $('.custom-file-label').html("Alege fotografii (max 12)");
        $(document).ready(function () {

            $('.custom-file-input').val("");
        });

    }
}

function createFlash(alertType, message) {
    $('#form-div')
        .prepend(`<div class="row d-flex justify-content-center ${alertType}-div" id="flashmessage"><div class="alert ${alertType}" role="alert">${message}</div></div>`);
}
function createFileFlash(alertType, message) {
    $('#add_product_form')
        .append(`<div class="row d-flex justify-content-center ${alertType}-div" id="flashmessage"><div class="alert ${alertType} m-0" role="alert">${message}</div></div>`);
}
function resetAlerts() {
    let allInvalidSpan = document.querySelectorAll('.invalid-feedback');
    allInvalidSpan.forEach(alertInvalid =>
        alertInvalid.remove()
    );
    let allInvalidInput = document.querySelectorAll('.is-invalid');
    allInvalidInput.forEach(invalidInput =>
        invalidInput.classList.remove('is-invalid')
    );

}
function resetFileAlerts() {
    let inputField = document.querySelector('#albumImage');
    if (inputField.classList.contains('is-invalid')) {
        inputField.classList.remove('is-invalid');
        document.querySelector('#albumImage ~span').remove();
    }
}
;

function generateFileNames(files) {
    fileNames = "";
    files.forEach(function (item) {
        if (item.name) {
            fileNames += item.name + ";";
        }
    });
    $(".custom-file-input").siblings(".custom-file-label").addClass("selected").html(fileNames);

}

function removeFlash(x) {
    let flash = document.querySelector(x);
    if (flash !== null) {
        flash.innerHTML = '';
    }
}




</script>


{{-- <script src="{{ mix('/js/uploadProduct.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('/js/droparea.js') }}" type="text/javascript"></script>

@endsection('scripts')
