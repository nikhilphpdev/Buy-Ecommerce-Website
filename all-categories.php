<?php include 'includes/upper-header.php'; ?>
<?php include 'includes/main-header.php';?>

<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo $url; ?>/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span>All Categories
                </div>
            </div>
        </div>
        <div class="page-content pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 m-auto">
                        <!--<div class="single-header style-2 text-center">-->
                        <!--    <h2>Industry Products</h2>-->
                        <!--</div>-->
                   <div class="inner-catgy">
    <?php
    global $contdb, $url;
    $categoryIdsWithProducts = hasProductsInCategory(); 
    foreach(ProductCatagroyShow() as $allcatgory){
        $explodevideos = json_decode($allcatgory['prd_cat_imagevale']);
        if (!empty($explodevideos[0]) && $allcatgory['prd_cat_name'] != "All" && $allcatgory['prd_cat_prent_categ'] == 0) {
            $arraygetallcat[] = $allcatgory['id'];
        }
    }

    if (!empty($arraygetallcat)) {
        foreach($arraygetallcat as $allcatgorynew){
            $selectqueryval = "SELECT * FROM product_categories WHERE id='$allcatgorynew'";
            $querygetvael = $contdb->query($selectqueryval);

            while($rowgaetids = $querygetvael->fetch_array()){
                $explodevideos = json_decode($rowgaetids['prd_cat_imagevale']);
                if (!empty($explodevideos[0]) && $rowgaetids['prd_cat_hidevale'] == 1) {
                    echo "<div class='mainsinglcat'><h3>".$rowgaetids['prd_cat_name']."</h3></div>";  
                    echo '<a href="'.$url.'/'.$rowgaetids['prd_cat_main_url'].'">
                            <div class="single-deign">
                                <img src="'.$url.'/images/'.$explodevideos[0].'"/>
                                <p>'.$rowgaetids['prd_cat_name'].'</p>
                            </div>
                        </a>';
                }
            }

            // Get child categories
            $getallcatey = "SELECT * FROM product_categories WHERE prd_cat_prent_categ='$allcatgorynew'";
            $qyueryval = $contdb->query($getallcatey);
            $allnewsubcat = [];

            while($rowvalew = $qyueryval->fetch_array()){
                $explodevideos = json_decode($rowvalew['prd_cat_imagevale']);
                if (!empty($explodevideos[0]) && $rowvalew['prd_cat_hidevale'] == 1 && in_array($rowvalew['id'], $categoryIdsWithProducts)) {
                    echo '<a href="'.$url.'/'.$rowvalew['prd_cat_main_url'].'">
                            <div class="single-deign">
                                <img src="'.$url.'/images/'.$explodevideos[0].'"/>
                                <p>'.$rowvalew['prd_cat_name'].'</p>
                            </div>
                        </a>';
                    $allnewsubcat[] = $rowvalew['id'];
                }
            }

            // Now sub-sub-categories
            if (!empty($allnewsubcat)) {
                foreach($allnewsubcat as $newidscval){
                    $selectqueryvael = "SELECT * FROM product_categories WHERE id='$newidscval'";
                    $querycvaelset = $contdb->query($selectqueryvael);

                    while($rowvaelnewsub = $querycvaelset->fetch_array()){
                        echo "<div class='mainsinglcat'><h5>".$rowvaelnewsub['prd_cat_name']."</h5></div>";
                    }

                    $getallcatey = "SELECT * FROM product_categories WHERE prd_cat_prent_categ='$newidscval'";
                    $qyueryval = $contdb->query($getallcatey);

                    while($rowvalew = $qyueryval->fetch_array()){
                        $explodevideos = json_decode($rowvalew['prd_cat_imagevale']);
                        if (!empty($explodevideos[0]) && $rowvalew['prd_cat_hidevale'] == 1 && in_array($rowvalew['id'], $categoryIdsWithProducts)) {
                            echo '<a class="subcatinner" href="'.$url.'/'.$rowvalew['prd_cat_main_url'].'">
                                    <div class="single-deign">
                                        <img src="'.$url.'/images/'.$explodevideos[0].'"/>
                                        <p>'.$rowvalew['prd_cat_name'].'</p>
                                    </div>
                                </a>';
                        }
                    }
                }
            }
        }
    }
    ?>
</div>


                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
</script>