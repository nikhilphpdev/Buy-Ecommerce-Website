<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Vendor Request</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/">Home</a></li>

              <li class="breadcrumb-item active">Vendor Request</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">
        <!-- left box -->
        <!-- right Box -->
        <div class="col-md-12">

          <div class="card card-primary">

            <div class="card-header">

              <h3 class="card-title">Vendor Request</h3>

            </div>

            <div class="card-body">

              <table id="example1233" class=" table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Email Id</th>
                    <th>Phone</th>
                      <th>Gst No.</th>
                    <th style="width: 93.7031px;">Date / Time</th>
                    <th style="width: 95.375px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach(GetVenderDatavale() as $valuecvnsor){
                    foreach(GetPermissionvalData($valuecvnsor['vendor_auto']) as $vendorpermisn){
                      if($vendorpermisn['user_p_email_ap'] == "1"){}else{
                          
                    $dateTime = new DateTime($valuecvnsor['vendor_date'] . ' ' . $valuecvnsor['vendor_time']);
                    $dateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
                    
                    $data_order = $dateTime->format('Y-m-d H:i:s');
                  
                    $display_date = $dateTime->format('d-m-Y');
                    $display_time = $dateTime->format('h:i A'); 
                  ?>
                  <tr class='blockvendor'>
                    <td style="width: 20%;"><img src="<?php echo $url; ?>/customer/images/default-user-icon.jpg" style="width: 30%;"></td>
                    <td><?php echo $valuecvnsor['vendor_f_name']; ?> <?php echo $valuecvnsor['vendor_l_name']; ?></td>
                    <td><?php echo $valuecvnsor['vendor_company']; ?></td>
                    <td><?php echo $valuecvnsor['vendor_email']; ?></td>
                    <td><?php echo $valuecvnsor['vendor_phone']; ?></td>
                     <td><?php echo !empty($valuecvnsor['gst_no']) ? $valuecvnsor['gst_no'] : 'N/A'; ?></td>
                    <td data-order="<?php echo $data_order; ?>">
                        <?php echo $display_date; ?><br><?php echo $display_time; ?>
                    </td>
                    <td class="text-right py-0 align-middle" >
                      <div class="btn-group btn-group-sm" style=" height: 37px; width: 37px;">
                        <a href="<?php echo $url; ?>/admin-manager/vendors-page?action=edit&id=<?php echo $valuecvnsor['vendor_auto']; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                      </div>
                      <button type="button" class="btn btn-danger deletebtn" data-toggle="modal" data-target="#delete" data-id="<?php echo $url; ?>/admin-manager/vendors/?action=delete&id=<?php echo $valuecvnsor['id']; ?>&eandid=<?php echo $valuecvnsor['vendor_auto']; ?>&request=back"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                <?php }}} ?>
                </tbody>
              </table>

            </div>

            <!-- /.card-body -->

          </div>

          <!-- /.card -->

        </div>
        <!-- right Box -->

      </div>

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

</div>

<!-- ./wrapper -->
