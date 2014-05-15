<?php

    require('../includes/config.php');
    $title = 'Register';
    require('../Templates/header.php');

//    session_start();
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $msg = '';
        $un = $_POST['userName'];
        $pass = $_POST['password'];
        $passConf = $_POST['passwordConfirm'];
        //validation
        if($un==''){
            $msg = "Please provide user name.<br>";
        } elseif(strlen($un)<6){
            $msg = "Username requires at least 6 characters.<br>";
        } elseif(strlen($un)>10){
            $msg = "Username must be no longer then 10 characters.<br>";
        } elseif(userExists($un)){//check if user with the same name already exists
                $msg = "User with the name of $un has already been registered.<br>";
        } elseif($pass==''){
            $msg .= "Please provide password.<br>";
        } elseif(strlen($pass)<6){
            $msg .= "Password requires at least 6 characters.<br>";
        } elseif(strlen($pass)>20){
            $msg .= "Password must be no longer then 20 characters.<br>";
        } elseif($pass != $passConf){//good password has been entered, check for match with confirmation
            $msg .= "Your password confirmation does not match your password.<br>";
        }
        
        if($msg == ''){
            //register the new user and redirect
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            query("INSERT INTO users (username, hash) VALUES ('$un', '$hash')");
            //login
            $_SESSION['username'] = $un;
            //redirect
            //get the page before login
            $lastpage = "button.php";
            if(isset($_SESSION['lastpage'])){
                $lastpage = $_SESSION['lastpage'];
            }
            header("Location: $lastpage");
        }
        
    }
    
?>
<div id="loginInfo" class="propertyGroup">
    <form id="loginForm" action="" method="POST">
        <input type="text" id="userName" name="userName" placeholder="username" value="<?= isset($un)?$un:'' ?>"/>
        <br>
        <input type="password" id="password" name="password" placeholder="password"/>
        <br>
        <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="password confirmation"/>
        <br>
        <input type="submit" id="register" name="register" value="Register" class="ctrlBtn"/>
        <!--<input type="submit" id="register" name="register" value="Register" class="ctrlBtn"/>-->
              
    </form>
    <!--<p>Name and password must be at least 6 and no more then 20 characters long.</p>-->
    <span id="message"><?=isset($msg)?$msg:''?>    </span>
</div>
<script type="text/javascript">
    $(document).ready(function(){
       $('#username').change(function(){
           
       });
    });
</script>
<?php
    require('../Templates/footer.php');
?>