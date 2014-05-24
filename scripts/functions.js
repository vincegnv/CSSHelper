/* 
author: Vince Ganev
 */




//changes the value in the spinner input
function spinnerRotate(step, id){
    window.timer = window.setInterval(function(){
        $('#'+id).val(parseInt($('#'+id).val())+step).trigger('change');  
    },110);
}

function stopSpinner(){
    window.clearInterval(window.timer);
}

function updateTheButton(button){
    $('#buttonContainer').html(button.getHTML());
    var b = $('#myButton');
    b.css('z-index', 1);
    b.css('font-family',button['buttonFont']);
    b.css('color', "#"+button['fontColor']);
    b.css('font-weight', button['bold']);
    b.css('font-style', button['italic']);
    b.css({'width':button['buttonWidth']+'px', 'margin-left':(-button['buttonWidth']/2)+'px'});
//    adjusting the container div
    if(button.buttonHeight>130){
        $("#buttonContainer").height(parseInt(button.buttonHeight)+20);
    } else{
        $("#buttonContainer").height(150);  
    }         

    b.css({'height':button['buttonHeight']+'px', 'margin-top':(-button['buttonHeight']/2)+'px'});
    b.css('background-color', "#"+button.buttonColor);
    if(button.type==='input'){
        b.attr('value', button['buttonText']);  
    } else{
        b.html(button.buttonText);
    }
    b.css({'font-size':button['buttonFontSize']+'pt'});
    b.css('border-width',button['borderWidth']+"px");
    b.css('border-style',button['borderStyle']);
    b.css('border-color',"#"+button['borderColor']);
    var tl = button['leftTop'];
    var tr = button['rightTop'];
    var br = button['rightBottom'];
    var bl = button['leftBottom'];
    b.css({'-moz-border-radius': tl + " " + tr + " " + br + " " + bl,
            '-webkit-border-radius': tl + " " + tr + " " + br + " " + bl,
            'border-radius': tl + "px " + tr + "px " + br + "px " + bl+"px"});
    if(button.type==='link'){
        b.css('text-decoration','none');
        b.css('line-height',button.buttonHeight+"px");
    }
//    gradient
    if(button.getGradientColorsCount()>=2){
        var str=button.gradientColors.toString();
        if(button.gradientType==='linear'){
            str = button.gradientAngle+'deg,'+str;
        }
        for(var i = 0; i<browsers.length; i++){
            b.css('background-image',browsers[i]+button.gradientType+'-gradient('+str+')');                   
        }
    }
    //box-shadow
    if(button.getBoxShadowLine!==''){
        var line = button.getBoxShadowLine();
        b.css('box-shadow', line);
    }
    //text-shadow
    if(button.getTextShadowLine!==''){
        var line = button.getTextShadowLine();
        b.css('text-shadow', line);
    }
}

function isInt(n){
    var intRegex = /^-?\d+$/;
    if(!intRegex.test(n)){
        return false;
    }    
    return true;
}

function putOnTop(div){
    //get all the divs that are siblings with this one, including itself
    //find our div in that group
    var index = $('.propertyGroup').index(div);
    while(index > 0){
        $('.propertyGroup').eq(index-1).insertAfter(div);        
        index--;
    }
    //close the divs that are open after the second div
    for(var i = 2; i<$('.propertyGroup').length; i++){
        if($('.propertyGroup').eq(i).is(':visible')){
            closeDiv($('.propertyGroup').eq(i).find('span').first());
        }
    }
}  

function openDiv(span){
    var color = '#'+span.parent('h2').css('color');
    var padding = span.parent('h2').css('padding-left');
    span.parent('h2').css('padding-left',300).css('color','#FFFFFF');
    span.parent('h2').animate({
        color:color
       , 'padding-left' :padding
    }, 600)
//            .animate({
//        color:color,
//        'padding-left': padding
//    }, 800);
    span.text('-');
    span.parent('h2').next().show();
    span.parent().removeClass('remove-margin'); 
//    span.parents('.propertyGroup').first().css('border-color','#0E398B');
}

function closeDiv(span){
    span.text('+');
    span.parent('h2').next().hide();
    span.parent().addClass('remove-margin');    
//    span.parents('.propertyGroup').first().css('border-color','#E1EAFB');
}

function titleEffect(){
    var title = $('#title');
    var container = title.parent('h1').eq(0);
    var travelMargin = container.width()- title.width() - 2*parseInt(title.css('padding-left'));
    var centerMargin = container.width()/2 - title.width()/2;
    title.animate({'margin-left': centerMargin}, 500);
}

//function shareElement(id){
//   $.ajax({  
//   type: "POST",  
//   data: "id="+id,  
//   url: "shareElement.php",  
//   success: function(msg)  
//   {  
//    $("span#votes_count"+the_id).html(msg);  
//    //fadein the vote count  
//    $("span#votes_count"+the_id).fadeIn();  
//    //remove the spinner  
//    $("span#vote_buttons"+the_id).remove();   
//}

