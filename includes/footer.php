<div id="page-loader" style="display: none;">
  <div class="spinner"></div>
</div>
</body>
<footer class="main">
        <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="position-relative newsletter-inner">
                            <div class="newsletter-content">
                                <h2 class="mb-20">
                                    Stay home & get your daily <br>
                                    needs from our shop
                                </h2>
                                <p class="mb-45">Start Your Daily Shopping with <span class="text-brand">Buyjee</span></p>
                                <form class="form-subcriber d-flex" role="form" method="post" action="">
                                    <input type="email" placeholder="Your emaill address" name="subemail" required>
                                    <button class="btn" type="submit" name="subemailbtn">Subscribe</button>
                                </form>
                            </div>
                            <img src="<?php echo $url; ?>/assetsnew/imgs/banner/banner-9.png" alt="newsletter">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="featured section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <div class="banner-icon">
                                <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-1.svg" alt="">
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Best prices & offers</h3>
                                <p>Orders ₹50 or more</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <div class="banner-icon">
                                <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-2.svg" alt="">
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Free delivery</h3>
                                <p>Amazing services</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            <div class="banner-icon">
                                <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-3.svg" alt="">
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Great daily deal</h3>
                                <p>When you sign up</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            <div class="banner-icon">
                                <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-4.svg" alt="">
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Wide assortment</h3>
                                <p>Mega Discounts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                            <div class="banner-icon">
                                <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-5.svg" alt="">
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Easy returns</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                        <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                            <div class="banner-icon">
                                <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-6.svg" alt="">
                            </div>
                            <div class="banner-text">
                                <h3 class="icon-box-title">Safe delivery</h3>
                                <p>Within 30 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                 
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <h4 class="widget-title">About Us</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <?php
                                foreach(Get_show_menuval("about-us") as $get_about){
                            ?>
                            <li><a href="<?php echo $get_about['menu_url']; ?>"><?php echo $get_about['menu_name']; ?></a></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <?php
                                foreach(Get_show_menuval("my-account") as $get_account){
                                    if(isset($_SESSION['customersessionlogin'])){
                                        if($get_account['menu_name'] == "Login"){
                                        }else{
                            ?>
                            <li><a href="<?php echo $get_account['menu_url']; ?>"><?php echo $get_account['menu_name']; ?></a></li>
                            <?php
                                }}else{
                            ?>
                            <li><a href="<?php echo $get_account['menu_url']; ?>"><?php echo $get_account['menu_name']; ?></a></li>
                            <?php
                                }}
                            ?>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <h4 class="widget-title">Contact Us</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <?php
                                foreach(Get_show_menuval("contact-us") as $get_countus){
                                    if(isset($_SESSION['customersessionlogin'])){
                                        if($get_countus['menu_name'] == "Vendor Inquiry"){
                                        }else{
                            ?>
                            <li><a href="<?php echo $get_countus['menu_url']; ?>"><?php echo $get_countus['menu_name']; ?></a></li>
                            <?php
                                }}else{
                            ?>
                            <li><a href="<?php echo $get_countus['menu_url']; ?>"><?php echo $get_countus['menu_name']; ?></a></li>
                            <?php
                                }}
                            ?>
                        </ul>
                    </div>
                    <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <?php
                            foreach(GLLFooterGetData() as $emallsubtin){
                             
                               $raw = $emallsubtin['footer_copyright'];
                                
                                // Remove last ]" if exists
    $clean = rtrim($raw, '"]');

    // Split by ",""," (middle empty string)
    $gllftemal_btn = explode('",""', $clean);
                        ?>
                            <?php echo $gllftemal_btn[0]; ?>
                        <?php } ?>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            
                            <li>
                                <form role="form" method="post" action="" class="form-inline">
                                    <input type="text" name="subemail" placeholder="Email address" class="mb-10" required>
                                    <button type="submit" name="subemailbtn">Send</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
        </div></section>
        <?php
            foreach(GLLFooterGetData() as $gllfooter){
                 //$gllfooter_btn = $gllfooter['footer_copyright']; 
    $raw = $gllfooter['footer_copyright'];

    // Remove last ]" if exists
    $clean = rtrim($raw, '"]');

    // Split by ",""," (middle empty string)
    $gllfooter_btn = explode('",""', $clean);

                
        ?>
        <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; <?php echo $gllfooter_btn[1]; ?></p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="hotline d-lg-inline-flex">
                      
                        <?php
                        foreach(GLLHederGetsection() as $phoneshow){
                            $phonenum = json_decode($phoneshow['head_numberbox']);
                        ?>
                               <p class="text-center">
                        <a href="https://api.whatsapp.com/send?phone=91<?php echo $phonenum[0]; ?>&text=Hi" target="_blank">
                        <img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/whatsapp-new27x27.png" alt="hotline" id="whatapp"><?php echo $phonenum[0]; ?></a></p>
                       
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6>Follow Us</h6>
                        <?php
                        foreach(GLLHederGetsection() as $socilicon){
                            $socialicon = json_decode($socilicon['head_socialicon']);
                        ?>
                        <?php
                            if($socialicon[0] != ""){
                        ?>
                            <a href="<?php echo $socialicon[0]; ?>" target="_blank"><img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-facebook-white.svg" alt=""></a>
                        <?php } ?>
                        <?php
                            if($socialicon[1] != ""){
                        ?>
                        <a href="<?php echo $socialicon[1]; ?>" target="_blank"><img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-twitter-white.svg" alt=""></a>
                        <?php } ?>
                        <?php
                            if($socialicon[2] != ""){
                        ?>
                        <a href="<?php echo $socialicon[2]; ?>" target="_blank"><img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-linkdin-white.png" alt=""></a>
                        <?php } ?>
                        <?php
                            if($socialicon[3] != ""){
                        ?>
                        <a href="<?php echo $socialicon[3]; ?>" target="_blank"><img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-youtube-white.svg" alt=""></a>
                        <?php } ?>
                        <?php
                            if($socialicon[4] != ""){
                        ?>
                        <a href="<?php echo $socialicon[4]; ?>" target="_blank"><img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-instagram-white.svg" alt=""></a>
                        <?php } ?>
                        <?php
                            if($socialicon[5] != ""){
                        ?>
                        <a href="https://api.whatsapp.com/send?phone=91<?php echo $socialicon[5]; ?>" target="_blank"><img src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-whatapp-white.png" alt=""></a>
                        <?php } ?>
                        <?php } ?>
                      
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="<?php echo $url; ?>/images/1347020945.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->

    <!-- Vendor JS-->
    <script src="<?php echo $url; ?>/assetsnew/js/vendor/modernizr-3.6.0.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/vendor/jquery-3.6.0.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/vendor/jquery-migrate-3.3.0.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/vendor/bootstrap.bundle.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/slick.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/jquery.syotimer.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/waypoints.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/wow.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/perfect-scrollbar.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/magnific-popup.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/select2.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/counterup.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/jquery.countdown.min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/images-loaded.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/isotope.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/scrollup.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/jquery.vticker-min.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/plugins/jquery.theia.sticky.js<?php echo $varsetval; ?>"></script>
   <script src="<?php echo $url; ?>/assetsnew/js/plugins/jquery.elevatezoom.js<?php echo $varsetval; ?>"></script>


    <!-- Template  JS -->
    <script src="<?php echo $url; ?>/assetsnew/js/main.js<?php echo $varsetval; ?>"></script>
    <script src="<?php echo $url; ?>/assetsnew/js/shop.js<?php echo $varsetval; ?>"></script>
    <script type="text/javascript">
    // fancy box
$(".btn-gallery").on('click', function() {

  $.fancybox.open([{
    src : $(this).attr("vlt"),
  },<?php echo substr($array_jsoncode, 0, -1); ?>],{
    loop    : false,
  arrows  : true,
  infobar : true,
  margin  : [44,0,22,0],
  buttons : [
    // 'arrowLeft',
    // 'counter',
    // 'arrowRight',
    'close'
  ],
  thumbs : {
    autoStart : true,
    axis : 'y'
  }
    // hash : "btn-gallery"
  });
});
/*$().fancybox({
  selector : '.item a:visible',
});*/
/*single product page price*/
 /* $(document).ready(function () {
    $(document).on('change', '.sizeattbut', function () {
    
        var variationId = $(this).val(); 
     
        if (variationId != '0') {
            $.ajax({
                url : "<?php echo $url; ?>/action", 
                method: 'GET',
                data: {
                    variation_id: variationId
                },
                 success: function (response) {
                     //alert('hello');
                    console.log("Server Response:", response);  
                    var responseParts = response.split('|');
                    if (responseParts[0] === 'Success') {
                        var regularPrice = responseParts[1].replace('Regular Price: ', '');
                        var SalePrice = responseParts[2].replace('Sale Price: ', '');
                         salePrice = SalePrice.replace(/[^0-9.-]+/g, '');
                        
                        // Display the prices
                        $('#singleo_price').html(regularPrice);
                        $('#singlep_price').html('₹'+salePrice);
                    } else {
                    
                        $('#size-msg').text(responseParts[1]);
                    }
                },
                 error: function (xhr, status, error) {
                   
                    console.error("AJAX Error: ", error);
                    $('#size-msg').text('Error fetching price');
                }
            });
        } else {
            $('#size-msg').text('Select a size to see the price');
        }
    });
});*/

$(document).ready(function () {
  
    $(".sizeattbut").change(function () {
       var get_val = [];
        $.each(document.getElementsByName('fillterval[]'), function () {
            get_val.push($(this).val());
        });
       var dataId = $(".item-stock.sizeattbut").attr("data-id");
          /* console.log("Data-ID:", dataId);
           console.log("variation:",get_val);*/
        if (jQuery.inArray("0", get_val) === -1) {
         
            $.ajax({
               url : "<?php echo $url; ?>/action", 
                type: "GET",
                data: { variation_id: get_val ,data_id:dataId}, 
               // dataType: "json", 
               success: function (response) {
                    console.log("Server Response:", response);  
                    if (typeof response === "string") {
                        response = JSON.parse(response);
                    }
                
                    if (response.status === "success" && response.prices.length > 0) { 
                        var priceData = response.prices[0]; 
              
                     var regularPrice = parseInt(priceData.regular_price.replace(/,/g, ''), 10);
                        var salePrice = priceData.sale_price;
                        var v_quantity = priceData.quantity;
                        salePrice = salePrice.replace(/[^0-9.]+/g, '');
                        $('#singleo_price').html(regularPrice);
                        $('#singlep_price').html('₹' + salePrice);
                          // **Update the Quantity Dropdown Dynamically**
                        updateQuantityDropdown(v_quantity);
                        
                         // **Calculate and update discount percentage**
                        updateDiscount(regularPrice, salePrice);
                    } else {
                        $('#size-msg').text('Error retrieving price');
                    }
                },
                
                error: function (xhr, status, error) {
                    console.error("AJAX Error: " + error);
                }
            });
        }
    });
    
     // **Function to Update the Quantity Dropdown**
    function updateQuantityDropdown(maxQuantity) {
        var $quantityDropdown = $("#pdqunity");
        $quantityDropdown.empty(); // Clear existing options

        for (var x = 1; x <= maxQuantity; x++) {
            var optionText = "Quantity: " + x;
            var selected = x === 1 ? " selected" : ""; // Default select first option
            $quantityDropdown.append("<option value='" + x + "'" + selected + ">" + optionText + "</option>");
        }
    }
    
      // **Function to Calculate and Update Discount**
    function updateDiscount(regularPrice, salePrice) {

        if (regularPrice > salePrice) {
            var discount = ((regularPrice - salePrice) / regularPrice) * 100;
            discount = Math.round(discount); // Round off the discount percentage
            
            $(".pro_dis").text(discount + "% OFF"); // Update discount text
        } else {
            $(".pro_dis").text(""); // Remove discount if no discount applies
        }
    } 
});
</script>

<script type="text/javascript">

  $(document).ready(function () {
    $(document).on('change', '#vvariation', function () {
    
        var variationId = $(this).val(); 
       
        if (variationId != '0') {
            $.ajax({
                url : "<?php echo $url; ?>/action", 
                method: 'GET',
                data: {
                    variation_id: variationId
                },
                 success: function (response) {
                    
                    console.log("Server Response:", response);  
                    var responseParts = response.split('|');
                    if (responseParts[0] === 'Success') {
                        var regularPrice = responseParts[1].replace('Regular Price: ', '');
                        var SalePrice = responseParts[2].replace('Sale Price: ', '');
                         salePrice = SalePrice.replace(/[^0-9.-]+/g, '');
                        
                        // Display the prices
                        $('.old-price').html(regularPrice);
                        $('#p_price').html('₹'+salePrice);
                    } else {
                    
                        $('#size-msg').text(responseParts[1]);
                    }
                },
                 error: function (xhr, status, error) {
                   
                    console.error("AJAX Error: ", error);
                    $('#size-msg').text('Error fetching price');
                }
            });
        } else {
            $('#size-msg').text('Select a size to see the price');
        }
    });
});


</script>

<script type="text/javascript">
$(document).ready(function(){
    $("body").delegate(".addToCart", "click", function(event){
      
    event.preventDefault();
    var p_id = $(this).attr('pid');
    var p_quntiy = $("#pdqunity").val();
    var p_price = $("#p_price").data("id");
    
        var get_val = [];
        $.each(document.getElementsByName('fillterval[]'), function(){
            get_val.push($(this).val());
        });
        if(jQuery.inArray("0", get_val) !== -1){
            alert('Select options first.');
        }else{
          var prodtsize = $("#sizeattbut").val();
          var prodtcolor = $("#colorattbut").val();
          //alert(p_id);
          $.ajax({
              url : "<?php echo $url; ?>/action/",
              method : "POST",
              data : {addToCart:1, proId:p_id, productvert:get_val, Productqunity:p_quntiy, productpric:p_price},
              success : function(data){
                  console.log(data);
                  //alert(data);
                  if(data == 0){
                      alert("Successfully added to cart.");
                      window.location.reload();
                  }else if(data == 1){
                    alert("Successfully added to cart.");
                      window.location.reload();
                  }
              }
          });
        }
    });
});

var _affirm_config = { 
    public_api_key: /* Replace with your Affirm Public API Key */ "IXUH742ZGVLBDE5G", /* Replace with your Affirm Public API Key */
    script: "https://cdn1.affirm.com/js/v2/affirm.js",
    session_id: "<?php echo uniqid(); ?>"
  };
  (function(l,g,m,e,a,f,b){var d,c=l[m]||{},h=document.createElement(f),n=document.getElementsByTagName(f)[0],k=function(a,b,c){return function(){a[b]._.push([c,arguments])}};c[e]=k(c,e,"set");d=c[e];c[a]={};c[a]._=[];d._=[];c[a][b]=k(c,a,b);a=0;for(b="set add save post open empty reset on off trigger ready setProduct".split(" ");a<b.length;a++)d[b[a]]=k(c,e,b[a]);a=0;for(b=["get","token","url","items"];a<b.length;a++)d[b[a]]=function(){};h.async=!0;h.src=g[f];n.parentNode.insertBefore(h,n);delete g[f];d(g);l[m]=c})(window,_affirm_config,"affirm","checkout","ui","script","ready");
// END AFFIRM.JS EMBED CODE

$("input[name='priceval']").click(function(){
    var get_filterval = $(this).val();
    if (get_filterval) { // require a URL
      window.location = "?q="+get_filterval; // redirect
  }
  return false;
});

$("input[name='search_priceval']").click(function(){
    var get_filterval = $(this).val();
    var get_filtename = $("#search_pagename").val();
    if (get_filterval) { // require a URL
      window.location = get_filtename+"&price="+get_filterval; // redirect
  }
  return false;
});

$('.moreless-button').click(function() {
  $('.moretext').slideToggle();
  if ($('.moreless-button').text() == "Read More") {
    $(this).text("Read Less")
  } else {
    $(this).text("Read More")
  }
});
</script>
<script>
$("body").delegate(".adtoLike", "click", function(event){
   
    event.preventDefault();
    var p_id = $(this).data('id');
    
    $.ajax({
      url : "<?php echo $url; ?>/action/",
      method : "POST",
      data : {addTowhislt:1, proId:p_id},
      success : function(data){
          console.log(data);
          //alert(data);
         // if(data == 0){
              alert("Successfully added to wishlist.");
              window.location.reload(true);
        //  }
      }
  });
});

/*Notify me code if product out of stock****/ 
$("body").delegate(".notifyme", "click", function(event){
   
    event.preventDefault();
    var p_id = $(this).attr('pid');
     var button = $(this);
    $.ajax({
      url : "<?php echo $url; ?>/action/",
      method : "POST",
      data : {addnotifyme:1, proId:p_id},
      success : function(data){
          /*console.log(data);
          alert(data);*/
          if(data == 0){
             alert("Thankyou We will notify you when this product is back in stock");
          }else{
              alert("Thankyou We will notify you when this product is back in stock");
          }
      }
  });
});




$("body").delegate(".removewhislist", "click", function(event){
    event.preventDefault();
    var whsidelid = $(this).data('id');
    $.ajax({
        url : "<?php echo $url; ?>/action/",
        method : "POST",
        data : {removeTowhislt:1, proIdwhis:whsidelid},
        success : function(data){
            //console.log(data);
             alert("Successfully deleted.");
            window.location.reload();
            // if(data.trim() == 0){
            //     alert("Successfully deleted.");
            //     window.location.reload();
            // }
        }
    });
});

</script>

<script type="text/javascript">
    $(".hideshow").hide();
    $(document).on("change", ".price-sorting", function() {

    var sortingMethod = $(this).val();

    $(".product").show();
    $(".page_navigation").hide();
    $(".hideshow").show();
    if(sortingMethod == 'l2h')
    {
      
        sortProductsPriceAscending();
    }
    else if(sortingMethod == 'h2l')
    {
     
        sortProductsPriceDescending();
    }else if(sortingMethod == '0')
    {
        window.location.reload();
    }

});
function sortProductsPriceAscending()
{
    var products = $('.product');
    products.sort(function(a, b){ return $(a).data("price")-$(b).data("price")});
    $(".products-grid").html(products);
    /*$(".products-grid").attr("id", "paginate");*/
}

function sortProductsPriceDescending()
{
    var products = $('.product');
    products.sort(function(a, b){ return $(b).data("price") - $(a).data("price")});
    $(".products-grid").html(products);
    /*$(".products-grid").attr("id", "paginate");*/
}

/*$("input[name='priceval']").click(function(){
    var getvale_min = $("input[name='priceval']:checked").attr("data-min");
    var getvale_max = $("input[name='priceval']:checked").attr("data-max");
    var get_prodct = $(".product").attr("data-price");
    alert(get_prodct);

});*/

makePager = function(page){
    var show_per_page = 36;
    var number_of_items = $('#paginate li').length;
    var number_of_pages = Math.ceil(number_of_items / show_per_page);
    var number_of_pages_todisplay = 3;
    var navigation_html = '';
    var current_page = page;
    if(number_of_items < 72){
        var lastnoofpage = number_of_pages;
    }else{
        var lastnoofpage = number_of_pages;
    }
    var getlastthreeage = number_of_pages - 3;
    var getlastfourage = number_of_pages - 4;
    var getlasttwoage = number_of_pages - 2;
    var lasttwormove = number_of_pages - 1;
    var current_link = (number_of_pages_todisplay >= current_page ? 1 : number_of_pages_todisplay + 1);
    if (current_page > 1)
        current_link = current_page;
    if (current_link != 1){
        navigation_html += "<a onclick='topFunction()' class='nextbutton' href=\"javascript:previous();\"><i class='fa fa-arrow-left'></i>&nbsp;</a>&nbsp;";
    }else{
        if (lasttwormove == "0" || lasttwormove == "-1"){
        }else{
            navigation_html += "<a class='cusernot' href=\"javascript:(0);\"><i class='fa fa-arrow-left'></i>&nbsp;</a>&nbsp;";
        }
    }
    if(current_link > '4'){
        navigation_html += "<a class='mobilehide dottet'>...</a>&nbsp;";
        if(current_link > lastnoofpage){
            navigation_html += "<a onclick='topFunction()' class='mobilehide numericButton' href=\"javascript:showPage('1');\">1</a>&nbsp;";
        }
    }
    if(getlasttwoage == "0"){}else{
        if(lasttwormove == current_link){
            navigation_html += "<a onclick='topFunction()' class='mobilehide numericButton " + lasttwormove + "' href=\"javascript:showPage('"+ getlasttwoage +"');\">"+ getlasttwoage +"</a>&nbsp;";
        }
    }
    if (current_link == number_of_pages - 1) current_link = current_link;
    else if (current_link == number_of_pages) current_link = current_link - 2;
    else if (current_link > 1) current_link = current_link - 1;
    else current_link = 1;
    var pages = number_of_pages_todisplay;
    while (pages != 0) {
        if (number_of_pages < current_link) { break; }
        if (current_link >= 1)
            if(number_of_pages > 1){
                navigation_html += "<a onclick='topFunction()' class='mobilehide " + ((current_link == current_page) ? "currentPageButton" : "numericButton") + "' href=\"javascript:showPage(" + current_link + ")\" longdesc='" + current_link + "'>" + (current_link) + "</a>&nbsp;";
            }
        current_link++;
        pages--;
    }
    /*if(getlastthreeage > current_page){
        if(getlastfourage > current_page){
            navigation_html += "<a class='nextbutton' href=\"javascript:last(" + getlastfourage + ");\">" + (getlastfourage) + "</a>&nbsp;";
        }
    }*/
    if(getlastthreeage > current_page){
        navigation_html += "<a class='mobilehide dottet'>...</a>&nbsp;";
    }
    if (lastnoofpage > current_page){
        navigation_html += "<a onclick='topFunction()' class='nextbutton' href=\"javascript:next()\"><i class='fa fa-arrow-right'></i></a>&nbsp;";
    }else{
        if (lasttwormove == "0" || lasttwormove == "-1"){
        }else{
            navigation_html += "<a class='cusernot' href=\"javascript:(0);\"><i class='fa fa-arrow-right'></i>&nbsp;</a>&nbsp;";
        }
    }
            $('.page_navigation').html(navigation_html);
}

var pageSize = 36;
showPage = function (page) {
    $("#paginate li").hide();
    $('.current_page').val(page);
    $("#paginate li").each(function (n) {
        if (n >= pageSize * (page - 1) && n < pageSize * page)
            $(this).show();
    });
makePager(page);
}
showPage(1);
next = function () {
    new_page = parseInt($('.current_page').val()) + 1;
    showPage(new_page);
}
last = function (number_of_pages) {
    new_page = number_of_pages;
    $('.current_page').val(new_page);
    showPage(new_page);
}
first = function () {
    var new_page = "1";
    $('.current_page').val(new_page);
    showPage(new_page);    
}
previous = function () {
    new_page = parseInt($('.current_page').val()) - 1;
    $('.current_page').val(new_page);
    showPage(new_page);
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
/*$(".page_navigation a").click(function(){
  $("body").click("#showpup");
});*/
$("#ship-different-add").click(function(){
    if ($("#ship-different-add").is(":checked")) {
        $("#different-address").addClass("dif-form-none");
    }else{
        $("#different-address").removeAttr("checked");
        $("#different-address").removeClass("dif-form-none");
    }
});

$("#lodwind").click(function(){
    var get_toname = $("#diff-fname").val();
    var get_tolname = $("#diff-lname").val();
    var get_toaddress = $("#diff-address").val();
    var get_tocity = $("#diff-city").val();
    var get_tocountry = $("#diff-country").val();
    var get_tostate = $("#newCstatetoadd").val();
    var get_tosatecode = $("#shpptocoe").val();
    var get_topincode = $("#diff-pcode").val();
    var get_tophone = $("#diff-phone").val();
    var get_toemail = $("#diff-email").val();

    $.ajax({
        url : "<?php echo $url; ?>/action/",
        method : "POST",
        data : {shptoaddrs:1, toname:get_toname, tolname:get_tolname, toaddess:get_toaddress, tocity:get_tocity, tocountry:get_tocountry, tostate:get_tostate, tostacode:get_tosatecode, topincode:get_topincode, tophone:get_tophone, toemail:get_toemail},
        success : function(data){
            console.log(data);
            //alert(data);
            if(data == 0){
                window.location.href='<?php echo $url; ?>/checkout/';
            }
        }
    });
});
</script>

<script type="text/javascript">
/*Product details page */
$(document).ready(function(){
    $("body").delegate(".adtoCartSingle", "click", function(event){
    
        event.preventDefault();
       
        var p_id = $(this).attr('pid');

          var p_quantity = $("#pdqunity").val() ? $("#pdqunity").val() : "1";
          var selectedVAttribut = $(".sizeattbut").map(function() {
    return $(this).val(); // Get each selected value
}).get(); // Convert to a normal JavaScript array

console.log("Selected Values:", selectedVAttribut);
           var oldd_price = $("#singleo_price").text();
           var old_price = oldd_price.replace(/,/g, '').replace(/\.00/, '').replace('₹', '');
          var p_price = $("#singlep_price").text();
          var selling_price = p_price.replace('₹', '').trim();
      
        $.ajax({
            url : "<?php echo $url; ?>/action/",
            method : "POST",
            data : {
                adtoCartSingle: '1', 
                proId: p_id,
                quityval: p_quantity,
                sizeattbut: selectedVAttribut,
                mrp_price:old_price,
                salePrice: selling_price
            },
            success : function(data){
          /* alert(data);
                console.log(data);*/
                if(data == 0){
                    alert("Successfully added to cart");
                    window.location.reload();
                } else if(data == 11){
                   
                    alert("Already added to cart.");
                   // window.location.reload();
                  
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    });
});


$(document).ready(function(){
    $("body").delegate(".adtoCartMainSingle", "click", function(event){
        event.preventDefault();
        var p_id = $(this).attr('pid');
          var p_quantity = $("#pdqunity").val() ? $("#pdqunity").val() : "1";
        
        $.ajax({
            url : "<?php echo $url; ?>/action/",
            method : "POST",
            data : {
                adtoCartMainSingle: '1', 
                proId: p_id,
                quityval: p_quantity
            },
            success : function(data){
                console.log(data);
                if(data == 0){
                    alert("Successfully added to cart");
                    window.location.reload();
                } else if(data == 1){
                   
                    alert("Already added to cart.");
                   // window.location.reload();
                  
                }
            },
            error: function(xhr, status, error) {
                console.error("An error occurred: " + error);
            }
        });
    });
});
/*Cart page variations*/
  $(document).ready(function () {
    $(document).on('change', '#cartvaiation', function () {
    
        var variationId = $(this).val(); 
       
        if (variationId != '0') {
            $.ajax({
                url : "<?php echo $url; ?>/action", 
                method: 'GET',
                data: {
                    variation_id: variationId
                },
                 success: function (response) {
                     //alert('hello');
                    console.log("Server Response:", response);  
                    var responseParts = response.split('|');
                    if (responseParts[0] === 'Success') {
                        var regularPrice = responseParts[1].replace('Regular Price: ', '');
                        var SalePrice = responseParts[2].replace('Sale Price: ', '');
                         salePrice = SalePrice.replace(/[^0-9.-]+/g, '');
                        
                        // Display the prices
                        $('.old-price').html(regularPrice);
                        $('.text-body').html('₹'+salePrice);
                    } else {
                    
                        $('#size-msg').text(responseParts[1]);
                    }
                },
                 error: function (xhr, status, error) {
                   
                    console.error("AJAX Error: ", error);
                    $('#size-msg').text('Error fetching price');
                }
            });
        } else {
            $('#size-msg').text('Select a size to see the price');
        }
    });
});
/**************menu js****************/

$(document).on('select2:select', function (e) {
    setTimeout(function () {
        $('#search').focus();
    }, 100); // Delay to ensure select2 updates first
});


/*********************Single Product page review section***********/

$(document).ready(function() {
    let selectedRating = 0; 

    
    $('.star').on('click', function() {
        selectedRating = $(this).data('value');
        $('.star').removeClass('selected');
        $(this).prevAll().addBack().addClass('selected');
    });

   
    $('#reviewForm').submit(function(e) {
        e.preventDefault();

        let product_id = $('input[name="product_id"]').val();
        let review_text = $('textarea[name="review_text"]').val();

        if (selectedRating === 0) {
            alert("Please select a star rating.");
            return;
        }

        $.ajax({
           url : "<?php echo $url; ?>/action", 
            type: 'POST',
            data: {
                 product_id : product_id,
                rating: selectedRating,
                review_text: review_text
            },
           success: function (response) {
               loadReviews(); 
                if (response.trim() === '0') {
                    window.location.href = "login.php"; // Redirect to login page
                } else {
                    $('#reviewForm')[0].reset(); 
                    selectedRating = 0; 
                    $('.star').removeClass('selected'); 
                }
              
            }
          
        });
    });

    // Function to load reviews dynamically
   function loadReviews() {
       let productid = $('input[name="product_id"]').val();
    
        $.ajax({
            url: '<?php echo $url; ?>/action',
            type: 'GET',
            data: { product_id: productid },
            success: function(data) {
              if ($.trim(data) === '') { // Check if response is empty
            $('#reviews').html('<p>No reviews available.</p>');
        } else {
            $('#reviews').html(data);
        }
            }
            
        });
    }

   loadReviews(); // Load reviews on page load
});

</script>

<!--
<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-messaging.js";

const firebaseConfig = {
  apiKey: "AIzaSyDD-nadMgzQafMraYob4ETn956_9EbHB9Q",
  authDomain: "buyjee-ba483.firebaseapp.com",
  projectId: "buyjee-ba483",
  storageBucket: "buyjee-ba483.appspot.com",
  messagingSenderId: "733579014702",
  appId: "1:733579014702:web:bb3362b9a79c33938065bf",
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

async function saveCustomerToken() {
  let customer_id = localStorage.getItem("customer_id");

  console.log("Customer ID:", customer_id);

  if (!customer_id) {
    console.warn("⚠ No customer_id found in localStorage — token will not be saved");
    return;
  }

  const permission = await Notification.requestPermission();
  console.log("Notification Permission:", permission);

  if (permission !== "granted") {
    alert("Notification permission denied");
    return;
  }

  try {
    const token = await getToken(messaging, {
      vapidKey: "BFF_uLCjw0CaWUmGj3_nduSiQxJjdeAR6ix_KldFOMneLo5Epli3a4XWbiFWQyRsAdXzOT4uSRpYoVu9xBh36MM"
    });

    console.log("FCM Token:", token);
    alert("Generated Token:\n" + token);

    if (!token) {
      alert("⚠ Token not generated");
      return;
    }

    $.post("<?php echo $url; ?>/save_token.php", {
      customer_id: customer_id,
      fcm_token: token
    })
    .done(function (res) {
      console.log("Server Response:", res);
      alert("Token Saved Successfully");
    })
    .fail(function (err) {
      console.error("Error Saving Token:", err);
      alert("Error: Token not saved");
    });

  } catch (error) {
    console.error("FCM Error:", error);
    alert("Error while generating token");
  }
}


saveCustomerToken();
</script>
-->

</html>
