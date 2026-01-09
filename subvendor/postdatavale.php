<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

if(isset($_POST['addproduct'])){
  $subvenderdataadd = $_POST['subvenderdata'];
    $subvedorsql = "SELECT * FROM `subvendor` WHERE subvendor_auto = '$subvenderdataadd'";
      $query_subvedorsql = $conn->query($subvedorsql);
     while($subvedordata = $query_subvedorsql->fetch_array()){
       $parevendor = $subvedordata['session_auto'];
     }
    $prodtaddname = addslashes(trim($_POST['prodttitle']));
    if(addslashes(trim($_POST['peramlink'])) == ""){
    	$newpdurlname = ChakingProductName($prodtaddname);
    }else{
    	$newpdurlname = ChakingProductName(addslashes(trim($_POST['peramlink'])));
    }
    $chkingprodname = ChakingProductName($prodtaddname);
    $prodaddpagename= makeurl($newpdurlname);
    $prodtaddlink = str_replace("/vendor/", "/", $url).''.trim($prodaddpagename);
    $prodtadddest = addslashes($_POST['texteditor']);
    $prodtaddregprice = addslashes($_POST['prodregprice']);
    $prodtaddsalprice = addslashes($_POST['prodsalgprice']);
    $prodtaddstock = addslashes($_POST['prodstock']);
    $prodtaddsku = addslashes($_POST['prodsku']);
    
      $ariticlecode = addslashes($_POST['ariticlecode']);
      $hsnsaccode = addslashes($_POST['hsnsaccode']);
       $breakable = addslashes($_POST['breakable']);
       $gst_rate = addslashes($_POST['gst_rate']);
    $venderdataadd = $parevendor;
    $prodtaddcateg = $_POST['prodt_cat'];
    $prodtcat_val = "";
    $product_url = "";
    foreach($prodtaddcateg as $value_cat){
    	$explode_val = explode('|', $value_cat);
		$product_url .= $explode_val[0] .',';
		$prodtcat_val .= $explode_val[1] .',';
    }

    $product_img = "prodtmainimg";
	$product_imguplod = images_upload($product_img);
	$fileinfoMainImg = @getimagesize($_FILES["prodtmainimg"]["tmp_name"]);
    $widthMainImg = $fileinfoMainImg[0];
    $heightMainImg = $fileinfoMainImg[1];
	if($product_imguplod == "0"){
		$edit_tvnes_thnualname = $_POST['mainimgchkig'];
		$Prod_006 = "0";
	}else{
	    if($widthMainImg == "720" || $heightMainImg == "720") {
    		$edit_tvnes_thnualname = $product_imguplod;
    		move_uploaded_file($_FILES['prodtmainimg']['tmp_name'], "$file_path/$product_imguplod");
    		$Prod_006 = "0";
	    }else{
            // echo "<script>alert('Image dimension should be within 720X720px.');</script>";
            $Prod_006 = "1";
        }
	}
    $shortdata = addslashes($_POST['shordest']);
    if(!empty($shortdata)){
        $Prod_002 == "0";
    }else{
        // echo "<script>alert('Your Short Description Required.');</script>";
        // $Prod_002 == "1";
    }
    $discountvale = addslashes($_POST['disountvalue']);
    $product_dis_type = $_POST['dissontype'];
    $domist_shpping = $_POST['domistupdtae'];
    if($domist_shpping == ""){
     // $shippingratesdest = "12";
    }else{
      $shippingratesdest = $domist_shpping;
    }
    $internal_shpping = $_POST['internolupdate'];
    if($internal_shpping == ""){
     // $shippingratesint = "20";
    }else{
      $shippingratesint = $internal_shpping;
    }
    $_get_pageautid = $_GET['autoid'];
    $_readcmdeps = $_POST['recmatepd'];
    $recomadepd = "";
    foreach($_readcmdeps as $reacmvale){
    	$recomadepd .= $reacmvale.',';
    }

    $pagename = $_POST['suname'];
    
    $multiimages = AddNewProudtcvaleimages($_FILES['prodtallimg'],$_get_pageautid);
    // print_r($multiimages);
    // die();

    if(trim($prodtaddname) == ""){
        echo "<script>alert('Please fill Product Name.');</script>";
    }else{
        if(trim($shortdata) == ""){
            echo "<script>alert('Please fill Short Description.');</script>";
        }else{
            if(trim($prodtaddsku) == ""){
                echo "<script>alert('Please fill SKU.');</script>";
            }else{
                if(trim($Prod_006) == 1){
                    echo "<script>alert('Upload image 720x720.');</script>";
                }else{
                // if(trim($prodtaddregprice) == ""){
                //     echo "<script>alert('Please fill Regular Price.');</script>";
                // }else{
               
                   // $qeryvaleuset = $contdb->query($uploadatevale);
                    $lowminholdmain = $_POST['prodminthold'];
                   
                     	$pageid =$_GET['pageid'];
                     	if($pageid == 0 ){
                              $sql = "INSERT INTO `all_product`(`product_name`, `product_link`, `product_page_name`, `product_destion`, `product_short_des`, 
                            `product_regular_price`, `product_sale_price`, `product_catger`, `product_catger_ids`, `product_cat_id`, `product_tags`, 
                            `product_stock`, `product_sku`, `product_weight`, `product_dimensions`, `product_color`, `product_size`, `product_volume`,
                             `product_auto_id`, `product_image`, `product_gallery_image`, `product_date`, `product_time`, `product_vender_id`, 
                             `product_status`,`is_breakable`, `product_discount`, `product_dis_type`, `product_approve_stmp`, `product_shppin_domst`, `product_ariticlecode`,`product_hsnsaccode`,`product_gst_rate`,
                             `product_shppin_inters`, `product_recomateprd`, `product_min_price`,`product_subvender_id`, `is_deleted`)
                             VALUES ('$chkingprodname','$prodtaddlink','$prodaddpagename','$prodtadddest','$shortdata','$prodtaddregprice','$prodtaddsalprice','$product_url','$prodtcat_val','$prodtcat_url','','$prodtaddstock',
							 '$prodtaddsku','','','','','','$_get_pageautid','$edit_tvnes_thnualname','$multiimages','$date','$time','$venderdataadd','0','$breakable','$discountvale','$product_dis_type',
                             '0','$shippingratesdest','$ariticlecode','$hsnsaccode','$gst_rate','$shippingratesint','$recomadepd','$lowminholdmain','$subvenderdataadd','0')";
                  if ($conn->query($sql) === TRUE) {
                     
                        $last_id = $conn->insert_id;
                        echo "<script> alert('Product Add Successfully. ');window.location.href = 'https://testing.buyjee.com/subvendor/addnewsubproduct/?pageid=$last_id&autoid=$_get_pageautid';
                        </script>";
                
                       

                       
                    } else {
                         echo "<script>alert('Product not saved successfully');</script>";
                        //echo "Error: " . $sql . "<br>" . $contdb->error; die;
                    }
                     	}else{
                   $modifydate = date('Y-m-d H:i:s');
                     $update_datafiled = "product_vender_id='$venderdataadd',product_name='$chkingprodname',product_link='$prodtaddlink',product_page_name='$prodaddpagename',product_destion='$prodtadddest',product_short_des='$shortdata',product_regular_price='$prodtaddregprice',product_sale_price='$prodtaddsalprice',product_catger='$product_url',product_catger_ids='$prodtcat_val',product_stock='$prodtaddstock',product_sku='$prodtaddsku',product_image='$edit_tvnes_thnualname',product_gallery_image='$multiimages',product_modifydate='$modifydate',product_status='0',is_breakable='$breakable',product_discount='$discountvale',product_dis_type='$product_dis_type',product_approve_stmp='0',
                                     product_shppin_domst='$shippingratesdest',product_ariticlecode='$ariticlecode',product_hsnsaccode='$hsnsaccode',product_gst_rate='$gst_rate',product_shppin_inters='$shippingratesint',product_recomateprd='$recomadepd',product_min_price='$lowminholdmain'";
                    $_getupdateid = "id='".$_GET['pageid']."' AND product_auto_id='".$_GET['autoid']."'";
                    $insert_data = UpdateAllDataFileds("all_product",$update_datafiled,$_getupdateid,$_pageidcsk);
                    if($insert_data == true){
                        echo "<script>alert('Successfully Uploaded')</script>";
                        header("Refresh:0");
                    }
                 }
            }
            }
        }
    }
}






?>