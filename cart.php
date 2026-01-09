<?php include 'includes/upper-header.php'; 
include 'includes/main-header.php';


$msg = "";
unset($_SESSION['tax_amt']);
?>
<style>
    input.decreaseQty, .qty-input, .increaseQty {
        float: left;
        padding: 0px;
        height: auto;
    }
    input.qty-input {
        text-align: center;
            margin: 0px 5px 0px 6px;
    }

    .detail-extralink .detail-qty {
            height: 70px !important;
    display: flex;
    align-items: center;
    margin: 0px;
    max-width:150px;
    }
    .qty-changer{
      display: flex !important;
      height: 29px !important;
      width: 79px;
    }
  .com-center{
    align-content: center;
    }
    .mb-123{
        padding: 15px;
        FONT-SIZE: 16px;
    }
    select#cartvaiation {
    width: 46px;
}
h4 strong {
    font-weight: 100;
    FONT-SIZE: 18px;
}
</style>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Cart
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h1 class="heading-2 mb-10">Your Cart</h1>
                </div>
            </div>
            <div class="row">
                <?php echo $msg; ?>
                <?php
                if(isset($_SESSION['customersessionlogin'])){
                    $custidvaleu = $_SESSION['customersessionlogin'];
                    $get_cartdata = "SELECT * FROM cart_user WHERE cart_userid='$custidvaleu' AND cart_status='0' ORDER BY id ASC";
                }else{
                    $customid = "";
                    $get_cartdata = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_userid='$customid' AND cart_status='0' ORDER BY id ASC";
                }
                $querycartdata = $contdb->query($get_cartdata);
                if($querycartdata->num_rows > 0){
                   
                ?>
                <div class="col-lg-8">
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2" class="start pl-30 text-center">Product</th>
                                    <th scope="col">Price</th>
                                <th scope="col">Attributes</th>
                                    <th scope="col">Quantity</th>
                                     
                                    <th scope="col" class="end">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                               // print_r($_SESSION["cart_item"]);
                                while($rowget_cart = $querycartdata->fetch_array()){
                                    $product_sizeval = $rowget_cart['cart_prdo_sizevalue'];
                                    $product_colorval = $rowget_cart['cart_prdo_colorvalue'];
                                    $salepriceinprod = $rowget_cart['cart_prdo_pricesale'];
                                    $regularpriceinprod = $rowget_cart['cart_prdo_pricereg'];
                                    $productautoid = $rowget_cart['cart_prdo_auto_id'];
                                    
                                 $productpricechk = "SELECT * FROM all_product WHERE product_auto_id='$productautoid'";
                                 $querychkingprc = $contdb->query($productpricechk);
                           
                                 if($querychkingprc->num_rows > 0){
                                 while($rowckingval = $querychkingprc->fetch_array()){
                                          
                                    //$regularpriceinprod = $rowckingval['product_regular_price'];
                                   // $salepriceinprod = $rowckingval['product_sale_price'];
                                    if(empty($salepriceinprod)){
                                        if($regularpriceinprod == $rowget_cart["cart_prdo_pricereg"]){
                                        }else{
                                            $updatepricecart = "UPDATE cart_user SET cart_prdo_pricereg='$regularpriceinprod' WHERE cart_prdo_auto_id='$productautoid'";
                                            echo "<script>location.reload(true);</script>";
                                        }
                                    }else{
                                        if($regularpriceinprod == $rowget_cart["cart_prdo_pricereg"] && $rowget_cart["cart_prdo_pricesale"] == $salepriceinprod){
                                        }else{
                                            $updatepricecart = "UPDATE cart_user SET cart_prdo_pricereg='$regularpriceinprod',cart_prdo_pricesale='$salepriceinprod' WHERE cart_prdo_auto_id='$productautoid'";
                                            echo "<script>location.reload(true);</script>";
                                        }
                                    }
                                    $queryupdateblnc = $contdb->query($updatepricecart);
                                 }
                                 }else{
                                     $deletepricecart = "DELETE FROM cart_user WHERE cart_prdo_auto_id='$productautoid'";
                                     $querydeleteblnc = $contdb->query($deletepricecart);
                                 }
                                
                                $regularPrice = $rowget_cart["cart_prdo_pricereg"];
                                $salePrice = $rowget_cart["cart_prdo_pricesale"];
                                if(empty($salePrice)){
                                    $finalPrice = $regularPrice;
                                }else{
                                    $finalPrice = $salePrice;
                                }
                                $get_product_auot_id = $rowget_cart["cart_prdo_auto_id"];
                                $item_price = $rowget_cart["cart_prdo_qutity"]*$finalPrice; ?>
                                <tr class="pt-30">
                                    <?php
                                        $get_product_url = "SELECT * FROM all_product WHERE product_auto_id='$get_product_auot_id'";
                                        $query_pro_url = $contdb->query($get_product_url);
                                        while($row_pro_url = $query_pro_url->fetch_array()){
                                            $get_product_url_name = $row_pro_url['product_page_name'];
                                    ?>
                                    <td class="image product-thumbnail pl-30"><a href="<?php echo $url; ?>/<?php echo $get_product_url_name; ?>"><img src="<?php echo $url; ?>/images/<?php echo $row_pro_url['product_image']; ?>" alt="Img"></a></td>
                                    <?php
                                        }
                                    ?>
                                    <td class="product-des product-name com-center">
                                        <h6 class="mb-5"><?php echo $rowget_cart['cart_prdo_name']; ?></h6>
                                    </td>
                                    <td class="price com-center" data-title="Price">
                                        <h4 class="text-body">₹<?php echo number_format($item_price, 2); ?></h4>
                                    </td>
                                 
                                          
                                                <td class="product-des product-name com-center">
                                                    <h4 class="mb-123"> <?php echo !empty($product_sizeval) ? '<strong>Size:</strong> ' . htmlspecialchars($product_sizeval, ENT_QUOTES, 'UTF-8') : ''; ?><br>
                                                <?php echo !empty($product_colorval) ? '<strong>Color:</strong> ' . htmlspecialchars($product_colorval, ENT_QUOTES, 'UTF-8') : ''; ?></h4>

                                                </td>
                                            
                                           
                                    <td class="text-center detail-info com-center" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <div class="item-qty qty-changer">
                                                        <input type="button" value="‒" pid="<?php echo $rowget_cart['id']; ?>" pqty="<?php echo $rowget_cart["cart_prdo_qutity"]; ?>" class="decreaseQty">
                                                        <input type="text" disabled class="qty-input" value="<?php echo $rowget_cart["cart_prdo_qutity"]; ?>" pid="<?php echo $rowget_cart['id']; ?>" data-min="0" data-max="5">
                                                        <input type="button" value="+" pid="<?php echo $rowget_cart['id']; ?>" class="increaseQty">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                         
                                    <td class="action text-center com-center" data-title="Remove"><a href="#remove" pid="<?php echo $rowget_cart['id']; ?>" class="icon icon-close-2 removeTocart text-body" id="removeadd" data-id="<?php echo $_SESSION['customersessionlogin']; ?>"><i class="fi-rs-trash"></i></a></td>
                                </tr>
                                <?php     
                                $total_quantity += $rowget_cart["cart_prdo_qutity"];
                               
                                $total_price += $item_price;
                                $_SESSION['subTotal'] = $total_price;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="cart-action d-flex justify-content-between">
                        <a class="btn" href='<?php echo $url; ?>'><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                    </div>
                    <div class="row mt-50">
                        <div class="col-lg-7">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span></p>
                                <form action="#">
                                    <?php
                                    if(isset($_SESSION['discount_amount'])){
                                    ?>
                                    <div class="d-flex justify-content-between">
                                        <input type="hidden" class="app-coupon" name="vcustomer" id="vcustomer" value="<?php echo $_SESSION['customersessionlogin']; ?>">
                                        <input class="font-medium mr-15 coupon app-coupon" name="coupon" placeholder="Enter Your Coupon" id="couponCode" value="<?php echo $_SESSION['discount_code']; ?>" required>
                                        <button class="btn apply-btn" type="submit" name="coupancode" id="subTotal" data-subTotal = "<?php echo $_SESSION['subTotal']; ?>"><i class="fi-rs-label mr-10"></i>Successfully Applied</button>
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="d-flex justify-content-between">
                                        <input type="hidden" class="app-coupon" name="vcustomer" id="vcustomer" value="<?php echo $_SESSION['customersessionlogin']; ?>">
                                        <input class="font-medium mr-15 coupon app-coupon" name="coupon" id="couponCode" placeholder="Coupon code" required>
                                        <button class="btn apply-btn" type="submit" name="coupancode" id="subTotal" data-subTotal = "<?php echo $_SESSION['subTotal']; ?>"><i class="fi-rs-label mr-10"></i>Apply Coupon</button>
                                    </div>
                                    <?php } ?>
                                    <span id="couponError" class="text-danger"></span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="border p-md-4 cart-totals ml-30">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <?php
                                if(isset($_SESSION['discount_amount'])){
                                    $gandtotal = number_format($_SESSION['subTotal'], 2);
                                    $subratamount = str_replace(',', '', $gandtotal)-$_SESSION['discount_amount'];
                                    //$_SESSION['grandTotal']=$subratamount;
                                ?>
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end total-amount">₹ <?php echo number_format($_SESSION['subTotal'], 2); ?></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Discount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end total-amount pric_reg">₹ <span id="subTotalCoupon"><?php echo number_format($_SESSION['discount_amount'], 2); ?></span></h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end total-amount pric_reg">₹ <span id="subTotalCoupon"><?php echo number_format($subratamount, 2); ?></span></h4>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                }else{
                                    $gandtotal = number_format($_SESSION['subTotal'], 2);
                                    //$_SESSION['grandTotal']=number_format($_SESSION['subTotal'], 2);
                                ?>
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end total-amount pric_reg">₹ <span id="subTotalCoupon"><?php echo $gandtotal; ?></span></h4>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <a href="<?php echo $url; ?>/checkout-login/" class="btn mb-20 w-100" id="lodwindvale">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                    </div>
                </div>
                <?php
                }else{
                ?>
                    <div class="cart-table text-center"><h2>Your Cart is Empty</h2></div>
                <?php
                }
                // new code uper
                ?>
            </div>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
$("#lodwindvale").click(function () {
  $("#loader").show();
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#loginaccount").hide();
    $(".loginaccount").click(function(){
        $("#loginaccount").show();
    });
    $(".newaccount").click(function(){
        $("#loginaccount").hide();
    });
});

$(document).ready(function(){
        $("body").delegate(".removeTocart", "click", function(event){
            event.preventDefault();
            var p_id = $(this).attr('pid');
            $.ajax({
                url : "<?php echo $url; ?>/action/",
                method : "POST",
                data : {removeTocart:1, proId:p_id},
                success : function(data){
                    let desc_data = data.substring(15); 
                if(desc_data == 0){
                        window.location.href='<?php echo $url; ?>/cart';
                    }
                }
            });
        });

        $("body").on("click", ".decreaseQty", function(event){
            event.preventDefault();
            var p_id = $(this).attr('pid');
            var qty = $(this).attr('pqty');
            
            if(qty > 1){
                $.ajax({
                    url : "<?php echo $url; ?>/action/",
                    method : "POST",
                    data : {decreaseQty:1, proId:p_id},
                    success : function(data){
                      let desc_data = data.substring(15); 
                        if(desc_data == 0){
                          //location.reload(true)
                           window.location.href='<?php echo $url; ?>/cart';
                        }
                    }
                }); 
            }else{
                return false;
            }
        });

    $("body").on("click", ".increaseQty", function(event){
            event.preventDefault();
            var p_id = $(this).attr('pid');
            $.ajax({
                url : "<?php echo $url; ?>/action/",
                type : "POST",
                data : {increaseQty:1, proId:p_id},
                success : function(data){
                    console.log(data);
                    //let newdata = data.substring(15); 
                   
                    if(data == 0){
                       alert("You can't add more quantity due to limitted stock.");
                      //  window.location.href='<?php echo $url; ?>/cart';
                    }else if(data == 1){
                        window.location.href='<?php echo $url; ?>/cart';
                    }
                }
            }); 
        });

        $("body").delegate(".qty-input", "keyup", function(event){
            event.preventDefault();
            var p_id = $(this).attr('pid');
            var p_qty = $(this).val();
            if(p_qty != ''){
                $.ajax({
                    url : "<?php echo $url; ?>/action/",
                    method : "POST",
                    data : {inputQty:1, proId:p_id, proQty:p_qty},
                    success : function(data){
                        if(data == 0){
                            alert("You can't add more quantity due to limitted stock.");
                            window.location.href='<?php echo $url; ?>/cart';
                        }else if(data == 1){
                            window.location.href='<?php echo $url; ?>/cart';
                        }
                    }
                });
            }
        });
        
       // FOR COUPON
$('.apply-btn').click(function(event){
    event.preventDefault();
    
    var couponCode = $('#couponCode').val();
    var subT = $('#subTotal').attr('data-subtotal');
  
    var vcustomer = $("#vcustomer").val();
    
    if(couponCode == ''){
        $('#couponError').text('Do Not leave blank.');
        $('#couponCode').focus();
        return false;
    }else{
        $.ajax({
            url : "<?php echo $url; ?>/action/",
            method : "POST",
            data : {couponCode:1, cCode:couponCode, subTotal:subT, vcusvale:vcustomer},
            success : function(response){
                console.log('Raw Response:', response);
                
                try {
                    // Remove the "Invalid request" prefix
                    let jsonData = response.replace(/^Invalid request/, '');
                    
                    console.log("Cleaned JSON data:", jsonData);
                    
                    let parsedData = JSON.parse(jsonData);
                    console.log("Parsed data:", parsedData);
                    
                    switch(parsedData.status) {
                        case 0:
                            $('#couponError').text('This Coupon code does not exist');
                            $('#couponCode').focus();
                            break;
                        case 1:
                              $('#couponError').text('Successfully Applied.');
                                $('#subTotalCoupon').text(parsedData.new_subtotal.toFixed(2));
                              setTimeout(() => {
                                window.location.href = '<?php echo $url; ?>/cart';
                            }, 1000);
                            break;
                        case 2:
                           $('#couponError').text('Successfully Applied.');
                                $('#subTotalCoupon').text(parsedData.discountAmount || parsedData.newTotal);
                               setTimeout(function(){
                                           window.location.reload();
                                        }, 1000);
                            break;
                        case 3:
                            $('#couponError').text('You have Already Use This Coupon..');
                            $('#couponCode').focus();
                          
                            break;
                         case 4:
                            $('#couponError').text('Coupon Date Expire	');
                            $('#couponCode').focus();
                          
                            break;
                    
                    
                    }
                } catch (error) {
                    console.error("Error parsing or processing data:", error);
                    //$('#couponError').text('An unexpected error occurred. Please try again.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
                $('#couponError').text('An error occurred while processing your request.');
            }
        }); 
    }
});


    });
$("#removeadd").click(function(){
    //alert(settoaddress);
    var customidval = $(this).data("id");
    $.ajax({
        type: "POST",
        url: "<?php echo $url; ?>/action/", 
        data : {removeshipto:1, custidshromve:customidval},
        success : function(response){
          //  alert('ok');
            window.location.href='<?php echo $url; ?>/cart';
        }        
    });
});


// hide msg
</script>