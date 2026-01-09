 <!------------- Seo Part ----------------->

<?php
$pageamseo = isset($_GET['datatbid']) ? $_GET['datatbid'] : "home-page";

// Initialize default meta data
$title = "Buyjee - Shop Quality and Shop Luxury";
$description = "Find exquisite products carefully selected from independent brands, designers, and artists.";
$keywords = "";
$canonical = $url;
$robots = "index, follow";
$ogType = "product";
$ogImage = "<?php $url ?>/images/1347020945.jpg";
$ogDescription = $description;

// Check for SEO data
$seodata = [];
if (!empty($pageamseo)) {
    $seodata = get_seotitlekeywords($pageamseo);
}

if (!empty($seodata) && $seodata['seo_title'] != "") {
    $title = $seodata['seo_title'];
    $description = $seodata['seo_desrpt'];
    $keywords = $seodata['seo_keyword'];
    $robots = ($seodata['seo_indexing'] === "No") ? "noindex, nofollow" : "index, follow";
    $canonical = ($pageamseo === "home-page") ? $canonical : "$canonical/$pageamseo";
    $ogImage = "$url/images/" . $seodata['seo_imageval'];
    $ogDescription = $description;
} else {
    // Check for product SEO data
    $productseo = $contdb->query("SELECT * FROM all_product WHERE product_page_name='$pageamseo' AND product_status='1'");

    if ($productseo->num_rows > 0) {
        $row = $productseo->fetch_assoc();
        $title = $row['product_name'];
        $description = $row['product_short_des'];
        $canonical = "$url/$pageamseo";
        $ogImage = "$url/images/" . $row['product_image'];
        $ogDescription = $description;
    }
}

// Output Meta Tags
?>
<title><?php echo htmlspecialchars($title, ENT_QUOTES); ?></title>
<meta name="description" content="<?php echo htmlspecialchars($description, ENT_QUOTES); ?>">
<meta name="keywords" content="<?php echo htmlspecialchars($keywords, ENT_QUOTES); ?>">
<link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
<meta name="robots" content="<?php echo htmlspecialchars($robots, ENT_QUOTES); ?>">
<meta name="twitter:card" value="summary">
<meta property="og:type" content="<?php echo htmlspecialchars($ogType, ENT_QUOTES); ?>">
<meta property="og:title" content="<?php echo htmlspecialchars($title, ENT_QUOTES); ?>">
<meta property="og:url" content="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
<meta property="og:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
<meta property="og:description" content="<?php echo htmlspecialchars($ogDescription, ENT_QUOTES); ?>">

<style>
.product-cart-wrap {
    height:460px !important;
    margin-top: 25px;
}

</style>

</head>
<body>
    
<?php

if(isset($_SESSION['customersessionlogin'])){

  $cutmervale = $_SESSION['customersessionlogin'];
  $update_datafiled = "whis_customerd='$cutmervale'";
  $_getupdateid = "whis_ip='$ip'";
  $get_whishlist = UpdateAllDataFileds("wishlistbl_table",$update_datafiled,$_getupdateid);
}
?>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <?php
                          foreach(GLLHederGetsection() as $logoset){
                            if($logoset['head_logo'] == "" && $logoset['head_logo'] == "0"){}else{
                        ?>
                        <a href="<?php echo $url; ?>/">
                          <img src="<?php echo $url; ?>/images/<?php echo $logoset['head_logo']; ?>" alt="Logo">

                        </a>
                        <?php
                            }
                          }
                        ?>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            <form class="searchbox-top" role="form" method="post" enctype="mutlipart/form-data" action="">
                                <select class="select-active">
                                    <option>All Categories</option>
                                    <?php $validCategories = hasProductsInCategory();
                                           categoryTree("0", 0, '', $validCategories); ?>
                                </select>
                              <input id="search" tabindex="0" type="search" placeholder="Search" autocomplete="off" autofocus="" name="mainsearch" class="search-box" required=""> 
                              </form>
                        </div>
                      
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                        <a href=<?php $url ?>"/vendor-inquiry/"><span class="lable">Become a Seller</span></a>
                        </div>
                                <div class="header-action-icon-2">
                                    <?php
                                     
                                      if(isset($_SESSION['customersessionlogin'])){
                                          $cutomervale = $_SESSION['customersessionlogin'];
                                      }else{
                                          $cutomervale = "";
                                      }
                                      $get_count = []; 
                                      foreach(GetWhisListData($cutomervale) as $valueset){
                                         
                                        $get_count[] = $valueset['whis_prd_id'];
                                      }
                                    
                                      $rray_countvl = count($get_count);
                                  
                                    ?>
                                    <a href="<?php echo $url; ?>/wishlist/">
                                        <img class="svgInject" alt="Buyjee" src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-heart.svg">
                                       <?php  if($rray_countvl != 0){ ?>  <span class="pro-count blue"><?php echo $rray_countvl; ?></span>      <?php   } ?>
                                    </a>
                                  
                                    <a href="<?php echo $url; ?>/wishlist/"><span class="lable">Wishlist</span></a>
                            
                                </div>
                                <div class="header-action-icon-2">
                                    <?php
                                       $get_qunityvale = [];
                                      if(isset($_SESSION['customersessionlogin'])){
                                          $customercountval = $_SESSION['customersessionlogin'];
                                          $cart_value = "SELECT * FROM cart_user WHERE cart_userid='$customercountval' AND cart_status='0' AND cart_user_browser='$brower'";
                                      }else{
                                          $customercountval = "";
                                         $cart_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_status='0' AND cart_userid='$customercountval'";
                                      }
                                      
                                      $fecth_cvalue = $contdb->query($cart_value);
                                   
                                    
                                          while ($row_getprodocunt = $fecth_cvalue->fetch_array()) {
                                              
                                              $get_qunityvale[] = $row_getprodocunt['cart_prdo_name'];
                                          }
                                          $get_count_cart = count($get_qunityvale);
                                   
                                      ?>
                                    <a class="mini-cart-icon" href="<?php echo $url; ?>/cart/">
                                        <img alt="Buyjee" src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-cart.svg">
                                      <?php  if($get_count_cart != 0){ ?>  <span class="pro-count blue"><?php echo $get_count_cart; ?></span><?php   } ?>
                                    </a>
                                    <a href="<?php echo $url; ?>/cart/"><span class="lable">Cart</span></a>
                                </div>
                             <div class="header-action-icon-2">
                            <a href="#">
                                <img class="svgInject" alt="Buyjee" src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-user.svg">
                            </a>
                        
                            <?php 
                                $is_logged_in = false;
                             //  echo'<pre>'; print_r($_SESSION); die;
                                if (isset($_SESSION['adminsessionlogin'])) {
                                    $display_name = "Admin";
                                    $dashboard_link = "$url/admin-manager/index/";
                                    $logout_link = "$url/admin-manager/logout/";
                                    $is_logged_in = true;
                                } elseif (isset($_SESSION['vendorsessionlogin'])) {
                                    foreach (GetVenderDatavale($_SESSION['vendorsessionlogin']) as $datavale) {
                                        $display_name = $datavale['vendor_f_name'];
                                    }
                                    $dashboard_link = "$url/vendor/dashboard/";
                                    $logout_link = "$url/vendor/logout/";
                                    $is_logged_in = true;
                                }
                                 elseif (isset($_SESSION['subvendorsessionlogin'])) {
                                    foreach (GetSubVenderDatavale($_SESSION['subvendorsessionlogin']) as $datasubvale) {
                                        
                                        $display_name = $datasubvale['subvendor_fname'];
                                    }
                                    $dashboard_link = "$url/subvendor/index/";
                                    $logout_link = "$url/subvendor/logout/";
                                    $is_logged_in = true;
                                }
                                elseif (isset($_SESSION['customersessionlogin'])) {
                                    $customer_data = GetCustomerDataVal($_SESSION['customersessionlogin']);
                                    if (!empty($customer_data)) {
                                        foreach ($customer_data as $get_cutsmename) {
                                            $display_name = $get_cutsmename['customer_fname'];
                                        }
                                    } else {
                                        $display_name = "My Account";
                                    }
                                    $dashboard_link = "$url/customer/dashboard/";
                                    $logout_link = "$url/customer/logout/";
                                    $is_logged_in = true;
                                } else {
                                    $display_name = "Login / Sign up";
                                    $dashboard_link = "$url/login/";
                                }
                            ?>
                        
                           <div class="user-info ">
                                        <a href="<?php echo $dashboard_link; ?>" class="user-name">
                                            <?php if ($is_logged_in): ?>
                                                Hello, <?php echo ucfirst(htmlspecialchars($display_name)); ?>
                                                <i class="fa fa-angle-down mini-cart-icon" style="margin-left: 5px;"></i>
                                            <?php else: ?>
                                                <?php echo $display_name; ?>
                                            <?php endif; ?>
                                        </a>
                                    
                                <?php if ($is_logged_in): ?>
                                    <div class="logout-hover-box">
                                        <a href="<?php echo $logout_link; ?>"><span>Logout</span></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                                
                                 <div class="hotline d-none d-lg-flex">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <?php
                          foreach(GLLHederGetsection() as $logoset){
                            if($logoset['head_logo'] == "" && $logoset['head_logo'] == "0"){}else{
                        ?>
                        <a href="<?php echo $url; ?>">
                          <img src="<?php echo $url; ?>/images/<?php echo $logoset['head_logo']; ?>" alt="Logo">

                        </a>
                        <?php
                            }
                          }
                        ?>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">                                                                                                                                                                                                                                                                                                                                   
                            <nav>
                           <ul class="menu">
       
                                    <?php
                                        $contact ='contact.php';
                                        foreach(Get_show_menuval("header") as $heradrval){
                                            
                                            $chkingcatagoymenu = "SELECT * FROM product_categories WHERE prd_cat_slug='".$heradrval['menu_url']."'";
                                            $qiueryckingval = $contdb->query($chkingcatagoymenu);
                                            if($qiueryckingval->num_rows > 0){
                                              $menuHtml = GetFirstFaceMneuCat($heradrval['menu_url']);
                            
                                    // Safely check if the menu contains valid links
                                    if (strpos($menuHtml, '<a') !== false) {
                                        echo $menuHtml; 
                                    }                                        
                                         }elseif ($heradrval['menu_url'] == 'contact-us') {
                                               echo '<li>
                                                    <a href='.$url.'/'.$contact.'>Contact Us</a>
                                                </li>';
                                            }
                                              else{
                                                echo '<li  class=="menu-item">
                                                    <a href='.$url.'/'.$heradrval['menu_url'].'>'.$heradrval['menu_name'].'</a>
                                                </li>';
                                            }
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                    
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                    <?php
                                     
                                      if(isset($_SESSION['customersessionlogin'])){
                                          $cutomervale = $_SESSION['customersessionlogin'];
                                      }else{
                                          $cutomervale = "";
                                      }
                                      $get_count = []; 
                                      foreach(GetWhisListData($cutomervale) as $valueset){
                                         
                                        $get_count[] = $valueset['whis_prd_id'];
                                      }
                                    
                                      $rray_countvl = count($get_count);
                                  
                                    ?>
                                    <a href="<?php echo $url; ?>/wishlist/">
                                        <img class="svgInject" alt="Buyjee" src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-heart.svg">
                                       <?php  if($rray_countvl != 0){ ?>  <span class="pro-count blue"><?php echo $rray_countvl; ?></span>      <?php   } ?>
                                    </a>
                                  
                                    <a href="<?php echo $url; ?>/wishlist/"><span class="lable">Wishlist</span></a>
                            
                                </div>
                                <div class="header-action-icon-2">
                                    <?php
                                       $get_qunityvale = [];
                                      if(isset($_SESSION['customersessionlogin'])){
                                          $customercountval = $_SESSION['customersessionlogin'];
                                          $cart_value = "SELECT * FROM cart_user WHERE cart_userid='$customercountval' AND cart_status='0' AND cart_user_browser='$brower'";
                                      }else{
                                          $customercountval = "";
                                         $cart_value = "SELECT * FROM cart_user WHERE cart_user_ip='$ip' AND cart_status='0' AND cart_userid='$customercountval'";
                                      }
                                      
                                      $fecth_cvalue = $contdb->query($cart_value);
                                   
                                    
                                          while ($row_getprodocunt = $fecth_cvalue->fetch_array()) {
                                              
                                              $get_qunityvale[] = $row_getprodocunt['cart_prdo_name'];
                                          }
                                          $get_count_cart = count($get_qunityvale);
                                   
                                      ?>
                                    <a class="mini-cart-icon" href="<?php echo $url; ?>/cart/">
                                        <img alt="Buyjee" src="<?php echo $url; ?>/assetsnew/imgs/theme/icons/icon-cart.svg">
                                      <?php  if($get_count_cart != 0){ ?>  <span class="pro-count blue"><?php echo $get_count_cart; ?></span><?php   } ?>
                                    </a>
                                    <a href="<?php echo $url; ?>/cart/"><span class="lable">Cart</span></a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <?php
                      foreach(GLLHederGetsection() as $logoset){
                        if($logoset['head_logo'] == "" && $logoset['head_logo'] == "0"){}else{
                    ?>
                    <a href="<?php echo $url; ?>/">
                      <img src="<?php echo $url; ?>/images/<?php echo $logoset['head_logo']; ?>" alt="Logo">

                    </a>
                    <?php
                        }
                      }
                    ?>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form class="searchbox-top" role="form" method="post" enctype="mutlipart/form-data" action="">
                        <input id="search" tabindex="0" type="search" placeholder="Search" autocomplete="off" autofocus="" name="mainsearch" class="search-box" required="">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <?php
                                $contact ='contact.php';
                                        foreach(Get_show_menuval("header") as $heradrval){
                                            
                                            if ($heradrval['menu_url'] == 'contact-us') {
                                               echo '<li>
                                                    <a href='.$url.'/'.$contact.'>Contact Us</a>
                                                </li>';
                                            }
                                              else{
                                                echo '<li  class=="menu-item">
                                                    <a href='.$url.'/'.$heradrval['menu_url'].'>'.$heradrval['menu_name'].'</a>
                                                </li>';
                                            }
                                        }
                            ?>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                     <div class="user-info">
                        <?php if ($is_logged_in): ?>
                            <a href="<?php echo $logout_link; ?>" class="logout-btn">
                                Logout
                            </a>
                        <?php else: ?>
                            <a href="<?php echo $dashboard_link; ?>" class="login-btn">
                                Login
                            </a>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="mobile-social-icon mb-10 mt-50">
                    <h6 class="mb-15">Follow Us</h6>
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
    <!--End header-->
    

  