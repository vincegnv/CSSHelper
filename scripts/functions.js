/* 
author: Vince Ganev
 */

//declaration of button properties holder object
var ButtonProperties = function(){
    this.width = 15;
    this.height = 30;
    this.font = "Arial";
    this.fontSize = 12;
    this.fontBold = "";
    this.fontItalic = "";
    this.fontColor = "000000";
    this.text = "";
    this.borderWidth = 1;
    this.borderStyle="solid";
    this.borderColor = "000000";
    this.borderLeftTop = 0;
    this.borderRightTop = 0;
    this.borderRightBottom = 0;
    this.borderLeftBottom = 0;
};
ButtonProperties.prototype.getHTML = function(){
    return "<input type=\"button\" class=\"myButton\" value=\""+this.text+"\">";
};
ButtonProperties.prototype.getCSS = function(){
    var css = ".myButton{\n"+
                            "\twidth: "+this.width+"px;\n"+
                            "\theight: "+this.height+"px;\n"+
                            "\tfont-family: "+this.font+";\n"+
                            "\tfont-size: "+this.fontSize+"px\n"+
                            "\tcolor: #"+this.fontColor+";\n";
    if(this.fontBold!==""){
        css+="\tfont-weight: "+this.fontBold+";\n";
    }
    if(this.fontItalic!==""){
        css+="\tfont-style: "+this.fontItalic+";\n";
    }
    if(this.borderWidth!==0){
        css+="\tborder: "+this.borderWidth+"px "+this.borderStyle+" #"+this.borderColor+";\n";
    }
    if(this.borderLeftTop!==0||this.borderRightTop!==0||this.borderRightBottom!==0||this.borderLeftBottom!==0){
        var cssRule = this.borderLeftTop+"px "+this.borderRightTop+"px "+this.borderRightBottom+"px "+this.borderLeftBottom+"px";
        css+="\tborder-radius: "+cssRule+";\n";
        css+="\t-webkit-border-radius: "+cssRule+":\n";
        css+="\t-moz-border-radius: "+cssRule+":\n";
    }
    css+="}";
   return css;
};
ButtonProperties.prototype.update = function(){
    this.width = $('#buttonWidth').val();
    this.height = $('#buttonHeight').val();
    this.font = $('#buttonFont').val();
    this.fontSize = $('#buttonFontSize').val();
    this.fontColor = $('#fontColor').val();
    if($('#bold').is(':checked')){
        this.fontBold = "bold";
    } else{
        this.fontBold = "";
    }
    if($('#italic').is(':checked')){
        this.fontItalic = "italic";
    } else{
        this.fontItalic = "";
    }
    this.text = $('#buttonText').val();
    this.borderWidth = $('#borderWidth').val();
    this.borderStyle = $('#borderStyle').val();
    this.borderColor = $('#borderColor').val();
    this.borderLeftTop = $('#leftTop').val();
    this.borderRightTop = $('#rightTop').val();
    this.borderRightBottom = $('#rightBottom').val();
    this.borderLeftBottom = $('#leftBottom').val();
};

////flag that indicates if the mouse button is still pressed
//var keepRotating = false;

//changes the value in the spinner input
function spinnerRotate(step, id){
//    if(!$(this).is(':disabled')){
//        keepRotating = true;
        $('#'+id).val(parseInt($('#'+id).val())+step).trigger('change');
//    }
}

function updateTheButton(button){
    var b = $('#theButton');
    b.css('font-family',button.font);
    b.css('color', "#"+button.fontColor);
    b.css('font-weight', button.fontBold);
    b.css('font-style', button.fontItalic);
    b.css({'width':button.width+'px', 'margin-left':(-button.width/2)+'px'});
    b.css({'height':button.height+'px', 'margin-top':(-button.height/2)+'px'});
    b.attr('value', button.text);
    b.css({'font-size':button.fontSize+'pt'});
    b.css('border-width',button.borderWidth+"px");
    b.css('border-style',button.borderStyle);
    b.css('border-color',"#"+button.borderColor);
    var tl = button.borderLeftTop;
    var tr = button.borderRightTop;
    var br = button.borderRightBottom;
    var bl = button.borderLeftBottom;
    b.css({'-moz-border-radius': tl + " " + tr + " " + br + " " + bl,
            '-webkit-border-radius': tl + " " + tr + " " + br + " " + bl,
            'border-radius': tl + "px " + tr + "px " + br + "px " + bl+"px"});
}
////stops the spinner
//function spinnerStop(){
//    keepRotating = false;
//}

//draws the button inside the div that was rassed as a parameter
//function drawButton(div){
//    div.innerHTML = "<input type=\"button\" "
//}

