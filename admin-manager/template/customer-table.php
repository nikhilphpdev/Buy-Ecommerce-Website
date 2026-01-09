<table class="table table-bordered tableexportcsv">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email Id</th>
      <th>Phone</th>
      <th>Age</th>
      <th>Gender</th>
      <th>Address</th>
      <th>City</th>
      <th>State</th>
      <th>Zip code</th>
      <th>Country</th>
      <th>Date / Time</th>
      <th>Customer Type</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $status = isset($_GET['status']) ? $_GET['status'] : '';
      foreach(GetCustomerDataExport($status) as $valuecvnsor){
          
         $cudatomerData = GetLoginUserDetails($valuecvnsor['customer_ui_id']);
        foreach($cudatomerData as $valedatalogin){
          if($vendorpermisn['customer_active'] == "0"){
            echo "<tr class='blockvendor'>";
          }else{
            echo "<tr class='unblockvendor'>";
          }
      ?>
 <td><?php echo !empty($valuecvnsor['customer_fname']) ? $valuecvnsor['customer_fname'] : 'N/A'; ?> <?php echo !empty($valuecvnsor['customer_lname']) ? $valuecvnsor['customer_lname'] : 'N/A'; ?></td>
<td><?php echo !empty($valedatalogin['user_email']) ? $valedatalogin['user_email'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_phone']) ? $valuecvnsor['customer_phone'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_age']) ? $valuecvnsor['customer_age'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_gender']) ? $valuecvnsor['customer_gender'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_address']) ? $valuecvnsor['customer_address'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_city']) ? $valuecvnsor['customer_city'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_state']) ? $valuecvnsor['customer_state'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_pincode']) ? $valuecvnsor['customer_pincode'] : 'N/A'; ?></td>
<td><?php echo !empty($valuecvnsor['customer_country']) ? $valuecvnsor['customer_country'] : 'N/A'; ?></td>
<td>
  <?php echo !empty($valuecvnsor['customer_date']) ? $valuecvnsor['customer_date'] : 'N/A'; ?> /
  <?php echo !empty($valuecvnsor['customer_time']) ? $valuecvnsor['customer_time'] : 'N/A'; ?>
</td>
<td><?php echo !empty($valuecvnsor['customer_type']) ? $valuecvnsor['customer_type'] : 'N/A'; ?></td>

      </tr>
    <?php }} ?>
  </tbody>
</table>