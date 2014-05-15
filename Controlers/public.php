<!--
author: Vince Ganev
-->
<?php
    require('../includes/config.php');
    $title='Shared Library';
    require('../Templates/header.php');
    
    //get the logged user's id
    if(isset($_SESSION['username'])){
        $userid = getUserId($_SESSION['username']);
    } else{
        $userid = 0;
    }
    
    $rows = query("SELECT * FROM htmlcsslib WHERE public=1");
    foreach($rows as $row){
        $css = getCSS($row['css']);        
        $divWidth = getAttrValue($css, "width")+40;
        if($divWidth<120){
            $divWidth = 120;
        }

        echo '<div class="elementContainer" style="width: ' . $divWidth . 'px">';
        $username = query("SELECT * FROM users WHERE userid={$row['userid']}")[0]['username'];
        echo "<p>{$username}</p>";
        echo '<form action="" method="get">';

        $html = replaceClass($row['html'], 'myButton');
        $html = removeId($html);
        $css = setMargins($css);
        $html = insertCSS($html, $css);
        $voted = count(query("SELECT * FROM votes WHERE userid=$userid AND itemid={$row['id']}"));
        $votes = count(query("SELECT * FROM votes WHERE itemid={$row['id']}"));
//        echo the button
        echo $html;
        echo '<input type="hidden" value="' . $row['id'] . '" name="id">';
        echo '<a class="btnOpen" href="button.php?id='.$row['id'].'">Open</a>';
//        echo'<input type="hidden" value="' . $row['id'] . '" name="id">';
        echo '<div class="voteContainer">';
        $class = "thumbsup";
        //disable the voting link if the user is not logged in or has created the item
        if($userid == 0 || $userid == $row['userid'] || $voted){
            $class .= " disabled-link";
        }
        echo "  <a class='$class' href=''>&#xf087;</a>"; 
        echo "  <span class='counter'>$votes</span>";
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }

    require '../Templates/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.thumbsup', function(event){
            event.preventDefault();
            if(!$(this).hasClass('disabled-link')){
                //do only if the link doesnt have a class "disabled-link", this is in case pointer-events: none; in .css doesnt work
                var count = $(this).next('.counter').eq(0);
                var id = $(this).parents('form').find('input[type=hidden]').first().val();
                $.ajax({
                    type: "POST",
                    data: "action=voteup&id="+id,
                    url: "ajaxAction.php",
                    success: function(msg){
                        var json = $.parseJSON(msg);
                        count.html(json.votes);
                        count.prev().addClass('disabled-link');
                    }
                });
            }
        });
    });
</script>