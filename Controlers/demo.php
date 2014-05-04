<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>


        <style>
            #cnt{
                margin-top:100px;
                margin-left:40%;
                margin-right:auto;
                position: relative;
            }    
            #btn{
                width: 200px;
                height: 200px;
                background-image:linear-gradient(left,red,blue);          
                background: -moz-linear-gradient(160deg,rgba(255,0,0,0), rgba(255,0,0,1));
                background-image:-webkit-linear-gradient(45deg,red,blue); 
                background-image:-ms-linear-gradient(left,red,blue); 
                /*border-radius: 1  00px;*/
            }
            
            #gradientContainer{
                /*temporary*/
                width: 492px;
                /*temporary*/
                
            }
        </style>

        <?php
            require('../includes/config.php');
            require('../Templates/header.php');
        ?>
        <div id="leftColumn">
                <div id="gradientContainer" class="propertyGroup">
                    <h2>Gradient<span class="plus-minus">-</span></h2>
                    <div class="groupWraper">
                        <label>Color:&nbsp;</label>
                        <input class="color property" value="" id="buttonColor"/> 
        <!--                <div class="spinner">
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
                    --></div>
                </div>
        </div>
        <?php
            require '../Templates/footer.php';
        ?>