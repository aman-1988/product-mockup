<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

$SHOPIFY_SHOP = 'goodnessforu.myshopify.com'; //For eg: storedenavin.myshopify.com

function getorder($url)
{
$ch = curl_init($url);      
//curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',  
    'Authorization: Basic NmM1ZjE2OWRhOGRkMGI4MjdmNzk4OGM0MjQ5NGVhYzE6c2hwcGFfMDQ1YTA0ODdiNDlmODYyNTcxMjFiYmQzYTYxZjcxOWM=')                                                                     
);                                                                                                                   
$output = curl_exec($ch);
curl_close($ch); 
$json_data_shopify = json_decode($output,true);   
return $json_data_shopify;
}



 
if(isset($HTTP_RAW_POST_DATA)) {
  parse_str($HTTP_RAW_POST_DATA,$arr); 
  $arr['extra']='1.POST Request from demo.com';
  echo json_encode($arr);
}
else
{
    $_POST['extra']='2.POST Request from demo.com';
  //  echo json_encode($_POST);
 $name = $_POST['name'];
 $age = $_POST['upsell'];
 if($age == "postupsell")
 {
 //echo '<img src="https://bouteeki-mockup.herokuapp.com/image.jpg" style="max-width:50%;">';
 
 //echo '<a href="https://goodnessforu.myshopify.com/cart/32056468766783:1">Buy Now</a>';
 
 $orderss = getorder("https://".$SHOPIFY_SHOP."/admin/api/2020-07/orders/".$name.".json");
 //echo "<pre>";
   //  print_r($orderss);
     
 $orderdata = $orderss['order'];
     
     $custemail = $orderdata['email'];
     $cust_first_name = $orderdata['shipping_address']['first_name'];
     $cust_last_name = $orderdata['shipping_address']['last_name'];
     $cust_address1 = $orderdata['shipping_address']['address1'];
     $cust_city = $orderdata['shipping_address']['city'];
     $cust_zip = $orderdata['shipping_address']['zip'];
     $cust_country = $orderdata['shipping_address']['country'];
     $cust_phone = $orderdata['shipping_address']['phone'];
     
     
     echo $custemail."<br>";
     echo $cust_first_name." ".$cust_last_name."<br>";
     echo $cust_address1."<br>";
     echo $cust_city."<br>";
     echo $cust_zip."<br>";
     echo $cust_country."<br>";
     
     
     
   $line_items = $orderss['order']['line_items'];  
//print_r($productss);
     foreach ($line_items as $keys1 => $values1)
     {
         $productid = $line_items[$keys1]['product_id'];
         $variant_id = $line_items[$keys1]['variant_id'];
         
         $protitle = $line_items[$keys1]['title'];
         $proname = $line_items[$keys1]['name'];
         $variant_title = $line_items[$keys1]['variant_title'];
         echo $productid;
         echo "<br>";
         //echo $protitle." - ".$variant_title;
     }
     
 
 
 } else {
 // echo "Code is not correct";
 }
 //echo $name." - ".$age;
 //echo "aman";
}
?>
