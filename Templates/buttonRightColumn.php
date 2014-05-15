<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
    <div id="right-column">
        <form action="save_code.php" method="post" style="z-index: 0; position: relative;" id="buttonForm">
            <div class="rightColumnContainer">
                <h2>
  
                    <input type="submit" value="Save" id="buttonSave" name="save"/>
                </h2>            
                <div id="buttonContainer">
                </div>
            </div> 
            <div id="SourceContainer" class="rightColumnContainer">
                <h2>HTML
                    <button id="htmlSelect">Select</button>
                </h2>
                <textarea name="HTMLsource" id="HTMLsource" rows="6" wrap="off"></textarea>
                <h2>CSS
                    <button id="cssSelect">Select</button>
                </h2>
                <textarea name="CSSsource" id="CSSsource" rows="6" wrap="off"></textarea>
<!--                <h2>Javascript</h2>
                <textarea name="JSsource" id="JSsource" rows="6" wrap="off"></textarea>-->
            </div>
          
            <input name="type" value="button" type="hidden"/>
<!--            <input name="elementid" value="<?= (isset($_SESSION['fromLibrary'])&&$_SESSION['fromLibrary']!==false)?$_SESSION['fromLibrary']:'' ?>" type="hidden"/>
            <input name="userid" value="<?= isset($_SESSION['username'])?$_SESSION['username']:'' ?>" type="hidden"/>-->
        </form>
    </div>