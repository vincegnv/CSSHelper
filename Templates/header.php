<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
    define("APP_ROOT", 'c:/xampp/htdocs/CSSHelper/');
    $path = APP_ROOT . 'CSS/CSSHelper.css';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CSS Helper</title>
        <link rel="stylesheet" type="text/css" href="../CSS/CSSHelper.css">
        <script type="text/javascript" src="../scripts/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="../scripts/functions.js"></script>
        <script src="../jscolor/jscolor.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="headerspace">
            <div id="header-all">
                <div id="header-logo">
                    CSSHelper
                </div>
                <div id="header-wraper">
                    <div id="header-buttons">
                        <ul>
                            <li>
                                <a href="../Controlers/button.php">BUTTON</a>
                            </li>
<!--                            <li>
                                <a href="..">SPINNER INPUT</a>
                            </li>     
                            <li>
                                <a href="..">SLIDER</a>
                            </li>                            -->
                        </ul>
                    </div>
                    <div id="header-buttons-right">
                        <ul>
                            <li>
                                <a href="../Controlers/library.php">LIBRARY</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div>
                    <a href="../Controlers/demo.php" style="position: absolute; right: 0; margin-right: 20px; cursor: pointer; width: 40px; height:20px;">Test</a>            
                </div>
            </div>
        </div>
        <!--end header-->
        
        <div id="content">
