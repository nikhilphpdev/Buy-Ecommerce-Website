<?php

include 'includes/upper-header.php'; ?>
<meta name="description" content="">
<meta name="keywords" content="">
<title>Successful Order</title>
<?php 
include 'includes/main-header.php';
date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION['customersessionlogin'])){
 echo '<script>';
    echo 'window.location.href="'.$url.'/";';
    echo '</script>';
}

if(isset($_SESSION['customersessionlogin'])){

              
        $get_cutomerid = $_SESSION['customersessionlogin'];
        $get_secorty_link = $_SESSION['secortycode'];
        $taxamountvale = $_SESSION["tax_amt"];
        $shpiing_address = $_SESSION["shppingto"];
            $shippaddres  = $_SESSION['shippaddres'];
       
        $dateval = date('m/d/Y');
        $path = realpath(dirname(__FILE__));

        $get_cartdatafour = "SELECT * FROM cart_user WHERE cart_status='0' AND cart_userid='$get_cutomerid'";
        $querycartfour = $contdb->query($get_cartdatafour);
 // echo'<pre>'; print_r($get_cartdatafour); die;
        if($querycartfour->num_rows > 0){
            while($rowgetvaleat = $querycartfour->fetch_array()){
                $get_cartvale[] = $rowgetvaleat;
               
                $get_productaoutid = $rowgetvaleat['cart_prdo_auto_id'];
            }
            $updatestock = "SELECT * FROM all_product WHERE product_auto_id='$get_productaoutid'";
               
            $querystock_val = $contdb->query($updatestock);
            while($rowstockval = $querystock_val->fetch_array()){
                $stock_vale = $rowstockval['product_stock'];
                $productid = $rowstockval['id'];
                if($stock_vale == "" || $stock_vale == "0"){}else{
                    $addvalestock = $stock_vale-1;
                    $updatevaleustock = "UPDATE all_product SET product_stock='$addvalestock' WHERE id='$productid' AND product_auto_id='$get_productaoutid'";
                    $queryupdatestock = $contdb->query($updatevaleustock);
                }
            }
            // End Update Stock Value 
        } // cart get data
     //   $arraycabinval = array_combine($get_secorty_link, $get_cartvale);
         
        foreach ($get_cartvale as $keyvale => $itemvalew) {
                       // echo'<pre>'; print_r($itemvalew); die;
            $productName = $itemvalew['cart_prdo_name'];
            $productsalepc = $itemvalew['cart_prdo_pricesale'];
            if($productsalepc == "" || $productsalepc == "0"){
                $productPrice = $itemvalew['cart_prdo_pricereg'];
            }else{
                $productPrice = $productsalepc;
            }
            $productQty = $itemvalew['cart_prdo_qutity'];
            $get_domastik = $itemvalew['cart_prdo_ship_domstik'];
            $get_internsal = $itemvalew['cart_prdo_ship_inter'];
            $productAutoid = $itemvalew['cart_prdo_auto_id'];
            $colorvale = $itemvalew['cart_prdo_colorvalue'];
            if($colorvale == "0" || $colorvale == ""){
                $colorvertin = "0";
            }else{
                $colorvertin = $itemvalew['cart_prdo_colorvalue'];
            }
            $sizevale = $itemvalew['cart_prdo_sizevalue'];
            if($sizevale == "0" || $sizevale == ""){
                $sizevertin = "0";
            }else{
                $sizevertin = $itemvalew['cart_prdo_sizevalue'];
            }
            $cartvertiondaat = $itemvalew['cart_prdo_sizename'];
            $vendor_productval = "SELECT * FROM all_product WHERE product_auto_id='$productAutoid'";
            $query_valprodt = $contdb->query($vendor_productval);
            while($rowget_prodtshpig = $query_valprodt->fetch_array()){
                $get_venodr_id = $rowget_prodtshpig['product_vender_id'];
                $get_colorver = $rowget_prodtshpig['product_color'];

                $get_stock_val = "SELECT * FROM product_attbut_vartarry WHERE prot_trm_prodtid='$get_colorver' AND prot_trm_id='$cartvertiondaat' OR prot_trm_prodtid='$productAutoid' AND prot_trm_id='$cartvertiondaat'";
                $queryverttqun = $contdb->query($get_stock_val);
                if($queryverttqun->num_rows > 0){
                    while($rowquntyadd = $queryverttqun->fetch_array()){
                        $quntityvale = $rowquntyadd['prot_trm_quantity'];
                    }
                    if($quntityvale == "" || $quntityvale == "0"){}else{
                        $qutiyvalue = $quntityvale-1; 
                        $updatevaleustock = "UPDATE product_attbut_vartarry SET prot_trm_quantity='$qutiyvalue' WHERE prot_trm_prodtid='$get_colorver' AND prot_trm_id='$cartvertiondaat' OR prot_trm_prodtid='$productAutoid' AND prot_trm_id='$cartvertiondaat'";
                        $queryupdatestock = $contdb->query($updatevaleustock);
                        /*if($queryupdatestock == true){
                            echo "ok";
                        }else{
                            echo "no";
                        }*/
                    }
                }
            }
            $get_product_vendor = "SELECT * FROM vendor WHERE vendor_auto='$get_venodr_id'";
            $query_dataqcon = $contdb->query($get_product_vendor);
            while($get_countryvenodr = $query_dataqcon->fetch_array()){
                $get_venodr_country = $get_countryvenodr['vendor_country'];
                $get_venodrname = $get_countryvenodr['vendor_f_name'].' '.$get_countryvenodr['vendor_l_name'];
            }
        
            if($shippaddres == "2"){
                $get_customer_cout = "SELECT * FROM shpptoadds WHERE cust_to_id='$get_cutomerid'";
                $query_valecust = $contdb->query($get_customer_cout);
                while($rowgetcustomercut = $query_valecust->fetch_array()){
                    $get_cyust_country = $rowgetcustomercut['cust_to_country'];
                }
                $shippaddres = "2";
            }elseif($shippaddres == "1"){
                $get_customer_cout = "SELECT * FROM customer WHERE customer_ui_id='$get_cutomerid'";
                $query_valecust = $contdb->query($get_customer_cout);
                while($rowgetcustomercut = $query_valecust->fetch_array()){
                    $get_cyust_country = $rowgetcustomercut['customer_country'];
                }
                $shippaddres = "1";
            }else{
                $get_customer_cout = "SELECT * FROM customer WHERE customer_ui_id='$get_cutomerid'";
                $query_valecust = $contdb->query($get_customer_cout);
                while($rowgetcustomercut = $query_valecust->fetch_array()){
                    $get_cyust_country = $rowgetcustomercut['customer_country'];
                }
                $shippaddres = "1";
            }
            $squlupdateadds = "UPDATE shpptoadds SET cust_to_status='1' WHERE cust_to_id='$get_cutomerid'";
            $shppintoval = $contdb->query($squlupdateadds);
            if($get_cyust_country == $get_venodr_country){
                $shppingtovaladd = $get_domastik;
            }else{
                $shppingtovaladd = $get_internsal;
            }
            
                $sqlupdate = "UPDATE customer_order SET payment_url_status='1',payment_response='1',p_shipping_address='$shippaddres' WHERE customer_id='$get_cutomerid' AND product_auto_id='$productAutoid' AND p_serty_id='$keyvale'";

                $insertdata = $contdb->query($sqlupdate);
            
            $update_shippingvale = "UPDATE shipping_table SET mul_shipp_trakingname='0',mul_shipp_shipptrakinid='0',mul_shipp_taxamunt='$taxamountvale' WHERE mul_shipp_custid='$get_cutomerid' AND mul_shipp_setid='$keyvale'";
            $queryupdate_vale = $contdb->query($update_shippingvale);

        } // Cart foreach loop

        $get_valedata = "SELECT * FROM customer_order WHERE customer_id='$get_cutomerid' AND p_date='$dateval'";
        $quuery_datavl = $contdb->query($get_valedata);
        if($quuery_datavl->num_rows > 0){
            while($row_val_data = $quuery_datavl->fetch_array()){
                $get_trcknum = $row_val_data['tnx_id'];
                if($get_trcknum == "0"){
                    $transaction_id = rand(8888888,999999999999);
                }elseif($get_trcknum == ""){
                    $transaction_id = rand(8888888,999999999999);
                }else{
                    $transaction_id = $get_trcknum;
                }
            }
        }
    
        include("success-pages/customer-email.php");
        include("success-pages/vender-email.php");
        include("success-pages/admin-email.php");

        if(isset($_SESSION['discount_amount']) && isset($_SESSION['discount_code'])){
            $coupancode = $_SESSION['discount_code'];
            $counpanvale = $_SESSION['discount_amount'];
            $totalamount = $_SESSION['grandTotal'];
            $chkingvale_set = "SELECT * FROM coupons WHERE coup_name='$coupancode'";
            $queryvalset = $contdb->query($chkingvale_set);
            while($rowvalue = $queryvalset->fetch_array()){
                $get_onevale = $rowvalue['coup_noofuse'];
            }
            $noofadd = $get_onevale+1;

            $updatecoupan = "UPDATE coupons SET coup_noofuse='$noofadd' WHERE coup_name='$coupancode'";
            $updatevale = $contdb->query($updatecoupan);

            $insertcoupnasetos = "INSERT INTO use_coupons_details(us_coup_name,us_coup_amount,us_coup_userid,us_coup_totalamount)VALUES('$coupancode','$counpanvale','$get_cutomerid','$totalamount')";
            $qinsevale = $contdb->query($insertcoupnasetos);
        }
      $delectcartvval = "DELETE FROM cart_user WHERE cart_userid='$get_cutomerid'";
        $querycartdelet = $contdb->query($delectcartvval);
        unset($_SESSION["tax_amt"]);
        unset($_SESSION["shippingvale"]);
        unset($_SESSION["discount_amount"]);
        unset($_SESSION["shippingname"]);
        unset($_SESSION["grandTotal"]);
        unset($_SESSION["processPayment"]);
        unset($_SESSION["shppingto"]);
        unset($_SESSION['shippingShowAmt']);
        unset($_SESSION['othernotevalue']);
        if(isset($_SESSION['gust_customer'])){
            unset($_SESSION['gust_customer']);
            unset($_SESSION['login-guestchout']);
            $_SESSION['login-guest-user']="Guestvale";
        }
   
}// check customer session
?>
<style type="text/css">
    .thanorder{width: 100%; background: #f5f5f5; padding: 15px; box-sizing: border-box; box-shadow: 0px 0px 1px #333; display: block; float: left;}
    .thanorder h4{ color:#02506c; font-size: 20px; padding: 8px 15px;  text-align: center;}
    .thanorder > p{ text-align: center; }
    .thanorder > p > a{color:#015a7a; }
    .itemllist{ width: 100%; float: left; text-align: left; margin-top: 15px; border-top: 1px solid #ccc; }
    .itemllist li{ float: left; width:100%; text-align: left; padding: 15px 0px; border-bottom: 1px solid #ccc; }
    .itemllist li:last-child{border-bottom: 0px solid #ccc;}
    .itembox{width: 100%; display: block; float: left;}
    .itemtxt{ width: 80%; float: left;   }
    .itemtxt p a {font-weight:bold; color: #222; }
    .itemtxt div span{ color:#015a7a; }
    .itemimg{ float: left; width: 20%; }
    .itemimg a{ width: 100%; display: block; float: left; }
    .itemimg img{ width:100%; display: block; float: left;  }
    .buttonarea { float: left; width: 100%; display: block; text-align: center; margin-bottom: 5px;}
    .buttonarea a{ color: #fff; background: #015a7a; border-radius: 3px; padding: 12px 15px; text-align: center; display: block; }
    .buttonarea a:hover{opacity: .8;}
.note-box {
    display: inline-block;
    margin: 15px 0px;
    background: #f5f5f5;
    border-radius: 6px;
    border: 1px solid #dcdcdc;
    padding: 13px 11px;
}
.note-box h6 {
    text-align: center;
    margin-bottom: 10px;
    font-size: 20px;
    color: #02506c;
}
.note-box p {
    text-align: center;
    font-size: 15px;
}

.thanorder .itemllist{ margin: 0; padding: 0; }
.thanorder .itemllist li{list-style: none;}
</style>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Successful Order
            </div>
        </div>
    </div>
    <div class="page-content pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="content-section2">
                                <div class="thanorder">
                                    <h4>Thank you, your order has been placed.</h4>
                                    <p>Please check your email for order confirmation and delivery details.</p>
                                    <div class="buttonarea">
                                        <a href="<?php echo $url; ?>/">Continue Shopping</a>
                                    </div>
                                </div>
                                <div class="note-box">
                                    <h6>CANCELLATIONS</h6>
                                    <p>THERE IS A 4 HOUR CANCELLATION WINDOW AFTER PLACING YOUR ORDER. AFTER THIS 4 HOUR WINDOW YOUR ORDER WILL NO LONGER BE ELIGIBLE FOR CANCELLATION, BUT YOU MAY BE ELIGIBLE FOR A REFUND OR EXCHANGE ONCE YOU HAVE RECEIVED YOUR ORDER DEPENDING ON THE CREATORS’ INDIVIDUAL SHIPPING AND RETURNS POLICY. PLEASE EMAIL CANCELLATION REQUESTS TO info@buyjee.com OR CALL (IN) 822 196 4901.</p>
                                </div>
        
                               <!--  <div class="centerbox">
                                    <h4 style="text-align:center">Your Payment has been Successful.</h4>
                                    <div class="returnCustmr py-3 mb-4 pl-3" style="border-top: 2px solid #015a7a;background-color: #f7f6f7;">
                                        <table>
                                            <tr>
                                                <th>Product Name : </th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Product Amount : </th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Tracking id : </th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Transaction id : </th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Date : </th>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
