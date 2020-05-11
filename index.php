<?php
//echo "New APP";
$imglink = "https://eparcel15.herokuapp.com/1-29.png";



    $callback ='mycallback';
 
    if(isset($_GET['mycallback']))
    {
        $callback = $_GET['mycallback'];
    }   
    $arr =array();
    $arr['name']="Ravishanker";
    $arr['name']=$imglink;
    $arr['age']=32; 
    $arr['location']="India";   
 
    echo $callback.'(' . json_encode($arr) . ')';
 

?>
