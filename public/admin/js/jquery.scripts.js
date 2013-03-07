$(document).ready(function(){
    $('#upload-file').css('display','none');
    
    $('#upload-file-enable').click(function() {
        $('#upload-file').toggle();
        if ($('.file_1').attr('disabled')=='disabled') {
            $('.file_1').removeAttr('disabled');
        }
        else {
            $('.file_1').attr('disabled',true);
        }
    })
    
});  