$(document).ready(function($){
    if(($(document).outerHeight()-$("footer").outerHeight())<$(window).height()){
        $("footer").addClass('footer-fixed');
    } 
    
    
    //mask fo form
    $("#user-phone").mask("+999(99)999-99-99");
    
    

});


//style for wysiwyg
if($('.cke_wysiwyg_frame').length){
    $('.cke_wysiwyg_frame').load(function(){
        $(this).contents().find(".cke_editable").css('font-size','15px').css('font-weight','bold');
    });
}




//MODAL SCRIPT
$(".delete-btn-a").click(function(e){
    $(".background-modal").css("display", "flex").hide().fadeIn();
});

$(".background-modal").click(function(e){
    if (e.target !== this){
        return;
    }
    $(".background-modal").fadeOut();
});
//MODAL SCRIPT (END)