$(document).ready(function($){
    if(($(document).outerHeight()-$("footer").outerHeight())<$(window).height()){
        $("footer").addClass('footer-fixed');
    } 
    
    
    //mask fo form
    $("#user-phone").mask("+999(99)999-99-99");
    
    
    
    
});


