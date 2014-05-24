<!--
author: Vince Ganev
-->

        <?php
            require('../includes/config.php');
            $title='Button Generator';
            require('../Templates/header.php');
        ?>

<div id="dialog-info" title="Message" style="display:none">
    <p></p>
</div>

<div id="dialog-choice" title="What to do?" style="display:none">
    <p>
        <span class="ui-icon ui-icon-copy" style="float:left; margin:0 7px 20px 0;"></span>
        The item was opened in your library. Do you want to save over or save as a new item?
    </p>
</div>

        <?php

            //remember the last page before login/logout
            $_SESSION['lastpage'] = 'button.php';
           
            if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['id'])){
                //havin id set shows that we come from the library
                $element = query("SELECT * FROM htmlcsslib WHERE id={$_GET['id']}");
                //saves the id of the element that is opened from the library to the SESSION
                //if it is opened by its creator
                $userid = $element[0]['userid'];
                $result = query("SELECT * FROM users WHERE userid=$userid");
                $creatorname = $result[0]['username'];
                if(isset($_SESSION['username']) && $_SESSION['username'] == $creatorname){
                    $_SESSION['fromLibrary'] = $_GET['id']; 
                } else{
                    unset($_SESSION['fromLibrary']);
                }
                
                //get the element with id = $id
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
                //do box shadow
                if(isset($acss['box-shadow'])){
                    $bShadow = getBoxShadow($acss['box-shadow']);
                    $insetBoxShadow = $bShadow['inset'];
                    $horizontalBoxShadow = $bShadow['horizontal'];
                    $verticalBoxShadow = $bShadow['vertical'];
                    $blurBoxShadow = $bShadow['blur'];
                    $spreadBoxShadow = $bShadow['spread'];
                    $colorBoxShadow = $bShadow['color'];
                    $opacityBoxShadow = $bShadow['opacity'];
                }
                if(isset($acss['text-shadow'])){
                    $tShadow = getTextShadow($acss['text-shadow']);
                    $horizontalTextShadow = $tShadow['horizontal'];
                    $verticalTextShadow = $tShadow['vertical'];
                    $blurTextShadow = $tShadow['blur'];
                    $colorTextShadow = $tShadow['color'];
                    $opacityTextShadow = $tShadow['opacity'];
                }
            } else{
                //brand new element
                $_SESSION['fromLibrary'] = false;
            }
            require('../Templates/buttonLeftColumn.php');
            require('../Templates/buttonRightColumn.php');
            require('../Templates/footer.php');
        ?>

        <script type="text/javascript">
            var button = new ButtonProperties();


            
            $(document).ready(function(){

                //load the button object
                button.update();
                //update the DOM object
                updateTheButton(button);
                //update the source textareas
                $('#HTMLsource').val(button.getHTML());
                $('#CSSsource').val(button.getCSS());    
                //update when the user changes a property
                $('.property').on('change', function(){
                    var id = $(this).attr('id');
//                    update the button object
                    if(id==='link'||id==='input'||id==='button'){
                        button['type'] = id;
                    } else if(id==='linear' || id==='radial'){
                        button.gradientType = id;
                        if(id==='linear'){
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
                            case "gradientAngle":
                                if(!isInt($(this).val())||$(this).val()<0 || $(this).val()>360){
                                    $(this).val(button.gradientAngle);
                                    $(this).trigger('change');
                                    return;
                                }                                
                                break;
                            case "horizontalBoxShadow":
                            case "verticalBoxShadow":
                            case "spreadBoxShadow":
                            case "horizontalTextShadow":
                            case "verticalTextShadow":                                
                                if(!isInt($(this).val())){
                                    $(this).val(button[id]);
                                    return;
                                }
                                break;
                            case "blurBoxShadow":
                            case "blurTextShadow":    
                                if(!isInt($(this).val())||$(this).val()<0){
                                   $(this).val(button[id]);
                                   return;
                                }                               
                                break;
                            case "opacityTextShadow":
                            case "opacityBoxShadow":                                
                                if(!isInt($(this).val())||$(this).val()<0||$(this).val()>100){
                                   $(this).val(button[id]);
                                   $(this).trigger('change');
                                   return;
                                }                                  
                                break;
                        }//end switch
                        //update the button object
                        if($(this).prop('type')==='checkbox'){
                            if($(this).is(':checked')){
                                button[id] = $(this).val();
                            } else{
                                button[id] = '';
                            }
                        } else{
                            button[id] = $(this).val();                        
                        }
                    }
                    //update the button
                    updateTheButton(button);
                    $('#HTMLsource').val(button.getHTML());
                    $('#CSSsource').val(button.getCSS());
                });
                //end .property onchange
                
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
                $('#SourceContainer, #paletteColors input').keypress(function(event){
                    event.preventDefault();
                });
                
//                hides and shows groups
                $(".plus-minus").on('click', function(){
                    if($(this).text()==='+'){
                        putOnTop($(this).closest('.propertyGroup')) ;
                        openDiv($(this));
                    } else{
                        closeDiv($(this));
                    }
                });
                
               //all hidden
               $('.plus-minus').trigger('click');
               
               //adds a color to the gradient palette
                $('#addToGradient').click(function(){
                    $('#paletteColors').html($('#paletteColors').html()+
                        '<input type="text" readonly="readonly" style="background:#'+$('#gradientColor').val()+
                        ';" value="'+$('#gradientColor').val()+'"/>');
                    if(button.addGradientColor($('#gradientColor').val())>1){
                        updateTheButton(button);
                        $('#CSSsource').val(button.getCSS());
                    }
                });
                //removes a color from gradient pallete
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
                

//                color  to stand out, using document, because the inputs are genereated dynamically
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
                
                //information box 
                 $(function(){
                     $( "#dialog-info" ).dialog({
                         resizable: false,
                         height:170,
                         autoOpen: false,
                         modal: true,
                         buttons: {
                             "OK": function() {
                                 $( this ).dialog( "close" );
                             }

                         }
                     });            
                 });
                 
                 var choice = '';
                 //choice dialog
                $(function(){
                    $( "#dialog-choice" ).dialog({
                        resizable: false,
                        height:170,
                        autoOpen: false,
                        modal: true,
                        buttons: {
                            "Overwrite": function() {
                                choice = "overwrite";
                                $('#buttonSave').trigger('click');
                                $( this ).dialog( "close" );
                            },
                            "New": function(){
                                choice = "new";
                                $('#buttonSave').trigger('click');
                                $( this ).dialog( "close" );                            
                            },
                            Cancel: function() {
                                choice = '';
                                $( this ).dialog( "close" );
                            }
                        }
                    });            
                });   
                
                //make the dialogs visible, since they are not when the page loads, needed for slow loading, otherwise you get a glimse at them whiel loading
                $("#dialog-choice, #dialog-info").css('display', 'block');
                
                //ajax for save
                $('#buttonForm').submit(function(event){
                    event.preventDefault();
                    //prepare the data
                    var data = $(this).serialize();
                    if(choice === ''){
                        choice = "save";
                    }
                    //adding the call signature
                    data += '&action=' + choice;
                    
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "save_code.php",
                        success: function(msg){
                            var html = '<span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>';
                            choice = '';
                            
                            if(msg === "exist" || msg === "saved" || msg === "logout"){
                                var p = $('#dialog-info p').eq(0)
//                                var html = p.html();
//                                var text = p.text();
//                                //clear the message, if any, from the paragraph container
//                                p.html(html.replace(text, ''));                              
                            }
                            
                            if(msg === "exist"){
                                //add the new message
                                p.html(html+'Item with the same parameters already exists in your library.')
                                //call the dialog    
                                $('#dialog-info').dialog("open");
                            } else if(msg === "choice"){
                                $('#dialog-choice').dialog("open");
                            } else if(msg === "saved"){
                                //add the messsage
                                p.html(html+'Saved.')
                                $('#dialog-info').dialog("open");
                            } else if(msg === "logout"){
                                //tell the user to login
                                //add the new message
                                p.html(html+'You need to login to be able to save your work.');
                                //call the dialog    
                                $('#dialog-info').dialog("open");                                
                            }
                                
                        }
                    });
                });
                
                $('#htmlSelect, #cssSelect').click(function(event){
                    event.preventDefault();
                    $(this).parent('h2').next('textarea').select();
                });
                
             

            });
        </script>