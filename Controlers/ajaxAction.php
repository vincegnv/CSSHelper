<?php
require_once '../includes/config.php';
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["action"]) && isset($_POST["id"])){
    $action = strtolower($_POST["action"]);
    $id = $_POST["id"];
    if(isset($_SESSION['username'])){
        $userid = getUserId($_SESSION['username']);
    
        if($action == "share"){
            //check if user has reached the share limit
            $shared = query("SELECT * FROM htmlcsslib WHERE userid=$userid AND public=1");
            if(count($shared) < 4){
                if($action == "share"){
                    //do share
                    if(query("UPDATE htmlcsslib SET public=1 WHERE id=$id") !== false){
                        echo 'success';
                    } else{
                        echo 'error';
                    }
                }
            } else{
                echo "overlimit";
            }
        }elseif($action == "unshare"){
            //do unshare
            if(query("UPDATE htmlcsslib SET public=0 WHERE id=$id") !== false){
                echo 'success';
            } else{
                echo 'error';
            }        
        } elseif($action == "delete") {
            //do delete
            //delete the item
            if(query("DELETE FROM htmlcsslib WHERE id=$id")!==false){
                //delete the votes for this item
                query("DELETE FROM votes WHERE id=$id");
                echo 'success';
            } else{
                echo 'error';
            }
        }  else if($action == "voteup"){
            //check if the same user has voted for this item already
            $rows = query("SELECT * FROM votes WHERE userid=$userid AND itemid=$id");
            if(count($rows) == 0){
                //register the vote
                query("INSERT INTO votes VALUES ($userid, $id)");
//                query("UPDATE htmlcsslib SET votes=votes+1 WHERE id=$id");

                //get the new vote count
                $votes = count(query("SELECT * FROM votes WHERE itemid=$id"));
//                $votes = query("SELECT * FROM htmlcsslib WHERE id=$id")[0]['votes'];
                //send the vote count
                echo json_encode(array("votes"=>$votes));
            }
        } else{
            echo 'Unknown action';
        }
    }
}

?>
