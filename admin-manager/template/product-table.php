

<table class="table table-bordered tableexportcsv">
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Vendor Name</th>
      <th>SKU</th>
      <th>Categories</th>
      <th>MRP</th>
      <th>Selling Price</th>
      <th>Stock Quantity</th>
      <th>ArticleCode</th>
      <th>Hsnsaccode</th>
      <th>GST(%)</th>
      <th>Status</th>
         <th>Discount (%)</th>
        <th>Date/Time</th>
      <th>Modify(Date/Time)</th>
    </tr>
  </thead>
  <tbody>
    <?php
   
  $status = isset($_GET['status']) ? $_GET['status'] : '';
  $vendor_id = isset($_GET['vendor_id']) ? $_GET['vendor_id'] : '';
    $productList = GetProductDataExport($status,$vendor_id); 
 
    foreach($productList as $productdetils){
     
             $vendor_id =$productdetils['product_vender_id'];
         $vendor_name = getVendorName($vendor_id);

        if($productdetils['product_status'] == "1"){
          echo "<tr class='blockvendor'>";
          $arrpvdval = "Block";
        }else{
          echo "<tr class='unblockvendor'>";
          $arrpvdval = "Unblock";
        } ?>
      <td><?php echo trim($productdetils['product_name']); ?></td>
      <td><?php echo $vendor_name; ?></td>
      <td><?php echo $productdetils['product_sku']; ?></td>
      <td><?php echo $productdetils['product_catger']; ?></td>
      <td><?php echo $productdetils['product_regular_price']; ?></td>
      <td><?php echo $productdetils['product_sale_price']; ?></td>
      <td><?php echo $productdetils['product_stock']; ?></td>
      <td><?php echo !empty($productdetils['product_ariticlecode']) ? $productdetils['product_ariticlecode'] : 'N/A'; ?></td>
      <td><?php echo !empty($productdetils['product_hsnsaccode']) ? $productdetils['product_hsnsaccode'] : 'N/A'; ?></td>
      <td><?php echo $productdetils['product_gst_rate']; ?></td>
      <td><?php echo $arrpvdval; ?></td>
      <td>
        <?php
        $mrp = floatval($productdetils['product_regular_price']);
        $selling = floatval($productdetils['product_sale_price']);

        if ($mrp > 0) {
            $discount = (($mrp - $selling) / $mrp) * 100;
           echo floor($discount + 0.5) . "%";
        } else {
            echo "0%";
        }
        ?>
      </td>
    <td>
  <?php echo !empty($productdetils['product_date']) ? $productdetils['product_date'] : 'N/A'; ?>
    <br>
  <?php echo !empty($productdetils['product_time']) ? $productdetils['product_time'] : 'N/A'; ?>
</td>
    <td>
  <?php echo !empty($productdetils['product_modifydate']) 
    ? date('d-m-Y H:i:A', strtotime($productdetils['product_modifydate'])) 
    : 'N/A'; ?>
</td>


    </tr>
  <?php } ?>
  </tbody>
</table>