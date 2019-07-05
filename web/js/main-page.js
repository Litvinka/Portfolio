$(document).ready(function(){
	//$(".photo_user img").css("height",$(".photo_user img").css("width"));
    
    if(($(document).outerHeight()-$("footer").outerHeight())<$(window).height()){
        $("footer").addClass('footer-fixed');
    } 
});