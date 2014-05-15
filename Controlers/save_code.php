<?php
    require('../includes/config.php');
    if(isset($_POST['save'])||isset($_POST['new'])||isset($_POST['overwrite'])){
        require('../Templates/header.php'); 
    }
//    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //CHECK FOR LOGIN
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $rows = query("SELECT * FROM users WHERE username='$username'");
            $userid = getUserId($username);
            
            if(isset($_POST['save']) || isset($_POST['action'])){
            //COMES FROM CREATION PAGE
                $html = $_POST['HTMLsource'];
                $css = $_POST['CSSsource'];
                $js = '';
                if(isset($_POST['JSsource'])){
                   $js = $_POST['JSsource']; 
                }
                $type=$_POST['type'];
            }
             if(isset($_POST['save']) || isset($_POST['action'])&&$_POST['action']=="save"){
            //COMES FROM CREATION PAGE    
                //CHECK IF EXISTS IN THE DATABASE
                if(elementExists($userid, $type, $html, $css, $js)){
                    if(isset($_POST['save'])){
                        //regular submission
                        echo "<div id=\"savePageMsg\">";
                        echo "<span>";
                        echo '<p>Element already exists.</p>';
                        echo "</span>";
                        echo "";
                        echo "<a id=\"backButton\" href=\"#\" onclick=\"history.back();\">Go Back</a>";
                        echo "</div>";    
                    } else{
                        //ajax call
                        echo "exist";
                    }
                } else if(isset($_SESSION['fromLibrary'])&&$_SESSION['fromLibrary']!==false){
                    //this element has been opened from the library
                    //save the source to the SESSION for the next call after user makes his choice
                    if(isset($_POST['save'])){
                        //regular submission
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
                        echo "<input type='submit' name='overwrite' value='Save Over' class='ctrlBtn'/>";
                        echo "<input type='submit' name='new' value='Save New' class='ctrlBtn'/>";
                        echo "</form>";
                        echo "</div>";  
                    } else{
                        //ajax call
                        echo 'choice';
                    }
                } else{
                    //this is a new element
                    query("INSERT INTO htmlcsslib (userid, type, html, css, js) VALUES ($userid, '$type', '$html', '$css', '$js')");
                    if(isset($_POST['save'])){
                        header("Location:library.php");
                    } else{
                        //ajax call
                        echo "saved";
                    }
                }                
            } elseif(isset($_POST['overwrite'])|| isset($_POST['new']) || (isset($_POST['action'])&&($_POST['action']=='overwrite'||$_POST['action']=="new"))){
                //do overwrite/new
                if(isset($_POST['overwrite'])|| isset($_POST['new'])){
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
                }
                if(isset($_POST['new'])||isset($_POST['action'])&&$_POST['action']=='new'){
                    //new copy
                    query("INSERT INTO htmlcsslib (userid, type, html, css, js) VALUES ($userid, '$type', '$html', '$css', '$js')");
                } elseif(isset($_POST['overwrite'])||isset($_POST['action'])&&$_POST['action']=='overwrite'){
                    //overwrite
                    $id=$_SESSION['fromLibrary'];
                    query("UPDATE htmlcsslib SET type='$type', html='$html', css='$css', js='$js' WHERE id=$id");
                }
                if(isset($_POST['new']) || isset($_POST['overwrite'])){
                    //regular submission
                    header("Location:library.php");
                } else{
                    //ajax call
                    echo "saved";
                }
            }
        } else{
            //user not logged in
            if(isset($_POST['save'])){
                echo "<div id=\"savePageMsg\">";
                echo "<span>";
                echo '    <p>You need to <a href="login.php">sign in</a> to be able to save your work. Do not have an account yet? Register <a href="register.php">here</a>.</p>';
                echo "</span>";
                echo "";
                echo "<a id=\"backButton\" href=\"#\" onclick=\"history.back();\">Go Back</a>";
                echo "</div>"; 
            } else if(isset($_POST['action'])&&$_POST['action']=="save"){
                echo 'logout';
            }
        }
    }
    if(isset($_POST['save'])||isset($_POST['new'])||isset($_POST['overwrite'])){        
        require '../Templates/footer.php';
    }
?>
