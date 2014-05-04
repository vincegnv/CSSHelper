<!--
author: Vince Ganev
-->
<?php
    require('../includes/config.php');
    require('../Templates/header.php');
//    require '../Templates/library_form.php';
    if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['idToDelete'])){
        deleteElement($_GET['idToDelete']);
    }
    echo '<div class="title">';
    echo '<h1>Library</h1>';
    echo '</div>';
    $rows = getElementsByType('button');
    foreach($rows as $row){
        $css = getCSS($row['css']);        
        $divWidth = getAttrValue($css, "width")+40;
        if($divWidth<120){
            $divWidth = 120;
        }
        echo '<div class="elementContainer" style="width: ' . $divWidth . 'px">';
        echo '<form action="button.php" method="post">';
        $html = replaceClass($row['html'], 'myButton');
        $html = removeId($html);
        $css = setMargins($css);
        $html = insertCSS($html, $css);

//        echo the button
        echo $html;
        echo '<input type="hidden" value="' . $row['id'] . '" name="id">';
       
        echo '<a class="btnDelete" href="library.php?idToDelete='.$row['id'].'">Delete</a>';
        echo '<input type="submit" value="Open" class="btnOpen">';
        echo '</form>';
        echo '</div>';
    }
    require '../Templates/footer.php';
?>