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
    this.verticalBoxShadow = 0;
    this.blurBoxShadow = 0;
    this.spreadBoxShadow = 0;
    this.insetBoxShadow = '';
    this.colorBoxShadow = '';
    this.opacityBoxShadow = 100;
    this.horizontalTextShadow = 0;
    this.verticalTextShadow = 0;
    this.blurTextShadow = 0;
    this.colorTextShadow = 0;
    this.opacityTextShadow = 100;
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
//        if color not in the array (when color=''), indexOf returns -1 and deletes the last element
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
            color = this.colorBoxShadow;
        } else{
            color = this.fontColor;
        }
        var o = '100';
        if(this.opacityBoxShadow!==undefined){
            o = this.opacityBoxShadow;
        } 
        var rgba = '';
        if(color!==''){
            rgba = doRGBA(color, o);
        }
        return inset+h+'px '+v+'px '+b+'px '+s+'px'+rgba; 
    }
    return '';
};
ButtonProperties.prototype.getTextShadowLine = function(){
    if(this.horizontalTextShadow!=='0' || this.verticalTextShadow!=='0' ||this.blurTextShadow!=='0'){ 
        var h = '0';
        if(this.horizontalTextShadow!==undefined){
            h = this.horizontalTextShadow;
        }
        var v = '0';
        if(this.verticalTextShadow!==undefined){
            v = this.verticalTextShadow;
        }
        var b = '0';
        if(this.blurTextShadow!==undefined){
            b = this.blurTextShadow;
        }
        var color = '';
        if(this.colorTextShadow!==undefined&&this.colorTextShadow!==''){
            color = this.colorTextShadow;
        } else{
            color = this.fontColor;
        }
        var o = '100';
        if(this.opacityTextShadow!==undefined){
            o = this.opacityTextShadow;
        } 
        var rgba = '';
        if(color!==''){
            rgba = doRGBA(color, o);
        }
        return h+'px '+v+'px '+b+'px'+rgba; 
    }
    return '';
};
function doRGBA(hex, opacity){
    var bigint = parseInt(hex, 16);
    var r = (bigint >> 16) & 255;
    var g = (bigint >> 8) & 255;
    var b = bigint & 255;
    var o = parseInt(opacity)/100;
    return ' rgba('+[r,g,b,o].join()+')';
}
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
    css+="\tborder-width: "+this['borderWidth']+"px;\n";
    css+="\tborder-style: "+this['borderStyle']+";\n";
    css+="\tborder-color: #"+this['borderColor']+";\n";
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
    if(this.getBoxShadowLine()!==''){
        css+='\t-moz-box-shadow: '+this.getBoxShadowLine()+';\n';
        css+='\t-webkit-box-shadow: '+this.getBoxShadowLine()+';\n';
        css+='\tbox-shadow: '+this.getBoxShadowLine()+';\n';
    }
    //text-shadow
    if(this.getTextShadowLine()!==''){
        css+='\t-moz-text-shadow: '+this.getTextShadowLine()+';\n';
        css+='\t-webkit-text-shadow: '+this.getTextShadowLine()+';\n';
        css+='\ttext-shadow: '+this.getTextShadowLine()+';\n';
    }    
    css+="}";
   return css;
};

ButtonProperties.prototype.update = function(){
    var keys = Object.keys(this);
    //updates all simple inputs that have ids named after Button property
    for(var i = 0; i<keys.length; i++){
        //anything that is not checkbox
        if($('#'+keys[i]).prop('type')!=='checkbox'){
            this[keys[i]] = $('#'+keys[i]).val();
       } else{
           //only checked checkboxes
           if($('#'+keys[i]).is(':checked')){
               this[keys[i]] = $('#'+keys[i]).val();
           } else{
               this[keys[i]] = '';
           }
        }
    }
 
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