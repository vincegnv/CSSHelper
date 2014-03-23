<!--
author: Vince Ganev
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="../CSS/CSSHelper.css">
        <script type="text/javascript" src="../scripts/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../scripts/functions.js"></script>
        <title>Button creator</title>
    </head>
    <body>
        <script type="text/javascript">
            var button = new ButtonProperties();
            
            $(document).ready(function(){
//                $(".spinner input:button").mouseup(spinnerStop);
                $("input.property:text").on("change",function(){
                    var id = $(this).attr('id');
                    if(id==="buttonWidth"){
                        $("#theButton").css({'width':$(this).val()+'px'});
                    } else if(id==="buttonHeight"){
                        $("#theButton").css({'height':$(this).val()+'px'});                        
                    } else if (id==="buttonText"){
                        $("#theButton").attr('value', $(this).val());                        
                    } else if(id==="buttonFontSize"){
                        $("#theButton").css({'font-size':$(this).val()+'pt'});                        
                    }
                });
            });
        </script>
        <?php
//            echo getcwd();
        ?>
        <!--button size-->
        <div id="properties">
            <div class="propertyGroup" id="size">
                <p class="groupName">Size</p>
                <div class="spinner">
                    <label>Width:&nbsp;</label>
                    <input type="text" value="70" id="buttonWidth" class="property"/>
                    <ul>
                        <li>
                            <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'buttonWidth' );"/>
                        </li>
                        <li>
                            <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'buttonWidth' );"/>                    
                        </li>
                    </ul>
                </div>
                <div class="spinner">
                    <label>Height:&nbsp;</label>
                    <input type="text" value="30 " id="buttonHeight" class="property"/>
                    <ul>
                        <li>
                            <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'buttonHeight' );"/>
                        </li>
                        <li>
                            <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'buttonHeight');"/>                    
                        </li>
                    </ul>
                </div>
            </div>
            <!--button size ends-->
            <div class="clear">&nbsp;</div>
            <!--button text-->
            <div class="propertyGroup" id="text">
                <p class="groupName">Text</p>
                <div>
                    Caption:&nbsp;
                    <input type="text" placeholder="Button Caption" id="buttonText" class="property"/><br/><br/>
                    <label>Font:&nbsp;</label>
                    <select id="buttonFont" class="property">
                        <option value="Ariel">Ariel</option>
                        <option value="Times New Roman">Times New Roman</option>
                    </select>
                </div>
                <div class="clear">&nbsp;</div>
                <div class="spinner">
                    <label>Font size:&nbsp;</label>
                    <input type="text" value="12" id="buttonFontSize" class="property"/>
                    <label class="floatRight">px</label>
                    <ul>
                        <li>
                            <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'buttonFontSize' );"/>
                        </li>
                        <li>
                            <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'buttonFontSize');"/>                    
                        </li>
                    </ul>
                </div>
                <div class="clear">&nbsp;</div>
                <div id="fontStyle">
                    <input type="checkbox" name="fontStyle" value="bold" class="property"/>&nbsp;<b>Bold</b>
                    <input type="checkbox" name="fontStyle" value="italic" id="italic" class="property"/>&nbsp;<i>Italic</i>
                </div>
            </div>        
            <!--button text ends-->
        </div>
        <!--actual button-->
        <div id="buttonContainer">
            <input type="button" id="theButton">
        </div>
        <!--actual button ends-->         
    </body>
</html>
