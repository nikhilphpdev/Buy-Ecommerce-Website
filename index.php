<?php include 'includes/upper-header.php'; 
?>
<?php

if(isset($_GET['datatbid'])){
    $get_page_name = $_GET['datatbid'];

    $page_name_check = page_name_checking($get_page_name);
    require_once($page_name_check);

}else{
    require_once('h-page-tb.php');
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
?>

<?php include 'includes/footer.php'; ?>