<?php


foreach(GetProductDataValTab("0","0",$get_page_name) as $productdetils){

}
$get_url = explode('?',$_SERVER[REQUEST_URI]);

$url_makeexplod = explode('=', $get_url[1]);
if($url_makeexplod[0] == "selection"){
    $explode_vale = str_replace('-', ',', $url_makeexplod[1]);
    $final_attbuid = $explode_vale;

}else{
    $final_attbuid = "0";

}

$productvaleset = $productdetils['product_size'];


if($productvaleset == ""){
    $productvale = $productdetils['product_auto_id'];
}else{
    $checking_datavale = "SELECT * FROM product_attbut_vartarry WHERE prot_trm_prodtid='$productvaleset'";
    $queryvalest = $contdb->query($checking_datavale);
    if($queryvalest->num_rows > 0){
        $productvale = $productdetils['product_size'];
    }else{
        $productvale = $productdetils['product_auto_id'];
    }
}
$arraycountpd = explode(',', $productvale);
foreach($arraycountpd as $stockcountarray){
    $get_hold_idtotle = "SELECT * FROM product_active_attbut WHERE attbut_productid='$stockcountarray'";
    $queryarrayset = $contdb->query($get_hold_idtotle);
    if($queryarrayset->num_rows > 0){
        $makevertionval[] = $productvale;
    }else{
        $makevertionval[] = $productdetils['product_size'];
    }
}
$unql_val = array_unique($makevertionval);
$implodevaertion = implode('', $unql_val);


/*===== Most View Products =====*/
mostviewproductsdatvale($productdetils['product_auto_id'],$get_page_name);


/*Review code*/
$products = getProductReviews($contdb,$productvale);

?>
<style>
    .variations {
    width: 62%;
    }   
.zoomLens {
    width: 300px !important;
    height: 300px !important;
}
.product-discount {
       position: absolute;
    margin-left: 2%;
    color: rgba(0,168,207,255);
    font-size: 20px;
    font-weight: 700;
    letter-spacing: .5px;
    margin-top: -10px;
}
.discont-pri{
      color: rgba(0,168,207,255);
}
 
        .price-header {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: left;
            color:#000;
        }
        .compiti-header {
            list-style-type: none;
            padding: 0;
            margin-left : 20px;
        }
        .compit-price {
            align-items: center;
            padding: 10px 0;
             margin-right: 25px;
            font-weight: bold;
        }
        .amz-compit{
                font-weight: bold;
                color: #000;
                margin-right: 14px;
        }
        li:last-child {
            border-bottom: none;
        }
        a {
            text-decoration: none;
           
            font-weight: bold;
        }
      
        a:hover {
            text-decoration: underline;
        }
        .dis-saless{
    color: #cc0c39 !important;
    font-weight: 300 !important;
    font-size: 25px;
    white-space: pre-wrap;
        }
</style>
<?php include 'includes/main-header.php'; ?>
<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <?php echo $productdetils['product_name']; ?>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="<?php echo $url; ?>/images/<?php echo $productdetils['product_image']; ?>" alt="product image">
                                        </figure>
                                        <?php
                                            foreach(GetProductSmallImage($productdetils['product_auto_id']) as $multiimages){
                                            $pdname = $multiimages['produt_img'];
                                            $arrayvale[] = array("src" => "$url/images/$pdname","opts" => array("thumb" => "$url/images/$pdname"));
                                            /*print_r($arrayvale);*/
                                        ?>
                                        <figure class="border-radius-10">
                                            <img src="<?php echo $url; ?>/images/<?php echo $multiimages['produt_img']; ?>" alt="product image">
                                        </figure>
                                        <?php
                                            }
                                            $array_jsoncode = substr(json_encode($arrayvale), 1);
                                        ?>
                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                        <div><img src="<?php echo $url; ?>/images/<?php echo $productdetils['product_image']; ?>" alt="product image"></div>
                                        <?php
                                            foreach(GetProductSmallImage($productdetils['product_auto_id']) as $multiimages){
                                            $pdname = $multiimages['produt_img'];
                                            $arrayvale[] = array("src" => "$url/images/$pdname","opts" => array("thumb" => "$url/images/$pdname"));
                                            /*print_r($arrayvale);*/
                                        ?>
                                        <div><img src="<?php echo $url; ?>/images/<?php echo $multiimages['produt_img']; ?>" alt="product image"></div>
                                        <?php
                                            }
                                            $array_jsoncode = substr(json_encode($arrayvale), 1);
                                        ?>
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">
                                    <?php
                                    	if($productdetils['product_regular_price'] == "0" || $productdetils['product_regular_price'] == ""){
                                            if($final_attbuid == "0"){
                                                StockProdutVertionval($productvale);
                                               
                                            }else{
                                                StockProdutVertionval($productvale,$final_attbuid);
                                                
                                            }
                                    	}else{
                                    		if($productdetils['product_stock'] == 0 && $productdetils['is_breakable'] == 0){
                                    		echo "<span class='stock-status out-stock'>Out Of Stock</span>";
                                                echo '<input type="hidden" id="stokqunt" value="'.$productdetils['product_stock'].'">';
                                    		}elseif($productdetils['product_stock'] ==  0  &&  $productdetils['is_breakable'] == 1){
                                              echo "<span class='stock-status in-stock'>In Stock</span>";
                                            }else{
                                    			echo "<span class='stock-status in-stock'>In Stock</span>";
                                                echo '<input type="hidden" id="stokqunt" value="'.$productdetils['product_stock'].'">';
                                    		}
                                    	}
                                    ?>
                                    <h2 class="title-detail"><?php echo $productdetils['product_name']; ?></h2>
                               <?php  if (!empty($products)): 
                                    foreach ($products as $review): ?>
                                        <div>
                                            <p class="Review-star">
                                                <?= getStarRating($review['avg_rating']) ?>  
                                                (<?= number_format($review['avg_rating'], 1) ?> / 5, <?= $review['total_reviews'] ?> reviews)
                                            </p>
                                        </div>
                                    <?php endforeach; 
                                else: ?>
                             
                                <?php endif; ?>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <?php
                                            if($productdetils['product_regular_price'] == "0" || $productdetils['product_regular_price'] == ""){
                                              
                                                if($final_attbuid == "0"){
                                                   echo SingleProductPagePrice($productvale);
                                               
                                                }else{
                                                     
                                                   echo SingleProductPagePrice($productvale,$final_attbuid);
                                                     
                                                }
                                            }else{
                                                $ddiscountt = GetProductDiscountPriceVal($productdetils['product_auto_id']); 
                                            $cleaned = str_replace("OFF", "", $ddiscountt);
                                            $finalDis = preg_replace('/<strong>(\d+%)/', '- $1', $cleaned);
                                            
                                            echo '<span class="dis-saless">' . $finalDis . '</span>'.
                                             GetProductSinglePriceVal($productdetils['product_auto_id']);
                                            
                                                    }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="short-desc mb-30">
                                        <p class="font-lg" id="product-price"><?php echo $productdetils['product_short_des']; ?></p>
                                    </div>
                                    <!--variation-->
                                    <?php
                                    
                                 //   $implodevaertion;
                                    if($productdetils['product_regular_price'] == "0" || $productdetils['product_regular_price'] == ""){
                                    
                                        if($final_attbuid == "0"){
                                          
                                            echo VertionsSetSinglePD($implodevaertion);
                                        }else{
                                        
                                          echo  VertionsSetSinglePD($implodevaertion,$final_attbuid);
                                        }
                                    }else{
                                      
                                              echo  VertionsSetSinglePD($productdetils['product_auto_id']);
                                            }
                                    
                                    ?>
                                    <div class="detail-extralink mb-10">
                                           <?php if (!empty($productdetils['product_stock']) && $productdetils['product_stock'] > 0) { ?>
                                        <div class="detail-qty border radius seletionsingle">
                                        
                                            <select class="qtyValue input-text qty qty-val" id="pdqunity">
                                                <?php
                                                    if($productdetils['product_stock']){
                                                        $prodcutstok = $productdetils['product_stock'];
                                                    }
                                                  
                                                    for ($x = 1; $x <= $prodcutstok; $x++) {
                                                        $optionText = "Quantity: " . (string)$x; // Append "Quantity: " to each option
                                                        echo "<option  value='$x'" . ($x == 1 ? " selected" : "") . ">$optionText</option>";
                                                    }
                                                ?>
                                            </select>
                                           
                                        </div>
                                         <?php } ?>
                                   <div class="product-extra-link2">
                                            <?php
                                            if (!isset($_SESSION["customersessionlogin"])) {
                                               // User is not logged in
                                                $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
                                                if ($productdetils['product_stock'] == 0 && $productdetils['is_breakable'] == 0) {
                                                    // Product is out of stock
                                                    echo '<button class="button alt notifymme button-add-to-cart" onclick="window.location.href=\'/login.php\'"
                                                            data-id="' . $productdetils['id'] . '" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Notify me">
                                                            <i class="fa fa-bell"></i> Notify Me
                                                          </button><a href="/login.php" class="login-required hover-up" title="Add to Wishlist">
                                                            <i class="fi-rs-heart"></i>
                                                          </a>';
                                                } 
                                                elseif ($productdetils['product_stock'] == 0  &&  $productdetils['is_breakable'] == 1) {
                                                            echo '
                                                            <button class="button alt adtoCartSingle button-add-to-cart login-required hover-up"
                                                                    data-bs-toggle="tooltip"
                                                                    title="This Product is only available in store"
                                                                    
                                                                    style="cursor:not-allowed;">
                                                                <i class="fa fa-shopping-basket"></i> Visit To Store
                                                            </button> <a href="/login.php" class="login-required hover-up" title="Add to Wishlist">
                                                            <i class="fi-rs-heart"></i>
                                                          </a>';
                                                        }
                                              elseif ($productdetils['is_breakable'] == 1) {
                                                            echo '
                                                            <button class="button alt adtoCartSingle button-add-to-cart login-required hover-up"
                                                                    data-bs-toggle="tooltip"
                                                                    title="This Product is only available in store"
                                                                    style="cursor:not-allowed;">
                                                                <i class="fa fa-shopping-basket"></i> Visit To Store
                                                            </button> <a href="/login.php" class="login-required hover-up" title="Add to Wishlist">
                                                            <i class="fi-rs-heart"></i>
                                                          </a>';
                                                        }
                                                else {
                                                    // Product is in stock
                                                    echo '<button class="button alt adtoCartSingle button-add-to-cart" 
                                                            onclick="window.location.href=\'/login.php\'" 
                                                            title="Add to Cart">
                                                            <i class="fi-rs-shopping-cart"></i> Add to Cart
                                                          </button>
                                                          <a href="/login.php" class="login-required hover-up" title="Add to Wishlist">
                                                            <i class="fi-rs-heart"></i>
                                                          </a>';
                                                }

                                            }else { 

                                            if($productdetils['product_regular_price'] == 0 || empty($productdetils['product_regular_price'])){
                                                if($final_attbuid == "0"){
                                                    AddToCartButtonSet($productvale,$productdetils['product_auto_id'],0,$get_page_name);
                                                }else{
                                                    AddToCartButtonSet($productvale,$productdetils['product_auto_id'],$final_attbuid,$get_page_name);
                                                }
                                            }else{
                                               $singlepdid = $productdetils['product_auto_id'];
                                                $get_cart_val_singl = "SELECT * FROM cart_user WHERE cart_prdo_auto_id='$singlepdid' AND cart_user_ip='$ip'";
                                                $get_valsetset_sing = $contdb->query($get_cart_val_singl);
                                                
                                                if ($get_valsetset_sing->num_rows > 0) {
                                                    if (empty($productdetils['product_stock'])) {
                                                      
                                                        echo '<button class="button alt adtoCartSingle alredyadd button-add-to-cart" 
                                                                pid="' . $productdetils['id'] . '" 
                                                                onclick="return gtag_report_conversion(\'' . $url . '/' . $get_page_name . '\')" 
                                                                data-bs-toggle="tooltip" 
                                                                title="Already in cart">
                                                                <i class="fi-rs-shopping-cart"></i> Add to Cart
                                                              </button>';
                                                    } elseif ($productdetils['product_stock'] == 0) {
                                                        
                                                    } else {
                                                        echo '<button class="button alt adtoCartSingle alredyadd button-add-to-cart" 
                                                                pid="' . $productdetils['id'] . '" 
                                                                onclick="return gtag_report_conversion(\'' . $url . '/' . $get_page_name . '\')" 
                                                                data-bs-toggle="tooltip" 
                                                                title="Already in cart">
                                                                <i class="fi-rs-shopping-cart"></i> Add to Cart
                                                              </button>';
                                                    }
                                                } else {
                                                    if ($productdetils['product_stock'] == 0 && $productdetils['is_breakable'] == 0) {
                                                        echo '<button class="button alt notifyme button-add-to-cart" 
                                                                pid="' . $productdetils['id'] . '" 
                                                                
                                                                data-bs-toggle="tooltip" 
                                                                title="notify me">
                                                                <i class="fa fa-bell"></i>Notify Me
                                                              </button>';
                                                    } elseif ($productdetils['product_stock'] == 0  &&  $productdetils['is_breakable'] == 1)  {
                                                       echo '<button class="button alt adtoCartSingle button-add-to-cart login-required hover-up"
                                                                    data-bs-toggle="tooltip" title="This Product is only available in store"
                                                                    style="cursor:not-allowed;">
                                                                <i class="fa fa-shopping-basket"></i>Visit To Store
                                                            </button>';
                                                    }
                                                    elseif ($productdetils['is_breakable'] == 1) {
                                                                 echo ' <button class="button alt adtoCartSingle button-add-to-cart login-required hover-up"
                                                                    data-bs-toggle="tooltip"
                                                                    title="This Product is only available in store"
                                                                    style="cursor:not-allowed;">
                                                                <i class="fa fa-shopping-basket"></i>Visit To Store
                                                            </button>';
                                                    }else {
                                                        echo '<button class="button alt adtoCartSingle button-add-to-cart" 
                                                                pid="' . $productdetils['id'] . '" 
                                                                onclick="return gtag_report_conversion(\'' . $url . '/' . $get_page_name . '\')" 
                                                                data-bs-toggle="tooltip" 
                                                                title="Add to Cart">
                                                                <i class="fi-rs-shopping-cart"></i> Add to Cart
                                                              </button>';
                                                    }
                                                }

                                            }
                                            ?>
                                           <?php
                                            $singlepdidwish = $productdetils['product_auto_id'];
                                            if (isset($_SESSION['customersessionlogin'])) {
                                                $cutomerid = $_SESSION['customersessionlogin'];
                                                $selt_btnvale_whis = "SELECT * FROM wishlistbl_table WHERE whis_prd_id='$singlepdidwish' AND whis_customerd='$cutomerid'";
                                                $query_valeuset = $contdb->query($selt_btnvale_whis);

                                                if ($query_valeuset->num_rows > 0) {
                                                    // Product is already in the wishlist
                                                    echo '<a class="action-btn already-wishlist hover-up" data-bs-toggle="tooltip" title="Already in wish list" data-id="' . $singlepdidwish . '">
                                                              <i class="fi-rs-heart"></i>
                                                          </a>';
                                                } else {
                                                    // Product is not in the wishlist
                                                    echo '<a class="action-btn adtoLike hover-up" data-bs-toggle="tooltip" title="Add to Wishlist" data-id="' . $singlepdidwish . '">
                                                              <i class="fi-rs-heart"></i>
                                                          </a>';
                                                }
                                            } }
                                            ?>
 
                                        </div>
                                    </div>
                                    <div class="font-xs">
                                        <ul class="mr-50 float-start">
                                            <li class="mb-5">SKU: <span class="text-brand"><?php echo $productdetils['product_sku']; ?></span></li>
                                            <li class="mb-5">Category:
                                            <?php 
                                            foreach(explode(',', $productdetils['product_catger_ids']) as $ids_vale){
                                                foreach(getCatagrioyesDataVal($ids_vale,11) as $get_catgoyval){
                                                    $valuesetdat[] = "<span class='text-brand ml-5'><a href='$url/".$get_catgoyval['prd_cat_main_url']."/' rel='".$get_catgoyval['prd_cat_name']."'>".$get_catgoyval['prd_cat_name']."</a></span>";
                                                }
                                            }
                                            echo $imploevale = implode(', ', $valuesetdat);
                                                /*$get_explodeva = substr($productdetils['product_catger'], 0, -1);
                                                foreach(explode(',', $get_explodeva) as $catgoryval){
                                                    $valuedat[] = $catgoryval.', ';
                                                }
                                                echo $valuedtval = substr(implode('', $valuedat), 0, -2);*/
                                            ?>
                                            </li>
                                            <?php
                                            foreach(GetVenderDatavale($productdetils['product_vender_id']) as $vensorname){
                                            ?>
                                             <li class="mb-5">Products by: <a href='<?php echo $url; ?>/<?php echo $vensorname['vendor_uni_name']; ?>'><span class="in-stock text-brand ml-5"><?php echo $vensorname['vendor_company']; ?></span></a></li>
                                           
                                            <?php } ?>
                                            <li>Shipped from: <span class="in-stock text-brand ml-5"><?php echo $vensorname['vendor_country']; ?></span></li>
                                        </ul>
                                        <!--<ul class="float-start">
                                        <li>Share</li>
                                        <li><a href="mailto:?subject=<?php echo $productdetils['product_name']; ?>&body=I want to purchase <?php echo $url; ?>/<?php echo $get_page_name; ?>"><i class="fa fa-envelope-o"></i></a></li>
                                        <li><a href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>/<?php echo $get_page_name; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>/<?php echo $get_page_name; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url; ?>/<?php echo $get_page_name; ?>&title=<?php echo $productdetils['product_name']; ?>&summary=<?php echo $productdetils['product_short_des']; ?>&source=LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://www.instagram.com/sharer.php?u=<?php echo $url; ?>/<?php echo $get_page_name; ?>" target="_blank"><i class="fa fa-instagram "></i></a></li>
                                        </ul>-->
                                    </div>
                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Product Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">About Creator</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Shipping and Returns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <?php echo $productdetils['product_destion']; ?>
                                    </div>
                                    <div class="tab-pane fade" id="Additional-info">
                                        <?php 
                                      		foreach(GetAboutVendor($productdetils['product_vender_id'],"vendor") as $aboutval){
                                      			echo $aboutval['about_content']; 
                                      		}
                                  		?>
                                    </div>
                                    <div class="tab-pane fade" id="Vendor-info">
                                        <?php 
                                      		foreach(GetShppingTreamValue($productdetils['product_vender_id'],"vendor") as $trimhppin){
                                      			echo $trimhppin['terms']; 
                                      		}
                                  		?>
                                    </div>
                                      <div class="tab-pane fade" id="Reviews">
                                           <div id="reviews"></div>
                                       <form id="reviewForm" class="reviewsection">
                                        <input type="hidden" name="product_id" value="<?php echo $productdetils['product_auto_id']?>">
                                        <div id="starRating" class="mb-2">
                                            <span class="star" data-value="1">★</span>
                                            <span class="star" data-value="2">★</span>
                                            <span class="star" data-value="3">★</span>
                                            <span class="star" data-value="4">★</span>
                                            <span class="star" data-value="5">★</span>
                                        </div>
                                        <textarea name="review_text" placeholder="Write your review..." required></textarea>
                                        <button type="submit" class="mt-2 ms-2 btn-pp">Submit</button> 
                                    </form>
                                   
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h2 class="section-title style-1 mb-30">Related products</h2>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    <?php
                                        foreach(RelatedProductSinglepd($productdetils['product_recomateprd'],$productdetils['product_vender_id']) as $recommend){
                                    ?>
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap hover-up" style='height:470px !important;margin-top: 25px;'>
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="<?php echo $url; ?>/<?php echo $recommend['product_page_name']; ?>" tabindex="0" target="_blank">
                                                        <img class="default-img" src="<?php echo $url; ?>/images/<?php echo $recommend['product_image']; ?>" alt="">
                                                        <?php
                                                            foreach(GetProductSmallImage($recommend['product_auto_id'],1) as $multiimagesval){
                                                                echo "<img class='hover-img' src='$url/images/".$multiimagesval['produt_img']."' alt='Product'>";
                                                            }
                                                        ?>
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <?php
                                                        if(isset($_SESSION['customersessionlogin'])){
                                                            echo GetAddtoWishList($recommend['product_auto_id'],$_SESSION['customersessionlogin']);
                                                        }else{
                                                           echo GetAddtoWishList($recommend['product_auto_id']);
                                                        }
                                                    ?>
                                                    <?php 
                                                    if($recommend['is_breakable'] == 1){
                                                        GetBreackbleButton($recommend['product_auto_id']);
                                                    }
                                                    else{
                                                    echo GetAddtocartButton($recommend['product_auto_id']); } ?>
                                                </div>
                                                 <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale discont-pri"><?php echo GetProductDiscountPriceVal($recommend['product_auto_id']) ?></span>
                                        </div>
                                        
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="<?php echo $url; ?>/<?php echo $recommend['product_page_name']; ?>" tabindex="0" target="_blank"><?php echo $recommend['product_name']; ?></a></h2>
                                                <?php 
                                              $relatedproductid= $recommend['product_auto_id'];
                                                $relatedproduct = getProductReviews($contdb,$relatedproductid);
                                                
                                                if (!empty($relatedproduct)): 
                                    foreach ($relatedproduct as $review): ?>
                                        <div>
                                            <p class="Review-star">
                                                <?= getStarRating($review['avg_rating']) ?>
                                            </p>
                                        </div>
                                    <?php endforeach; 
                                else: ?>
                             
                                <?php endif; ?>
                                <div class='product-card-bottom'>
                                                <div class="product-price">
                                                      <span class="saless"><?php  $ddiscountt = GetProductDiscountPriceVal($recommend['product_auto_id']); 
                                              
                                            $cleaned = str_replace("OFF", "", $ddiscountt);
                                            echo $finalDis = preg_replace('/<strong>(\d+%)/', '- $1', $cleaned);
                                               ?></span>
                                                    <?php
                                                        echo GetProductPriceVal($recommend['product_auto_id']);
                                                    ?>
                                                </div>
                                                 <div class="add-cart">
                                                     
                                            <?php 
                                             if ($recommend['is_breakable'] == 1) {
                                                
                                                echo '<div style="cursor: not-allowed;">
                                                        <span class="add adtoCartMainSingle" data-toggle="tooltip" data-placement="top" title="This Product is only available in store">
                                                                <i class="fa fa-shopping-basket"></i>
                                                           
                                                        </span>
                                                      </div>';
                                            }
                                            else{
                                            
                                            echo GetAddtocartButton($recommend['product_auto_id']); }?>
                                        </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
  