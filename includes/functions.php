<!--author: Vince Ganev-->


<?php
//connects to predeterment database
function dbConnect(){
    $dsn = 'mysql:host=' . SERVER . ';dbname=' . DATABASE;
    static $db;
    if(!isset($db)){
        try{
            $db= new PDO($dsn, USERNAME, PASSWORD);
            // ensure that PDO::prepare returns false when passed invalid SQL
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);             
        } catch(PDOException $e){
            trigger_error($e->getMessage(), E_USER_ERROR);
            exit;
        }
    }
    return $db;
}

//saves to database, if the same element has already been saved returns false
function insertElement($type, $html, $css, $js){
    //check if this elelment already exists by comparing the css code of the same type
    $rows = getElementsByType($type);
    $hasMatch = false;
    foreach($rows as $row){
        if($row['css']===$css){
            $hasMatch = true;
            break;
        }
    }
    if(!$hasMatch){
        $query = "INSERT INTO htmlcsslib (type, html, css, js) VALUES ('$type', '$html', '$css', '$js')";
        $db = dbConnect();
        $statement = $db->prepare($query);
        if ($statement === false){
            $err = $db->errorInfo();
            trigger_error($err[2], E_USER_ERROR);
            exit;
        }    
        if($statement->execute()==false){
            trigger_error('Could not execute query: ' . $query . ".", E_USER_ERROR);
            exit;
        }
        return true;
    } else{
        return false;
    }
}

//updates existing element in the database, returns true if success, false if not
function updateElement($id, $type, $html, $css, $js){
        $query = "UPDATE htmlcsslib SET type='$type', html='$html', css='$css', js='$js' WHERE id=$id";
        $db = dbConnect();
        $statement = $db->prepare($query);
        if ($statement === false){
            $err = $db->errorInfo();
            trigger_error($err[2], E_USER_ERROR);
            return false;
        }    
        if($statement->execute()==false){
            trigger_error('Could not execute query: ' . $query . ".", E_USER_ERROR);
            return false;
        }
        return true;
}

//returns all elements of a certain type from the dB
function getElementsByType($type){
    $query = "SELECT * FROM htmlcsslib WHERE type='$type'";
    $db = dbConnect();
    $statement = $db->prepare($query);
    if($statement === false){
            $err = $db->errorInfo();
            trigger_error($err[2], E_USER_ERROR);
        exit;        
    }
    if($statement->execute()){
        return $statement->fetchAll();
    } else{
        trigger_error('Could not execute query: ' . $query . ".", E_USER_ERROR);
        exit;
    }
}

//queries the dB for $id
function getElementById($id){
    $query = "SELECT * FROM htmlcsslib WHERE id=$id";
    $db = dbConnect();
    $statement = $db->prepare($query);
    if($statement === false){
            $err = $db->errorInfo();
            trigger_error($err[2], E_USER_ERROR);
        exit;        
    }
    if($statement->execute()){
        return $statement->fetchAll();
    } else{
        trigger_error('Could not execute query: ' . $query . ".", E_USER_ERROR);
        exit;
    }
}

//deletes from dB element with id=$id
function deleteElement($id){
    $query = "DELETE FROM htmlcsslib WHERE id=$id";
    $db = dbConnect();
    $statement = $db->prepare($query);
    if($statement === false){
            $err = $db->errorInfo();
            trigger_error($err[2], E_USER_ERROR);
        return false;        
    }
    if($statement->execute()){
        return true;
    } else{
        trigger_error('Could not execute query: ' . $query . ".", E_USER_ERROR);
        return false;
    }    
}

//returns number of existing copies of the element in the database
function elementExists($type, $html, $css, $js){
    $query = "SELECT * FROM htmlcsslib WHERE type='$type' AND html='$html' AND js='$js' AND css='$css'";
    $db = dbConnect();
    $statement = $db->prepare($query);
    if($statement === false){
            $err = $db->errorInfo();
            trigger_error($err[2], E_USER_ERROR);
        return false;        
    }
    if($statement->execute()){
        $r = $statement->fetchAll();
        return count($r);
    } else{
        trigger_error('Could not execute query: ' . $query . ".", E_USER_ERROR);
        return false;
    }      
}

function replaceClass($html, $newClass){
    $startClass = strpos($html, 'class="');
    $startQuote = strpos($html, '"', $startClass);
    $endQuote = strpos($html, '"', $startQuote+1);
    $newhtml = substr($html, 0, $startQuote+1).$newClass.substr($html, $endQuote);
    return $newhtml;
}

//removes the id attribute from the html
function removeId($html){
    $startId = strpos($html, 'id="');
    $startQuote = strpos($html, '"', $startId);
    $endQuote = strpos($html, '"', $startQuote+1);
    $newhtml = substr($html, 0, $startId).substr($html, $endQuote+1);
    return $newhtml;   
}
//returns clean css that can be added to the html
function getCSS($css){
    $startBracket = strpos($css, '{');
    $endBracket = strpos($css, '}');
    $newcss = substr($css, $startBracket+1, $endBracket-$startBracket-1);
    $newcss = str_replace(array("\n","\r","\t", "  "),'',$newcss); 
    $newcss = str_replace(";",'; ',$newcss);
    return $newcss;
}

//inserts the css inside the html brakets, works for <input>, <button> and <a>
function insertCSS($html, $css){
    $insertPosition = strpos($html, ">");
    if($html[$insertPosition-1]==="/"){
        --$insertPosition;
    }
    $newhtml = substr_replace($html, " style=\"$css\"", $insertPosition, 0);
    return $newhtml; 
    
}

//returns the numerical value of a css attribute
function getAttrValue($css, $attr){
    $pos = strpos($css, $attr);
    if($pos===false){
        return false;
    }
    $pos+=strlen($attr);
    $value = '';
    while(!ctype_alnum($css[$pos])){
        $pos++;
    }
    while(ctype_alnum($css[$pos])||$css[$pos]==' '){
        $value.=$css[$pos++];
    }
//    echo "$attr : $value";
    return $value;
}

//centers the element inside the containing div by adjusting the top and left margin
function setMargins($css){
    $x = getAttrValue($css, "width")/-2;
    $y = getAttrValue($css, "height")/-2-20;
    return $css . " margin-left: {$x}px; margin-top: {$y}px;";
}

//returns an associative array with key the css on the left of ':' and value the css on the right
function cssToArray($css){
    $array = explode(';',$css,-1);
    $new_array = array();
    foreach($array as $a){
        $b = explode(':', $a);
        $new_array[str_replace(' ', '', $b[0])] = trim(str_replace(array('px', '#'), '', $b[1]));
    }
    return $new_array;
}

function getButtonType($html){
    if($html[1]=='a'){
        return 'link';
    } else if($html[1]=='b'){
        return 'button';
    } else{
        return 'input';
    }
}

function getButtonText($html, $type){
    $text='';
    if($type=='input'){
        $pos = strpos($html,'value=');
        while($html[$pos]!=='"'){
            $pos++;
        }
        $pos++;
        while($html[$pos]!=='"'){
            $text.=$html[$pos];
            $pos++;
        }
    } else{
        $pos=strpos($html, '>')+1;
        while($html[$pos]!=='<'){
            $text.=$html[$pos];
            $pos++;
        }
    }
    return $text;
}

//takes as argument ta line like 'linear-gradient("angle",color1", "color2",...);' and returns an array [angle,color1,color2,...]
function getGradientColors($line){
    $startBracket = strpos($line, '(');
    $endBracket = strpos($line, ')');
    $colors = explode(',',substr($line, $startBracket+1, $endBracket-$startBracket-1));    
    return $colors;
}

//returns the gradient type (linear/radial)
function getGradientType($line){
    $type='radial';
    if(strpos($line, 'linear')!==false){
        $type='linear';
    }
    return $type;
}

function getBoxShadow($line){
    $bs = explode(' ', $line);
    $bShadow = array();
    $i = 0;
    if($bs[0]=='inset'){
        $bShadow['inset'] = 'inset';
        $i++;
    } else{
        $bShadow['inset'] = '';
    }    
    $bShadow['horizontal'] = $bs[$i++];
    $bShadow['vertical'] = $bs[$i++];
    $bShadow['blur'] = $bs[$i++];
    $bShadow['spread'] = $bs[$i++];
    if(isset($bs[$i])){
        $rgba = explode(',', str_replace(array('rgba(', ')'), '', $bs[$i]));
        $bShadow['color'] = RGBToHex($rgba[0], $rgba[1], $rgba[2]);
        $bShadow['opacity'] = $rgba[3]*100;
    } else{
        $bShadow['color'] = '';
        $bShadow['opacity'] = 100;
    }
    return $bShadow;
}

function getTextShadow($line){
   $ts = explode(' ', $line);
    $tShadow = array();
    $tShadow['horizontal'] = $ts[0];
    $tShadow['vertical'] = $ts[1];
    $tShadow['blur'] = $ts[2];
    $rgba = explode(',', str_replace(array('rgba(', ')'), '', $ts[3]));
    $tShadow['color'] = RGBToHex($rgba[0], $rgba[1], $rgba[2]);
    $tShadow['opacity'] = $rgba[3]*100;
    return $tShadow;
}
function RGBToHex($r, $g, $b) {
    $hex = "";
    $hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
    $hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
    $hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
 
return $hex;
}

//draws a custom slider control with styling defined in slider.css and functionality defined in slider.js
function drawSlider($min, $max, $sliderWidth, $input, $inputLabel){
    echo '<div class="sliderWraper">';
    echo '    <div class="sliderBody">';
    echo '        <label>'.$min.'</label>';

    echo '          <div class="sliderBar" style="width:'.$sliderWidth.'px">';
    echo '            <div class="sliderThumb">&nbsp;</div>';
    echo '          </div>';

    echo '        <label>'.$max.'</label>';
    echo '    </div>';
    echo '    <!--<div class="sliderTop"></div>-->';
    echo '    <div style="clear: left; text-align:left">';
    echo $inputLabel;
    echo $input;
    echo '    </div>';      
    echo '</div>';
}
?>




