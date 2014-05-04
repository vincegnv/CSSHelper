<!--
author: Vince Ganev
-->

        <?php
            require('../includes/config.php');
            require('../Templates/header.php');

            session_start();
           
            if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['id'])){
                //saves the id of the element that is opened from the library to the SESSION
                $_SESSION['fromLibrary'] = $_POST['id'];
                
                $element = getElementById($_POST['id']);
                $css = getCSS($element[0]['css']);
                $html = $element[0]['html'];
                $type = getButtonType($html);
                $acss = cssToArray($css);
                //do border-radius
                if(isset($acss['border-radius'])){
                    $acss['border-radius'] = explode(' ', $acss['border-radius']);
                    if(count($acss['border-radius']) == 1){
                        array_push($acss['border-radius'], $acss['border-radius'][0], $acss['border-radius'][0], $acss['border-radius'][0]);
                    }
                }
                //do gradient
                if(isset($acss['background-image'])){
                    $gradientType = getGradientType($acss['background-image']);
//                    $gradientType = 'linear';
                    $gradientColors = getGradientColors($acss['background-image']);

                    if($gradientType === 'linear'){
                        $gradientAngle = str_replace('deg', '', $gradientColors[0]);
                        //remove the gradient angle from the colors array
                        unset($gradientColors[0]);
                        $gradientColors = array_values($gradientColors);
                    }
                }
            } else{
                $_SESSION['fromLibrary'] = false;
            }
            require('../Templates/buttonLeftColumn.php');
            require('../Templates/buttonRightColumn.php');
            require('../Templates/footer.php');
        ?>

        <script type="text/javascript">
            var button = new ButtonProperties();


            
            $(document).ready(function(){
 
                button.update();
                updateTheButton(button);
                $('#HTMLsource').val(button.getHTML());
                $('#CSSsource').val(button.getCSS());                
                $('.property').on('change', function(){
                    var id = $(this).attr('id');
//                    update the button object
                    if(id==='link'||id==='input'||id==='button'){
                        button['type'] = id;
                    } else if(id==='linear' || id==='radial'){
                        button.gradientType = id;
                        if(id=='linear'){
                            $('#gradientAngleContainer').show();
                        } else{
                            $('#gradientAngleContainer').hide();
                        }
                    } else{
                        //validation
                        switch(id){
                            case "bold":
                                if($(this).is(':checked')){
                                    button['bold'] = "bold";
                                } else{
                                    button['bold'] = "";
                                }  
                                break;
                           case "borderWidth":
                               var maxBorderWidth = (button.buttonHeigth>button.buttonWidth)?parseInt(button.buttonWidth)/2:parseInt(button.buttonHeight)/2;
                               if(!isInt($(this).val())||$(this).val()<0||$(this).val()>maxBorderWidth){
                                    $(this).val(button.borderWidth);
                                    return;                                   
                               }
                               break;
                           case "buttonHeight":
//                                validate
                                if(!isInt($(this).val())||$(this).val()<0||$(this).val()>160){
                                    $(this).val(button.buttonHeight);
                                    return;
                                }
                              
                                break;
                            case "buttonWidth":
//                                validate
                                if(!isInt($(this).val())||$(this).val()<0||$(this).val()>400){
                                    $(this).val(button.buttonWidth);
                                    return;
                                }
                                break;
                            case "buttonFontSize":
                                if(!isInt($(this).val())||$(this).val()<0){
                                    $(this).val(button.buttonFontSize);
                                    return;
                                }
                                break;
                            case "gradientColor":
                                if(!isInt($(this).val())||$(this).val()<0 || $(this).val()>360){
                                    $(this).val(button.gradientAngle);
                                    return;
                                }                                
                                break;
                            case "italic":
                                if($(this).is(':checked')){
                                  button['italic'] = "italic";
                                } else{
                                    button['italic'] = "";
                                }
                                break;
 
                            case "lockCorners":
                                if($(this).is(':checked')){
                                    ///disable the last three spinner inputs
                                    $("#cornerTool div.spinner:not(:first-child) :input").prop('disabled', true);
                                    $("#cornerTool div.spinner:not(:first-child) :input[type='button']").addClass('spinnerDisabled');
                                    var curve = $('#leftTop').val();
                                    button['rightTop'] = curve;
                                    button['rightBottom'] = curve;
                                    button['leftBottom'] = curve;
                                } else{
                                    //enable them
                                    $("#cornerTool div.spinner:not(:first-child) :input").prop('disabled', false);   
                                    $("#cornerTool div.spinner:not(:first-child) :input[type='button']").removeClass('spinnerDisabled');
                                    button.rightTop = $('#rightTop').val();
                                    button.rightBottom = $('#rightBottom').val();
                                    button.leftBottom = $('#leftBottom').val();
                                }
                                break;
                            case "leftTop":
                            case "rightTop":
                            case "rightBottom":
                            case "leftBottom":
                                var maxRadius = (parseInt(button.buttonHeight)>parseInt(button.buttonWidth))?button.buttonWidth:button.buttonHeight;
                                if(!isInt($(this).val())||$(this).val()<0||parseInt($(this).val())>maxRadius){
                                    $(this).val(button[id]);
                                    return;
                                }
                                if(id==="leftTop" && $('#lockCorners').is(':checked')){
                                    var curve = $('#leftTop').val();
                                    button['rightTop'] = curve;
                                    button['rightBottom'] = curve;
                                    button['leftBottom'] = curve;                                
                                }
                                break;
                        }
                        //update
                        button[id] = $(this).val();                        
                    }
                    updateTheButton(button);
                    $('#HTMLsource').val(button.getHTML());
                    $('#CSSsource').val(button.getCSS());
                });

                $('#buttonText').on('keyup', function(){
                    if(button.type==='input'){
                        $('#myButton').attr('value',$(this).val());
                    } else{
                        $('#myButton').html($(this).val());
                    }
                    button.buttonText = $(this).val();
                    $(this).trigger('change');
                });
                                $(".spinner input[type='button']").on('mouseup',stopSpinner);
                $(".spinner input[type='button']").on('mouseout',stopSpinner);

                //makes textareas readonly, but still scrollable
                $('#SourceContainer').keypress(function(event){
                    event.preventDefault();
                });
                
//                hides and shows groups
                $(".plus-minus").on('click', function(){
                    if($(this).text()==='+'){
                        $(this).text('-');
                        $(this).parent('h2').next().show();
                        $(this).parent().removeClass('remove-margin');
                    } else{
                        $(this).text('+');
                        $(this).parent('h2').next().hide();
                        $(this).parent().addClass('remove-margin');
                     }
                });
               //all hidden
               $('.plus-minus').trigger('click');
               
               
                $('#addToGradient').click(function(){
//                    if($('#paletteColors').children('input').length%3===0&&$('#paletteColors').children('input').length>0){
//                        $('#paletteColors').html($('#paletteColors').html()+'<br/>');
//                    }
                    $('#paletteColors').html($('#paletteColors').html()+
                        '<input type="text" readonly="readonly" style="background:#'+$('#gradientColor').val()+';" value="'+$('#gradientColor').val()+'"/>');
                    if(button.addGradientColor($('#gradientColor').val())>1){
                        updateTheButton(button);
                        $('#CSSsource').val(button.getCSS());
                    }
                });
                
                $('#removeFromGradient').click(function(){
                    var inputs = $('#paletteColors').children('input');  
                    var color='';
                    for(var i=0; i<inputs.length; i++){
                        if(inputs.eq(i).hasClass('redText')){
                            color = inputs.eq(i).val();
                            inputs.eq(i).remove();
                        }
                    }
                    if(color===''){
//                        color not selected, delete the last one
                        inputs.eq(inputs.length-1).remove();
                    }
                    button.removeGradientColor(color);
//                    to invoke update
                    updateTheButton(button);
                    $('#CSSsource').val(button.getCSS());
                });
                

//                color  to stand out, using document, because the inputs are genereated dinamically
                $(document).on('click','#paletteColors input',function(event){
                    event.preventDefault();
                    if($(this).hasClass('redText')){
                        $(this).removeClass();
                    } else{
                        var inputs = $('#paletteColors').children('input');
                        for(var i=0; i<inputs.length; i++){
                            inputs.removeClass();
                        }
                        $(this).addClass('redText');
                    }
                }); 
            });
        </script>