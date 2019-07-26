$(function() {
    $("html").on("dragover", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(".upload-area h4").text("Drag here");
    });

    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

    
    $('.upload-area').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".upload-area h4").text("Файл загружен");
        var file = e.originalEvent.dataTransfer.files;
        var fd = new FormData();
        fd.append('file', file[0]);
        uploadData(fd);
    });

    
    $("#upload-file").click(function(){
        $("#file").click(); 
    });

    
    $("#file").change(function(){
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        uploadData(fd);
    });
});


function uploadData(formdata){
    formdata.append('id',getUrlParameter('id'));
    $.ajax({
        url: 'index.php?r=elements/upload',
        type: 'post',
        data: formdata,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data){
            var html="<div><img src='"+data+"'></div>";
            $("#all-elements-photo").append(html);
            $("#all-elements-photo div img").on('load', function() {
                resize_img(this,$(this).parent());
            });
            $("#all-elements-photo div img").click(function(){
                start_galery(this);
            });
        }
    });
}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};