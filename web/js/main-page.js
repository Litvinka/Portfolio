$(document).ready(function($){
    footer();
    //change size photo
    var all_photo=$("#all-elements-photo div img.img-elem");
    for(var i=0;i<all_photo.length;++i){
        resize_img(all_photo[i],$(all_photo[i]).parent());
    }
    //mask fo form
    $("#user-phone").mask("+999(99)999-99-99");
    
       
});


//resize_window
$(window).resize(function(){
    var all_photo=$("#all-elements-photo div img.img-elem");
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

function delete_photo(id){
    $(".background-modal-element").css("display", "flex").hide().fadeIn();
    $('.modal-window-element #id').val(id);
}
$(".background-modal-element").click(function(e){
    if (e.target !== this){
        return;
    }
    $(".background-modal-element").fadeOut();
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


function footer(){
    if(($(document).outerHeight()-$("footer").outerHeight())<$(window).height()){
        $("footer").addClass('footer-fixed');
    } 
}


// --- GALERY ---
$("#all-elements-photo div img.img-elem").click(function(){
    start_galery(this);
});

//начало просмотра всех фото в большом размере в галерее
function start_galery(img){
    $('.background-galery').css("display", "flex").hide().fadeIn();
    $('.galery-img').attr('src',$(img).attr("src"));
    getLeftImg(img);
    getNextImg(img);
}

function getLeftImg(img){
    var prev_img=$(img).parent().prev().find('img.img-elem');
    if(prev_img.length>0){
        $('.galery-block a.left').attr('href',prev_img.attr("src"));
        $('.galery-block a.left').css('display','block');
    }
    else{
        $('.galery-block a.left').css('display','none');
    }
}

function getNextImg(img){
    var next_img=$(img).parent().next().find('img.img-elem');
    if(next_img.length>0){
        $('.galery-block a.right').attr('href',next_img.attr("src"));
        $('.galery-block a.right').css('display','block');
    }
    else{
        $('.galery-block a.right').css('display','none');
    }
}

$(".galery-block a").click(function(e){
    e.preventDefault();
    $('.galery-img').attr('src',$(this).attr('href'));
    var img=$('#all-elements-photo div img[src = "'+$(this).attr('href')+'"]').first();
    getLeftImg(img);
    getNextImg(img);
});

$("img.close-img").click(function(){
    $('.background-galery').fadeOut();
});

$(".background-galery").click(function(e){
    if (e.target !== this){
        return;
    }
    $(".background-galery").fadeOut();
});
// --- GALERY (END) ---
