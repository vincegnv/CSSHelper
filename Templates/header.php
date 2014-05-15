<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
    define("APP_ROOT", 'c:/xampp/htdocs/CSSHelper/');
    $path = APP_ROOT . 'CSS/CSSHelper.css';
    
//    session_start();
    
    $user = '';
    $logInOut = 'LOGIN';
    if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
        $logInOut = 'LOGOUT';
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CSS Helper</title>
        <link rel="stylesheet" type="text/css" href="../CSS/CSSHelper.css">
        <link rel="stylesheet" type="text/css" href="../CSS/slider.css">   
        <link rel="stylesheet" type="text/css" href="../CSS/spiner.css"> 
        <link rel="stylesheet" type="text/css" href="../CSS/jquery-ui-1.10.4.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


    </head>
    <body>
        <div id="headerspace">
            <div id="header-all">

                <div id="header-wraper">
                    <div id="header-buttons">
                        <ul>
                            <li>
                                <a href="../Controlers/button.php">BUTTON</a>
                            </li>
                <?php
                    if(isset($_SESSION['username'])){
                        echo '<li>';
                        echo '    <a href="../Controlers/library.php">SAVES</a>';
                        echo '</li>';
                    }
                ?>
                            <li>
                                <a href="../Controlers/public.php">SHARES</a>
                            </li>     <!--
                            <li>
                                <a href="..">SLIDER</a>
                            </li>                            -->
                        </ul>
                    </div>
                    <div id="header-logo">
                        CSSHelper
                    </div> 
<!--                    <div id="username">
                        
                    </div>-->
                    <div id="header-buttons-right">
                        <ul>
                            <li>
                                <a href="../Controlers/login.php"><?=$user?> <?=$logInOut?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                 
            </div>
          
        </div>
        <!--end header-->
        
        <div id="content">
            <div class="title">
                <h1><label id="title"><?= isset($title)?$title:'' ?></label></h1>
            </div>