<!--
author: Vince Ganev
-->

        <?php
            require('../Templates/header.php');
            require('../Templates/buttonLeftColumn.php');
            require('../Templates/buttonRightColumn.php');
            require('../Templates/footer.php')
        ?>

        <script type="text/javascript">
            var button = new ButtonProperties();
            
            $(document).ready(function(){
                button.update();
                updateTheButton(button);
//                $('#theButton').css({'width':button.width,'height':button.height,'font-family':button.font,'font-size':button.fontSize,});
////                $(".spinner input:button").mouseup(spinnerStop);
//                $('#theButton').attr('value', button.buttonText);
//                update the button and the class holding all the properties
                $('.property').on('change', function(){
                    var id = $(this).attr('id');
                    switch(id){
                        case "buttonFont":
                            $('#theButton').css('font-family',$(this).val());
                            button.font = $(this).val();
                            break;
                        case "bold":
                            if($(this).is(':checked')){
                                $('#theButton').css('font-weight', 'bold');
                                button.fontBold = "bold";
                            } else{
                                $('#theButton').css('font-weight', '');
                                button.fontBold = "";
                            }  
                            break;
                        case "italic":
                            if($(this).is(':checked')){
                              $('#theButton').css('font-style', 'italic');
                              button.fontItalic = "italic";
                            } else{
                                $('#theButton').css('font-style', '');
                                button.fontItalic = "";
                            }
                            break;
                        case "buttonWidth":
                            if($('#theButton').width() < $('#buttonContainer').width()-20){
                                $("#theButton").css({'width':$(this).val()+'px', 'margin-left':(-$(this).val()/2)+'px'});
                                button.width = $(this).val();
                            } 
                            break;
                        case "buttonHeight":
                            if($('#theButton').height() < $('#buttonContainer').height()-20){
                                $("#theButton").css({'height':$(this).val()+'px', 'margin-top':(-$(this).val()/2)+'px'});    
                                button.height = $(this).val();
                            }   
                            break;
                        case "buttonText":
                            button.text = $(this).val(); 
                            break;
                        case "buttonFontSize":
                            $("#theButton").css({'font-size':$(this).val()+'pt'});
                            button.fontSize = $(this).val();   
                            break;
                        case "fontColor":
                            $('#theButton').css('color', "#"+$(this).val());
                            button.fontColor = $(this).val();
                            break;
                        case "borderWidth":
                            $('#theButton').css('border-width',$(this).val()+"px");
                            button.borderWidth = $(this).val();
                            break;
                        case "borderStyle":
                            $('#theButton').css('borderStyle', $(this).val());
                            button.borderStyle = $(this).val();
                            break;
                        case "borderColor":
                            $('#theButton').css('borderColor',"#"+$(this).val());
                            button.borderColor = $(this).val();
                            break;
                        case "lockCorners":
                            if($(this).is(':checked')){
                                $("#cornerTool div.spinner:not(:first-child) :input").prop('disabled', true);
                                $("#cornerTool div.spinner:not(:first-child) :input[type='button']").addClass('spinnerDisabled');
                            } else{
                                $("#cornerTool div.spinner:not(:first-child) :input").prop('disabled', false);   
                                $("#cornerTool div.spinner:not(:first-child) :input[type='button']").removeClass('spinnerDisabled');                                
                            }
                            break;
                        case "leftTop":
                            
                        case "rightTop":
                        case "rightBottom":
                        case "leftBottom":
                            var tl = $('#leftTop').val();
                            var tr = $('#rightTop').val();
                            var br = $('#rightBottom').val();
                            var bl = $('#leftBottom').val();
                            $('#theButton').css('border-radius', tl + "px " + tr + "px " + br + "px " + bl+"px");                            
                            break;
                             
                    }
                    
                    $('#HTMLsource').val(button.getHTML());
                    $('#CSSsource').val(button.getCSS());
                });

                $('#buttonText').on('keyup', function(){
                    $('#theButton').attr('value',$(this).val());
                    button.text = $(this).val();
                    $(this).trigger('change');
                });
                
//                $('#buttonFont').on('change', function(){
//                   $('#theButton').css('font-family',$(this).val());
//                   button.font = $(this).val();
//                });
                
//                $('#bold').on('change', function(){
//                    if($(this).is(':checked')){
//                        $('#theButton').css('font-weight', 'bold');
//                        button.fontBold = "bold";
//                    } else{
//                        $('#theButton').css('font-weight', '');
//                        button.fontBold = "";
//                    }
//                });

//                $('#italic').on('change', function(){
//                    if($(this).is(':checked')){
//                        $('#theButton').css('font-style', 'italic');
//                        button.fontItalic = "italic";
//                    } else{
//                        $('#theButton').css('font-style', '');
//                        button.fontItalic = "";
//                    }
//                });

//                $("input.property:text").on("change",function(){
//                    var id = $(this).attr('id');
//                    if(id==="buttonWidth"){
//                        if($('#theButton').width() < $('#buttonContainer').width()-20){
//                            $("#theButton").css({'width':$(this).val()+'px', 'margin-left':(-$(this).val()/2)+'px'});
//                            button.width = $(this).val();
//                        }
//                    } else if(id==="buttonHeight"){
//                        if($('theButton').height() < $('buttonContainer').height()-20){
//                            $("#theButton").css({'height':$(this).val()+'px', 'margin-top':(-$(this).val()/2)+'px'});    
//                            button.heigth = $(this).val();
//                        }
//                    } else if (id==="buttonText"){
//                        button.text = $(this).val();
//                    } else if(id==="buttonFontSize"){
//                        $("#theButton").css({'font-size':$(this).val()+'pt'});
//                        button.fontSize = $(this).val();
//                    }
//                });
            });
        </script>