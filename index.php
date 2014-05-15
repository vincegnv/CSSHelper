<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CSS Helper</title>
    </head>
    <body>
        <h1>CSS Helper</h1>
        <?php
            session_start();
            if(isset($_SESSION['username'])){
                unset($_SESSION['username']);
            }
            header('Location: Controlers/button.php');
        ?>
    </body>
</html>
