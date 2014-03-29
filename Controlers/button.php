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
                $('.spinner input[type=button]').on('mousedown', spinnerRotate(1,$(this)));
                
                button.update();
                updateTheButton(button);
                $('#HTMLsource').val(button.getHTML());
                $('#CSSsource').val(button.getCSS());                
                $('.property').on('change', function(){
                    var id = $(this).attr('id');
//                    prevent non integer input
                    if($(this).hasClass('int')){
                        var intRegex = /^\d+$/;
                        if(!intRegex.test($(this).val())){
                            return;
                        }
                    }
                    switch(id){
                        case "buttonFont":
//                            $('#theButton').css('font-family',$(this).val());
//                            if((this.val()))
                            button.font = $(this).val();
                            break;
                        case "bold":
                            if($(this).is(':checked')){
//                                $('#theButton').css('font-weight', 'bold');
                                button.fontBold = "bold";
                            } else{
//                                $('#theButton').css('font-weight', '');
                                button.fontBold = "";
                            }  
                            break;
                        case "italic":
                            if($(this).is(':checked')){
//                              $('#theButton').css('font-style', 'italic');
                              button.fontItalic = "italic";
                            } else{
//                                $('#theButton').css('font-style', '');
                                button.fontItalic = "";
                            }
                            break;
                        case "buttonWidth":
//                            if($('#theButton').width() < $('#buttonContainer').width()-20){
//                                $("#theButton").css({'width':$(this).val()+'px', 'margin-left':(-$(this).val()/2)+'px'});
                            var intRegex = /^\d+$/;
                            if(!intRegex.test($(this).val())){
                                $(this).val(button.width);
                            } else{
                                button.width = $(this).val();
                            }
//                            } 
                            break;
                        case "buttonHeight":
//                            if($('#theButton').height() < $('#buttonContainer').height()-20){
//                                $("#theButton").css({'height':$(this).val()+'px', 'margin-top':(-$(this).val()/2)+'px'});    
                            button.height = $(this).val();
//                            }   
                            break;
                        case "buttonText":
                            button.text = $(this).val(); 
                            break;
                        case "buttonFontSize":
//                            $("#theButton").css({'font-size':$(this).val()+'pt'});
                            button.fontSize = $(this).val();   
                            break;
                        case "fontColor":
//                            $('#theButton').css('color', "#"+$(this).val());
                            button.fontColor = $(this).val();
                            break;
                        case "borderWidth":
//                            $('#theButton').css('border-width',$(this).val()+"px");
                            button.borderWidth = $(this).val();
                            break;
                        case "borderStyle":
//                            $('#theButton').css('borderStyle', $(this).val());
                            button.borderStyle = $(this).val();
                            break;
                        case "borderColor":
//                            $('#theButton').css('borderColor',"#"+$(this).val());
                            button.borderColor = $(this).val();
                            break;
                        case "lockCorners":
                            if($(this).is(':checked')){
                                $("#cornerTool div.spinner:not(:first-child) :input").prop('disabled', true);
                                $("#cornerTool div.spinner:not(:first-child) :input[type='button']").addClass('spinnerDisabled');
                                var curve = $('#leftTop').val();
                                button.borderRightTop = curve;
                                button.borderRightBottom = curve;
                                button.borderLeftBottom = curve;
                            } else{
                                $("#cornerTool div.spinner:not(:first-child) :input").prop('disabled', false);   
                                $("#cornerTool div.spinner:not(:first-child) :input[type='button']").removeClass('spinnerDisabled');
                                button.borderRightTop = $('#rightTop').val();
                                button.borderRightBottom = $('#rightBottom').val();
                                button.borderLeftBottom = $('#leftBottom').val();
                            }
                            break;
                        case "leftTop":
                            button.borderLeftTop = $(this).val();
                            if($('#lockCorners').is(':checked')){
                                var curve = $('#leftTop').val();
                                button.borderRightTop = curve;
                                button.borderRightBottom = curve;
                                button.borderLeftBottom = curve;                               
                            }
                            break;
                        case "rightTop":
                            button.borderRightTop = $(this).val();                        
                            break;
                        case "rightBottom":
                            button.borderRightBottom = $(this).val();
                            break;
                        case "leftBottom":
                            button.borderLeftBottom = $(this).val();                        
                            break;
                    }
                    updateTheButton(button);
                    $('#HTMLsource').val(button.getHTML());
                    $('#CSSsource').val(button.getCSS());
                });

                $('#buttonText').on('keyup', function(){
                    $('#theButton').attr('value',$(this).val());
                    button.text = $(this).val();
                    $(this).trigger('change');
                });
            });
        </script>