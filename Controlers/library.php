
<?php
    require('../includes/config.php');
    $title='My Library';
    require('../Templates/header.php');
?>

<div id="dialog-delete" title="Delete confirmation" style="display:none">
    <p>
        <span class="ui-icon ui-icon-trash" style="float:left; margin:0 7px 20px 0;"></span>
        The item will be permanently deleted and cannot be recovered. Are you sure?;
    </p>
</div>

<div id="dialog-info" title="Share limit reached" style="display:none">
    <p>
        <span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 20px 0;"></span>
        You have reached the limit for shared items (<?=SHARELIMIT?>). 
    </p>
</div>
<?php

    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['id'])){
        $id = $_POST['id'];
        if(isset($_POST['btnDelete'])){
            //DELETE
            query("DELETE FROM htmlcsslib WHERE id=$id");
        } elseif(isset($_POST['btnShare'])){
            //SHARE
            query("UPDATE htmlcsslib SET public=1 WHERE id=$id");
        } elseif(isset($_POST['btnUnshare'])){
            //UNSHARE
            query("UPDATE htmlcsslib SET public=0 WHERE id=$id");
        }
        
    }

    //remember the last page before login/logout
    $_SESSION['lastpage'] = 'library.php';
            
    $userid = 0;
    if(isset($_SESSION['username'])){
//        display only user's elements
        $username = $_SESSION['username'];
        $userid = getUserId($username);
        
        $rows = query("SELECT * FROM htmlcsslib WHERE userid=$userid");
        foreach($rows as $row){
            $css = getCSS($row['css']);        
            $divWidth = getAttrValue($css, "width")+40;
            if($divWidth<120){
                $divWidth = 120;
            }

            echo '<div class="elementContainer" style="width: ' . $divWidth . 'px">';
            echo '<form action="" method="post">';
                //distinguish shared elelments
                $text = "Share";
                if($row['public'] > 0){
                    //display a share button
                    $text = "Unshare";
                }            
            echo "<input type='submit' value='{$text}' name='btn{$text}' class='btnShare'/>";
            
            $html = replaceClass($row['html'], 'myButton');
            $html = removeId($html);
            $css = setMargins($css);
            $html = insertCSS($html, $css);

    //        echo the button
            echo $html;
            echo '<input type="hidden" value="' . $row['id'] . '" name="id">';

            echo '<a class="btnOpen" href="button.php?id='.$row['id'].'">Open</a>';
            echo '<input type="submit" value="Delete" class="btnDelete" name="btnDelete"/>';
            echo '</form>';
            echo '</div>';
        }
    } else{
        //display message
        echo '<div id="loginInfo" class="propertyGroup">';
        echo '  <p>You need to <a href="login.php">login</a> to get access to the library.</p>';
        echo '  <p>Do not have an account yet? Register <a href="register.php">here</a>.</p>';
        echo '</div>';
    }
    require '../Templates/footer.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
        var confirm = false;
        var btn;
        //dialog box for delete confirmation using jquery-ui
        $(function(){
            $( "#dialog-delete" ).dialog({
                resizable: false,
                height:170,
                autoOpen: false,
                modal: true,
                buttons: {
                    "Delete": function() {
                        confirm = true;
                        btn.trigger('click');
                        $( this ).dialog( "close" );
                    },
                    Cancel: function() {
                        confirm = false;
                        btn.parents('.elementContainer').first().removeClass('redBorder');
                        $( this ).dialog( "close" );
                    }
                }
            });            
        });
       //information box 
        $(function(){
            $( "#dialog-info" ).dialog({
                resizable: false,
                height:170,
                autoOpen: false,
                modal: true,
                buttons: {
                    "OK": function() {
                        $( this ).dialog( "close" );
                    }

                }
            });            
        });
        
        //make the dialogs visible, since they are not when the page loads, needed for slow loading, otherwise you get a glimse at them whiel loading
        $("#dialog-choice, #dialog-info").css('display', 'block');        
        
        $(document).on('click','input[type=submit]', function(event){
//            event.preventDefault();
//            confirm = true;
            var id = $(this).parent().find("input[type=hidden]").val();
            btn = $(this);
            var action = btn.val().toLowerCase(); 
//            var proceed = true;
            if(action === "share" || action === "unshare"){
                confirm = true;
                var newLabel = "Share";
                if(action === 'share'){
                    newLabel = "Unshare";
                }
            }
            
            if(action === 'delete' && !confirm){
                btn.parents('.elementContainer').first().addClass('redBorder');
                $('#dialog-delete').dialog("open");
                btn.preventDefault();
            }
            if(confirm){
                confirm = false;
                $.ajax({
                   type: "POST",
                   data: "action="+action+"&id="+id,
                   dataType: "text",
                   url: "ajaxAction.php",
                   success: function(msg){
    //                      alert(msg);
                     if(msg === 'success'){
    //                        btnShare.fadeOut(100);
                         if(action === "share" || action === "unshare"){
                             btn.val(newLabel);
                         } else if(action === "delete")
                             btn.parents().remove('.elementContainer');
                     } else{
                         if(action === "share" || action === "unshare"){
                             if(msg === "overlimit"){
                                 $('#dialog-info').dialog("open");
                             }
                         } else{
                            alert('Unable to '+action+'.');
                         }
                     }
                   }
                });
            }
        });
        //make sure the form doesnt submit   
        $(document).on('submit','form', function(event){ 
            event.preventDefault();
        });
    });
</script>