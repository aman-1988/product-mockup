<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 
if(isset($HTTP_RAW_POST_DATA)) {
  parse_str($HTTP_RAW_POST_DATA,$arr); 
  $arr['extra']='1.POST Request from hayageek.com';
  echo json_encode($arr);
}
else
{
    $_POST['extra']='2.POST Request from hayageek.com';
  //  echo json_encode($_POST);
 $name = $_POST['name'];
 $age = $_POST['age'];
 if($age == "22222")
 {
 echo "<img src='http://apitest.harjihousing.com/image-preview-upload/uploads/Mens-Summer-Fashion.png'>";
 }
 //echo $name." - ".$age;
 //echo "aman";
}
?>
