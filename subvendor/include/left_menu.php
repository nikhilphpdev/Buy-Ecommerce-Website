<?php


$session_valuedata = $_SESSION['subvendorsessionlogin'];
$get_data_val = "SELECT * FROM userpermission WHERE user_p_id='$session_valuedata'";
$query_daa = $conn->query($get_data_val);

while($rowvaldata = $query_daa->fetch_array()){

    $banner_hide = $rowvaldata['user_banner'];
    $profiel_hide = $rowvaldata['user_profilepic'];
    $about_hide = $rowvaldata['user_aboutval'];
    $shpping_hide = $rowvaldata['user_shhpinval'];
    $addressval = $rowvaldata['user_addresedt'];
}
?>
<aside class="left-sidebar" data-sidebarbg="skin5">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar">

                <div class="prfbox">
                 
                    <div class="urr_btn">
                        <a href="https://testing.buyjee.com/<?php echo getsubvendrurl(); ?>" target="_blank" class="storebtn">Go to Your Store</a>
                        <a href="https://testing.buyjee.com/" class="ursshop">SHOP</a>
                    </div>             
                </div>

                <!-- Sidebar navigation-->                
                <nav class="sidebar-nav">

                    <ul id="sidebarnav" class="m-t-30">

                        <li class="sidebar-item"> 

                            <a class="sidebar-link" href="<?php echo $url; ?>index/">

                                <i class="mdi mdi-view-dashboard"></i>

                                <span class="hide-menu">Dashboard </span>

                            </a>

                        </li>

                        <li class="sidebar-item">

                            <a href="<?php echo $url; ?>approved-products" class="sidebar-link">

                                <i class="fa fa-product-hunt"></i>

                                <span class="hide-menu"> Products </span>

                            </a>

                        </li>

                        <li class="sidebar-item">

                            <a href="<?php echo $url; ?>logout/" class="sidebar-link">

                                <i class="fa fa-power-off"></i>

                                <span class="hide-menu"> Logout </span>

                            </a>

                        </li>

                    </ul>

                </nav>


            </div>

            <!-- End Sidebar scroll-->

        </aside>