function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-photo').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$('.upload-file-container input:file').change(function () {
    readURL(this);
});



