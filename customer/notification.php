<?php include 'sessionset.php'; ?>
<?php include 'format.php'; ?>
<?php include 'includes/upper-header.php';?>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Customer Dashboard </title>
  <link rel="stylesheet" type="text/css" href="<?php echo $cus_url; ?>/user_dasboard.css">
<?php include 'includes/main-header.php'; ?>
<style type="text/css">
img.img-responsive {width: 50%;}
label.custom-file {margin-bottom: 41px;}
.table-bordered {
    overflow: auto;
    flex-wrap: wrap;
    display: block;
}
button.cancel-btn {
    background: none;
    color: #0fa8ae;
}
.order-cancel-box button.btn.btn-default {
    border: 1px solid #0fa8ae;
}
.order-cancel-box textarea {
    width: 100%;
    border-radius: 10px;
    border-color: #0fa8ae;
    color: #000;
}
.order-cancel-box {
    position: fixed;
    top: 0px;
    z-index: 1111;
    background: #0000005e;
    left: 0px;
    right: 0px;
    bottom: 0px;
}
.body-cancel-box {
    background: #FFF;
    width: 30%;
    margin: auto;
    position: relative;
    top: 11%;
    padding: 20px 10px;
    border-radius: 5px;
}
.body-cancel-box .modal-head h4 {
    float: left;
}
.body-cancel-box .modal-head {
    margin-bottom: 8px;
    overflow: auto;
    border-bottom: 1px solid #dee2e6;
    padding: 0px 0px 8px 0px;
}


.note-bord p {
    font-size: 14px;
    font-weight: 700;
    float: left;
}
.note-bord span {
    font-size: 13px;
    margin-left: 4px;
    font-weight: 500;
    margin-bottom: 15px;
    display: block;
}
h4.note-bord {
    margin-top: 5px;
}

.table-bordered{border: 0px !important;}
.thead-dark{
    border-top: 1px solid #ddd;
}
.table>thead>tr>th {
        padding: 10px 50PX !important;
}


.cust-section{
    text-align: justify;
    align-items: self-end;
    font-size: 24px;
    padding-bottom: 20px;
}

td.colos {
    color: green;
}
td.setimmg a img {
    max-width: 64px;
    text-align: center;
    padding-left: 7px;
}
</style>


<!-- ========= main banner section ========== -->
<section>
    <div class="main-content w-100">
      
            <div class="row">
                <div class="user_profile">
            		<!-- Left Sidebar -->
                    <?php include 'sidebar.php';?>
            		<!--- End -->
                    <div class="user_right">
                        <div class="mx-container">

                            <div class="row my-2">
                                <div class="col-lg-12 order-lg-12">
                                                                <section>
                                      <div class="page-breadcrumb cust-section">

                                        <div class="row">
                        
                                            <div class="col-12 d-flex no-block align-items-center">
                        
                                                <h4 class="page-title"> <span class="btntopadd">Notifications</span></h4>
                        
                                            
                        
                                            </div>
                        
                                        </div>
                        
                                    </div>
                               </section>
                                  
                                  
                                            <table id="dtcExample" class="table table-striped">
                                             <tr> <thead class="thead-dark">
                                             
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    
                                                    <th>Status</th>
                                                  
                                                  
                                            </thead></tr>
                                            <tbody>
                                          <?php echo mynotification(); ?>
                                            </tbody>
                                        </table>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
    </div>
</section>
<!-- /////////// footer section ////////////// -->
<?php include 'includes/footer.php'; ?>



<script type="text/javascript">
 $(document).ready(function() {
  $('#dtcExample').DataTable({
    initComplete: function() {
      var searchInput = $('.dataTables_filter input');
      searchInput.attr('placeholder', 'Enter Mobile Or Email');
    }
   /* order: [[0, 'desc']],*/
    
  });
});

