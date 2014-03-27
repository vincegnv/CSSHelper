<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
        <div id="title">
            <h1>Button Generator</h1>
        </div>
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
                        <label>Color:&nbsp;</label>
                        <input class="color property" value="000000" id="fontColor"/>  
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="groupWraper">
                        <div class="spinner">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Font:&nbsp;</label>
                            <select id="buttonFont" class="property">
                                <option value="Ariel">Ariel</option>
                                <option value="Courier New">Courier New</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Helvetica">Helvetica</option>
                                <option value="Tahoma">Tahoma</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Verdana">Verdana</option>
                            </select>                        
                        </div>
                        <div class="spinner">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;Size:&nbsp;</label>
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


                    </div>
                    <div id="fontStyle" class="groupWraper">
                        <input type="checkbox" value="bold" id="bold" class="property"/>&nbsp;<b>Bold</b>
                        <input type="checkbox" value="italic" id="italic" class="property"/>&nbsp;<i>Italic</i>
                    </div>                    
            </div>
            <!--button text ends-->
            <!--button border starts-->
            <div class="propertyGroup" id="border">
                <h2>Border</h2>
                <div class="groupWraper">
                    <div class="spinner">
                        <label>Width:&nbsp;</label>
                        <input type="text" value="1" id="borderWidth" class="property"/>
                        <ul>
                            <li>
                                <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'borderWidth' );"/>
                            </li>
                            <li>
                                <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'borderWidth' );"/>                    
                            </li>
                        </ul>
                    </div >
                    <label>Style: &nbsp;</label>
                    <select id="borderStyle" class="property">
                        <option value="solid">solid</option>
                        <option value="none">none</option>
                        <option value="dotted">dotted</option>
                        <option value="dashed">dashed</option>
                        <option value="double">double</option>
                        <option value="groove">groove</option>
                        <option value="ridge">ridge</option>
                        <option value="inset">inset</option>
                        <option value="outset">outset</option>
                    </select>
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;Color:&nbsp;</label>
                    <input class="color property" value="000000" id="borderColor"/>
                </div>
                <div class="clear">&nbsp;</div>   
                <div class="groupWraper">
                    <div class="groupWraper">
                        <label>Radius:</label>
                    </div>
                    <div class="groupWraper" id="cornerTool">
                        <div class="spinner spinnerSmall">
                            <input type="text" value="0" id="leftTop" class="property"/>
                            <ul>
                                <li>
                                    <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'leftTop' );"/>
                                </li>
                                <li>
                                    <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'leftTop' );"/>                    
                                </li>
                            </ul>
                        </div >  
                        <div class="spinner spinnerSmall">
                            <input type="text" value="0" id="rightTop" class="property"/>
                            <ul>
                                <li>
                                    <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'rightTop' );"/>
                                </li>
                                <li>
                                    <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'rightTop' );"/>                    
                                </li>
                            </ul>
                        </div > 
                        <div id="cornerExampleWraper">
                            <div id="lockWraper">
                                <label>Lock</label>
                                <input type="checkbox" id="lockCorners" class="property"/>
                            </div> 
                            <div id="cornerExample">
                                &nbsp;
                            </div>

                        </div>
                        <div class="spinner spinnerSmall">
                            <input type="text" value="0" id="rightBottom" class="property"/>
                            <ul>
                                <li>
                                    <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'leftBottom' );"/>
                                </li>
                                <li>
                                    <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'leftBottom' );"/>                    
                                </li>
                            </ul>
                        </div >  
                        <div class="spinner spinnerSmall">
                            <input type="text" value="0" id="leftBottom" class="property"/>
                            <ul>
                                <li>
                                    <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'rightBottom' );"/>
                                </li>
                                <li>
                                    <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'rightBottom' );"/>                    
                                </li>
                            </ul>
                        </div >                     
                     </div>
                </div>
            </div>
            <!--button border ends-->
        </div>
