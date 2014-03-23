<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
        <div id="left-column">
            <div class="propertyGroup" id="size">
                <h2>Size</h2>
               <div class="groupWraper">
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
            </div> 
            <!--button size ends-->
            <div class="clear">&nbsp;</div>
            <!--button text-->
            <div class="propertyGroup" id="text">
                <h2>Text</h2>
                <!--<div id="groupWraper">-->
                    <div class="groupWraper">
                        <label>Caption:&nbsp;</label>
                        <input type="text" placeholder="Text" id="buttonText" class="property"/>
                        <label>Font:&nbsp;</label>
                        <select id="buttonFont" class="property">
                            <option value="Ariel">Ariel</option>
                            <option value="Times New Roman">Times New Roman</option>
                        </select>
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="groupWraper">
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
  
                        <!--<div class="clear">&nbsp;</div>-->
                        <div id="fontStyle">
                            <input type="checkbox" name="fontStyle" value="bold" class="property"/>&nbsp;<b>Bold</b>
                            <input type="checkbox" name="fontStyle" value="italic" id="italic" class="property"/>&nbsp;<i>Italic</i>
                        </div>
                    </div>
            </div>
            <!--button text ends-->
        </div>
