$(document).ready(function() {
    $('.js-example-basic-single').select2({
        tags: true
    });
});

Dropzone.options.myDropzone= {
    url: '/management/addProduct',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 1,
    addRemoveLinks: true,
    dictRemoveFile: 'Odstrani sliko',
    dictFileTooBig: 'Slika je večja kot 5 MB',
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("_token", jQuery("#token").val());
            formData.append("name", jQuery("#name").val());
            formData.append("description", jQuery("#description").val());
            formData.append("price", jQuery("#price").val());
            formData.append("producer", jQuery("#producer").val());
        });

        this.on("queuecomplete", function (file) {
            window.location.href = "/management/products";
        });
    }
}