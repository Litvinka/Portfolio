$(document).ready(function($){
    footer();
    //change size photo
    var all_photo=$("#all-elements-photo div img");
    for(var i=0;i<all_photo.length;++i){
        resize_img(all_photo[i],$(all_photo[i]).parent());
    }
    //mask fo form
    $("#user-phone").mask("+999(99)999-99-99");
    
       
});


//resize_window
$(window).resize(function(){
    var all_photo=$("#all-elements-photo div img");
    for(var i=0;i<all_photo.length;++i){
        resize_img(all_photo[i],$(all_photo[i]).parent());
    }
    footer();
});




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



//RESIZE IMAGE ON PAGE
function resize_img(img, div){  
    var width_div=$(div).css('width').substring(0,$(div).css('width').length-2);
    var height_img=$(img).css('height').substring(0,$(img).css('height').length-2);
    var width_img=$(img).css('width').substring(0,$(img).css('width').length-2);
    $(div).css('height',width_div);
    if(height_img >= width_img){
        var height=(height_img*width_div)/width_img;
        var width=width_div;
        $(img).css('width',width_div);
        $(img).css('height',(height));
        $(img).css('left',(((-1)*(height-width)/2)));
    }
    else{
        var width=(width_img*width_div)/height_img;
        var height=width_div;
        $(img).css('height',width_div);
        $(img).css('width',(width));
        $(img).css('left',((-1)*(width-height)/2));
    }
}


//RESIZE IMAGE BEFORE UPLOAD
function resize_img_upload(img){
    
}


function footer(){
    if(($(document).outerHeight()-$("footer").outerHeight())<$(window).height()){
        $("footer").addClass('footer-fixed');
    } 
}


$("#all-elements-photo div img").click(function(){
    $('.background-galery').css("display", "flex").hide().fadeIn();
    $('.galery-img').attr('src',$(this).attr("src"));
    console.log($(this).attr("src"));
});
$(".background-galery").click(function(e){
    if (e.target !== this){
        return;
    }
    $(".background-galery").fadeOut();
});


