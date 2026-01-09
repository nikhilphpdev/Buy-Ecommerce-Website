<?php
include_once("upper_function.php");
include_once("directory/url.php");

$url = get_template_directory_subvendor();

$adminUrl = get_template_directory_admin();

$weburl = get_template_directory_main();

?>

<!DOCTYPE html>

<html dir="ltr" lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="https://testing.buyjee.com/images/128573733.jpg">

    <title><?php echo fullnameval(); ?> | Buyjee</title>

    <!-- Custom CSS -->

    <link href="<?php echo $url; ?>/assets/libs/flot/css/float-chart.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="<?php echo $url; ?>/dist/css/style.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo $url; ?>/dist/css/chat.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->
<!-- Data Table -->
<link href="<?php echo $url; ?>/assets/libs/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://testing.buyjee.com/admin-manager/admin_dist/includes/plugins/summernote/summernote-bs4.css">

</head>



<body>

    <!-- ============================================================== -->

    <!-- Preloader - style you can find in spinners.css -->

    <!-- ============================================================== -->

<!--    <div class="preloader">

        <div class="lds-ripple">

            <div class="lds-pos"></div>

            <div class="lds-pos"></div>

        </div>

    </div>-->

    <!-- ============================================================== -->

    <!-- Main wrapper - style you can find in pages.scss -->

    <!-- ============================================================== -->

    <div id="main-wrapper">

        <!-- ============================================================== -->

        <!-- Topbar header - style you can find in pages.scss -->

        <!-- ============================================================== -->

        <header class="topbar" data-navbarbg="skin5">

            <nav class="navbar top-navbar navbar-expand-md navbar-dark">

                <div class="navbar-header" data-logobg="skin5">

                    <!-- This is for the sidebar toggle which is visible on mobile only -->

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

                    <!-- ============================================================== -->

                    <!-- Logo -->

                    <!-- ============================================================== -->

                    <a class="navbar-brand" href="https://testing.buyjee.com/subvendor">

                        <!-- Logo icon -->

                        <!-- <b class="logo-icon p-l-10">

                            <img src="assets/images/logo-icon.png" alt="homepage" class="light-logo" />

                           

                        </b>

                        <span class="logo-text">

                             <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" />

                            

                        </span> -->

                        

                        <!-- Logo icon -->

                        <!-- <b class="logo-icon"> -->

                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->

                            <!-- Dark Logo icon -->

                            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                            

                        <!-- </b> -->

                        <!--End Logo icon -->

                    </a>

                    <!-- ============================================================== -->

                    <!-- End Logo -->

                    <!-- ============================================================== -->

                    <!-- ============================================================== -->

                    <!-- Toggle which is visible on mobile only -->

                    <!-- ============================================================== -->

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>

                </div>

                <!-- ============================================================== -->

                <!-- End Logo -->

                <!-- ============================================================== -->



            </nav>

        </header>