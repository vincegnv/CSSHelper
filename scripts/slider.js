/* 
 *Provides fuctionality for the custom slider control
 */
var thumb = null;
var bar = null;
var leftStop, rightStop;
var minValue, maxValue;
var holdingThumb = false;

$(document).ready(function(){
//    $('.sliderValue').val(function(){
//       return $(this).parents('.sliderWraper').find('label').first().html();
//    });
    //to update slider thumb position
    
    $('.sliderValue').each(function(){
        if($(this).val()!=='0'){
            var wraper = $(this).closest('.sliderWraper');
            var thumb = wraper.find('.sliderThumb').eq(0);
            var bar = wraper.find('.sliderBar').eq(0);
            var minValue = wraper.find('label').first().html();
            var maxValue = wraper.find('label').last().html();
            var leftStop = parseInt(bar.offset().left,10);
            var rightStop = parseInt(bar.offset().left + bar.width() - thumb.width(),10);            
            var value = parseInt($(this).val());
            var position = Math.abs(value/(maxValue-minValue))*(rightStop-leftStop);
            var leftOffset = Math.round(bar.offset().left+position);
            var topOffset = thumb.offset().top;
            thumb.offset({top: topOffset, left: leftOffset});
        }
    });
    
//    if($('.sliderValue').val()!=='0'){
//        $('.sliderValue').val().trigger('change');
//    }
    
    //get all the "global" parameters needed
    $('.sliderWraper').mouseenter(function(){
        thumb = $(this).find('.sliderThumb').eq(0);
        bar = $(this).find('.sliderBar').eq(0);
        minValue = parseInt($(this).find('label').first().html());
        maxValue = parseInt($(this).find('label').last().html());
        leftStop = Math.round(bar.offset().left);
        rightStop = Math.round(bar.offset().left + bar.width() - thumb.width());
            
    });
//unset thumb when leaving the control
    $('.sliderWraper').mouseleave(function(){
       thumb = null; 
    });
    //turn on
    $('.sliderThumb').mousedown(function(e){
        holdingThumb = true;
    });
    //turn off
    $(document).mouseup(function(){
       holdingThumb = false; 
    });            
    //move
    $('.sliderWraper').mousemove(function(e){
        var pageX = Math.round(e.pageX);
     if(holdingThumb && pageX>=leftStop && pageX<=rightStop){
         var value;
         if(pageX==leftStop){
             value = minValue;
         } else if(pageX==rightStop){
             value = maxValue;
         } else{
//        thumb.offset({top: thumb.offset().top, left: e.pageX-thumb.width()/2});
            var percent = 100*((pageX - bar.offset().left)/(rightStop-leftStop));
            var step = (maxValue-minValue)/100;
            var value = Math.round(minValue+step*percent);
         }
//        if(value < minValue){
//            value = minValue;
//        }
//        else if(value > maxValue){
//            value = maxValue;
//        }
    
        $(this).find('.sliderValue').val(value).trigger('change');
     }
    });
    

    $('.sliderBar').click(function(e){

        var clickX =  e.pageX;
        var thumbX = thumb.offset().left + thumb.width()/2;
        //step that is 10% of the whole range
        var bigStep = Math.abs((maxValue - minValue)/10);
        var step = 1;
        //convert click offset with thumb to value
        var offsetValue = Math.abs(clickX-thumbX)*(maxValue-minValue)/(rightStop-leftStop);
        //set the direction
        if(clickX < thumbX){
            step = -1;
        }
        var text = $(this).parents('.sliderWraper').find('input[type=text]').eq(0);
        var currValue = parseInt(text.val());
//                var newValue;
        if(offsetValue > bigStep){
            step *= bigStep;
        }
        var newValue = currValue;
        //check if passes the right limit
        if(currValue+step > maxValue){
            newValue = maxValue;
            //if passes the left limit
        } else if(currValue+step < minValue){
            newValue = minValue;
        } else{
            newValue = currValue+step;
        }
        //set the new value and thumb position
        text.val(newValue).trigger('change'); 
    });

    //slide the thumb when value is changed manualy
    $('.sliderValue').change(function(){
        var thumb = $(this).closest('.sliderWraper').find('.sliderThumb').eq(0);
        var value = parseInt($(this).val());
        var position = Math.abs(value/(maxValue-minValue))*(rightStop-leftStop);
        var leftOffset = Math.round(bar.offset().left+position);
        var topOffset = thumb.offset().top;
        thumb.offset({top: topOffset, left: leftOffset});
    });

});

