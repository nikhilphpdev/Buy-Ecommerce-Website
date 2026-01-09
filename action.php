<?php
//session_start();
include_once('dis-setting/connection.php');
// Add to cart

if(isset($_POST['addToCart'])){
   
		$pid = $_POST['proId'];
		$data = GetProductDataValTab($pid);
		$prodautid = $data[0]["product_auto_id"];
		$implodeadddat = implode(',', $_POST['productvert']);
		$produtprice = $_POST['productpric'];
		$custoer_id = $_SESSION['customersessionlogin'];
		$get_query_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_prdo_sizename='$implodeadddat' AND cart_userid='$custoer_id'";
		$queyavaldata = $contdb->query($get_query_value);
		if($queyavaldata->num_rows > 0){
		while($rowfetchdata = $queyavaldata->fetch_array()){
				$querty_value = $rowfetchdata['cart_prdo_qutity'];
				$quntyid_val = $rowfetchdata['id'];
				$product_vertionval[] = $rowfetchdata['cart_prdo_sizename'];
			}
			$addquyty = $_POST['Productqunity'];

			$update_size = "UPDATE cart_user SET cart_prdo_qutity='$addquyty' WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND id='$quntyid_val' AND cart_prdo_sizename='$implodeadddat'";
			$query_valuepdtae = $contdb->query($update_size);
			echo 1;
		}else{
		
			$produt_name = $data[0]["product_name"];
			$produt_autid = $data[0]['product_auto_id'];
			$produt_qutiny = $_POST['Productqunity'];
			if($data[0]['product_regular_price'] == ""){
			    $arrayvael = SingleProductPagePriceAddToCart($pid,$implodeadddat);
                $produt_pri_sale = $arrayvael[0];
                $produt_pri_reg = $arrayvael[1];
			}else{
			    $produt_pri_reg = $data[0]['product_regular_price'];
			    $produt_pri_sale = $data[0]['product_sale_price'];
			}
			$produt_imgvale = $data[0]['product_image'];
			$produt_shdomstk = $data[0]['product_shppin_domst'];
			$produt_shintern = $data[0]['product_shppin_inters'];
			if(isset($_SESSION['customersessionlogin'])){
				$customervaledata = $_SESSION['customersessionlogin'];
				$get_query_checkname = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$customervaledata'";
			}else{
				$customervaledata = "";
				$get_query_checkname = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid'";
			}
			$cehck_querysameval = $contdb->query($get_query_checkname);
			if($cehck_querysameval->num_rows > 0){
				if($produt_shdomstk == "0"){
					$halfshppindomastik = $produt_shdomstk;
				}else{
					$halfshppindomastik = $produt_shdomstk/4;
				}
				if($produt_shintern == "0"){
					$halfinternasal = $produt_shintern;
				}else{
					$halfinternasal = $produt_shintern/4;
				}
			}else{
				$halfinternasal = $produt_shintern;
				$halfshppindomastik = $produt_shdomstk;
			}
			$insert_new_product = "INSERT INTO cart_user(cart_prdo_name,cart_prdo_auto_id,cart_prdo_qutity,cart_prdo_pricereg,cart_prdo_pricesale,cart_prdo_img,cart_prdo_sizename,cart_user_ip,cart_user_date,cart_user_time,cart_status,cart_prdo_ship_domstik,cart_prdo_ship_inter,cart_userid,cart_user_browser)VALUES('$produt_name','$produt_autid','$produt_qutiny','$produt_pri_reg','$produt_pri_sale','$produt_imgvale','$implodeadddat','$ip','$date','$time','0','$halfshppindomastik','$halfinternasal','$customervaledata','$brower')";
			$queryupdat = $contdb->query($insert_new_product);
			echo 0; // when first product added first time.
		}
		//$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
		//echo 1; // another new one added
		/*if($color != ""){
			if(in_array($data[0]["product_auto_id"], array_column($_SESSION['cart_item'], 'product_auto_id'))) {
				foreach ($_SESSION["cart_item"] as $key => $value) {
					if($data[0]["product_auto_id"] == $_SESSION["cart_item"][$key]['product_auto_id']) {
						if(empty($_SESSION["cart_item"][$key]["quantity"])) {
							$_SESSION["cart_item"][$key]["quantity"] = 0;
						}
						$_SESSION["cart_item"][$key]["quantity"] += 1;
						echo $_SESSION["cart_item"][$key]['attbutvaluecolor']; //already added
					}
				}
			}else{
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				echo 1; // another new one added
			}
		}
		if($size != ""){
			if(in_array($data[0]["product_auto_id"], array_column($_SESSION['cart_item'], 'product_auto_id'))) {
				foreach ($_SESSION["cart_item"] as $key => $value) {
					if($data[0]["product_auto_id"] == $_SESSION["cart_item"][$key]['product_auto_id']) {
						if(empty($_SESSION["cart_item"][$key]["quantity"])) {
							$_SESSION["cart_item"][$key]["quantity"] = 0;
						}
						$_SESSION["cart_item"][$key]["quantity"] += 1;
						echo 0; //already added
					}
				}
			}else{
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				echo 1; // another new one added
			}
		}else{
			if(in_array($data[0]["product_auto_id"], array_column($_SESSION['cart_item'], 'product_auto_id'))) {
				foreach ($_SESSION["cart_item"] as $key => $value) {
					if($data[0]["product_auto_id"] == $_SESSION["cart_item"][$key]['product_auto_id']) {
						if(empty($_SESSION["cart_item"][$key]["quantity"])) {
							$_SESSION["cart_item"][$key]["quantity"] = 0;
						}
						$_SESSION["cart_item"][$key]["quantity"] += 1;
						echo 0; //already added
					}
				}
			}else{
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				echo 1; // another new one added
			}
		}*/
	/*}else{
		
	}*/
}

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);*/
/*Single product Reviw Code*/


if (isset($_POST['product_id'])) {
    if (!isset($_SESSION["customersessionlogin"])) {
        echo 0;
        exit;
    } 

    $customerid = $_SESSION["customersessionlogin"];
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    $query_value = "SELECT * FROM `customer` WHERE `customer_ui_id` = ?";
    $stmt = $contdb->prepare($query_value);
    $stmt->bind_param("s", $customerid);
    $stmt->execute();
    $queydata = $stmt->get_result();
    
    if ($queydata->num_rows > 0) {
        $rowdata = $queydata->fetch_assoc();
        $customerid = $rowdata['id'];
        $customername = $rowdata['customer_fname'] . ' ' . $rowdata['customer_lname'];
    }
    $stmt->close();

    // Validate input
    if (!empty($product_id) && !empty($rating) && !empty($review_text)) {
        $check_query = "SELECT * FROM reviews WHERE product_id = ? AND customer_id = ?";
        $stmt = $contdb->prepare($check_query);
        $stmt->bind_param("si", $product_id, $customerid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Update existing review
            $update_query = "UPDATE reviews SET rating = ?, review_text = ?, user_name = ? WHERE product_id = ? AND customer_id = ?";
            $stmt = $contdb->prepare($update_query);
            $stmt->bind_param("isssi", $rating, $review_text, $customername, $product_id, $customerid);
            if ($stmt->execute()) {
                echo "Review updated successfully!";
            } else {
                echo "Error updating review!";
            }
        } else {
            // Insert new review
            $insert_query = "INSERT INTO reviews (product_id, customer_id, rating, review_text, user_name) VALUES (?, ?, ?, ?, ?)";
            $stmt = $contdb->prepare($insert_query);
            $stmt->bind_param("siiss", $product_id, $customerid, $rating, $review_text, $customername);
            if ($stmt->execute()) {
                echo "Review submitted successfully!";
            } else {
                echo "Error submitting review!";
            }
        }
        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}

/*fetch Review data*/
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
$query = "SELECT rating, review_text, created_at,user_name FROM reviews WHERE product_id = ? ORDER BY created_at DESC";

$stmt = $contdb->prepare($query);
$stmt->bind_param("s", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formatted_date = date('d-F-Y', strtotime($row['created_at']));
        echo '<div class="review">';
        echo '<div class="a-profile-avatar">
    <img src="https://m.media-amazon.com/images/S/amazon-avatars-global/default.png" alt="User Avatar" class="imgsize">
    <span class="usernamecls">'.htmlspecialchars($row['user_name']).'</span>
</div>';
        echo '<strong class="Review-star">' . str_repeat('★', $row['rating']) . '</strong>';
        echo '<p class="content-data">' . htmlspecialchars($row['review_text']) . '</p>';
        echo '<small>Posted on: ' . $formatted_date . '</small>';
        echo '</div>';
    }
} else {
   return false;
}
}

if (isset($_GET['variation_id']) && !empty($_GET['variation_id']))  {
    $variation_ids = $_GET['variation_id'];
    $prot_prId = $_GET['data_id'];
  if (is_array($variation_ids) && !empty($variation_ids)) {
    $variation_ids = array_filter($variation_ids, 'is_numeric');
    if (!empty($variation_ids)) {
        $variation_ids_str = implode(',', $variation_ids);
    
       $sql = "SELECT * FROM product_attbut_vartarry 
WHERE (prot_trm_id LIKE '0'  OR prot_trm_id LIKE '$variation_ids_str' OR prot_trm_id LIKE '%$variation_ids_str,%' OR prot_trm_id LIKE '%,$variation_ids_str'  OR prot_trm_id LIKE '%,$variation_ids_str,%' OR prot_trm_id LIKE '%$variation_ids_str,%' 
    OR prot_trm_id LIKE '%,$variation_ids_str' 
    OR prot_trm_id LIKE '%,$variation_ids_str,%') 
    AND prot_trm_prodtid = '$prot_prId'";

        $result = $contdb->query($sql);

        if ($result && $result->num_rows > 0) {
            $prices = [];
            while ($row = $result->fetch_assoc()) {
                $prices[] = [
                    'variation_id' => $row['prot_trm_id'],
                    'regular_price' => number_format($row['prot_trm_regulprc'], 2),
                    'sale_price' => $row['prot_trm_saleprc'],
                    'quantity' => $row['prot_trm_quantity']
                ];
                    echo $price['variation_id'];
            }
                   
            echo json_encode(['status' => 'success', 'prices' => $prices]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No price data found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid variation IDs']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
}


if (isset($_GET['variation_iiid']) && !empty($_GET['variation_iiid']))  {
  
    $variation_iiid=$_GET['variation_iiid'];
    
  if (is_numeric($variation_iiid)) {
        // Query to get the price for the selected variation
        $sql = "SELECT * FROM product_attbut_vartarry WHERE prot_trm_id = $variation_iiid";
        $result = $contdb->query($sql);

        if ($result && $roww = $result->fetch_array()) {
            // If variation is found, return sale price and regular price as plain text 
            echo 'Success|Regular Price: ' . number_format($roww['prot_trm_regulprc'],2) . '|Sale Price: ' .  $roww['prot_trm_saleprc']. '|quntity: ' .  $roww['prot_trm_quantity'];
        } else {
            // If no variation is found, return an error message
            echo 'Error|No price data found';
        }
    } else {
        
       // echo 'Error|Invalid variation_id';
    }
}

/*home page*/

if(isset($_POST['adtoCartMainSingle'])) {
    $pid = $_POST['proId'];
    $quityvale = $_POST['quityval'];
    $data = GetProductDataValTab(0, 0, 0, $pid);

    if (empty($data)) {
        echo "Product not found";
        exit;
    }

    $prodautid = $data[0]["product_auto_id"];
    $blank = "";

    // Ensure $ip is set correctly
    $ip = $_SERVER['REMOTE_ADDR'];

    if(isset($_SESSION['customersessionlogin'])) {
        $customerid = $_SESSION['customersessionlogin'];
        $get_query_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$customerid'";
    } else {
        $get_query_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$blank'";
    }

    $queyavaldata = $contdb->query($get_query_value);

    if($queyavaldata->num_rows > 0) {
        while($rowfetchdata = $queyavaldata->fetch_array()) {
            $querty_value = $rowfetchdata['cart_prdo_qutity'];
            $quntyid_val = $rowfetchdata['id'];
            $product_vertionval[] = $rowfetchdata['cart_prdo_sizename'];
        }

        $addquyty = $querty_value + 1;
        $update_size = "UPDATE cart_user SET cart_prdo_qutity='$addquyty' WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND id='$quntyid_val'";
        $query_valuepdtae = $contdb->query($update_size);

        if ($query_valuepdtae) {
            echo 1;
        } else {
            echo "Error updating cart";
        }
    } else {
        $produt_name = $data[0]["product_name"];
        $produt_autid = $data[0]['product_auto_id'];
        $produt_qutiny = ($quityvale == "" || $quityvale == "0") ? "1" : $quityvale;
        $produt_pri_reg = $data[0]['product_regular_price'];
        $produt_pri_sale = $data[0]['product_sale_price'];
        $produt_imgvale = $data[0]['product_image'];
      /*  $produt_shdomstk = $data[0]['product_shppin_domst'];
        $produt_shintern = $data[0]['product_shppin_inters'];
*/
        if(isset($_SESSION['customersessionlogin'])) {
            $customervaledata = $_SESSION['customersessionlogin'];
            $get_query_checkname = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$customervaledata'";
        } else {
            $customervaledata = "";
            $get_query_checkname = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid'";
        }

        $cehck_querysameval = $contdb->query($get_query_checkname);

        /*if($cehck_querysameval->num_rows > 0) {
            $halfshppindomastik = ($produt_shdomstk == "0") ? $produt_shdomstk : $produt_shdomstk / 4;
            $halfinternasal = ($produt_shintern == "0") ? $produt_shintern : $produt_shintern / 4;
        } else {
            $halfinternasal = $produt_shintern;
            $halfshppindomastik = $produt_shdomstk;
        }*/
  
       
        $insert_new_product = "INSERT INTO cart_user(cart_prdo_name, cart_prdo_auto_id, cart_prdo_qutity, cart_prdo_pricereg, cart_prdo_pricesale, cart_prdo_img, cart_user_ip, cart_user_date, cart_user_time, cart_status, cart_userid, cart_user_browser) 
        VALUES ('$produt_name', '$produt_autid', '$produt_qutiny', '$produt_pri_reg', '$produt_pri_sale', '$produt_imgvale', '$ip', '$date', '$time', '0', '$customervaledata', '$brower')";

     
        $queryupdat = $contdb->query($insert_new_product);
          
        if ($queryupdat) {
            echo 0; 
        } else {
            echo "Error adding product to cart";
        }
    }
}

/*single Product page */


if(isset($_POST['adtoCartSingle'])){
  
    $pid = $_POST['proId'];
    $quityvale = $_POST['quityval'];
   // $sizevale = $_POST['sizeattbut'];
   $mrp_price =$_POST['mrp_price'];
    $current_price = $_POST['salePrice'];

if (isset($_POST["sizeattbut"]) && is_array($_POST["sizeattbut"])) {
         $selectedValues = $_POST["sizeattbut"];
     
        $sizeid = intval($selectedValues[0]); 
        $colorid = intval($selectedValues[1]);

              $get_query_sizevale = "SELECT * FROM product_variationsdata WHERE id IN ($sizeid, $colorid)";
              $cehck_querysizeval = $contdb->query($get_query_sizevale);
               if($cehck_querysizeval->num_rows > 0) {
               $size = null;
                $color = null;
                $size_value = [];
        while($rowfetchdata = $cehck_querysizeval->fetch_array()) {
            $size_value[$rowfetchdata['id']] = $rowfetchdata['proval_trm_value'];
          //   $values[] = $rowfetchdata['proval_trm_value'];
              $value = $rowfetchdata['proval_trm_value'];
             $proval_trm_attid =$rowfetchdata['proval_trm_attid'];
          if ($proval_trm_attid == 31) {  
            $color = $value;
        } elseif ($proval_trm_attid == 25) {  
            $size = $value;
        }
        } 
               }
               $get_query_attbut_name ="SELECT * FROM product_attbut WHERE id='$proval_trm_attid'";
        $cehck_queryabutt = $contdb->query($get_query_attbut_name);
         while($rowfetchattbut = $cehck_queryabutt->fetch_array()) {
             $pd_attbut_name =$rowfetchattbut['pd_attbut_name'];
             $pd_attbut_id =$rowfetchattbut['id'];
         }
     
      
      /*   $color = isset($values[1]) ? $values[1] : null;
          $size = isset($values[0]) ? $values[0] : null; 
*/

         
}

    $data = GetProductDataValTab(0, 0, 0, $pid);

    if (empty($data)) {
        echo "Product not found";
        exit;
    }

    $prodautid = $data[0]["product_auto_id"];
    $blank = "";

    
    
    // Ensure $ip is set correctly
    $ip = $_SERVER['REMOTE_ADDR'];

    if(isset($_SESSION['customersessionlogin'])) {
        $customerid = $_SESSION['customersessionlogin'];
        $get_query_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$customerid'";
    } else {
        $get_query_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$blank'";
    }

    $queyavaldata = $contdb->query($get_query_value);

    if($queyavaldata->num_rows > 0) {
        while($rowfetchdata = $queyavaldata->fetch_array()) {
           
            $querty_value = $rowfetchdata['cart_prdo_qutity'];
            $quntyid_val = $rowfetchdata['id'];
        }

        $addquyty = $querty_value;
        $update_size = "UPDATE cart_user SET cart_prdo_qutity='$addquyty' WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND id='$quntyid_val'";

        $query_valuepdtae = $contdb->query($update_size);

        if ($query_valuepdtae) {
            echo 1;
        } else {
            echo "Error updating cart";
        }
        if(!empty($selectedValues)){
        $update_size = "UPDATE cart_user SET  cart_prdo_sizevalue='$size',cart_prdo_colorvalue='$color',cart_prdo_pricereg='$mrp_price',cart_prdo_pricesale='$current_price' WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid'";
        //echo'<pre>'; print_r($update_size); die;
        $query_valuepdtae = $contdb->query($update_size);

        if ($query_valuepdtae) {
            echo 1;
        } else {
            echo "Error updating cart";
        }
   }
    } else {
        $produt_name = $data[0]["product_name"];
        $produt_autid = $data[0]['product_auto_id'];
        $produt_qutiny = ($quityvale == "" || $quityvale == "0") ? "1" : $quityvale;
         $produt_sizevale = $size;
         $product_colvale =$color;
        $produt_pri_reg = $mrp_price;
        $produt_pri_sale = $current_price;
        $produt_imgvale = $data[0]['product_image'];
        $produt_shdomstk = $data[0]['product_shppin_domst'];
        $produt_shintern = $data[0]['product_shppin_inters'];

        if(isset($_SESSION['customersessionlogin'])) {
            $customervaledata = $_SESSION['customersessionlogin'];
            $get_query_checkname = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid' AND cart_userid='$customervaledata'";
        } else {
            $customervaledata = "";
            $get_query_checkname = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_prdo_auto_id='$prodautid'";
        }

        $cehck_querysameval = $contdb->query($get_query_checkname);

        if($cehck_querysameval->num_rows > 0) {
            $halfshppindomastik = ($produt_shdomstk == "0") ? $produt_shdomstk : $produt_shdomstk / 4;
            $halfinternasal = ($produt_shintern == "0") ? $produt_shintern : $produt_shintern / 4;
        } else {
            $halfinternasal = $produt_shintern;
            $halfshppindomastik = $produt_shdomstk;
        }
          
        $insert_new_product = "INSERT INTO cart_user(cart_prdo_name, cart_prdo_auto_id, cart_prdo_qutity, cart_prdo_pricereg, cart_prdo_pricesale, cart_prdo_img,cart_prdo_sizename, cart_prdo_sizevalue,cart_prdo_colorname,cart_prdo_colorvalue ,cart_user_ip, cart_user_date, cart_user_time, cart_status, cart_prdo_ship_domstik, cart_prdo_ship_inter, cart_userid, cart_user_browser) 
        VALUES ('$produt_name', '$produt_autid', '$produt_qutiny', '$produt_pri_reg', '$produt_pri_sale', '$produt_imgvale','size','$size','color','$color','$ip', '$date', '$time', '0', '$halfshppindomastik', '$halfinternasal', '$customervaledata', '$brower')";
     // echo'<pre>'; print_r($insert_new_product); die;
       $queryupdat = $contdb->query($insert_new_product);
        if ($queryupdat) {
            echo 0; 
        } else {
            echo "Error adding product to cart";
        }
    }
}



if(isset($_POST['removeTocart'])){
	$pid = $_POST['proId'];
	$cartvalue_decrec = "SELECT * FROM cart_user WHERE id='$pid'";
	$query_value_data = $contdb->query($cartvalue_decrec);
	if($query_value_data->num_rows > 0){
		while($rowdecvale = $query_value_data->fetch_array()){
			$get_queryvale = $rowdecvale['cart_prdo_qutity'] += 1;
			$updatevaluev = "DELETE FROM cart_user WHERE id='$pid'";
			$queryvaledata = $contdb->query($updatevaluev);
			unset($_SESSION["tax_amt"]);
			unset($_SESSION["discount_amount"]);
			unset($_SESSION["shippingname"]);
			unset($_SESSION['secortycode']);
			unset($_SESSION['shippingShowAmt']);
			unset($_SESSION["shippingvale"]);
			unset($_SESSION["shppingto"]);
			unset($_SESSION["discount_code"]);
			unset($_SESSION['othernotevalue']);
		}
		echo '0';
	}
}

if(isset($_POST['decreaseQty'])){
	$pid = $_POST['proId'];
	$cartvalue_decrec = "SELECT * FROM cart_user WHERE id='$pid'";
	$query_value_data = $contdb->query($cartvalue_decrec);
	if($query_value_data->num_rows > 0){
		while($rowdecvale = $query_value_data->fetch_array()){
			if($rowdecvale['cart_prdo_qutity'] == 1){
				$delect_value = "DELETE FROM cart_user WHERE id='$pid'";
				$qauery_valuedata = $contdb->query();
			}else{
				$get_queryvale = $rowdecvale['cart_prdo_qutity'] -= 1;
				$updatevaluev = "UPDATE cart_user SET cart_prdo_qutity='$get_queryvale' WHERE id='$pid'";
				$queryvaledata = $contdb->query($updatevaluev);
			}
		}
		echo "0";
	}
}
 
if(isset($_POST['increaseQty'])){

	$pid = $_POST['proId'];
	$cartvalue_decrec = "SELECT * FROM cart_user WHERE id='$pid'";
	$query_value_data = $contdb->query($cartvalue_decrec);
	if($query_value_data->num_rows > 0){
		while($rowdecvale = $query_value_data->fetch_array()){
		   
			$product_auto_idvale = $rowdecvale['cart_prdo_auto_id'];
			$product_arry_id = $rowdecvale['cart_prdo_sizename'];
			$get_qunity_smal = $rowdecvale['cart_prdo_qutity'];
 
			$ceckingtream = "SELECT * FROM all_product WHERE product_auto_id='$product_auto_idvale'";
			$query_product_qunity = $contdb->query($ceckingtream);
			
			if($query_product_qunity->num_rows > 0){
				while($row_get_produt_qunity = $query_product_qunity->fetch_array()){
					$get_procut_colorquniy = $row_get_produt_qunity['product_color'];
					$get_procut_quniytval = $row_get_produt_qunity['product_stock'];

					if($get_procut_colorquniy == "" || $get_procut_colorquniy == "0"){

						if($get_procut_quniytval == "0"){
							$qunity_value = "0";
						}elseif($get_procut_quniytval == ""){
							$qunity_value = "1";
						}else{
							$qunity_veritonval = $get_procut_quniytval;
							$qunity_value = "1";
						}

					}else{

						$get_array_productvt = "SELECT * FROM product_attbut_vartarry WHERE prot_trm_prodtid='$get_procut_colorquniy' AND prot_trm_id='$product_arry_id'";
						$query_arry_dataval = $contdb->query($get_array_productvt);
						if($query_arry_dataval->num_rows > 0){
							while($row_get_arryvertion = $query_arry_dataval->fetch_array()){
								if($row_get_arryvertion['prot_trm_quantity'] == ""){
									$qunity_value = "1";
									echo $qunity_veritonval = $row_get_arryvertion['prot_trm_quantity'];
								}elseif($row_get_arryvertion['prot_trm_quantity'] == "0"){
									$qunity_value = "0";
									$qunity_veritonval = $row_get_arryvertion['prot_trm_quantity'];
								}else{
									$qunity_veritonval = $row_get_arryvertion['prot_trm_quantity'];
									$qunity_value = "1";
								}
							}
						}
					}
					
					if($qunity_veritonval == ""){
						$qunity_cart_notincre = "1";
					}elseif($qunity_veritonval == "0"){
						$qunity_cart_notincre = "0";
					}else{
						if($qunity_veritonval > $get_qunity_smal){
						    
	                      $qunity_cart_notincre = "1";
	                        
	                    }else{
	                      $qunity_cart_notincre = "0";
	                    
	                    }
					}
				}
			}
			if($qunity_cart_notincre == "1"){
				$get_queryvale = $rowdecvale['cart_prdo_qutity'] += 1;

				if($get_queryvale > $get_procut_quniytval){
				    echo "0";
				}else{
    				$updatevaluev = "UPDATE cart_user SET cart_prdo_qutity='$get_queryvale' WHERE id='$pid'";
    				$queryvaledata = $contdb->query($updatevaluev);
    				echo "1";
				}
			}elseif($qunity_cart_notincre == "0"){
			    
				echo "0";
			}
		}
	}
}

if(isset($_POST['inputQty'])){
	$pid = $_POST['proId'];
	$qty = $_POST['proQty'];
	$cartvalue_decrec = "SELECT * FROM cart_user WHERE id='$pid'";
	$query_value_data = $contdb->query($cartvalue_decrec);
	if($query_value_data->num_rows > 0){
		while($rowdecvale = $query_value_data->fetch_array()){
			$product_auto_idvale = $rowdecvale['cart_prdo_auto_id'];
			$product_arry_id = $rowdecvale['cart_prdo_sizename'];
			$get_qunity_smal = $rowdecvale['cart_prdo_qutity'];

			$ceckingtream = "SELECT * FROM all_product WHERE product_auto_id='$product_auto_idvale'";
			$query_product_qunity = $contdb->query($ceckingtream);
			if($query_product_qunity->num_rows > 0){
				while($row_get_produt_qunity = $query_product_qunity->fetch_array()){
					$get_procut_colorquniy = $row_get_produt_qunity['product_color'];
					$get_procut_quniytval = $row_get_produt_qunity['product_stock'];

					if($get_procut_colorquniy == "" || $get_procut_colorquniy == "0"){

						if($get_procut_quniytval == "0"){
							$qunity_value = "0";
						}elseif($get_procut_quniytval == ""){
							$qunity_value = "1";
						}else{
							$qunity_veritonval = $get_procut_quniytval;
							$qunity_value = "1";
						}

					}else{

						$get_array_productvt = "SELECT * FROM product_attbut_vartarry WHERE prot_trm_prodtid='$get_procut_colorquniy' AND prot_trm_id='$product_arry_id'";
						$query_arry_dataval = $contdb->query($get_array_productvt);
						if($query_arry_dataval->num_rows > 0){
							while($row_get_arryvertion = $query_arry_dataval->fetch_array()){
								if($row_get_arryvertion['prot_trm_quantity'] == ""){
									$qunity_value = "1";
								}elseif($row_get_arryvertion['prot_trm_quantity'] == "0"){
									$qunity_value = "0";
								}else{
									$qunity_veritonval = $row_get_arryvertion['prot_trm_quantity'];
									$qunity_value = "1";
								}
							}
						}
					}

					if($qunity_veritonval > $get_qunity_smal){
                      $qunity_cart_notincre = "1";
                    }else{
                      $qunity_cart_notincre = "0";
                    }
				}
			}
			if($qunity_cart_notincre == "1"){
				//$get_queryvale = $rowdecvale['cart_prdo_qutity'] += 1;
				$updatevaluev = "UPDATE cart_user SET cart_prdo_qutity='$qty' WHERE id='$pid'";
				$queryvaledata = $contdb->query($updatevaluev);
				echo "1";
			}elseif($qunity_cart_notincre == "0"){
				echo "0";
			}
		}
	}
}

// Coupon Code
if(isset($_POST['couponCode'])){
   // echo'<pre>'; print_r($_POST); die;
	$couponCode = $_POST['cCode'];
	$subTotal = $_POST['subTotal'];
	$loginid = $_POST['vcusvale'];
	$validate = couponValidate($couponCode);
		
	$date = date('m/d/Y');
	$time = date('H:i:s');
	//print_r($validate);
	if($validate[0] == 0){
	$result = array(
               'status' => 0,
          );
		echo json_encode($result); // No coupon Exists in database
	}else{
		$dateValidate = couponDateValidate($couponCode);
	
		if($dateValidate[0] == 0){
		$result = array(
               'status' => 4,
          );
		echo json_encode($result); //Coupon Date Expire	
		}else{
			$coupsusecechk_vale = "SELECT COUNT(1) FROM coupons_use WHERE coup_use_custid='$loginid' AND coup_use_coupanname='$couponCode' AND coup_use_status='1'";
			$vale_datacopusn = mysqli_query($contdb,$coupsusecechk_vale);
			
			$rowquerycoupions = mysqli_fetch_array($vale_datacopusn);
			$totalusecopancustomer = $rowquerycoupions[0];

			$get_coupanvale = "SELECT * FROM coupons WHERE coup_name='$couponCode'";
			$coupnavale = mysqli_query($contdb,$get_coupanvale);
				
			while($rowvaledatacoup = mysqli_fetch_array($coupnavale)){
				$get_coupanvaledata = $rowvaledatacoup['coup_noofuse'];
			}
			if($get_coupanvaledata <= $totalusecopancustomer){
				$result = array(
               'status' => 3,
             );
				echo json_encode($result);
			}else{
				$delectdatavle = "DELETE FROM coupons_use WHERE coup_use_custid='$loginid' AND coup_use_date='$date' AND coup_use_status='0'";
				$deletcoupan = mysqli_query($contdb,$delectdatavle);
				// for flat Rate
				if($dateValidate[1][0]['coup_type'] == 1){
					$rate = $dateValidate[1][0]['coup_amount'];
				
					$_SESSION['subTotal'] = $subTotal-$rate;
					$_SESSION['discount_amount'] = $rate;
					$_SESSION['discount_code'] = $couponCode;
					$result = array(
                        'status' => 1,
                        'new_subtotal' => $_SESSION['subTotal'],
                        'discount_amount' => $_SESSION['discount_amount']
                    );
                    echo json_encode($result);
					$lessamountvale = number_format(($subTotal-$rate), 2);
					$insertcoupanvale = "INSERT INTO coupons_use(coup_use_custid,coup_use_achul_amt,coup_use_dicountamt,coup_use_less_amut,coup_use_coupanname,coup_use_date,coup_use_time,coup_use_status,coup_use_cataloger)VALUES('$loginid','$subTotal','$rate','$lessamountvale','$couponCode','$date','$time','0','1')";
					$queryvaledatainst = mysqli_query($contdb,$insertcoupanvale);
				}
				//for percentage
				if($dateValidate[1][0]['coup_type'] == 2){
					$rate = $dateValidate[1][0]['coup_amount'];
					$discAmt = $subTotal*($rate/100);
					//session_start();
					$_SESSION['subTotal'] = number_format(($subTotal-$discAmt), 2);
					$_SESSION['discount_amount'] = $discAmt;
					$_SESSION['discount_code'] = $couponCode;
			   	$result = array(
                    'status' => 2,
                    'new_subtotal' => $_SESSION['subTotal'],
                    'discount_amount' => $_SESSION['discount_amount']
                );
                echo json_encode($result);
                    
					$lessamountvale = number_format(($subTotal-$discAmt), 2);
					$insertcoupanvale = "INSERT INTO coupons_use(coup_use_custid,coup_use_achul_amt,coup_use_dicountamt,coup_use_less_amut,coup_use_coupanname,coup_use_date,coup_use_time,coup_use_status,coup_use_cataloger)VALUES('$loginid','$subTotal','$rate','$lessamountvale','$couponCode','$date','$time','0','1')";
				
					$queryvaledatainst = mysqli_query($contdb,$insertcoupanvale);
					
				}
			}
		
		}
		
	}

}


if(isset($_POST['removeshipto'])){
	$romvecustid = $_POST['custidshromve'];
	$remove_vale = "SELECT * FROM shpptoadds WHERE cust_to_id='$romvecustid' AND cust_to_status='0'";
	$queryvale = $contdb->query($remove_vale);
	if($queryvale->num_rows > 0){
		$removeaddews = "DELETE FROM shpptoadds WHERE cust_to_id='$romvecustid' AND cust_to_status='0'";
		$querydelet = $contdb->query($removeaddews);
		unset($_SESSION['shppingto']);
	}
}

    if(isset($_POST['payset'])){
      
      $Payment_session = $_POST['payset'];
      if(!empty($Payment_session)){
    
	 $_SESSION['processPayment'] = $Payment_session;
  
      }
}


if(isset($_POST['customer-firstName'])){
	$fname = $_POST['customer-firstName'];
	$lname = $_POST['customer-lastName'];
	$email = $_POST['customer-email'];
	//$password = MD5($_POST['customer-pass']);
	$phone = $_POST['customer-phone'];
	$country = $_POST['customer-country'];
	$address = $_POST['customer-address'];
	$city = $_POST['customer-city'];
	$state = $_POST['customer-state'];
	$postalcode = $_POST['customer-postalcode'];
	$countrycodeval = $_POST['customer-countcod'];
	$otherNote = $_POST['customer-orderNotes'];
	$singlvednname = str_replace(" ","_", $fname);
	$singlvedlast = str_replace(" ","_", $lname);
	$sing_val_data = $singlvednname.'_'.$singlvedlast;
	$siionidval = $_SESSION['customersessionlogin'];
	/*$auto_num = rand(888888,9999999);
	$singlauto = $auto_num.$email;
	$shaffauto = str_shuffle($singlauto);*/
	$date = date("m/d/Y");
	$time = date("h:i A");
	if(isset($_SESSION['gust_customer'])){
	 
		$update_datauser = "UPDATE customer SET customer_address='$address',customer_country='$country',customer_state='$state',customer_city='$city',customer_pincode='$postalcode',customer_phone='$phone',customer_otherNote='$otherNote' WHERE customer_ui_id='$siionidval'";
		$queryvaldata = $contdb->query($update_datauser);
		/*$update_datauser = "INSERT INTO customer(customer_fname,customer_lname,customer_address,customer_country,customer_state,customer_city,customer_pincode,customer_phone,customer_otherNote,customer_ui_id,customer_img,customer_date,customer_time,customer_active,customer_type)VALUES('$fname','$lname','$address','$country','$state','$city','$postalcode','$phone','$otherNote','$siionidval','0','$date','$time','1','Guest')";
		$queryvaldata = $contdb->query($update_datauser);

		$insert_login_detal = "INSERT INTO userlogntable(user_first_name,user_email,user_lastname,user_password,user_session_id,user_type,user_status,user_auto)VALUES('Guest','$email','User','Guest','0','customer','0','$siionidval')";
    	$query_loginset_user = $contdb->query($insert_login_detal);*/

	}else{
	    	  
		$update_datauser = "UPDATE customer SET customer_address='$address',customer_country='$country',customer_state='$state',customer_city='$city',customer_pincode='$postalcode',customer_phone='$phone',customer_otherNote='$otherNote' WHERE customer_ui_id='$siionidval'";
		$queryvaldata = $contdb->query($update_datauser);
	}
	echo 2;
	/*$cehck_email = "SELECT * FROM userlogntable WHERE user_email='$email'";
	$cehkquery = mysqli_query($conn, $cehck_email);
	if(mysqli_num_rows($cehkquery)){
		echo 0;
	}else{*/
		/*$checkname = "SELECT * FROM customer WHERE customer_name_url='$sing_val_data'";
		$query_namecehck = mysqli_query($conn,$checkname);
		if(mysqli_num_rows($query_namecehck)){
			echo 1;
		}else{*/
			/*$vendorinsert = "INSERT INTO userlogntable(user_first_name,user_email,user_lastname,user_password,user_session_id,user_cookies,user_type,user_status,user_auto)VALUES('$fname','$email','$lname','$password','0','0','customer','0','$shaffauto')";
			$vendor_login = mysqli_query($conn, $vendorinsert);*/
			/*$vendorall = "INSERT INTO customer(customer_fname,customer_lname,customer_name_url,customer_ui_id,customer_img,customer_address, customer_country, customer_state, customer_city, customer_pincode, customer_otherNote, customer_gender,customer_age,customer_phone,customer_auto,customer_date,customer_time,customer_active)VALUES('$fname','$lname','$sing_val_data','$shaffauto','0','$address','$country','$state','$city','$postalcode','$otherNote','0','0','$phone','$auto_num','$date','$time','1')";
			$venderquery = mysqli_query($conn, $vendorall);
			if($venderquery == true){
				$_SESSION['othernotevalue']=$otherNote;
				$_SESSION['customersessionlogin']=$shaffauto;
				$shrevarmail = $url."/phpmailer/mail?type=user&emailid=$email&nameget=$fname $lname";
				echo 2;
				//echo "<span class='green'>Account has been created successfully! You can enjoy your shopping now.</span>";
			}*/
		//}
	//}
}

if(isset($_POST["countrychage"])){
    // Capture selected country
    $countryvale = $_POST["countrychage"];
    $customeid = $_POST["Custyomeval"];
    $subtoalval = $_POST["subtotal"];
    $taxvaldata = $_POST["taxvaldat"];

    $_SESSION['shppingcountry']=$countryvale;
    
    $get_cartthree = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_status='0' AND cart_userid='$customeid'";
	$querycartthree = $contdb->query($get_cartthree);
	while($row_cartquery = $querycartthree->fetch_array()){
		$productidval = $row_cartquery['cart_prdo_auto_id'];
		$rowvaluedat[] = $row_cartquery;
		//if()
		
	} // while loop end
	foreach ($rowvaluedat as $shppgvaldat) {
		
		$date = date('m/d/Y');
		$produidvale[] = $shppgvaldat['cart_prdo_auto_id'];
		$countycodeval = $countryvale;

		$product_forloopid = $shppgvaldat['cart_prdo_auto_id'];
		$get_proudct_data = "SELECT * FROM all_product WHERE product_auto_id='$product_forloopid' AND product_status='1'";
		$query_setprodt = $contdb->query($get_proudct_data);
		while($row_getprodtval = $query_setprodt->fetch_array()){
			$get_vendot_id = $row_getprodtval['product_vender_id'];
		}
		$get_domistval = $shppgvaldat['cart_prdo_ship_domstik'];
		$get_internal = $shppgvaldat['cart_prdo_ship_inter'];
		/*if(count($count_valuedata) == "2"){
			echo "2";
		}else{
			echo "1";
		}*/
		$get_venodr_dat = "SELECT * FROM vendor WHERE vendor_auto='$get_vendot_id'";
		$query_vendorval = $contdb->query($get_venodr_dat);
		while($row_vendorval = $query_vendorval->fetch_array()){
			$get_couny_name = $row_vendorval['vendor_country'];
		//echo $get_couny_name;
		//echo $countycodeval;
			if($get_couny_name == $countycodeval){
				//echo '<li>'.substr($shppgvaldat['cart_prdo_name'], 0,40).' <span class="sub-count">$'.number_format($get_domistval, 2).'</span></li>';
				$total_shpping += $get_domistval;
			}else{
				//echo '<li>'.substr($shppgvaldat['cart_prdo_name'], 0,40).' <span class="sub-count">$'.number_format($get_internal, 2).'</span></li>';
				$total_shpping += $get_internal;
			}
		}
	}

    $_SESSION['shippingShowAmt']=$total_shpping;
   	$arrayval = number_format($total_shpping, 2);
   	$arrayvaltotal = number_format($subtoalval+$taxvaldata+$total_shpping, 2);
   	$_SESSION["grandTotal"]=$arrayvaltotal;
   	$resultval = array($arrayval, $arrayvaltotal);
	//$result = array($_SESSION["grandTotal"], $taxAmt, $subTotal);
	//echo $taxAmt;
	echo json_encode($resultval);
    //$_SESSION['countryvale']=$countryvale;
    /*$inset_country = "UPDATE customer SET customer_country='$countryvale' WHERE customer_ui_id='$customeid'";
    $query_instcout = $conn->query($inset_country);*/
    // Define country and city array
   /*$sqlcount = "SELECT * FROM shiptaxval WHERE shiptx_type = 'Tax' AND shiptx_countryname='$countryvale' ORDER BY shiptx_value";
	$qrycountyr = mysqli_query($conn,$sqlcount);
	while($rowcounty = mysqli_fetch_assoc($qrycountyr)){
		echo $resultsetval = '<option value="'.$rowcounty['shiptx_value'].'">'.$rowcounty['shiptx_value'].'</option>';
	}*/
}

// Tax and shipping charge
if(isset($_POST['stateGst'])){
	$state = $_POST['stateTax'];
	$subTotal = str_replace(",","", $_POST['subTotal']);
	$weight = $_POST['weight'];
	$data = stateTax($state);
	$shppivlaedata = $_POST['shppingvl'];
	// stateTax calculate
	$taxRate = $data[0]["shiptx_rate"];
	$taxAmt = number_format($subTotal*($taxRate/100), 2);
	$_SESSION["tax_amt"] = number_format($taxAmt, 2);
	//shipping charge calculate
	//$shippingCharge = number_format(shippingCharge($state, $weight), 2);
	//$_SESSION["shippingvalue"] = number_format(shippingCharge($state, $weight), 2);
	$_SESSION["grandTotal"] = number_format(($subTotal+$taxAmt+$shppivlaedata), 2);
	$result = array($_SESSION["grandTotal"], $taxAmt);
	//$result = array($_SESSION["grandTotal"], $taxAmt, $subTotal);
	//echo $taxAmt;
	echo json_encode($result);
}

if(isset($_POST['shipping'])){
	$date = date('m/d/Y');
	$time = date('H:i:s');
	$shipping_vale = $_POST['shippvale'];
	$explodatshipin = explode(',', $shipping_vale);
	$shppingamount = $explodatshipin[0];
	$shppingname = $explodatshipin[1];
	$shppinpd_id = $explodatshipin[2];
	$shipping_totlaamt = str_replace(',', '', $_POST['grantotval']);
	$taxvaleamout = $_POST['taxvaledata'];
	$customer_id = $_POST['shipping'];
	$cehck_shppingval = "SELECT * FROM shipping_table WHERE shipping_cust_id='$customer_id' AND shipping_date='$date' AND shipping_prodyut_id='$shppinpd_id'";
	$quewryvale = mysqli_query($contdb,$cehck_shppingval);
	if(mysqli_num_rows($quewryvale)){
		$updateshpping = "UPDATE shipping_table SET shipping_name='$shppingname',shipping_value='$shppingamount' WHERE shipping_cust_id='$customer_id' AND shipping_date='$date' AND shipping_prodyut_id='$shppinpd_id'";
		$uopdate_vale = mysqli_query($contdb,$updateshpping);
		if($uopdate_vale == true){
			
			$shppingamountArry = array($shppinpd_id=>array('ProductID'=>$shppinpd_id,'shppingValue'=>$shppingamount,'ShppingName'=>$shppingname));

			/*if(isset($_SESSION["shippingvale"])){*/

				foreach ($_SESSION["shippingvale"] as $keyShppin => $Shppivalue) {
					$keyChaleValue[] = $keyShppin;
					$PdIDname[] = $Shppivalue['ProductID'];
				}
				//print_r($keyChaleValue);
				if(in_array($shppinpd_id,$keyChaleValue)){
					foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
						$_SESSION["shippingvale"][$Updatekey]['shppingValue']=$shppingamount;
						$_SESSION["shippingvale"][$Updatekey]['ShppingName']=$shppingname;
						$AddCost[] = $updatevalue['shppingValue'];
					}
				}elseif(in_array($shppinpd_id,$PdIDname)){
					foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
						if($_SESSION["shippingvale"][$Updatekey]['ProductID'] == $shppinpd_id){
							$_SESSION["shippingvale"][$Updatekey]['shppingValue']=$shppingamount;
							$_SESSION["shippingvale"][$Updatekey]['ShppingName']=$shppingname;
						}
						$AddCost[] = $updatevalue['shppingValue'];
					}
				}else{
					foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
						$AddCost[] = $updatevalue['shppingValue'];
					}
					$_SESSION["shippingvale"]=array_merge($_SESSION["shippingvale"],$shppingamountArry);
				}
				$shppiSum = array_sum($AddCost);
				$_SESSION["shippingShowAmt"] = number_format($shppiSum, 2);
				$addshpinval = number_format($shipping_totlaamt+$taxvaleamout+$shppiSum, 2);
				$shpdidval = $shppinpd_id.$shppingamount;
				$singhlvale = json_encode(array('grandtotal'=>$addshpinval,'shippingdata'=>$shppiSum,'idvaleget'=>$shpdidval,'clickcount'=>'0'));
				echo $singhlvale;
				$_SESSION["grandTotal"] = number_format(str_replace(',', '', $addshpinval), 2);
			/*}else{*/
				/*foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
					$AddCost[] = $updatevalue['shppingValue'];
				}*/
				//$_SESSION['check']="SessionNot Set";
				/*$_SESSION["shippingvale"]=$shppingamountArry;
				$shppiSum = $shppingamount;
				$_SESSION["shippingShowAmt"] = number_format($shppiSum, 2);

				$addshpinval = number_format($shipping_totlaamt+$taxvaleamout+$shppiSum, 2);
				$shpdidval = $shppinpd_id.$shppingamount;
				$singhlvale = json_encode(array('grandtotal'=>$addshpinval,'shippingdata'=>$shppiSum,'idvaleget'=>$shpdidval,'clickcount'=>'1'));
				echo $singhlvale;
				$_SESSION["grandTotal"] = number_format(str_replace(',', '', $addshpinval), 2);*/
			/*}*/
			//unset($_SESSION['check']);
			//$shppiSum = array_sum($AddCost);
		}
	}else{
		$insertshippig = "INSERT INTO shipping_table(shipping_cust_id,shipping_name,shipping_value,shipping_date,shipping_time,shipping_prodyut_id)values('$customer_id','$shppingname','$shppingamount','$date','$time','$shppinpd_id')";
		$insertvale = mysqli_query($contdb,$insertshippig);
		if($insertvale == ture){
			
			$shppingamountArry = array($shppinpd_id=>array('ProductID'=>$shppinpd_id,'shppingValue'=>$shppingamount,'ShppingName'=>$shppingname));
			if(isset($_SESSION["shippingvale"])){

				foreach ($_SESSION["shippingvale"] as $keyShppin => $Shppivalue) {
					$keyChaleValue[] = $keyShppin;
					$PdIDname[] = $Shppivalue['ProductID'];
				}
				//print_r($keyChaleValue);
				if(in_array($shppinpd_id,$keyChaleValue)){
					foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
						$_SESSION["shippingvale"][$Updatekey]['shppingValue']=$shppingamount;
						$_SESSION["shippingvale"][$Updatekey]['ShppingName']=$shppingname;
						$AddCost[] = $updatevalue['shppingValue'];
					}
				}elseif(in_array($shppinpd_id,$PdIDname)){
					foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
						if($_SESSION["shippingvale"][$Updatekey]['ProductID'] == $shppinpd_id){
							$_SESSION["shippingvale"][$Updatekey]['shppingValue']=$shppingamount;
							$_SESSION["shippingvale"][$Updatekey]['ShppingName']=$shppingname;
						}
						$AddCost[] = $updatevalue['shppingValue'];
					}
				}else{
					foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
						$AddCost[] = $updatevalue['shppingValue'];
					}
					$_SESSION["shippingvale"]=array_merge($_SESSION["shippingvale"],$shppingamountArry);
				}
				$shppiSum = array_sum($AddCost);
				$addshpinval = number_format($shipping_totlaamt+$taxvaleamout+$shppiSum, 2);
				$shpdidval = $shppinpd_id.$shppingamount;
				$singhlvale = json_encode(array('grandtotal'=>$addshpinval,'shippingdata'=>$shppiSum,'idvaleget'=>$shpdidval,'clickcount'=>'2'));
				echo $singhlvale;
				$_SESSION["shippingShowAmt"] = number_format($shppiSum, 2);
				$_SESSION["grandTotal"] = number_format(str_replace(',', '', $addshpinval), 2);
			}else{
				/*foreach ($_SESSION["shippingvale"] as $Updatekey => $updatevalue) {
					$AddCost[] = $updatevalue['shppingValue'];
				}*/
				//$_SESSION['check']="SessionNot Set";
				$_SESSION["shippingvale"]=$shppingamountArry;

				$shppiSum = $shppingamount;
				$addshpinval = number_format($shipping_totlaamt+$taxvaleamout+$shppiSum, 2);
				$shpdidval = $shppinpd_id.$shppingamount;
				$singhlvale = json_encode(array('grandtotal'=>$addshpinval,'shippingdata'=>$shppiSum,'idvaleget'=>$shpdidval,'clickcount'=>'3'));
				echo $singhlvale;
				$_SESSION["shippingShowAmt"] = number_format($shppiSum, 2);
				$_SESSION["grandTotal"] = number_format(str_replace(',', '', $addshpinval), 2);
			}
			//unset($_SESSION['check']);
		}
	}
}

if(isset($_POST['removeshipto'])){
	$romvecustid = $_POST['custidshromve'];
	$remove_vale = "SELECT * FROM shpptoadds WHERE cust_to_id='$romvecustid' AND cust_to_status='0'";
	$queryvale = $contdb->query($remove_vale);
	if($queryvale->num_rows > 0){
		$removeaddews = "DELETE FROM shpptoadds WHERE cust_to_id='$romvecustid' AND cust_to_status='0'";
		$querydelet = $contdb->query($removeaddews);
		$_SESSION['shppingto']="1";
	}
}

if(isset($_POST['addTowhislt'])){
	$preodti = $_POST['proId'];

	if(isset($_SESSION['customersessionlogin'])){
			$cutomerauto_id = $_SESSION['customersessionlogin'];
	}else{
		$cutomerauto_id = "0";
	}
	$rowname = "whis_prd_id,whis_ip,whis_customerd,whis_date,whis_time,whis_broswer";
	$rowvalues = "'$preodti','$ip','$cutomerauto_id','$date','$time','$brower'";
	$insert_vale = GllInsertDataAllTable("wishlistbl_table",$rowname,$rowvalues);
	echo 0;
}
if(isset($_POST['addnotifyme'])){
	$notify = $_POST['proId'];
 
	if(isset($_SESSION['customersessionlogin'])){
			$cutomerauto_id = $_SESSION['customersessionlogin'];
	}else{
		$cutomerauto_id = "0";
	}
	$rowname = "noti_prd_id,noti_ip,noti_customerd,noti_date,noti_time,noti_broswer,noti_status";
	$rowvalues = "'$notify','$ip','$cutomerauto_id','$date','$time','$brower','0'";
	 $checkCondition = "noti_prd_id = '$notify' AND noti_customerd = '$cutomerauto_id'";
	 $updateValues = "noti_status = '0'";
	$insert_vale = GlllNotifyTablle("notifytbl_table",$rowname,$rowvalues,$checkCondition,$updateValues);
if($insert_vale == 0){
    echo 0;
}else{
    echo 1;
}
}

if(isset($_POST['removeTowhislt'])){
  
	echo $deletvaleids = $_POST['proIdwhis'];
	$deletid = "id='$deletvaleids'";
	$deletvale = DeleteALlDataVlae("wishlistbl_table",$deletid);
        echo 0; 
}


if(isset($_POST['shptoaddrs'])){
	$fname_vale = $_POST['toname'];
	$lname_vale = $_POST['tolname'];
	$shppto_addres = addslashes($_POST['toaddess']);
	$shppto_city = addslashes($_POST['tocity']);
	$shppto_country = $_POST['tocountry'];
	$shppto_state = $_POST['tostate'];
	$shppto_stcode = $_POST['tostacode'];
	$shppto_pincode = $_POST['topincode'];
	$custidvale = $_SESSION['customersessionlogin'];
	$phoneal = $_POST['tophone'];
	$emailvale = $_POST['toemail'];

	$set_shppingdata = shiptodetails($shppto_addres,$shppto_city,$shppto_country,$shppto_state,$shppto_stcode,$shppto_pincode,$custidvale,$fname_vale,$lname_vale,$phoneal,$emailvale);
	if($set_shppingdata == true){
		$_SESSION['shppingto']="2";
	}
}
?>