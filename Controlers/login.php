<?php

    require('../includes/config.php');
    $title = 'Login';
    require('../Templates/header.php');

//    session_start();
    
    if(isset($_SESSION['username'])){
        //do logout
        unset($_SESSION['username']);
//        unset($_SESSION['userid']);
        header("Location: button.php");
    } elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        //do login
        $un = $_POST['userName'];
        $pass = $_POST['password'];
        //validation
        $msg = '';
        if($un==''){
            $msg = "Please provide user name.<br>";
        } elseif(strlen($un)<6){
            $msg = "Username requires at least 6 characters.<br>";
        } elseif(strlen($un)>10){
            $msg = "Username must be no longer then 10 characters.<br>";
        } elseif($pass==''){
            $msg .= "Please provide password.<br>";
        } elseif(strlen($pass)<6){
            $msg .= "Password requires at least 6 characters.<br>";
        } elseif(strlen($pass)>20){
            $msg .= "Password must be no longer then 20 characters.<br>";
        }
        if($msg == ''){
            //check if user/password exist
            $user = query("SELECT * FROM users WHERE username='$un'");
            if(count($user) > 0 && password_verify($pass, $user[0]['hash'])){
                $_SESSION['username'] = $user[0]['username'];
//                $_SESSION['userid'] = $user[0]['userid'];
                //get the page before login
                $lastpage = "button.php";
                if(isset($_SESSION['lastpage'])){
                    $lastpage = $_SESSION['lastpage'];
                }
                header("Location: $lastpage");
            } else{
                $msg = "Invalid username or password.";
            }
        }
    }
    
?>
<div id="loginInfo" class="propertyGroup">
    <form id="loginForm" action="" method="POST">
        <input type="text" id="userName" name="userName" placeholder="username" value=""/>
        <br>
        <input type="password" id="password" name="password" placeholder="password"/>
        <br>
        <input type="submit" id="login" name="login" value="Login" class="ctrlBtn"/>
        <!--<input type="submit" id="register" name="register" value="Register" class="ctrlBtn"/>-->
              
    </form>
    <p>Do not have an account yet? Register <a href="register.php">here</a>.</p>
    <span id="message"><?= isset($msg)?$msg:'' ?></span>
</div>

<?php
    require('../Templates/footer.php');
?>