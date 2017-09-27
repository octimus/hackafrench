'use strict';
/* Lien et Sous Liste ### deroulante ### */
$(function(){
$('li:has(ul)').hover(function(){
        $(this).addClass('open');
        $(this).find('ul').slideDown('slow');
});
$('li:has(ul)').mouseleave(function(){
        $(this).removeClass('open');
        $(this).find('ul').slideUp('slow');
});
});
/*
$('.nav li').hover(function(){
   $(this).addClass('active'); 
},function(){
    $(this).removeClass('active'); 
});*/
