@extends("layouts.admin")
@section("content")

<h5>Adauga articol</h5>
<div class="row m-0 mb-5">
    <div class="col-md-12" id="form-div">
        <form id="add_post_form" method='post' action='{{route("admin.posts.update", $post)}}'
            enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label for="title">Titlu articol</label>
                <input type="text" class="form-control" required id="title" aria-describedby="title_help"
                    value="{{$post->title}}" placeholder="Scrie titlu articol" name='title'>
                @error('title')
                <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="date" class="me-2">Categorie articol:</label>
                <select name="category_id" class="form-control" required id="post_categories">
                    <option disabled selected>Alege categorie</option>
                    @foreach($categories as $category)
                    <option @if($post->category_id == $category->id)
                        selected
                        @endif
                        value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label for="text">Text articol

                    (HTML)

                </label>
                <textarea style='min-height:600px;' required class="form-control" id="text" aria-describedby="text_help"
                    name='text'>{{ $post->text }}</textarea>

            </div>
            <div class="form-group">
                <label for="date" class="me-2">Cuvinte cheie:</label>
                <select name="tags[]" class="form-control" id="tags" multiple="multiple">
                    <option disabled>Adauga cuvinte</option>
                    @foreach($tags as $tag)
                    <option @if(old('tags')==$tag->id)
                        selected
                        @endif
                        value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>

            </div>


            <div class="form-group">
                <label for="post_meta_title">SEO: {{"<title>"}} tag (optional)</label>
                <input class="form-control" id="post_meta_title" aria-describedby="post_meta_title_help"
                    name='meta_title' type='text' value="{{$post->meta_title}}">
            </div>

            <div class="form-group">
                <label for="post_meta_description">Meta Desc (optional)</label>
                <textarea class="form-control" id="post_meta_description" aria-describedby="post_meta_description_help"
                    name='meta_description'>{{ $post->meta_description }}</textarea>
                <small id="post_meta_description_help" class="form-text text-muted">Meta description (optional)</small>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group pl-2">
                        <div class="row">Pune pe prima pagina</div>
                        <label for="da">Da:</label>
                        <input type="radio" id="da" name="is_main" value='1' @if($post->is_main)
                        checked
                        @endif
                        >
                        <br>
                        <label for="nu">NU</label>
                        <input type="radio" id="nu" name="is_main" value='0' @if(!$post->is_main)
                        checked
                        @endif
                        >
                    </div>


                </div>
                @if ($post->photo)
                <div class="col-6 thumb_edit_container">
                    <div class="row justify-content-center">
                        <h5>Poza curenta:</h5>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <img src="{{ $post->photo->thumbnail->file_url}}" id="current_thumbnail" alt="event image"
                                class="img-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary w-100"
                                        onclick="previewFile('{{$post->photo->file_url}}')">Editeaza</button>
                                </div>
                                <div class="col-12">

                                    <button type="button" class="btn btn-danger w-100"
                                        onclick="showModal({{ $post->photo->id}})">Sterge poza</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <div class="form-group">
                <strong>Schimba thumbnail</strong>

                <div class="custom-file">
                    <input type="hidden" name="albumImage" value="">

                    <input type="file" class="custom-file-input" multiple="multiple" id="albumImage"
                        onchange="previewFiles(this.files)" lang="eng" name="albumImage[]">
                    <label class="custom-file-label" for="albumImage[]">Alege fotografiile</label>
                </div>
            </div>


            <div class="row justify-content-end mt-5">
                <input type='submit' class='btn btn-primary' value="Salveaza modificarile">
            </div>
            <div class="row justify-content-center" id="preview"></div>

        </form>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-auto">
        <!-- This is the modal -->
        <div class="modal" tabindex="-1" role="dialog" id="uploadimageModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0 pt-2">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div id="image-crop-div"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span class="mr-5">Regleaza cu ajutorul scrollului sau al barei</span>
                        <button type="button" onclick="removeFile()" class="btn btn-secondary"
                            data-dismiss="modal">Anuleaza</button>
                        <button id="cropresult" type="button" class="btn btn-success">Salveaza</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.deletemodal',['object'=>"imaginea"])

@endsection
@section('scripts')
<script>
    $('#post_categories').select2({

    });

    function showModal(id) {
                $('#deletemodal').modal('show');
                var modalDialog = $(".modal-dialog");
                modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 3));
                $('#delete-item-button').attr('data-id',id)
            }



        function deleteItem(event){
            let target_id = event.currentTarget.dataset.id;
            let formData = new FormData();
                formData.append('photo_id',target_id );
            $.ajax({
            method: 'post',
            processData: false,
            contentType: false,
            async: true,
            cache: false,
            data: formData,
            enctype: 'multipart/form-data',
            url: '{{route("admin.posts.delete.photo")}}',
            encode: true
        })
        // using the done promise callback
        .done(function (data, textStatus, jqXHR) {
            if(data.success){
                $('#deletemodal').modal('hide');
                $('.thumb_edit_container').html('');
                // $('#preview').hmtl('');
            }


        });
        }




    var post = @json($post);

    var dataTags = $.map(post.tags, function(obj) {
        obj.id = obj.name;
        obj.text = obj.name;
        obj.selected = true;
        return obj;
    });

    $('#tags').select2({
     tags: true,
       placeholder: 'Alege categorie'
       , data: dataTags
        , maximumSelectionLength: 5
        , tokenSeparators: [',']
        , "language": {
            "noResults": function() {
                return "Scrie tagul si apasa enter!";
            }
        }
        , escapeMarkup: function(markup) {
            return markup;
        }
    });


</script>


<script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<script>
    if( typeof(CKEDITOR) !== "undefined" ) {
            CKEDITOR.replace('text');
        }
</script>

<script>
    var albumFiles = [];
    var fileMap = [];
    var newFiles = [];
    var fileNames = "";
    var maxNumber = 1;
    var numberOfFiles = 0;
    var tooBig = 0;



    function createDivs() {
        if (!document.querySelector('#preview')) {
            let parentDiv = document.querySelector('#form-div');
            let rowDiv = document.createElement('div');
            rowDiv.setAttribute('class', 'row d-flex mt-1 justify-content-center');
            rowDiv.setAttribute('id', 'preview');
            parentDiv.appendChild(rowDiv);
        }
    }
    // this function is called when the user adds files in the file input
    // first it resets the error messages, then
    function previewFiles(files) {
        if (files.length > 0) {

            removeFlash(".alert-danger-div");
            if (numberOfFiles < maxNumber) {

                resetFileAlerts();
                createDivs();
                var preview = document.querySelector('#preview');
                // The newfiles array contains the newly selected files from the input; it is used so that we can add files multiple times
                newFiles = Array.from(files);
                newFiles.splice(maxNumber);
                //we save the number of existing files added in the albumFiles array so that we can name and map the newly added files
                let indexStart = albumFiles.length;
                albumFiles = albumFiles.concat(newFiles);
                for (let i = 0, len = albumFiles.length; i < len; i++) {
                    if (numberOfFiles === maxNumber) {
                        albumFiles.splice(i);
                        break;
                    }
                    if (albumFiles[i] instanceof File) {
                        numberOfFiles++;
                    }
                }
                generateFileNames(albumFiles);

                function readFiles(file, key, islast) {
                    // Make sure `file.name` matches our extensions criteria
                    if (/\.(jpe?g|png|gif|bmp)$/i.test(file.name)) {
                        var reader = new FileReader();
                        reader.addEventListener("loadstart", function() {
                            $('.loadingPhotos').show();
                            $('#submit').attr('disabled', 'disabled');
                        });
                        reader.addEventListener("loadend", function() {
                            if (islast) {
                                $('.loadingPhotos').hide();
                                if (tooBig == 0) {
                                    $('#submit').prop("disabled", false);
                                }
                            }
                        });
                        reader.addEventListener("load", function() {
                            let thumbDiv = document.createElement('div');
                            thumbDiv.setAttribute('class', 'thumbDiv');
                            thumbDiv.setAttribute('id', `thumbNo${indexStart + key}`);
                            // map the position of each image in the albumImage array, according to the div id
                            fileMap[indexStart + key] = `thumbNo${indexStart + key}`;
                            var imgThumb = new Image();
                            imgThumb.height = 100;
                            imgThumb.title = file.name;
                            imgThumb.src = this.result;
                            imgThumb.setAttribute('class', 'img-thumbnail');
                            if (file.size / 1048576 > 20) {
                                thumbDiv.classList.add('img-too-big');
                                if (tooBig == 0) {
                                    createFileFlash('alert-danger',
                                        'Marimea maxima per fisier este de 20 Mb. Elimina fisierele prea mari!'
                                    );
                                }
                                tooBig++;
                                $('#submit').attr('disabled', 'disabled');

                            }
                            preview.appendChild(thumbDiv);
                            thumbDiv.appendChild(imgThumb);
                            thumbDiv.innerHTML +=
                                '<div onclick="removeImage(event)" class="close-icon-link"><i class="material-icons close-icon">delete_forever</i></div>';
                        }, false);
                        reader.readAsDataURL(file);
                    }

                }

                if (newFiles) {
                    const iterator = newFiles.keys();
                    let lastKey = newFiles.length - 1;
                    if (numberOfFiles <= maxNumber) {
                        for (const key of iterator) {
                            if (key != lastKey) {
                                readFiles(newFiles[key], key, false);
                            } else {
                                readFiles(newFiles[key], key, true);
                            }
                        }
                    }
                }
            }

        } else {
            $('.custom-file-input').removeAttr('required');

        }
    }

    function removeImage(event) {
        document.getElementById('albumImage').value = "";

        let thumbDiv = event.target.parentElement.parentElement;
        const thumbId = thumbDiv.getAttribute('id');
        if (thumbDiv.classList.contains('img-too-big')) {
            tooBig--;
            if (tooBig == 0) {
                removeFlash('.alert-danger-div');
                $('#submit').prop("disabled", false);

            }
        } //find and replace the image in the albumFiles array with '' so that we can eliminate it when sending the request
        albumFiles.splice(fileMap.indexOf(thumbId), 1, '');
        thumbDiv.remove();
        numberOfFiles--;
        let includesFiles = false;
        albumFiles.forEach(element => {
            let elementType = typeof element;
            if (elementType === 'object') {
                includesFiles = true;
                generateFileNames(albumFiles);
            }
        });
        removeFlash(".alert-danger-div");

        // verify if there are files left, if not change the label to Alege fisier
        if (includesFiles === false) {
            $('.custom-file-label').html("Alege fotografia");
            $(document).ready(function() {

                $('.custom-file-input').val("");
            });

        }
    }

    function createFlash(alertType, message) {
        $('#form-div')
            .prepend(
                `<div class="row d-flex justify-content-center ${alertType}-div" id="flashmessage"><div class="alert ${alertType}" role="alert">${message}</div></div>`
            );
    }

    function createFileFlash(alertType, message) {
        $('#add_news_form')
            .append(
                `<div class="row d-flex justify-content-center ${alertType}-div" id="flashmessage"><div class="alert ${alertType} m-0" role="alert">${message}</div></div>`
            );
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
    };

    function generateFileNames(files) {
        fileNames = "";
        files.forEach(function(item) {
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

// aici

    // cropped
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var width = window.innerWidth * 0.25;
var height = window.innerWidth * 0.25;
var bwidth = window.innerWidth * 0.3;
var bheight = window.innerWidth * 0.4;
var uploadCrop;

$(document).ready(function () {

    uploadCrop = $('#image-crop-div').croppie({
    enableExif: true,
    viewport: { width: width, height: height },
    boundary: { width: bwidth, height: bheight },
    showZoomer: true,
    enableResize: true,
    enableOrientation: true,
    mouseWheelZoom: 'ctrl'
    });


});



// `await` can only be used in an async body, but showing it here for simplicity.


function uploadCropped(formData) {
    $('#uploadimageModal').modal('hide');

    $.ajax({
        method: 'post',
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        data: formData,
        enctype: 'multipart/form-data',
        url: '{{route("upload.cropped")}}',
        encode: true
    })
        // using the done promise callback
        .done(function (data, textStatus, jqXHR) {
            if (data.success) {
                location.reload(true);

            } else {
                removeFile();
                $.each(data.error, function (key, value) {


                    let mainDiv = $('.profile-photo');
                    let allErrors = '';

                    mainDiv.append('<span class="invalid-feedback" role="alert"></span>');
                    $.each(value, function (i, val) {
                        allErrors += val + ' ';
                    });
                    mainDiv.children().last().append(`<strong>${allErrors}</strong>`);
                });

            }
        })
        .fail(function (jqXHR, textStatus) {
            createFlash('alert-danger', "S-a produs o eroare neasteptata! Da refresh si incearca din nou!");

        });
};

async function getFileFromUrl(url, name, defaultType = 'image/jpeg'){
  const response = await fetch(url);
  const data = await response.blob();
  return new File([data], name, {
    type: data.type || defaultType,
  });
}


async function previewFile(files) {
    let file = await getFileFromUrl(files, 'imagine.jpg');
    let thumbSrc;
    let photo_id = @json($post->photo? $post->photo->id:'');
    let photo_model = 'App\\Models\\PostPhoto';
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        thumbSrc = reader.result;
        uploadCrop.croppie('bind', {
            url: thumbSrc,
        });

        $('#uploadimageModal').modal('show');
        $('#uploadimageModal').modal('handleUpdate');
        $('#cropresult').on('click', function () {
            uploadCrop.croppie('result', 'blob', 'original', 'png', 1, true).then(function (blob) {
                let formData = new FormData();
                thumbSrc = URL.createObjectURL(blob, { oneTimeOnly: true });
                $('#image-crop-div').attr("src", thumbSrc);
                formData.append('image', blob, 'imagine_cropped');
                formData.append('photo_id',photo_id )
                formData.append('photo_model',photo_model )
                uploadCropped(formData);
            });
        });

    };
}


function removeFile() {
    $('.custom-file-label').html("Alege foto");
    $(document).ready(function () {

        $('.custom-file-input').val("");
    });
}








</script>
@endsection
