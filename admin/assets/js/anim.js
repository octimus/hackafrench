"use strict";
$(window).on('load',function() {
    $('#img_load').fadeOut(2000);
});
$(function(){
    $('#body').fadeIn(4000);
});


var larg = $('body').width();
if(larg > 750){
    var ins = $('#inscrit h3');
    var con = $('#connect h3');
    
    ins.click(function(){
        $('#inscrit').css({
            'transform':'rotate(0deg)',
            'left': '0'
        });
    });
    
    ins.dblclick(function(){
        $('#inscrit').css({
            'transform':'rotate(90deg)',
            'left': '-237'
        });
    });
    
    con.click(function(){
        $('#connect').css({
            'transform':'rotate(0deg)',
            'right': '0'
        });
    });
    
    con.dblclick(function(){
        $('#connect').css({
            'transform':'rotate(-90deg)',
            'right': '-156'
        })
    });
}