
var dropArea = document.getElementById('form-div');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}
;

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false);
})

    ;
['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropArea.classList.add('highlight');
}

function unhighlight(e) {
    dropArea.classList.remove('highlight');
}


dropArea.addEventListener('drop', handleDrop, false);



function handleDrop(e) {

    let dt = e.dataTransfer;
    let files = dt.files;
    previewFiles(files);
    $('.custom-file-input').removeAttr('required');


}
