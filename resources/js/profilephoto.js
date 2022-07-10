$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var width = window.innerWidth * 0.3;
var height = window.innerWidth * 0.3;
var bwidth = window.innerWidth * 0.3;
var bheight = window.innerWidth * 0.3;
var uploadCrop;
$(document).ready(function () {
    uploadCrop = $('#user-crop').croppie({
        enableExif: true,
        viewport: {
            width: width,
            height: height,
            type: 'circle'
        },
        boundary: {
            width: bwidth,
            height: bheight
        },
    });
});
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
        url: '/api/update-profile-photo',
        encode: true
    })
        // using the done promise callback
        .done(function (data, textStatus, jqXHR) {
            if (data.success) {
                removeFile();

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


function previewFiles(files) {
    let file = files[0];
    var thumbSrc;
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        thumbSrc = reader.result;
        uploadCrop.croppie('bind', {
            url: thumbSrc,
        });

        $('#uploadimageModal').modal('show');
        $('#uploadimageModal').modal('handleUpdate')
        $('#cropresult').on('click', function () {
            uploadCrop.croppie('result', 'blob', 'original', 'png', 1, true).then(function (blob) {
                let formData = new FormData();
                thumbSrc = URL.createObjectURL(blob, { oneTimeOnly: true });
                $('#user-pic').attr("src", thumbSrc);
                formData.append('image', blob);
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

function createFlash(alertType, message) {
    $('.flashcontainer')
        .prepend(`<div class="row d-flex justify-content-center ${alertType}-div" id="flashmessage"><div class="alert ${alertType}" role="alert">${message}</div></div>`);
}
function removeFlash(x) {
    let flash = document.querySelector(x);
    if (flash !== null) {
        flash.innerHTML = '';
    }
}
