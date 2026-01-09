<?php

include_once('admin_dist/includes/uper-header.php');

include_once('admin_dist/includes/main-header.php');

include_once('admin_dist/includes/top-bar.php');

include_once('admin_dist/includes/left-menu.php');
date_default_timezone_set('Asia/Kolkata');
$date = date("d-m-d"); 
$time = date("h:i A"); 
?>
<style type="text/css">
  a.btn.btn-danger.btnseptu {
    margin: 0px 19px;
    color: #FFF;
    cursor: pointer;
}
a.uppy-Dashboard-poweredBy {
    display: none !important;
}
div#loadtableabut {
    background: #f5f5f5;
    padding: 11px 8px;
}
#loadtableabut table.table.table-bordered {
    border: 1px solid;
    width: 100%;
    display: inline-table;
}
#loadtableabut .set_tablevale tr {
    cursor: grab;
}
td.editvertion, td.delectvertion {
    cursor: pointer;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    border: 1px solid #007bff;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
}
p#alertvertion {
    background: #007bff;
    padding: 5px 11px;
    margin-top: 11px;
    border-radius: 4px;
    color: #FFF;
}
.modal-dialog {
    max-width: 650px;
}
.my-error-class {
    color:#FF0000;  /* red */
}
.multiimages {
    border: 1px solid #CCC;
    padding: 10px 10px;
    margin: 10px 0px;
    display: inline-block;
    width: 16.66666666%;
}
.red-color {
    color: #dc3545;
    font-size: 15px;
}
#charCount{
    color:red;
}
.sku-message {
    font-size: 0.9rem;
    color: #e74c3c;
}
</style>
<?php

if(isset($_GET['pageid']) && isset($_GET['autoid'])){
    
}else{

  $paenameval = AddNewPageOneTime();
  echo "<script>window.location.href='$paenameval';</script>";
}
foreach(GetProductDataValTab($_GET['autoid']) as $product_data){
$pageautoid = $product_data['product_page_name'];


}
?>
<link href="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.css" rel="stylesheet">
 
<script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">
            <?php
              if($product_data['product_name'] == ""){
            ?>
            <h1>Add New Product</h1>
            <?php
              }else{
            ?>
            <h1>Edit</h1>
            <?php
              }
            ?>
            
          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="<?php echo $url; ?>/admin-manager/">Home</a></li>

              <?php
                if($product_data['product_name'] == " "){
              ?>
              <li class="breadcrumb-item active">Add New Product</li>
              <?php
                }else{
              ?>
              <li class="breadcrumb-item active">Edit</li>
              <?php
                }
              ?>
              
            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-md-12">

          <div class="card card-outline card-info">

            <!-- /.card-header -->
          <form role="form" method="post" enctype="multipart/form-data" action="">
            <div class="card-body pad">

                <div class="row">

                  <div class="col-md-8">
                    <div class="row">

                      <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Vendor Name <span class="red-color">*</span></label>
                            <select name="venderdata" class="form-control" required>
                              <option value="">Select one</option>
                             <?php
                                foreach(GetVenderDatavale() as $vendername){
                                  foreach(GetPermissionvalData($vendername['vendor_auto']) as $vendorpermision){
                                    if($vendorpermision['user_p_block'] == "0" && $vendorpermision['user_p_email_ap'] == "1"){
                                      if($product_data['product_vender_id'] == $vendername['vendor_auto']){
                              ?>
                                <option value="<?php echo $vendername['vendor_auto']; ?>" selected><?php echo $vendername['vendor_f_name']; ?> <?php echo $vendername['vendor_l_name']; ?></option>
                              <?php
                                }else{
                              ?>
                                <option value="<?php echo $vendername['vendor_auto']; ?>"><?php echo $vendername['vendor_f_name']; ?> <?php echo $vendername['vendor_l_name']; ?></option>
                              <?php
                                }
                              }}}
                              ?>
                            </select>
                        </div>
                      </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>Product Name <span class="red-color">*</span></label>

                            <input type="text" class="form-control chaking-pagename" name="prodttitle" placeholder="Product Name" value="<?php echo $product_data['product_name']; ?>" id="chckprodt" required>
                           <span id="errorMsg" style="color: red; display: none;">Character limit reached!</span>
                            
                            <div id="result"></div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Permalink </label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $url; ?>/</span>
                              </div>
                              <input type="text" class="form-control" value="<?php echo $product_data['product_page_name']; ?>" name="peramlink" placeholder="Permalink" required disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="mb-3">

                            <label>Product Description</label>

                            <textarea class="textarea" name="texteditor" placeholder="Place some text here..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required><?php echo $product_data['product_destion']; ?></textarea>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="mb-3">

                            <label>Short Description <span class="red-color">*</span></label>

                            <input type="text" class="form-control chaking-pagename" name="shordest" placeholder="Short Description" value="<?php echo $product_data['product_short_des']; ?>" required>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="row">
                          <div class="col-12">
                            <!-- Custom Tabs -->
                            <div class="card">
                              <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">Stock Management</h3>
                                <ul class="nav nav-pills ml-auto p-2">
                                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Inventory</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">General</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Variations</a></li>
                                </ul>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                <div class="tab-content">
                                   <div class="tab-pane active " id="tab_1">
                                       <div class="row">
                                    <div class="col-md-12">
                                      <div class="mb-3">
                                          <label>SKU <span class="red-color">*</span></label>
                                          <input type="text" class="form-control chaking-pagename product-sku" name="prodsku" placeholder="SKU" value="<?php echo $product_data['product_sku']; ?>" required>
                                           <small class="message-error text-danger sku-message" style="display: none;"></small>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Article Code</span>
                                        </div>
                                        <input type="text" class="form-control" value="<?php echo $product_data['product_ariticlecode']; ?>" name="ariticlecode" placeholder="Article Code" id="ariticlecode" maxlength="24">
                                        <span class="message-error" style="display:none"></span>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-6">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">HSN/SAC Code<span class="red-color">*</span></span>
                                        </div>
                                        <input type="text" name="hsnsaccode" value="<?php echo $product_data['product_hsnsaccode']; ?>" class="form-control" placeholder="HSN/SAC Code" id="hsnsaccode" maxlength="8">
                                         <span class="message-error" style="display:none"></span>
                                      </div>
                                    </div>
                                     <div class="col-md-6">
                                     <div class="mb-3">
                                              
                                                 <select class="form-select form-control" aria-label=".form-select-lg example" name="gst_rate" id="gst_rate">
                                                <option value="" selected disabled>Select GST Rate %</option>
                                                
                                                <option value="0" <?php echo ($product_data['product_gst_rate'] == 0) ? 'selected' : ''; ?>>0%</option>
                                                <option value="5" <?php echo ($product_data['product_gst_rate'] == 5) ? 'selected' : ''; ?>>5%</option>
                                                <option value="12" <?php echo ($product_data['product_gst_rate'] == 12) ? 'selected' : ''; ?>>12%</option>
                                                <option value="18" <?php echo ($product_data['product_gst_rate'] == 18) ? 'selected' : ''; ?>>18%</option>
                                                <option value="28" <?php echo ($product_data['product_gst_rate'] == 28) ? 'selected' : ''; ?>>28%</option>
                                            </select>
                                                  
                                                  
                                                </div>

                                    </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-check mb-3">
                                    <input type="hidden" name="breakable" value="0">
                                          <input type="checkbox" name="breakable" value="1" class="form-check-input" id="breakable"
                                            <?php if($product_data['is_breakable'] == 1){ echo "checked"; } ?> >
                                    
                                          <label class="form-check-label" for="breakable">
                                            This is Breakable Product
                                          </label>
                                    
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_2">
                                    <div class="col-md-12">
                                      <p id="mainalertregsal"></p>
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Regular price (₹) <i class="red-color">*</i></span>
                                        </div>
                                        <?php 
                                        if($product_data['product_regular_price'] == "0" || $product_data['product_regular_price'] == ""){
                                          $productprice = "";
                                        }else{
                                          $productprice = $product_data['product_regular_price'];
                                        }
                                        ?>
                                        <input type="text" name="prodregprice" id="prodregprice" value="<?php echo $productprice; ?>" class="form-control mainregular chaking-pagename" placeholder="Price">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Sale price (₹) <i class="red-color">*</i></span>
                                        </div>
                                        <input type="text" name="prodsalgprice" id="prodsalgprice" value="<?php echo $product_data['product_sale_price']; ?>" class="form-control mainsale" placeholder="Price">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Low stock threshold</i></span>
                                        </div>
                                        <input type="number" name="prodminthold" value="<?php echo $product_data['product_min_price']; ?>" class="form-control" placeholder="Low stock threshold">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Stock Quantity<i class="red-color">*</i></span>
                                        </div>
                                        <input type="text" name="prodstock" id ="prodstock" value="<?php echo $product_data['product_stock']; ?>" class="form-control" placeholder="Stock Quantity">
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_3">
                                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Attributes</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Variations</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="custom-content-below-tab Content">
                                      <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                        <div class="row">
                                          <div class="col-md-10">
                                            <div class="form-group">
                                              <div class="form-group"></div>
                                              <select class="form-control selctoption" id="attbuteval" name="getattbut">
                                                <option value="">Select One</option>
                                                <?php
                                                   echo get_attbutval();
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-2">
                                            <div class="form-group">
                                              <div class="form-group"></div>
                                              <button type="button" class="btn btn-primary" id="addattbut">Add</button>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div id="lodvalue">
                                              <?php
                                                if(isset($_GET['autoid'])){
                                                 
                                                   ge_show_attbutval($_GET['autoid']);
                                                }
                                              ?>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <button type="button"id="saveattbut" class="buttonb btn btn-primary">Save</button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                        <p id="alertvertion"></p>
                                        <div id="loadvariations">
                                            <?php
                                                if(isset($_GET['autoid'])){
                                                   // print_r($get_attseion);
                                                   echo  show_trem_val($_GET['autoid'],$product_data['product_color']);
                                                }
                                            ?>
                                        </div>
                                        <p id="alertdengs"></p>
                                        <div class="col-md-4 form-group">
                                            <button type="button" class="saveatbutvert buttonb btn btn-primary">Add</button>
                                            
                                        </div>
                                        <div id="loadtableabut">
                                            <table class="table table-bordered">
                                                <?php 
                                                    if(isset($_GET['autoid'])){
                                                       
                                                      vertionattbut($_GET['autoid'],$product_data['product_size']);
                                                    }
                                                ?>
                                            </table>
                                            <!--<div class="col-md-4 form-group">
                                              <button type="button" class="savetablever buttonb btn btn-primary">Save Variations</button>
                                        </div>-->
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                              </div><!-- /.card-body -->
                            </div>
                            <!-- ./card -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      
<!--<div class="card">
                              <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">Competitor Prices</h3>
                              
                              </div>
                              <div class="card-body">
                                <div class="tab-content">
                                  <div class="tab-pane active" id="tab_1">
                                   
                                    <div class="col-md-12">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Amazon Url</span>
                                        </div>
                                        <input type="text" class="form-control" value="<?php //echo $product_data['amazon_url']; ?>" name="amazon" placeholder="Amazon Url">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text">Flipkart Url</span>
                                        </div>
                                        <input type="text" name="flipkart" value="<?php //$product_data['flipkart_url']; ?>" class="form-control" placeholder="Flipkart Url">
                                      </div>
                                    </div>
                                  </div>
                                  
                                </div>
                          
                              </div>
                            </div>-->
                    </div>
                    <input type="hidden" name="dissontype" value="<?php echo $product_data['product_discount']; ?>">
                    <input type="hidden" class="form-control" value="<?php echo $product_data['product_discount']; ?>" name="disountvalue">
                </div>
                <?php include_once("template/seo-page.php"); ?>
              </div>
              <div class="col-md-4">
                <!-- /.col (left) -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Action</h3>
                  </div>
                  <div class="card-body">
                    <!-- Date range -->
                    <div class="form-group">
                      <?php
                      if($product_data['product_name'] == ""){
                      ?>
                        <input type="submit" value="Publish" name="addproduct" class="btn btn-primary float-left submitbt" id="submitbtnadd">
                        <input type="hidden" name="suname" value="Successfully Added.">
                      <?php }else{ ?>
                        <input type="submit" value="Update" name="addproduct" class="btn btn-primary float-left submitbt" id="submitbtnadd">
                        <input type="hidden" name="suname" value="Successfully Updated.">
                      <?php } ?>
                      <a class="btn btn-danger btnseptu" href="<?php echo $url; ?>/admin-manager/all-product/">Cancel</a>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card repert this -->

                <!-- /.col (left) -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Product Categories</h3>
                  </div>
                  <div class="form-group">
                    <input type="text" id="search-box" class="form-control" placeholder="Search categories...">  
                      </div>
                  <div class="card-body catory-setht">
                    <!-- Date range -->
                    <div class="form-group">
                       
                      <?php
                        echo ProductInnercategoryTree($product_data['product_catger_ids'],$parent_id = 0, $sub_mark = '');
                      ?>
                      
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card repert this -->

                <!-- /.col (left) -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Related Products</h3>
                  </div>
                  <div class="card-body">
                    <!-- Date range -->
                    <div class="form-group">
                      <div class="select2-purple">
                        <select class="select2" multiple="multiple" data-placeholder="SKU" data-dropdown-css-class="select2-purple" name="recmatepd[]" style="width: 100%;">
                          <?php
                          $ecplodeval = explode(',', $product_data['product_recomateprd']);
                            foreach(GetProductDataValTab() as $valueproduct){
                              if(in_array($valueproduct['product_auto_id'],$ecplodeval)){
                              echo "<option value='".$valueproduct['product_auto_id']."' selected>".$valueproduct['product_sku']."</option>";
                            }else{
                              echo "<option value='".$valueproduct['product_auto_id']."'>".$valueproduct['product_sku']."</option>";
                            }
                            }
                          ?>
                        </select>
                      </div>
                        <!-- /.form-group -->
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card repert this -->

                <!-- /.col (left) -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Product Image (Size: 720 x 720 px)</h3>
                  </div>
                 <div class="col-md-12">
                    <div id="singleimageview">
                        <?php if(!empty($product_data['product_image'])) { ?>
                            <img src="<?php echo htmlspecialchars($url); ?>/images/<?php echo htmlspecialchars($product_data['product_image'] ?? ''); ?>" class="img-responsive">
                        <?php } ?>                      
                    </div>
                    

                    <label>Image</label>
                    <input type="file" 
       accept="image/*" 
       class="form-control form-group" 
       id="singleimage" 
       name="prodtmainimg" 
       onchange="return singlfileValidation()" 
       <?php if(empty($product_data['product_image'])) echo 'required'; ?>>
                    <input type="hidden" name="mainimgchkig" value="<?php echo $product_data['product_image']; ?>">
                </div>

                </div>
                <!-- /.card repert this -->

                <!-- /.col (left) -->
               <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Product Gallery (Size: 720 x 720 px)</h3>
                  </div>
                  <div class="col-md-12">
                    <div id="multiimagesview" class="row_position">
                      <?php
                        foreach(GetProductSmallImage($_GET['autoid']) as $mutlipaimages){
                          echo "<div><i class='fa fa-trash-o removeval' data-id='".$mutlipaimages['id']."|".$mutlipaimages['produt_img']."'></i><img src='$url/images/".$mutlipaimages['produt_img']."' class='img-responsive' id='".$mutlipaimages['id']."'></div>";
                        }
                      ?>
                    </div>
                    <!-- <div id="drag-drop-area"></div> -->
                    <label>Image</label>
                   <input type="file" 
       accept="image/*" 
       class="form-control form-group mutliimages" 
       name="prodtallimg[]" 
       multiple 
       <?php if(empty(GetProductSmallImage($_GET['autoid']))) echo 'required'; ?>>

                  </div>
                </div>
                <!-- /.card repert this -->
              </div>
            </div>
            </div>

          </form>

          </div>

        </div>

        <!-- /.col-->

      </div>

      <!-- ./row -->

    </section>
    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Variations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="vertionshow"></div>
        <button type="button" id="vertionupdate" class="buttonb btn btn-primary">Update</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="clickclose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 <?php

include_once('admin_dist/includes/footer.php');

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script class="text/javascript">
  var uppy = Uppy.Core()
    .use(Uppy.Dashboard, {
      inline: true,
      target: '#drag-drop-area'
    })
    .use(Uppy.Tus, {endpoint: 'https://www.gallerylala.com/images/'}) //you can put upload URL here, where you want to upload images

  uppy.on('complete', (result) => {
    console.log('Upload complete! We’ve uploaded these files:', result.successful)
  })
</script> -->
<script type="text/javascript">
$(document).ready(function() {
    var maxLength = 100;

    $('#chckprodt').on('input', function() {
        var currentLength = $(this).val().length;
        var remainingChars = maxLength - currentLength;

       if (currentLength >= maxLength) {
            $('#errorMsg').show(); // Display validation message
            $(this).val($(this).val().substring(0, maxLength)); // Trim input to 100 characters
            remainingChars = 0;
        } else {
            $('#errorMsg').hide(); // Hide validation message if below the limit
        }

        $('#charCount').text(`${remainingChars} characters remaining`);
    });
});


var get_lient = $("#load-datasetion").length;
if(get_lient == 0 && get_lient == ""){
  $("#saveattbut").hide();
}else{
  $("#saveattbut").show();
}
$("#addattbut").click(function(){

  $("#saveattbut").show();
      
});
$( ".row_position" ).sortable({  
    delay: 150,  
    stop: function() {  
        var selectedData = new Array();  
        $('.row_position>div>img').each(function() {  
            selectedData.push($(this).attr("id"));  
        });  
        updateOrder(selectedData);
    }
});  
  
function updateOrder(data) {
    $.ajax({  
        url:"<?php echo $url; ?>/admin-manager/ajax-data-file/",  
        type:'post',
        data:{postinmutipd:data},
        success:function(){
            //alert('Successfully Changed.');  
            //window.location.href = "";
        }  
    })  
}

$("body").delegate(".savetablever", "click", function(){
    var selectedData = [];
    $('.set_tablevale>tr').each(function() {
        selectedData.push($(this).attr("id"));
    });
    //alert(selectedData);
    updateOrdertablecick(selectedData);
});
  
function updateOrdertablecick(data) {
    $.ajax({  
        url:"<?php echo $url; ?>/admin-manager/ajax-data-file/",  
        type:'post',
        data:{tablevale:data},
        success:function(response){
            //alert(response);
            alert('Successfully Saved.');
            //window.location.href = "";
        }  
    })
}

$( ".set_tablevale" ).sortable({  
    delay: 150,  
    stop: function() {
        var selectedData = new Array();  
        $('.set_tablevale>tr').each(function() {  
            selectedData.push($(this).attr("id"));  
        });  
        //alert(selectedData);
        updateOrdertable(selectedData);
    }
});  
  
function updateOrdertable(data) {
    $.ajax({  
        url:"<?php echo $url; ?>/admin-manager/ajax-data-file/",  
        type:'post',
        data:{tablevale:data},
        success:function(response){
            //alert(response);
            //alert('Successfully Changed.');  
            //window.location.href = "";
        }  
    })  
}

$('.removeval').click(function(){
  var get_multimg = $(this).data("id");
 //alert(get_multimg);
 $.ajax({  
      url:"<?php echo $url; ?>/admin-manager/ajax-data-file/",  
      type:'post',
      data:{imageremovmulti:get_multimg},
      success:function(){
          alert('successfully delete');
          window.location.href = "";
      }  
  });
});
function dataedit(vertionid){
    
  var vercheck = "new";
  var secionval = "<?php echo $_GET['pageid']; ?>";
  var seciautoid ="<?php echo $_GET['autoid']?>";
  $.ajax({
      type: "POST",
      url: "<?php echo $url; ?>/admin-manager/ajax-data-file/",
      data : {addnewvert:1, verindid:vertionid, vertioncehck:vercheck, sessionvale:secionval,autoid:seciautoid},
      success : function(response){
          //alert(response);
          let cleanedResponse = response.replace(/^\s*null\s*/, '');

        $("#vertionshow").html(cleanedResponse);
      }        
  });
}

$("#lodvalue").load(" #lodvalue", function () {
    bindRemoveButton(); // Rebind event after content reload
});

function bindRemoveButton() {
    $(document).on("click", ".removeabbut", function () {
        var getidval = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "<?php echo $url; ?>/admin-manager/ajax-data-file/",
            data: { removeabut: 1, abutid: getidval },
            cache: false,
            success: function (response) {
                //alert(response);
                $("#lodvalue").load(" #lodvalue");
                $("#loadvariations").load(" #loadvariations");
                $("#loadtableabut").load(" #loadtableabut");
            }
        });
    });
}

$(document).on("keyup change", "#prodregprice, #prodsalgprice", function () {

    let mrp = parseFloat($("#prodregprice").val().replace(/[,₹]/g, ""));
    let sale = parseFloat($("#prodsalgprice").val().replace(/[,₹]/g, ""));

    if (isNaN(mrp) || isNaN(sale) || mrp <= 0) {
        $("#mainalertregsal").html("");
        $(".submitbt").prop("disabled", false);
        return;
    }

    let minSelling = mrp * 0.10;   // 10% of MRP
    let maxLimit90 = mrp * 0.90;   // up to 90% allowed

    //  Selling price must be >= 10% of MRP
    if (sale < minSelling.toFixed(0)) {
        $("#mainalertregsal").html(
            "<span class='alert alert-danger'>Invalid price: Sale price must be at least ₹" 
            + minSelling.toFixed(0) + ".</span>"
        );
        $(".submitbt").prop("disabled", true);
    }


    else if (sale > mrp) {
        $("#mainalertregsal").html(
            "<span class='alert alert-danger'>Invalid price: Sale price must be less than or equal to the Regular price.</span>"
        );
        $(".submitbt").prop("disabled", true);
    }

    //  Valid (allowed cases: 10%–90% OR exactly MRP)
    else {
        $("#mainalertregsal").html("");
        $(".submitbt").prop("disabled", false);
    }
});




/*variation validation mrp selling price*/
$(document).on("keyup change", ".regpricever, .salepricever", function () {
  //  let row = $(this).closest("tr"); // current variation row
    let vmrp = parseFloat($(".regpricever").val());
    let vsale = parseFloat($(".salepricever").val());



    if(isNaN(vmrp) || isNaN(vsale)){
        $("#alertdengs").html("");
        $(".saveatbutvert").prop("disabled", false);
        return;
    }
    let minSelling = vmrp * 0.10;   // 10% of MRP
    let maxLimit90 = vmrp * 0.90;   // up to 90% allowed

    //  Selling price must be >= 10% of MRP
    if (vsale < minSelling.toFixed(0)) {
        $("#alertdengs").html(
            "<span class='alert alert-danger'>Invalid price: Sale price must be at least ₹ " 
            + minSelling.toFixed(0) + ".</span>"
        );
        $(".saveatbutvert").prop("disabled", true);
    }

    else if (vsale > vmrp) {
        $("#alertdengs").html(
            "<span class='alert alert-danger'>Invalid price: Sale price must be less than or equal to the Regular price.</span>"
        );
        $(".saveatbutvert").prop("disabled", true);
    }

    //  Valid (allowed cases: 10%–90% OR exactly MRP)
    else {
        $("#alertdengs").html("");
        $(".saveatbutvert").prop("disabled", false);
    }
});

/*var submit_button = document.getElementById("submitbtnadd");

submit_button.addEventListener("click", function(e) {
  var required = document.querySelectorAll("input[required]");
  
  required.forEach(function(element) {
    if(element.value.trim() == "") {
      element.style.borderColor = "red";
    }
  });
});
$(".salepricever").keyup(function(){
  var regualrpice = $(".regpricever").val();
  var saleprice = $(".salepricever").val();
  if(Number(regualrpice) < Number(saleprice)){
    $("#alertdengs").html("<span class='alert alert-danger'>Sales price can not be greater than regular price.</span>");
  }else{
    $("#alertdengs").html("");
  }
});

$(".mainregular").keyup(function(){
  var mainregualrpice = $(".mainregular").val();
  var mainsaleprice = $(".mainsale").val();
  if(parseInt(mainregualrpice) < parseInt(mainsaleprice)){
    $("#mainalertregsal").html("<span class='alert alert-danger'>Sales price can not be greater than regular price.</span>");
  }else{
    $("#mainalertregsal").html("");
  }
});
$(".mainregular").keydown(function(){
  var mainregualrpice = $(".mainregular").val();
  var mainsaleprice = $(".mainsale").val();
  if(mainregualrpice < mainsaleprice){
    $("#mainalertregsal").html("<span class='alert alert-danger'>Sales price can not be greater than regular price.</span>");
  }else{
    $("#mainalertregsal").html("");
  }
});

$(".mainsale").keyup(function(){
  var mainregualrpice = $(".mainregular").val();
  var mainsaleprice = $(".mainsale").val();
  if(parseInt(mainregualrpice) < parseInt(mainsaleprice)){
    $("#mainalertregsal").html("<span class='alert alert-danger'>Sales price can not be greater than regular price.</span>");
  }else{
    $("#mainalertregsal").html("");
  }
});
$(".mainsale").keydown(function(){
  var mainregualrpice = $(".mainregular").val();
  var mainsaleprice = $(".mainsale").val();
  if(mainregualrpice < mainsaleprice){
    $("#mainalertregsal").html("<span class='alert alert-danger'>Sales price can not be greater than regular price.</span>");
  }else{
    $("#mainalertregsal").html("");
  }
});*/

document.addEventListener('DOMContentLoaded', function() {
    const productNameInput = document.getElementById('chckprodt');
    const permalinkInput = document.querySelector('input[name="peramlink"]');

    function generatePermalink(text) {
        return text.toLowerCase()
            .replace(/[^a-z0-9\s]/g, '') // Remove special characters
            .trim()
            .split(/\s+/).join('-'); // Convert spaces to hyphens
    }

    function updatePermalink() {
        const productName = productNameInput.value.trim();
        const permalink = generatePermalink(productName);
     
        permalinkInput.value = permalink;
     
    }

    // Initial permalink generation
    updatePermalink();

    // Listen for changes in the product name input
    productNameInput.addEventListener('input', updatePermalink);
 
});


  
   $(document).ready(function () {
        const urlParams = new URLSearchParams(window.location.search);
    const product_id = urlParams.get('autoid') || 0;
    
     $('.product-sku').on('blur', function () {
         var sku = $(this).val().trim();
         var messageDiv = $('.sku-message'); // The message div near the SKU field
        
         messageDiv.hide().text('');
        
         if (sku !== '') {
             $.ajax({
                   url:"https://testing.buyjee.com/admin-manager/customer-update.php",  
                 type: 'POST',
                  data: { sku: sku,  product_id: product_id },
               
                   success: function (response) {
                    
                        try {
                            if (response.exists) {
                                $('.product-sku').addClass('is-invalid'); 
                                messageDiv.text('SKU already exists. Please choose another.').show(); 
                                $('.submitbt').attr('disabled', true);
                            } else {
                                $('.product-sku').removeClass('is-invalid'); 
                                messageDiv.text('').hide(); 
                                $('.submitbt').removeAttr('disabled'); 
                            }
                        } catch (e) {
                            console.error('Error handling JSON response:', e);
                            messageDiv.text('Unexpected response from server.').show();
                        }
                    },
                 error: function () {
                     messageDiv.text('An error occurred while checking the SKU.').show();
                 }
             });
        }
    });
 });

  
/*********Serach Category***************** */
$(document).ready(function () {
    $('#search-box').on('keyup', function () {
        var searchTerm = $(this).val().toLowerCase().replace(/\s+/g, ' ').trim();

        // Hide all categories initially
        $('.catgoyval').hide();

        // If search is empty, show all
        if (searchTerm.length === 0) {
            $('.catgoyval').show();
            return;
        }

        // Keep track of matched IDs
        var matchedIds = [];

        // Match elements containing the search term
        $('.catgoyval').each(function () {
            var $this = $(this);
            var text = $this.text().toLowerCase().replace(/\s+/g, ' ').trim();

            if (text.includes(searchTerm)) {
                $this.show(); // Show the matched element
                matchedIds.push($this.data('id'));

                // Show parent categories
                showParents($this);

                // Show children categories
             //   showChildren($this.data('id'));
            }
        });
    });

    // Show parent categories recursively
    function showParents(element) {
        var parentId = element.data('parent');
        if (parentId && parentId != 0) {
            var parentDiv = $('.catgoyval[data-id="' + parentId + '"]');
            if (parentDiv.length) {
                parentDiv.show();
                showParents(parentDiv); // Recursive call
            }
        }
    }

    // Show child categories recursively
   /* function showChildren(parentId) {
        $('.catgoyval[data-parent="' + parentId + '"]').each(function () {
            $(this).show();
            showChildren($(this).data('id')); // Recursive call
        });
    }*/
});
    
    
  /*validiation Regular Price and selling price*/
$(document).ready(function(){
    $("#prodregprice, #prodsalgprice, #prodstock").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, ''); 
    });
    
    $("#submitbtnadd").click(function(e){
        var regularPrice = $("#prodregprice").val().trim();
        var salePrice = $("#prodsalgprice").val().trim();
        var stock = $("#prodstock").val().trim();
         var articleCode = $("#ariticlecode").val().trim();
          var hsnCode = $("#hsnsaccode").val().trim();
        
        var isValid = true;
            
          // Article Code Validation
        /*if (!/^[a-zA-Z0-9]{6,24}$/.test(articleCode)) {
            alert("Article Code must be alphanumeric and 6–24 characters long.");
            $("#ariticlecode").focus();
            return false;
        }*/
        
          // HSN/SAC Code Validation
            if (!/^\d{8}$/.test(hsnCode)) {
                alert("HSN/SAC Code must be exactly 8 digits.");
                $("#hsnsaccode").focus();
                return false;
            }       
         
            
        if (regularPrice === "" || isNaN(regularPrice) || parseFloat(regularPrice) <= 0) {
            alert("Regular price is required and must be a valid number.");
            isValid = false;
        }

        if (salePrice === "" || (isNaN(salePrice) || parseFloat(salePrice) <= 0)) {
            alert("Sale price must be a valid number.");
            isValid = false;
        }
        if (stock === "" || isNaN(stock) || !/^\d+$/.test(stock)) {
            alert("Please enter a valid numeric stock quantity.");
            $("#prodstock").focus(); // Focus on input field
            return false; // Stop submission
        }
       
        if (!isValid) {
            e.preventDefault();
        }
    });
       $("#prodregprice, #prodsalgprice, #prodstock").on("input", function (e) {
        if (e.key.match(/[a-zA-Z]/)) {
            e.preventDefault(); // Block alphabetic input
        }
    });
});

// Allow only digits in HSN/SAC Code field
$("#hsnsaccode").on("keypress", function (e) {
    var charCode = e.which ? e.which : e.keyCode;
    if (charCode < 48 || charCode > 57) {
        e.preventDefault(); // Block non-numeric keys
    }
});

// Also clean pasted input (in case someone pastes letters/symbols)
$("#hsnsaccode").on("input", function () {
    this.value = this.value.replace(/\D/g, ''); // Remove non-digits
});

// Prevent special characters while typing
/*$("#ariticlecode").on("keypress", function (e) {
    var regex = /^[a-zA-Z0-9]+$/;
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!regex.test(key)) {
        e.preventDefault();
        return false;
    }
});*/

// Clean pasted input (remove special characters)
/*$("#ariticlecode").on("input", function () {
    this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
});*/

/*variation price validiation*/
$(document).on("input", ".regpricever, .salepricever, .quantyver, .lowstockvale", function () {
    this.value = this.value.replace(/[^0-9]/g, ''); 
});

$(document).on("input", ".updateregul, .upatesale, .updatequant, .updatelowstok", function () {
    this.value = this.value.replace(/[^0-9]/g, ''); 
});


</script>