<?php

if (file_exists('sessionset.php')) {
    include 'sessionset.php';
}
include_once('../config_db/conn_connect.php');
 
$conn = conndata();

if (isset($_SESSION['customersessionlogin'])) {
    $setsession = $_SESSION['customersessionlogin'];
  // echo "Session variable value: " . $setsession;
} else {
    //echo "Session variable 'customersessionlogin' is not set.";
}

function customerdeatilsview(){
	global $conn;
	global $setsession;
	$customerviewdata = "SELECT * FROM customer WHERE customer_ui_id='$setsession'";

	$querycustomerview = mysqli_query($conn,$customerviewdata);

	while($rowcusviewdata = mysqli_fetch_array($querycustomerview)){
		$custviewemial = "SELECT * FROM userlogntable WHERE user_auto='$setsession'";
		$queryviewmail = mysqli_query($conn,$custviewemial);
		while($rowcustviewdata = mysqli_fetch_array($queryviewmail)){
		   
			$logincustviewemail = $rowcustviewdata['user_email'];
		}
        if($rowcusviewdata['customer_phone'] == "0" || $rowcusviewdata['customer_phone'] == ""){
            $phonenumb = "";
        }else{
            $phonenumb = $rowcusviewdata['customer_phone'];
        }

        if($rowcusviewdata['customer_address'] == "0" || $rowcusviewdata['customer_address'] == ""){
            $address = "";
        }else{
            $address = $rowcusviewdata['customer_address'];
        }

        if($rowcusviewdata['customer_city'] == "0" || $rowcusviewdata['customer_city'] == ""){
            $addcity = "";
        }else{
            $addcity = $rowcusviewdata['customer_city'];
        }

        if($rowcusviewdata['customer_pincode'] == "0" || $rowcusviewdata['customer_pincode'] == ""){
            $pincodeadd = "";
        }else{
            $pincodeadd = $rowcusviewdata['customer_pincode'];
        }

        if($rowcusviewdata['customer_age'] == "0" || $rowcusviewdata['customer_age'] == ""){
            $agecut = "";
        }else{
            $agecut = $rowcusviewdata['customer_age'];
        }

        if($rowcusviewdata['customer_gender'] == "0" || $rowcusviewdata['customer_gender'] == ""){
            $gendercust = "";
        }else{
            $gendercust = $rowcusviewdata['customer_gender'];
        }
		echo "<tr>
                <td>First Name</td>
                <td>".$rowcusviewdata['customer_fname']."</td>                            
              </tr>
              <tr>
                <td>Last Name</td>
                <td>".$rowcusviewdata['customer_lname']."</td>                            
              </tr>
              <tr>
                <td>Age</td>
                <td>".$agecut."</td>                            
              </tr>
              <tr>
                <td>Gender</td>
                <td>".$gendercust."</td>                            
              </tr>
              <tr>
                <td>Phone</td>
                <td><a href='tel:".$phonenumb."'>".$phonenumb."</a></td>                            
              </tr>
              <tr>
                <td>Email</td>
                <td><a href='mailto:$logincustviewemail'>$logincustviewemail</a></td>                            
              </tr>                          
              <tr>
                <td>Address</td>
                <td>".$address."</td>                            
              </tr>
              <tr>
                <td>Town / City</td>
                <td>".$addcity."</td>                            
              </tr>
              <tr>
                <td>Country / State</td>
                <td>".$rowcusviewdata['customer_country']." / ".$rowcusviewdata['customer_state']."</td>                            
              </tr>
              <tr>
                <td>Postal / Zip Code</td>
                <td>".$pincodeadd."</td>                            
              </tr>
              <tr>
                <td>Active Type</td>";
                if($rowcusviewdata['customer_active'] == "1"){
                	echo "<td>Active</td>";
                }elseif($rowcusviewdata['customer_active'] == "0"){
                	echo "<td>Un Active</td>";
                }                           
            echo "</tr>";
	}
}



function customereditview(){

	global $conn;

	global $setsession;

	$customereditdata = "SELECT * FROM customer WHERE customer_ui_id='$setsession'";

	$querycustomeredit = mysqli_query($conn,$customereditdata);

	while($rowcuseditdata = mysqli_fetch_array($querycustomeredit)){



		$custeditemial = "SELECT * FROM userlogntable WHERE user_auto='$setsession'";

		$queryeditmail = mysqli_query($conn,$custeditemial);

		while($rowcusteditdata = mysqli_fetch_array($queryeditmail)){

			$logincusteditemail = $rowcusteditdata['user_email'];

		}

        if($rowcuseditdata['customer_phone'] == "0" || $rowcuseditdata['customer_phone'] == ""){
            $phonenumb = "";
        }else{
            $phonenumb = $rowcuseditdata['customer_phone'];
        }

        if($rowcuseditdata['customer_address'] == "0" || $rowcuseditdata['customer_address'] == ""){
            $address = "";
        }else{
            $address = $rowcuseditdata['customer_address'];
        }

        if($rowcuseditdata['customer_city'] == "0" || $rowcuseditdata['customer_city'] == ""){
            $addcity = "";
        }else{
            $addcity = $rowcuseditdata['customer_city'];
        }

        if($rowcuseditdata['customer_pincode'] == "0" || $rowcuseditdata['customer_pincode'] == ""){
            $pincodeadd = "";
        }else{
            $pincodeadd = $rowcuseditdata['customer_pincode'];
        }

		echo "<div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>First name</label>

                <div class='col-lg-9'>

                    <input class='form-control' type='text' value='".$rowcuseditdata['customer_fname']."' name='fname' required>

                </div>

            </div>

            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Last name</label>

                <div class='col-lg-9'>

                    <input class='form-control' type='text' value='".$rowcuseditdata['customer_lname']."' name='lname' required>

                </div>

            </div>

            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Age</label>

                <div class='col-lg-9'>

                    <select id='user_time_zone' class='form-control' name='age' required>

                        <option value=''>Select Age</option>";

                        for($i=20; $i<100; $i++){

                            if($rowcuseditdata['customer_age'] == $i){

							 echo $ageoption = "<option value='$i' selected>$i</option>";

                            }else{

                                echo $ageoption = "<option value='$i'>$i</option>";

                            }

						}

                    echo "</select>

                </div>

            </div>

            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Gender</label>

                <div class='col-lg-9'>

                    <select id='user_time_zone' class='form-control' name='gender' required>

                        <option value='' disabled>Select Gender</option>";

                            if($rowcuseditdata['customer_gender'] == "male"){

                                echo "<option value='male' selected  >Male</option>

                                    <option value='female'>Female</option>

                                    <option value='other'>Other</option>";

                            }elseif($rowcuseditdata['customer_gender'] == "female"){

                                echo "<option value='male'>Male</option>

                                    <option value='female' selected>Female</option>

                                    <option value='other'>Other</option>";

                            }elseif($rowcuseditdata['customer_gender'] == "other"){

                                echo "<option value='male'>Male</option>

                                    <option value='female'>Female</option>

                                    <option value='other' selected>Other</option>";

                            }else{

                                echo "<option value='male'>Male</option>

                                <option value='female'>Female</option>

                                <option value='other'>Other</option>";

                            }

                    echo "

                    </select>

                </div>

            </div>

            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Email</label>

                <div class='col-lg-9'>

                    <input class='form-control' type='email' value='$logincusteditemail' name='email' required disabled>

                </div>

            </div>

            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Phone</label>

                <div class='col-lg-9'>

                    <input class='form-control' type='text' placeholder='Phone' value='".$phonenumb."' name='phone' maxlength='10' required>

                </div>

            </div>
            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Address</label>

                <div class='col-lg-9'>

                    <input class='form-control' type='text' value='".$address."' placeholder='Street Address' name='address' required>

                </div>

            </div>
            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Town / City:</label>

                <div class='col-lg-9'>

                    <input class='form-control' type='text' value='".$addcity."' placeholder='City' name='city' required>

                </div>

            </div>

            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Country / State</label>

                <div class='col-lg-5'>
                    <select class='form-control country' name='country' required>";
                        
                        $countname = "SELECT * FROM countries_db ORDER BY id ASC";
                        $query = mysqli_query($conn, $countname);
                        while($rowcount = mysqli_fetch_array($query)){
                            if($rowcuseditdata['customer_country'] == "" && $rowcuseditdata['customer_country'] == "0"){
                                echo "<option vlaue='".$rowcount['name']."'>".$rowcount['name']."</option>";
                            }else{
                                if($rowcuseditdata['customer_country'] == $rowcount['name']){
                                    echo "<option vlaue='".$rowcuseditdata['customer_country']."' selected>".$rowcuseditdata['customer_country']."</option>";
                                }else{
                                    $get_ids_vale[] = $rowcount['id'];
                                    echo "<option vlaue='".$rowcount['name']."'>".$rowcount['name']."</option>";
                                }
                                //echo "<option vlaue='".$rowcuseditdata['customer_country']."' selected>".$rowcuseditdata['customer_country']."</option>";
                            }
                        }
                        $countyname = $rowcuseditdata['customer_country'];
                        $get_countryset = "SELECT * FROM countries_db WHERE name='$countyname' ORDER BY id ASC";
                        $query_count = mysqli_query($conn, $get_countryset);
                        while($rowcount_count = mysqli_fetch_array($query_count)){
                            $get_ids_vale = $rowcount_count['id'];
                        }
                echo "</select>

                </div>
                <div class='col-lg-4'>
                    <select class='form-control response' name='state' required>";
                        echo "<option vlaue='' disabled selected>Select State</option>";
                        $selectstatev = "SELECT * FROM states WHERE country_id='101' ORDER BY name ASC";
                        $queryvale = $conn->query($selectstatev);
                        while($rowvaluestate = $queryvale->fetch_array()) {
                            $get_allstateval = $rowvaluestate['name'];

                            if($get_allstateval == $rowcuseditdata['customer_state']){
                                echo $get_arrayshppin[] = "<option value='".$get_allstateval."' selected>".$get_allstateval."</option>";
                            }else{
                                echo $get_arrayshppin[] = "<option value='".$rowvaluestate['name']."'>".$rowvaluestate['name']."</option>";
                            }
                        }
                echo "</select>
                </div>

            </div>
            
            <div class='form-group row'>

                <label class='col-lg-3 col-form-label form-control-label'>Postal / Zip Code<i>*</i></label>

                <div class='col-lg-9'>

                    <input class='form-control' type='number' value='".$pincodeadd."' placeholder='Postal / Zip Code' name='pincode' required maxlength='6'>

                </div>

            </div>
            <input class='form-control statecodevale' type='hidden' value='".$rowcuseditdata['customer_state_code']."' name='cuntcodevl'>
            ";

	}

}


function customeredit($fnamecustedit,$lnamecustedit,$agecustedit,$gendercustedit,$emailcustedit,$phonecustedit,$addrescustedit,$countrycustedit,$sataecustedit,$citycustedit,$pincodecustedit,$countycodevl){

	global $conn;

	global $setsession;



	$editviewupdate = "UPDATE customer SET customer_fname='$fnamecustedit', customer_lname='$lnamecustedit', customer_address='$addrescustedit', customer_gender='$gendercustedit', customer_age='$agecustedit', customer_phone='$phonecustedit',customer_email='$emailcustedit', customer_country='$countrycustedit', customer_state='$sataecustedit', customer_city='$citycustedit', customer_pincode='$pincodecustedit', customer_state_code='$countycodevl' WHERE customer_ui_id='$setsession'";

	$editqueryupat = mysqli_query($conn,$editviewupdate);

	if($editqueryupat == true){

		return true;

	}else{

		return false;

	}

}



function customrimg(){

    global $conn;

    global $setsession;

    global $url;

    $cust_img = "SELECT * FROM customer WHERE customer_ui_id='$setsession'";

    $queryimgcust = mysqli_query($conn,$cust_img);

    while($rowimgcust = mysqli_fetch_array($queryimgcust)){

        if($rowimgcust['customer_img'] == "0"){

            echo "$url/customer/images/default-user-icon.jpg";

        }else{

            echo "$url/images/".$rowimgcust['customer_img']."";

        }

    }

}

function customrname(){

    global $conn;

    global $setsession;



    $cust_name = "SELECT * FROM customer WHERE customer_ui_id='$setsession'";

    $querynamecust = mysqli_query($conn,$cust_name);

    while($rownamecust = mysqli_fetch_array($querynamecust)){

        $fnamecust = $rownamecust['customer_fname'];
        $lnamecust = $rownamecust['customer_lname'];

        echo $singlenamecut = $fnamecust.' '.$lnamecust;

    }

}



function customrimgupadte($productimgnewfilename){

    global $conn;

    global $setsession;



    $upadimg = "UPDATE customer SET customer_img='$productimgnewfilename' WHERE customer_ui_id='$setsession'";

    $queryimgupdate = mysqli_query($conn,$upadimg);

    if($queryimgupdate == true){

        return true;

    }else{

        return false;

    }

}


function chatvenodr(){
    global $conn;
    global $url;
    $getuserid = "SELECT * FROM vendor";
    $get_custome_data = mysqli_query($conn,$getuserid);
    while($rowdatacust = mysqli_fetch_array($get_custome_data)){
        $singl_id = $rowdatacust['vendor_auto'];
        if(isset($_GET['id'])){
            $sesiondata = $_GET['id'];
        }else{
            $sesiondata = "0";
        }
        if($sesiondata == $singl_id){
            echo '<a href="?id='.$rowdatacust['vendor_auto'].'"><li class="person active set_data" data-chat="" data-id="'.$rowdatacust['vendor_auto'].'">';
        }else{
            echo '<a href="?id='.$rowdatacust['vendor_auto'].'"><li class="person set_data" data-chat="'.$rowdatacust['vendor_auto'].'" data-id="'.$rowdatacust['vendor_auto'].'">';
        }
                if($rowdatacust['vendor_img'] == "0"){
                    echo '<img src="'.$url.'/assets/images/vendor_images/logo.png" alt="" />';
                }elseif($rowdatacust['vendor_img'] == ""){
                    echo '<img src="'.$url.'/assets/images/vendor_images/logo.png" alt="" />';
                }else{
                    echo '<img src="'.$url.'/assets/images/vendor_images/'.$rowdatacust['vendor_img'].'" alt="" />';
                }
        echo '<span class="name">'.$rowdatacust['vendor_f_name'].' '.$rowdatacust['vendor_l_name'].'</span>';
                echo '<span class="preview offline">'.$rowdatacust['vendor_date'].'&nbsp;'.$rowdatacust['vendor_time'].'</span>';
        echo '</li></a>';
    }
}

function chatviewdata($sessionval,$customerid){
    global $conn;

    $query_val = "SELECT * FROM chat_request WHERE chat_req_vedorid='$sessionval' AND chat_req_customer='$customerid' AND chat_req_status='1'";
    $valuequery = mysqli_query($conn,$query_val);
    if(mysqli_num_rows($valuequery)){
        $get_anem_val = "SELECT * FROM vendor WHERE vendor_auto='$sessionval'";
        $queryvaldata = mysqli_query($conn,$get_anem_val);
        while($rowdatvcat = mysqli_fetch_array($queryvaldata)){
           echo '<div class="top"><span>To: <span class="name">'.$rowdatvcat['vendor_f_name'].' '.$rowdatvcat['vendor_l_name'].'</span></span></div>';
        }
        echo '<div class="chat active-chat" data-chat="'.$sessionval.'"><div id="updatecaht">';

        $getcaht_val = "SELECT * FROM chat_user WHERE chat_u_id='$sessionval' AND chat_cust_id='$customerid' ORDER BY id ASC";
        $single_val = mysqli_query($conn,$getcaht_val);
        while($rowchat = mysqli_fetch_array($single_val)){
            if($rowchat['chat_u_id'] == $sessionval){
                echo '<div class="bubble me" title="'.$rowchat['chat_date'].' '.$rowchat['chat_time'].'">'.$rowchat['chat_text'].'</div>';
            }else{
                echo '<div class="bubble you title="'.$rowchat['chat_date'].' '.$rowchat['chat_time'].'">'.$rowchat['chat_text'].'</div>';
            }
        }
        echo '</div></div>
            <div class="write">
                <div id="repert">
                    <input type="text" id="textval"/>
                </div>';
            if(isset($_GET['id'])){
                $sesiondata = $_GET['id'];
                echo '<a href="javascript:;" class="write-link smiley"></a>
                    <a href="javascript:;" class="write-link send" data-id="'.$sesiondata.'"></a>';
            }
        echo '</div>';
    }else{
        echo '<div class="top"><span>To: <span class="name">Welcome</span></span></div>';
        echo '<div class="chat active-chat" data-chat="'.$customerid.'">
                <span id="clickadd" data-cust="'.$sessionval.'">Add Vendor to chat</span>
            </div>';
    }
}

if(isset($_POST['addvendor'])){
    $custmoerval = $_POST['custval'];
    $vendorval = $_POST['vaendval'];
    $date = date('m/d/Y');
    $time = date('h:i A');
    $check_val = "SELECT * FROM chat_request WHERE chat_req_vedorid='$vendorval' AND chat_req_customer='$custmoerval'";
    $query_val = mysqli_query($conn,$check_val);
    if(mysqli_fetch_array($query_val)){
        echo "1";
    }else{
        $insertdatarequest = "INSERT INTO chat_request(chat_req_vedorid,chat_req_customer,chat_req_date,chat_req_time,chat_req_block,chat_req_delete,chat_req_status)VALUES('$vendorval','$custmoerval','$date','$time','0','0','1')";
        $querydatarequest = mysqli_query($conn,$insertdatarequest);
        echo "1";
    }
}

if(isset($_POST['postdata'])){
    $id = $_POST['id'];
    $unquserval = addslashes($_POST['value']);
    $customerid = $_POST['cssvalid'];
    $date = date('m/d/Y');
    $time = date('h:i A');
    $insertdata = "INSERT INTO chat_user(chat_u_id,chat_cust_id,chat_date,chat_time,chat_status,chat_text,chat_delete)VALUES('$id','$customerid','$date','$time','1','$unquserval','0')";
    $querydata = mysqli_query($conn,$insertdata);
    echo $unquserval;
}

function customerOrdersnew() {
    global $conn;
    global $setsession;

    // Ensure $conn and $setsession are set
    if (!isset($conn) || !isset($setsession)) {
        echo "Database connection or session not set.";
        return;
    }

    // Prepare the main SQL query
    $sql = $conn->prepare("SELECT * FROM customer_order WHERE customer_id=? ORDER BY id DESC");
    $sql->bind_param("s", $setsession);
    $sql->execute();
    $qry = $sql->get_result();

    while ($row = $qry->fetch_assoc()) {
      
        $stid = $row['p_serty_id'];
        $customerid = $row['customer_id'];
        $productnumber = $row['product_auto_id'];
        $productsize = $row['p_filter_value'];
        $productcolor = $row['p_filter_color'];
        $shppingamout = $row['p_shpping_amount'];
        $prodprice = $row['p_price'];

        // Fetch product details
        $getproduct = $conn->prepare("SELECT * FROM all_product WHERE product_auto_id=?");
        $getproduct->bind_param("s", $productnumber);
        $getproduct->execute();
        $queryproduct = $getproduct->get_result();

        while ($rowfetcprodutc = $queryproduct->fetch_assoc()) {
            $getvdnortname = $rowfetcprodutc['product_vender_id'];
            $getsku = $rowfetcprodutc['product_sku'];
            $getproducturl = $rowfetcprodutc['product_page_name'];
            $getproduycdst = $rowfetcprodutc['product_short_des'];
            $getproduyregprice = $rowfetcprodutc['product_regular_price'];
            $getproduysaleprce = $rowfetcprodutc['product_sale_price'];
            $getproductname = $rowfetcprodutc['product_name'];
            $prodcutprice = $prodprice;

            // Fetch vendor details
            $queryget_vendor = $conn->prepare("SELECT * FROM vendor WHERE vendor_auto=?");
            $queryget_vendor->bind_param("s", $getvdnortname);
            $queryget_vendor->execute();
            $quervendoral = $queryget_vendor->get_result();
            
            while ($rowvaleqyert = $quervendoral->fetch_assoc()) {
                $get_venodrname = $rowvaleqyert['vendor_f_name'] . ' ' . $rowvaleqyert['vendor_l_name'];
            }
        }

        // Fetch shipping details
        $get_shippingvale = $conn->prepare("SELECT * FROM shipping_table WHERE mul_shipp_setid=? AND mul_shipp_custid=?");
        $get_shippingvale->bind_param("ss", $stid, $customerid);
        $get_shippingvale->execute();
        $queryshgppinvl = $get_shippingvale->get_result();

        while ($rowshppingquery = $queryshgppinvl->fetch_assoc()) {
            $get_labelnumber = $rowshppingquery['mul_shipp_shipptrakinid'];
            $get_taxmount = $rowshppingquery['mul_shipp_taxamunt'];
            $get_checkvale = $rowshppingquery['mul_shipp_trakingname'];

            // Fetch tracking details
            $tracingname = $conn->prepare("SELECT * FROM shipping_compy WHERE shipping_c_name=?");
            $tracingname->bind_param("s", $get_checkvale);
            $tracingname->execute();
            $queryvaleudat = $tracingname->get_result();
            
            while ($rowgetcshpping = $queryvaleudat->fetch_assoc()) {
                $get_shppinurl = $rowgetcshpping['shipping_c_tracklink'];
            }

            if ($get_checkvale == "0") {
                $trakingid = "<td style='color:red;'>Awaiting Tracking ID</td>";
            } else {
                $trakingid = "<td class='info-btn pointers' data-toggle='modal' data-target='#myModal' data-name='$get_checkvale' data-link='$get_shppinurl' data-id='$get_labelnumber'>" . $get_labelnumber . "</td>";
            }

            $totalcharges = $prodcutprice + $shppingamout + $get_taxmount;
        }

        // Check payment response and output table row
        if ($row['payment_response'] == "1") {
            // Add product size display here
            $parringval = explode(',', $productsize); // Split sizes into an array
            $sizeOutput = '';
            /*foreach ($parringval as $filtervalue) {
                // Fetch size details
                $get_frilter = $conn->prepare("SELECT * FROM product_variationsdata WHERE id=?");
                $get_frilter->bind_param("s", $filtervalue);
                $get_frilter->execute();
                $get_singlval = $get_frilter->get_result();
                while ($rowtremval = $get_singlval->fetch_assoc()) {
                    $sizeOutput .= "<b>" . $rowtremval['proval_trm_value'] . "</b><br/>";
                }
            }*/
 $sizeText = !empty($productsize) ? 'Size: ' . $productsize . '<br>' : '';
    $colorText = !empty($productcolor) ? 'Color: ' . $productcolor : '';
            // Echo the table row with product details, including size and tracking
            echo "<tr>
                <td>" . date("m-d-Y", strtotime($row['p_date'])) . "</td>
                <td>" . $row['tnx_id'] . "</td>
                <td>" . $get_venodrname . "</td>
                <td>" . $getproductname . "</td>
                <td><a href='https://testing.buyjee.com/" . $getproducturl . "' target='_blank'>" . $getsku . "</a></td>
                 <td>". $sizeText. $colorText. "</td>
                $trakingid
            </tr>";
        } elseif ($row['payment_response'] == "2") {
            // Similar output as above for payment response 2
            $parringval = explode(',', $productsize); // Split sizes into an array
            $sizeOutput = '';
            /*foreach ($parringval as $filtervalue) {
                // Fetch size details
                $get_frilter = $conn->prepare("SELECT * FROM product_variationsdata WHERE id=?");
                $get_frilter->bind_param("s", $filtervalue);
                $get_frilter->execute();
                $get_singlval = $get_frilter->get_result();
                while ($rowtremval = $get_singlval->fetch_assoc()) {
                    $sizeOutput .= "<b>" . $rowtremval['proval_trm_value'] . "</b><br/>";
                }
            }*/

            // Echo the table row with product details, including size
            echo "<tr>
                <td>" . date("m-d-Y", strtotime($row['p_date'])) . "</td>
                <td>" . $row['tnx_id'] . "</td>
                <td>" . $get_venodrname . "</td>
                <td>" . $getproductname . "</td>
                <td><a href='https://testing.buyjee.com/" . $getproducturl . "' target='_blank'>" . $getsku . "</a></td>
                     <td>". $sizeText. $colorText. "</td>


            </tr>";
        } 
    }
}

 // function end

function cancelformData($data_msg_val,$set_valedata,$session_valeid){
    global $conn;
    global $setsession;

    $cancle_vlaedata = explode(',', $set_valedata);
    $label_ID = $cancle_vlaedata[0];
    $trangtn_ID = $cancle_vlaedata[1];
    $id_customer_order = $cancle_vlaedata[2];

    $insert_vale = "SELECT * FROM customer WHERE customer_ui_id='$session_valeid'";
    $query_valdata = $conn->query($insert_vale);
    while($rowDataValeu = $query_valdata->fetch_array()){
        $name_valecancle = $rowDataValeu['customer_fname'];
        $name_valecancle = $rowDataValeu['customer_lname'];

        $update_cancle_data = "UPDATE customer_order SET p_cancled_requst='1' WHERE tnx_id='$trangtn_ID' AND id='$id_customer_order' AND customer_id='$session_valeid'";
        $query_updateCancle = mysqli_query($conn,$update_cancle_data);
        if($query_updateCancle == true){
            //return true;
            $insertDataMsg = "INSERT INTO cancel_request(can_msg,can_tanx_id,can_order_id,can_session_id)VALUES('$data_msg_val','$trangtn_ID','$id_customer_order','$setsession')";
            $querysetMsg = $conn->query($insertDataMsg);
            if($querysetMsg == true){
                return true;
            }else{
                return false;
            }
        }
    }
}

// Order Lists
function customerOrders(){
    global $conn;
    global $setsession;

    $sql = "SELECT * FROM customer_order WHERE customer_id='$setsession'";
    $qry = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($qry)){

        $get_shippingvale = "SELECT * FROM shipping_table WHERE shipping_secorty_key='".$row['p_serty_id']."'";
        $queryshgppinvl = mysqli_query($conn,$get_shippingvale);
        if(mysqli_num_rows($queryshgppinvl)){
            while($rowshppingquery = mysqli_fetch_array($queryshgppinvl)){
                $get_labelnumber = $rowshppingquery['shipping_traking_number'];
                if($row['payment_response'] == "1"){
                    include '../../ups_shipping/tracking.php';

                    echo "<tr>
                        <td></td>
                        <td>".$row['p_name']."</td>                            
                        <td>".$row['p_qty']."</td> 
                        <td>$".$row['p_price']."</td>                            
                        <td>".$get_labelnumber."</td>
                        <td>".$row['tnx_id']."</td>
                        <td>".$row['p_date']."</td>
                        <td>Order Successfully ".$final_output."</td>
                        <td><a href='https://www.ups.com/track' target='_blank'>Track</a></td>
                        <td><a href='".$url."/paymentrefund/' target='_blank'>Cancel Order</a></td>
                      </tr>";
                }
            }
        }else{
            if($row['payment_response'] == "2"){
                echo "<tr>
                    <td></td>
                    <td>".$row['p_name']."</td>                            
                    <td>".$row['p_qty']."</td> 
                    <td>$".$row['p_price']."</td>                            
                    <td>No Tracking ID</td>
                    <td>".$row['tnx_id']."</td>
                    <td>".$row['p_date']."</td>
                    <td>Cancancel Order</td>
                    <td>No Track</td>
                  </tr>";
            }
        }
    }
}

function changepssval($oldpassword,$newpassword,$session_data){
    global $conn;

    if($oldpassword == "Guest"){
        $passworcehcl = $oldpassword;
    }else{
        $passworcehcl = MD5($oldpassword);
    }
    $cehckpassword = "SELECT * FROM userlogntable WHERE user_password='$passworcehcl' AND user_auto='$session_data'";
    $quwerycehck = mysqli_query($conn,$cehckpassword);
    if(mysqli_num_rows($quwerycehck)){
        $makpassword = MD5($newpassword);
        $update_new_pass = "UPDATE userlogntable SET user_password='$makpassword' WHERE user_auto='$session_data'";
        $updatepass_val = mysqli_query($conn,$update_new_pass);
        if($updatepass_val == true){
            return true;
        }
    }else{
        return false;
    }
}


/*Notification code */

function mynotification() {
    global $conn;
    global $setsession;
 global $url;
 
    if (isset($_SESSION['customersessionlogin'])) {
        $customerautoid = $_SESSION['customersessionlogin'];

        $sql = "
            SELECT 
                n.noti_prd_id,
                n.noti_customerd,
                n.noti_date,
                n.noti_time,
                n.noti_status,
                p.product_image,
                p.product_link,
                p.product_name,
                p.product_stock,
                p.product_status,
                c.customer_ui_id,
                c.customer_fname,
                c.customer_lname
            FROM 
                notifytbl_table n
            LEFT JOIN 
                all_product p ON n.noti_prd_id = p.id
            LEFT JOIN 
                customer c ON n.noti_customerd = c.customer_ui_id
        ";

        $query = $conn->query($sql);

        if ($query) {
            while ($row = $query->fetch_array()) {
                
                $notify_customers = $row['customer_ui_id'];

                if ($customerautoid == $notify_customers && $row['noti_status'] == 1 && $row['product_status'] != 0 && $row['product_stock'] != 0) {
                    ?>
                    <tr>
                        <td class="setimmg">
                            <a href="<?php echo $row['product_link']; ?>" target="_blank">
                                <img src="<?php echo $url; ?>images/<?php echo $row['product_image']; ?>" class="img-fluid" alt="Product Image">
                            </a>
                        </td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td class="colos">
                            <p> Product Currently Available</p>
                        </td>
                    </tr>
                    <?php
                }
            }
        } else {
            echo "Error executing query: " . $conn->error;
        }
    }
}


?>