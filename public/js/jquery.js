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
    maxFiles: 20,
    maxFilesize: 1,
    addRemoveLinks: true,
    dictRemoveFile: 'Odstrani sliko',
    dictFileTooBig: 'Slika je večja kot 5 MB',
    dictDefaultMessage: "Datoteke lahko dodate tako, da jih povlečete in spustite sem.",
    dictCancelUpload: "Prekliči nalaganje",
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            console.log($("#name").val());
            if(!$("#name").val()) {
                $('#errors-message').text('Ime je obvezno polje');
                $('#errors-message').attr('style','display: block');
            } else if(!$("#description").val()) {
                $('#errors-message').text('Opis je obvezno polje');
                $('#errors-message').attr('style','display: block');
            } else if (!$("#price").val()) {
                $('#errors-message').text('Cena je obvezno polje');
                $('#errors-message').attr('style','display: block');
            } 
            else {
                dzClosure.processQueue();
            }
            
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("_token", jQuery("#token").val());
            formData.append("name", jQuery("#name").val());
            formData.append("description", jQuery("#description").val());
            formData.append("price", jQuery("#price").val());
            formData.append("producer", jQuery("#producer").val());
        });

        this.on("success", function (file) {
            window.location.href = "/management/products";
        });
    }
}