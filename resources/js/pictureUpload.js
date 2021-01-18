$image_crop = $('#picture-box').croppie({
    enableExif: true,
    viewport: {
        width:250,
        height:250,
        type:'circle' //circle
    },
    boundary:{
        width:300,
        height:300
    }
});

$('#close-profile-picture-modal').on('click', function(){
    $('#picture-file').val('');
});

$("#profile-picture-modal").on('hidden.bs.modal', function(){
    $('#picture-file').val('');
});

$('#picture-file').on('change', function(){
    var file = this.files[0];
    var fileType = file["type"];
    var fileSize = file["size"];
    var validImageTypes = ["image/jpg", "image/jpeg", "image/png"];
    if ($.inArray(fileType, validImageTypes) > 0) {
        if (fileSize < 5242880){
            var reader = new FileReader();
            reader.onload = function (event) {
            $image_crop.croppie('bind', {
                url: event.target.result
                }).then(function(){
                    console.log('jQuery Bind Complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
    
            $('#profile-picture-modal').modal('show');
            
            }
        else {
            $('#profile-picture-modal-error-content').html('File size exceeded the limit of 5 MB.');
            $('#profile-picture-modal-error').modal('show');
        }
    }
    else {
        $('#profile-picture-modal-error-content').html('JPG and PNG are the only accepted files.');
        $('#profile-picture-modal-error').modal('show');
    }
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#crop-upload-picture').on('click', function(event){
    $image_crop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
    }).then(function(response){
        $.ajax({
            url: "profile/upload",
            type: "POST",
            data: { image: response },
            success:function(data){
                window.location.href = "profile"
            }
        });
    });
});