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
    $arr['src']=$imglink;
    $arr['age']=32; 
    $arr['location']="India"; 

    $gettagss = $_REQUEST['tags'];
 echo $gettagss;
if($gettagss == 'imagestag')
{
  //echo $callback.'(' . json_encode($arr) . ')';
    echo json_encode($arr);
} 

?>
