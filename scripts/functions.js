/* 
author: Vince Ganev
 */

//declaration of button properties holder object
//var ButtonProperties = function(){
//    this.width = 15;
//    this.heigth = 30;
//    this.font = "Arial";
//    this.fontSize = 12;
//    this.fontBold = false;
//    this.fontItalic = false;
//};

////flag that indicates if the mouse button is still pressed
//var keepRotating = false;

//changes the value in the spinner input
function spinnerRotate(step, id){
    keepRotating = true;
    $('#'+id).val(parseInt($('#'+id).val())+step).trigger('change');
}

////stops the spinner
//function spinnerStop(){
//    keepRotating = false;
//}

//draws the button inside the div that was rassed as a parameter
//function drawButton(div){
//    div.innerHTML = "<input type=\"button\" "
//}

