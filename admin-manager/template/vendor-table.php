<table class="table table-bordered tableexportcsv">
  <thead>
    <tr>
      <th>Name</th>
      <th>Company Name</th>
      <th>Store Url</th>
      <th>Email Id</th>
      <th>Phone</th>
      <th>Commission</th>
      <th>Address</th>
      <th>City</th>
      <th>State code</th>
      <th>Zip code</th>
      <th>Country</th>
      <th>Date / Time</th>
      <th>Approved Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    date_default_timezone_set("Asia/Kolkata");
   foreach(GetVenderDatavale() as $valuecvnsor){
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $permissionData = GetPermissionvalExportData($valuecvnsor['vendor_auto'], $status);

    // Check if $permissionData is not empty
    if (!empty($permissionData)) {
        foreach($permissionData as $vendorpermisn){
            if($vendorpermisn['user_p_block'] == "1"){
                echo "<tr class='blockvendor'>";
                $arrpvdval = "Block";
            } else {
                echo "<tr class='unblockvendor'>";
                $arrpvdval = "Unblock";
            }
?>
    <td><?php echo $valuecvnsor['vendor_f_name']; ?> <?php echo $valuecvnsor['vendor_l_name']; ?></td>
    <td><?php echo $valuecvnsor['vendor_company']; ?></td>
    <td><a target="_blank" href="<?php echo $url; ?>/<?php echo $valuecvnsor['vendor_uni_name']; ?>"><?php echo $url; ?>/<?php echo $valuecvnsor['vendor_uni_name']; ?></a></td>
    <td><?php echo $valuecvnsor['vendor_email']; ?></td>
    <td><?php echo $valuecvnsor['vendor_phone']; ?></td>
    <td><?php echo $valuecvnsor['vendor_commi_type']; ?> - <?php echo $valuecvnsor['vendor_commi_val']; ?></td>
    <td><?php echo $valuecvnsor['vendor_address']; ?></td>
    <td><?php echo $valuecvnsor['vendor_city']; ?></td>
    <td><?php echo $valuecvnsor['vendor_state']; ?></td>
    <td><?php echo $valuecvnsor['vendor_zipcode']; ?></td>
    <td><?php echo $valuecvnsor['vendor_country']; ?></td>
    <td><?php echo $valuecvnsor['vendor_date']; ?><br><?php echo $valuecvnsor['vendor_time']; ?></td>
    <td><?php echo $arrpvdval; ?></td>
</tr>
<?php
        }
    }
}
?>
  </tbody>
</table>