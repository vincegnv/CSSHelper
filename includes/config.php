<?php
    //database's name
    define("DATABASE", "csshelper");

    // database's password
    define("PASSWORD", "sesame");

    // database's server
    define("SERVER", "localhost");

    // database's username
    define("USERNAME", "root");
    
    //limit the shares a single user can have at most at the same time
    define("SHARELIMIT", 4);
    
    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);
    session_start();
    
    require('functions.php');
?>
