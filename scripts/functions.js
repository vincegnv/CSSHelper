/* 
author: Vince Ganev
 */

//            prefixes for all the browsers for css3
var browsers = ['-moz-','-webkit-','-ms-','-o-',''];

//declaration of button properties holder object
var ButtonProperties = function(){
    this.type='input';
    this.buttonWidth = 15;
    this.buttonHeight = 30;
    this.buttonColor='';
    this.buttonFont = "Arial";
    this.buttonFontSize = 12;
    this.bold = "";
    this.italic = "";
    this.fontColor = "000000";
    this.buttonText = "";
    this.borderWidth = 1;
    this.borderStyle="solid";
    this.borderColor = "000000";
    this.leftTop = 0;
    this.rightTop = 0;
    this.rightBottom = 0;
    this.leftBottom = 0;
    this.gradientColors = [];
    this.gradientAngle = 0;
    this.gradientType = '';
    this.horizontalBoxShadow = 0;
    this.verticalBoxShadow = '0';
    this.blurBoxShadow = 0;
    this.spreadBoxShadow = 0;
    this.insetBoxShadow = '';
    this.colorBoxShadow = '';
};
ButtonProperties.prototype.addGradientColor = function(color){
    if(this.gradientColors === undefined){
        this.gradientColors=[];
    }
    this.gradientColors.push('#'+color);
    return this.gradientColors.length;
};
ButtonProperties.prototype.removeGradientColor = function(color){
    var gc = this.gradientColors;
    if(gc!==undefined&&gc.length>=1){
        var i = gc.indexOf(color);
//        if color not in the array (when color=''), index of returns -1 and deletes the last element
        gc.splice(gc.indexOf('#'+color),1);
    }
    return gc.length;
};
ButtonProperties.prototype.getGradientColorsCount=function(){
    if(this.gradientColors===undefined){
        return 0;
    }
    return this.gradientColors.length;
};
ButtonProperties.prototype.getBoxShadowLine = function(){
    if(this.horizontalBoxShadow!=='0' || this.verticalBoxShadow!=='0' ||this.blurBoxShadow!=='0' || this.spreadBoxShadow!=='0'){ 
        var inset = '';
        if(this.insetBoxShadow!==undefined){
            inset = this.insetBoxShadow;
            if(inset==='inset'){
                inset+=' ';
            } else{
                inset='';
            }
        }
        var h = '0';
        if(this.horizontalBoxShadow!==undefined){
            h = this.horizontalBoxShadow;
        }
        var v = '0';
        if(this.verticalBoxShadow!==undefined){
            v = this.verticalBoxShadow;
        }
        var b = '0';
        if(this.blurBoxShadow!==undefined){
            b = this.blurBoxShadow;
        }
        var s = '0';
        if(this.spreadBoxShadow!==undefined){
            s = this.spreadBoxShadow;
        }
        var color = '';
        if(this.colorBoxShadow!==undefined&&this.colorBoxShadow!==''){
            color = ' #'+this.colorBoxShadow;
        }
        return inset+h+'px '+v+'px '+b+'px '+s+'px'+color; 
    }
    return '';
};
ButtonProperties.prototype.getHTML = function(){
    switch(this.type){
        case "link":
            return "<a class=\"myButton\" id=\"myButton\" href=\"#  \">"+this.buttonText+"</a>";
            break;        
        case "button":
            return "<button class=\"myButton\" id=\"myButton\" type=\"button\">"+this.buttonText+"</button>";
            break;
        default:
            return "<input type=\"button\" class=\"myButton\" id=\"myButton\" value=\""+this.buttonText+"\">";            
            break;
    }
};

ButtonProperties.prototype.getCSS = function(){
    var css = ".myButton{\n"+
                            "\twidth: "+this['buttonWidth']+"px;\n"+
                            "\theight: "+this['buttonHeight']+"px;\n"+
                            "\tbackground-color: "+"#"+this.buttonColor+";\n"+
                            "\tfont-family: "+this['buttonFont']+";\n"+
                            "\tfont-size: "+this['buttonFontSize']+"px;\n"+
                            "\tcolor: #"+this['fontColor']+";\n";
    if(this['bold']!==""){
        css+="\tfont-weight: "+this['bold']+";\n";
    }
    if(this['italic']!==""){
        css+="\tfont-style: "+this['italic']+";\n";
    }
//    if(this['borderWidth']!=='0'){
    css+="\tborder-width: "+this['borderWidth']+"px;\n";
    css+="\tborder-style: "+this['borderStyle']+";\n";
    css+="\tborder-color: #"+this['borderColor']+";\n";
//    }
    if((this.leftTop!=='0')||(this.rightTop!=='0')||(this.rightBottom!=='0')||(this.leftBottom!=='0')){
        var cssRule='';
        if($('#lockCorners').is(':checked')){
            cssRule=this.leftTop+"px "+this.leftTop+"px "+this.leftTop+"px "+this.leftTop+"px";
        } else{
            cssRule=this.leftTop+"px "+this['rightTop']+"px "+this['rightBottom']+"px "+this['leftBottom']+"px";
        }
        css+="\tborder-radius: "+cssRule+";\n";
        css+="\t-webkit-border-radius: "+cssRule+";\n";
        css+="\t-moz-border-radius: "+cssRule+";\n";
    }
    if(this.type==='link'){
        css+="\ttext-decoration: none;\n";
        css+="\tline-height: "+this.buttonHeight+"px;\n";
        css+="\tdisplay: block;\n";
        css+="\ttext-align: center;\n";
        
    }
    if(this.gradientColors!==undefined&&this.gradientColors.length>1){
        var gType = $("input[name='gradientType']:checked").val();
        var str=this.gradientColors.toString();
        if(gType==='linear'){
            str = this.gradientAngle+'deg,'+str;
        }
        for(var i=0; i<browsers.length; i++){
            css+='\tbackground-image: '+browsers[i]+gType+'-gradient('+str+');\n';
        }
        
    }
    //box-shadow
//    var t = this.getBoxShadowLine();
    if(this.getBoxShadowLine()!==''){
        css+='\tbox-shadow: '+this.getBoxShadowLine()+';\n';
    }
    css+="}";
   return css;
};

ButtonProperties.prototype.update = function(){
    var keys = Object.keys(this);
    //updates all simle inputs that have ids named after Button property
    for(var i = 0; i<keys.length; i++){
//        because type is not id and it is first in the array
        if($('#'+keys[i]).prop('type')!=='checkbox'){
//        if(i>0){
            this[keys[i]] = $('#'+keys[i]).val();
       } else{
           if($('#'+keys[i]).is(':checked')){
               this[keys[i]] = $('#'+keys[i]).val();
           } else{
               this[keys[i]] = '';
           }
//            this[keys[i]] = $("input[name='bType']:checked").val();
        }
    }
    //do checkboxes
//    if($('#bold').is(':checked')){
//        this.bold = "bold";
//    } else{
//        this.bold = "";
//    }
//    if($('#italic').is(':checked')){
//        this.italic = "italic";
//    } else{
//        this.italic = "";
//    }   
    //do the corners
    if($('#lockCorners').is(':checked')){
        this.rightTop = this.leftTop;
        this.rightBottom = this.leftTop;
        this.leftBottom = this.leftTop;
    }    
    //do gradient colors
    var colors = $('#paletteColors').children('input');
    this.gradientColors = [];   
    for(var i = 0; i<colors.length; i++){
        this.gradientColors[i] = '#'+colors.eq(i).val();
    }
    //do gradient type
    this.gradientType = $("input[name='gradientType']:checked").val();
};


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
}

function isInt(n){
    var intRegex = /^\d+$/;
    if(!intRegex.test(n)){
        return false;
    }    
    return true;
}



