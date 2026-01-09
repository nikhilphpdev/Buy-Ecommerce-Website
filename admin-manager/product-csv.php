<?php 
date_default_timezone_set('Asia/Kolkata');
if (ob_get_level()) ob_end_clean();
include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');


// Set CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="product_'.date('Y-m-d').'.csv"');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: 0');

// Your query
$status = $_GET['status'] ?? '';
$sql = "SELECT * FROM all_product"; // You can add WHERE if needed

$result = $contdb->query($sql);

// CSV output
$output = fopen('php://output', 'w');
fputcsv($output, ['Product Name', 'Vendor Name', 'SKU', 'Category', 'MRP', 'Selling Price', 'Stock', 'Article Code', 'HSN Code', 'GST', 'Status', 'Date/Time', 'Modified']);

while ($row = $result->fetch_assoc()) {
    $vendor_name = getVendorName($row['product_vender_id']);
    $statusText = ($row['product_status'] == 1) ? 'Active' : (($row['product_status'] == 0) ? 'Inactive' : 'Soft Deleted');

    fputcsv($output, [
        $row['product_name'],
        $vendor_name,
        $row['product_sku'],
        $row['product_catger'],
        $row['product_regular_price'],
        $row['product_sale_price'],
        $row['product_stock'],
        $row['product_ariticlecode'],
        $row['product_hsnsaccode'],
        $row['product_gst_rate'],
        $statusText,
        $row['product_date'] . ' ' . $row['product_time'],
        $row['product_modifydate']
    ]);
}

// Close the file pointer
fclose($output);
exit;
?>