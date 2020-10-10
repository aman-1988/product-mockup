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
     $cust_province = $orderdata['shipping_address']['province'];
     
     
    // echo $custemail."<br>";
    // echo $cust_first_name." ".$cust_last_name."<br>";
     //echo $cust_address1."<br>";
     //echo $cust_city."<br>";
    // echo $cust_zip."<br>";
    // echo $cust_country."<br>";
     
     
     
     $checkout_email = $custemail;
$checkout_city = $cust_city;
$checkout_first_name = $cust_first_name;
$checkout_last_name = $cust_last_name;
$checkout_address1 = $cust_address1;
$checkout_zip = $cust_zip;
$checkout_country = $cust_country;
$checkout_province = $cust_province;
     
     
   $line_items = $orderss['order']['line_items'];  
//print_r($productss);
     foreach ($line_items as $keys1 => $values1)
     {
         $productid = $line_items[$keys1]['product_id'];
         $variant_id = $line_items[$keys1]['variant_id'];
         
         $protitle = $line_items[$keys1]['title'];
         $proname = $line_items[$keys1]['name'];
         $variant_title = $line_items[$keys1]['variant_title'];
        // echo $productid;
        // echo "<br>";
         //echo $protitle." - ".$variant_title;
         
         $productss = getorder("https://".$SHOPIFY_SHOP."/admin/api/2020-07/products/".$productid.".json");
         //$productss = getorder("https://".$SHOPIFY_SHOP."/admin/api/2020-07/products/4537111740479.json");
//echo "<pre>";
//print_r($productss['product']);
//$product_line_items = $productss['products'];  
$product_line_items = $productss['product'];  



         $productid2 = $product_line_items['id'];
         $productdesc = $product_line_items['body_html'];
         //$variant_id2 = $product_line_items['variant_id'];
         $protitle2 = $product_line_items['title'];
         $proname2 = $product_line_items['name'];
         $handle1 = $product_line_items['handle'];
         $proimgs1 = $product_line_items['image']['src'];
         $price1 = $product_line_items['variants'][0]['price'];
         $defaultvar = $product_line_items['variants'][0]['id'];
         $compare_at_price_default = $product_line_items['variants'][0]['compare_at_price'];
         
         $allvariants = $product_line_items['variants'];
        // echo $protitle2;
         
         foreach ($allvariants as $keys4 => $values4)
         {
              $vartid = $allvariants[$keys4]['id'];
              $product_id = $allvariants[$keys4]['product_id'];
              $varttitle = $allvariants[$keys4]['title'];
              $vartprice = $allvariants[$keys4]['price'];
              $compare_at_price = $allvariants[$keys4]['compare_at_price'];
              $vartoption1 = $allvariants[$keys4]['option1'];
              $vartoption2 = $allvariants[$keys4]['option2']; 
              $vartoption3 = $allvariants[$keys4]['option3'];
              $vartinventory_item_id = $allvariants[$keys4]['inventory_item_id'];
              $vartqty = $allvariants[$keys4]['inventory_quantity'];
              //echo $varttitle."<br>";
             // $varnames[] = "<option value='".$vartid."'>".$varttitle."</option>";
              echo '<input type="hidden" id="'.$vartid.'" value="'.$vartprice.'">';
              echo '<input type="hidden" id="compare'.$vartid.'" value="'.$compare_at_price.'">'; 
              //$varprices[] = $vartprice;
          }

?>

<script>
     function getvarients(var1)
     {
         
     //alert(var1);
     $('#selectedvar<?=$product_id;?>').val(var1);
     var pricess = $('#' + var1).val();
     var compareprice =  $('#compare' + var1).val();    
     $('#pricess<?=$product_id;?>').val(pricess);
     $('#varprices<?=$product_id;?>').html('$ ' + pricess);
     if(compareprice != '') {  $('#compshow<?=$product_id;?>').html('$ ' + compareprice);   } else {   $('#compshow<?=$product_id;?>').html(''); }
         
     //alert($('#' + var1).val());
     }
     
     function getsubmitted()
     {
     var selectedvar1 =  $('#selectedvar<?=$product_id;?>').val(); 
     
    //alert(selectedvar1);
    var checkoutlink = "https://physix-gear-sport.myshopify.com/cart/" + selectedvar1 + ":1?checkout[email]=<?=$checkout_email;?>&checkout[shipping_address][city]=<?=$checkout_city;?>&checkout[shipping_address][first_name]=<?=$checkout_first_name;?>&checkout[shipping_address][last_name]=<?=$checkout_last_name;?>&checkout[shipping_address][address1]=<?=$checkout_address1;?>&checkout[shipping_address][zip]=<?=$checkout_zip;?>&checkout[shipping_address][country]=<?=$checkout_country;?>&checkout[shipping_address][province]=<?=$checkout_province;?>";
    location.href = checkoutlink;
     }
     
 </script>

<div style=" width:100%; display:inline-block; border:1px solid #ccc; padding:15px;  margin:15px 0px;">
<h1 style=" width:100%; display:inline-block; font-size:18px; color:#0d7700; margin-bottom:10px; margin-top:0px;"><?=$suo_popup_title;?></h1>
<h4 style=" width:100%; display:inline-block; font-size:14px; color:#3a3a3a; margin-bottom:15px; margin-top:0px;"><?=$suo_popup_description;?></h4>
<div style=" width:100%; display:inline-block;">
<img src="<?=$proimgs1;?>" style=" width:20%; display:inline-block;">    
<div style=" width:52%; margin-left:5%; display:inline-block; vertical-align:top;">
<h3 style=" width:100%; color:#045484; display:inline-block; vertical-align:top; font-size:16px; margin-top:0px;"><?=$protitle2;?></h3> 
<select name="allvarients" onchange="getvarients(this.value);" style="appearance:auto; border:1px solid #000; border-radius:2px; padding:2px 4px; margin-top:7px;">
<?php 
foreach ($allvariants as $keys4 => $values4)
{
    $vartid = $allvariants[$keys4]['id'];
     $varttitle = $allvariants[$keys4]['title'];
     echo  "<option value='".$vartid."'>".$varttitle."</option>";
}

?>
</select>
    <br>
    <input type="number" id="quantityselect" name="quantity" min="1" max="15">
<input type="hidden" id="selectedvar<?=$product_id;?>" value="<?=$defaultvar;?>">
<input type="hidden" id="pricess<?=$product_id;?>" value="<?=$price1;?>">
<input type="hidden" id="comp_price<?=$product_id;?>" value="<?=$compare_at_price_default;?>">
</div>    
 
<div style="width:15%; margin-left:5%; display:inline-block; vertical-align:top;  text-align:right;"> 
<?php if(!empty($compare_at_price_default)) { ?><span style="font-size:15px; color:#8c8c8c; font-weight:normal; text-decoration:line-through; text-align:right; width:100%; display:inline-block;" id="compshow<?=$product_id;?>">$ <?=$compare_at_price_default;?></span><?php } ?>
<span style="font-size:18px; color:#9c0707; font-weight:bold; text-align:right; width:100%; display:inline-block;" id="varprices<?=$product_id;?>">$ <?=$price1;?></span>
</div>

        
</div>

<div style="width:100%; margin-top:2%; display:inline-block; text-align:right;" ><button onclick="getsubmitted();" style=" padding:7px 15px; font-size:15px; cursor:pointer; background:#00691c; color:#fff; outline:none; border:none; border-radius:5px;">Buy Now</button>
</div> 

</div>


         
         
         
         
         
         
         
         
         
         
         
         
         
 <?php        
         
         
     }
     
 
 
 } else {
 // echo "Code is not correct";
 }
 //echo $name." - ".$age;
 //echo "aman";
}
?>
