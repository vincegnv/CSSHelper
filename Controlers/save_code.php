<!--
author: Vince Ganev
-->
<?php
    require('../includes/config.php');
    require('../Templates/header.php'); 
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST['overwrite'])|| isset($_POST['new'])){
            //do overwrite/new
            $html = $_SESSION['HTMLsource'];
            $css = $_SESSION['CSSsource'];
            $js = '';
            if(isset($_SESSION['JSsource'])){
               $js = $_SESSION['JSsource']; 
            }
            $type=$_SESSION['type']; 
            unset($_SESSION['HTMLsource']);
            unset($_SESSION['CSSsource']);
            unset($_SESSION['JSsource']);
            unset($_SESSION['type']);
            if(isset($_POST['new'])){
                insertElement($type, $html, $css, $js);
            } else{
                $id=$_SESSION['fromLibrary'];
                updateElement($id, $type, $html, $css, $js);
            }
            header("Location:library.php");
        } else{ 
        //comes from creation page
            $html = $_POST['HTMLsource'];
            $css = $_POST['CSSsource'];
            $js = '';
            if(isset($_SESSION['JSsource'])){
               $js = $_SESSION['JSsource']; 
            }
            $type=$_POST['type'];
            //check if the same elelement exists in the database            
            if(elementExists($type, $html, $css, $js)){
                echo "<div id=\"savePageMsg\">";
                echo "<span>";
                echo '<p>Element already exists.</p>';
                echo "</span>";
                echo "";
                echo "<a id=\"backButton\" href=\"#\" onclick=\"history.back();\">Go Back</a>";
                echo "</div>";                
            } else if(isset($_SESSION['fromLibrary'])&&$_SESSION['fromLibrary']!==false){
                //this element has been opened from the library
                //save the source to the SESSION for the next call after user makes his choice
                $_SESSION['HTMLsource']=$html;
                $_SESSION['CSSsource'] = $css;
                $_SESSION['JSsource'] = $js;
                $_SESSION['type']=$type;        
                //draw the message
                echo "<div id=\"savePageMsg\">";
                echo "<span>";
                echo "<form action=\"\" method=\"post\">";
                echo '<p>Do you want to overwrite this element or save it as a new?</p>';
                echo "</span>";
                echo "<input type='submit' name='overwrite' value='Save Over'/>";
                echo "<input type='submit' name='new' value='Save New'/>";
                echo "</form>";
                echo "</div>";            
            } else{
                //this is a new element
                insertElement($type, $html, $css, $js);
                header("Location:library.php");
            }
        }
        require '../Templates/footer.php';
    }
?>

