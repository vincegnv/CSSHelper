<!--
author: Vince Ganev
-->
        <div class="title">
            <h1>Button Generator</h1>
        </div>
        <div id="left-column">
<!--            <div class="propertyGroup">
                <h2>Type<span class="plus-minus">-</span></h2>

            </div>-->
            <div class="propertyGroup" id="size">
                <h2>Basics<span class="plus-minus">-</span></h2>
               <div class="groupWraper">
                    <div style="padding-bottom: 20px;margin:0 auto;width:230px;">
                        <div class="groupWraper">
                            <input type="radio" name="bType" id="link" value="link" <?=isset($type)?(($type=='link')?'checked':''):'checked'?> class="property"/>
                            <label>Link</label>
                        </div>                
                        <div class="groupWraper">
                            <input type="radio" name="bType" id="button" value="button" <?=isset($type)?(($type=='button')?'checked':''):'checked'?> class="property"/>
                            <label>Button</label>
                        </div>                
                        <div class="groupWraper">
                            <input type="radio" name="bType" id="input" value="input" <?=isset($type)?(($type=='input')?'checked':''):'checked'?> class="property"/>
                            <label>Input</label>
                        </div>
                        <div class="clear">&nbsp;</div>
                    </div>
                   
                    <div class="spinner floatLeft">
                        <label>Width:&nbsp;</label>
                        <input type="text" value="<?= isset($acss)?$acss['width']:70?>" id="buttonWidth" class="property int"/>
                        <ul>
                            <li>
                                <input type="button" value="&#9650;" onmousedown="spinnerRotate(1, 'buttonWidth');"/>
                            </li>
                            <li>
                                <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'buttonWidth' );"/>                    
                            </li>
                        </ul>
                    </div>
                    <div class="spinner floatLeft">
                        <label>Height:&nbsp;</label>
                        <input type="text" value="<?= isset($acss)?$acss['height']:30?>" id="buttonHeight" class="property int"/>
                        <ul>
                            <li>
                                <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'buttonHeight' );"/>
                            </li>
                            <li>
                                <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'buttonHeight');"/>                    
                            </li>
                        </ul>
                    </div>
                   <label>Color:&nbsp;</label>
                   <input class="color property" value="<?= isset($acss)?$acss['background-color']:'FFFFFF'?>" id="buttonColor"/>                   
                </div>
            </div> 
            <!--button size ends-->
            <div class="clear">&nbsp;</div>
            <!--button text-->
            <div class="propertyGroup" id="text">
                <h2>Text<span class="plus-minus">-</span></h2>
                <div>
                    <div class="groupWraper">
                        <label>Caption:&nbsp;</label>
                        <input type="text" placeholder="Text" id="buttonText" class="property" value="<?= isset($html)?getButtonText($html, $type):''?>"/>
                        <label>Color:&nbsp;</label>
                        <input class="color property" value="<?= isset($acss)?$acss['color']:'000000'?>" id="fontColor"/>  
                    </div>
                    <div class="clear">&nbsp;</div>
                    <div class="groupWraper">
                        <div class="spinner floatLeft">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Font:&nbsp;</label>
                            <select id="buttonFont" class="property">
                                <option value="Ariel" <?=(isset($acss)&&$acss['font-family']=='Arial')?'selected':'' ?>>Ariel</option>
                                <option value="Courier New" <?=(isset($acss)&&$acss['font-family']=='CourierNew')?'selected':'' ?>>Courier New</option>
                                <option value="Georgia" <?=(isset($acss)&&$acss['font-family']=='Georgia')?'selected':'' ?>>Georgia</option>
                                <option value="Helvetica" <?=(isset($acss)&&$acss['font-family']=='Helvetica')?'selected':'' ?>>Helvetica</option>
                                <option value="Tahoma" <?=(isset($acss)&&$acss['font-family']=='Tahoma')?'selected':'' ?>>Tahoma</option>
                                <option value="Times New Roman" <?=(isset($acss)&&$acss['font-family']=='TimesNewRoman')?'selected':'' ?>>Times New Roman</option>
                                <option value="Verdana" <?=(isset($acss)&&$acss['font-family']=='Verdana')?'selected':'' ?>>Verdana</option>
                            </select>                        
                        </div>
                        <div class="spinner floatLeft">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;Size:&nbsp;</label>
                            <input type="text" value="<?= isset($acss)?$acss['font-size']:12?>" id="buttonFontSize" class="property int"/>
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
                        <input type="checkbox" value="bold" id="bold" class="property" <?=(isset($acss['font-weight'])&&$acss['font-weight']=='bold')?'checked':''?>/>&nbsp;<b>Bold</b>
                        <input type="checkbox" value="italic" id="italic" class="property" <?=(isset($acss['font-style'])&&$acss['font-style']=='italic')?'checked':''?>/>&nbsp;<i>Italic</i>
                    </div> 
                </div>
            </div>
            <!--button text ends-->
            <!--button border starts-->
            <div class="propertyGroup" id="border">
                <h2>Border<span class="plus-minus">-</span></h2>
                <div>
                    <div class="groupWraper">
                        <div class="spinner floatLeft">
                            <label>Width:&nbsp;</label>
                            <input type="text" value="<?=isset($acss['border-width'])?$acss['border-width']:1?>" id="borderWidth" class="property int"/>
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
                            <option value="solid" <?=(isset($acss['border-style'])&&$acss['border-style']=='solid')?'selected':''?>>solid</option>
                            <option value="none" <?=(isset($acss['border-style'])&&$acss['border-style']=='none')?'selected':''?>>none</option>
                            <option value="dotted" <?=(isset($acss['border-style'])&&$acss['border-style']=='dotted')?'selected':''?>>dotted</option>
                            <option value="dashed" <?=(isset($acss['border-style'])&&$acss['border-style']=='dashed')?'selected':''?>>dashed</option>
                            <option value="double" <?=(isset($acss['border-style'])&&$acss['border-style']=='double')?'selected':''?>>double</option>
                            <option value="groove" <?=(isset($acss['border-style'])&&$acss['border-style']=='groove')?'selected':''?>>groove</option>
                            <option value="ridge" <?=(isset($acss['border-style'])&&$acss['border-style']=='ridge')?'selected':''?>>ridge</option>
                            <option value="inset" <?=(isset($acss['border-style'])&&$acss['border-style']=='inset')?'selected':''?>>inset</option>
                            <option value="outset" <?=(isset($acss['border-style'])&&$acss['border-style']=='outset')?'selected':''?>>outset</option>
                        </select>
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;Color:&nbsp;</label>
                        <input class="color property" value="<?=isset($acss['border-color'])?$acss['border-color']:'000001'?>" id="borderColor"/>
                    </div>
                    <div class="clear">&nbsp;</div>   
                    <div class="groupWraper">
                        <div class="groupWraper">
                            <label>Radius:</label>
                        </div>
                        <div class="groupWraper" id="cornerTool">
                            <div class="spinner spinnerSmall floatLeft">
                                <input type="text" value="<?=isset($acss['border-radius'])?$acss['border-radius'][0]:0?>" id="leftTop" class="property int"/>
                                <ul>
                                    <li>
                                        <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'leftTop' );"/>
                                    </li>
                                    <li>
                                        <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'leftTop' );"/>                    
                                    </li>
                                </ul>
                            </div >  
                            <div class="spinner spinnerSmall floatLeft">
                                <input type="text" value="<?=isset($acss['border-radius'])?$acss['border-radius'][1]:0?>" id="rightTop" class="property int"/>
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
                            <div class="spinner spinnerSmall floatLeft">
                                <input type="text" value="<?=isset($acss['border-radius'])?$acss['border-radius'][2]:0?>" id="rightBottom" class="property int"/>
                                <ul>
                                    <li>
                                        <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'rightBottom' );"/>
                                    </li>
                                    <li>
                                        <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'rightBottom' );"/>                    
                                    </li>
                                </ul>
                            </div >  
                            <div class="spinner spinnerSmall floatLeft">
                                <input type="text" value="<?=isset($acss['border-radius'])?$acss['border-radius'][3]:0?>" id="leftBottom" class="property int"/>
                                <ul>
                                    <li>
                                        <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'leftBottom' );"/>
                                    </li>
                                    <li>
                                        <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'leftBottom' );"/>                    
                                    </li>
                                </ul>
                            </div >                     
                         </div>
                    </div>
                    
                </div>
            </div>
            <!--button border ends-->
            <div id="gradientContainer" class="propertyGroup">
                <h2>Gradient<span class="plus-minus">-</span></h2>
                <div>
                    <div>
                        <div class="groupWraper">
                            <input type="radio" name="gradientType" id="linear" value="linear" class="property" <?= isset($gradientType)?($gradientType=='linear')?'checked':'':'checked'?>/>
                            <label>Linear</label>
                        </div>
                        <div class="groupWraper">
                            <input type="radio" name="gradientType" id="radial" value="radial" class="property" <?= (isset($gradientType)&&$gradientType=='radial')?'checked':''?>/>
                            <label>Radial</label>
                        </div>
                    </div>
                    

                    <div class="clear">&nbsp;</div>
                    <div class="groupWraper">
                        <input type="button" value="Add" title="Add color to gradient" id="addToGradient"/>
                        <input class="color" value="" id="gradientColor"/> 
                        <div class="spinner" style="margin:10px;" id="gradientAngleContainer">
                            <label>Angle&nbsp;</label>
                            <input type="text" value="<?= isset($gradientAngle)?$gradientAngle:0 ?>" id="gradientAngle" class="property int"/>
                            <ul>
                                <li>
                                    <input type="button" value="&#9650;" onmousedown="spinnerRotate(1,'gradientAngle' );"/>
                                </li>
                                <li>
                                    <input type="button" value="&#9660;" onmousedown="spinnerRotate(-1,'gradientAngle');"/>                    
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="palette" style="float:right;margin-right:15px;">
                        <input type="button" value="Remove" title="Remove the last color" id="removeFromGradient" style="float: left; margin-right:3px;"/>
                        <div id="paletteColors" style="float:left;width:198px;">
                            <?php
                                if(isset($gradientColors)){
                                    foreach($gradientColors as $color){
                                        echo '<input type="text" value="'.$color.'" style="background:#'.$color.'"/>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
