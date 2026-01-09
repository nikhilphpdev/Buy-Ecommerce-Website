 <footer class="footer text-center">

                 &copy; 2022-<?php echo date('Y'); ?> Karyamitra Associates Private Limited. All Rights Reserved.

            </footer>

            <!-- ============================================================== -->

            <!-- End footer -->

            <!-- ============================================================== -->

        </div>

        <!-- ============================================================== -->

        <!-- End Page wrapper  -->

        <!-- ============================================================== -->

    </div>

    <!-- ============================================================== -->

    <!-- End Wrapper -->

    <!-- ============================================================== -->

    <!-- ============================================================== -->

    <!-- All Jquery -->

    <!-- ============================================================== -->
    <script src="<?php echo $url; ?>/assets/libs/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap tether Core JavaScript -->

    <script src="<?php echo $url; ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

    <script src="<?php echo $url; ?>/assets/extra-libs/sparkline/sparkline.js"></script>

    <!--Wave Effects -->

    <script src="<?php echo $url; ?>/dist/js/waves.js"></script>

    <!--Menu sidebar -->

    <script src="<?php echo $url; ?>/dist/js/sidebarmenu.js"></script>

    <!--Custom JavaScript -->

    <script src="<?php echo $url; ?>/dist/js/custom.min.js"></script>
    <script src="<?php echo $url; ?>../admin-manager/admin_dist/includes/plugins/select2/js/select2.full.min.js"></script>

    <!--This page JavaScript -->

    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->

    <!-- Charts js Files -->

    <script src="<?php echo $url; ?>/assets/libs/flot/excanvas.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/flot/jquery.flot.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/flot/jquery.flot.pie.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/flot/jquery.flot.time.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/flot/jquery.flot.stack.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/flot/jquery.flot.crosshair.js"></script>

    <script src="<?php echo $url; ?>/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>

    <script src="<?php echo $url; ?>/dist/js/pages/chart/chart-page-init.js"></script>
<script src="https://testing.buyjee.com/admin-manager/admin_dist/includes/plugins/select2/js/select2.full.min.js"></script>
    <!-- Data Table --> 
<script src="<?php echo $url; ?>/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script> 
<!-------> 
<script src="https://testing.buyjee.com/admin-manager/admin_dist/includes/plugins/summernote/summernote-bs4.min.js"></script>

<script src="<?php echo $url; ?>/assets/js/tableToExcel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    var maxLength = 100;

    $('#chckprodt').on('input', function() {
        var currentLength = $(this).val().length;
        var remainingChars = maxLength - currentLength;

        if(currentLength >= maxLength) {
            $(this).val($(this).val().substring(0, maxLength));
            remainingChars = 0;
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
        url:"<?php echo $url; ?>/vendor/ajaxfile/",  
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
        url:"<?php echo $url; ?>/vendor/ajaxfile/",  
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
        url:"<?php echo $url; ?>/vendor/ajaxfile/",  
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
      url:"https://testing.buyjee.com/admin-manager/ajax-data-file/",  
      type:'post',
      data:{imageremovmulti:get_multimg},
      success:function(){
          alert('successfully delete');
          window.location.href = "";
      }  
  });
});

$(document).on("keyup change", "#prodregprice, #prodsalgprice", function () {
    let mrp = parseFloat($("#prodregprice").val());
    let sale = parseFloat($("#prodsalgprice").val());


    if(isNaN(mrp) || isNaN(sale)){
        $("#mainalertregsal").html("");
        $(".submitbt").prop("disabled", false);
        return;
    }
  let minSelling = mrp * 0.10;   // 10% of MRP
    let maxLimit90 = mrp * 0.90;   // up to 90% allowed

    //  Selling price must be >= 10% of MRP
    if (sale < minSelling.toFixed(0)) {
        $("#mainalertregsal").html(
            "<span class='alert alert-danger'>Invalid price: Sale price must be at least ₹ " 
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
            "<span class='alert alert-danger'>Invalid price: Sale price must be at least ₹" 
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
  if(Number(mainregualrpice) < Number(mainsaleprice)){
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
  if(Number(mainregualrpice) < Number(mainsaleprice)){
    $("#mainalertregsal").html("<span class='alert alert-danger'>Sales price can not be greater than regular price.</span>");
  }else{
    $("#mainalertregsal").html("");
  }
});
*/
$(".removeabbut").click(function(){
  var getidval = $(this).data('id');
  $.ajax({
      type: "POST",
      url: "https://testing.buyjee.com/admin-manager/ajax-data-file/",
      data : {removeabut:1, abutid:getidval},
      success : function(response){
     //   alert(response);
        $("#lodvalue").load(" #lodvalue");
        $("#loadvariations").load(" #loadvariations");
        $("#loadtableabut").load(" #loadtableabut");
      }        
  });
});

function dataedit(vertionid){
    
  var vercheck = "new";
  var secionval = "<?php echo $_GET['pageid']; ?>";
  var seciautoid ="<?php echo $_GET['autoid']?>";
  $.ajax({
      type: "POST",
       url:"https://testing.buyjee.com/admin-manager/ajax-data-file/",
      data : {addnewvert:1, verindid:vertionid, vertioncehck:vercheck, sessionvale:secionval,autoid:seciautoid},
      success : function(response){
      //   alert(response);
          let cleanedResponse = response.replace(/^\s*null\s*/, '');

        $("#vertionshow").html(cleanedResponse);
      }        
  });
}


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


</script>
<script>
    function singlfileprivewildone(){
    var fileInput = document.getElementById('multisinlpvone');
    var filesize = document.getElementById('multisinlpvone').files[0];
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else if(filesize.size > 1048576){
        alert('Please upload less then 1MB');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('singleimagepvone').innerHTML = '<img src="'+e.target.result+'" class="img-responsive"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

function singlfileprivewiltwo(){
    var fileInput = document.getElementById('multisinlpvtwo');
    var filesize = document.getElementById('multisinlpvtwo').files[0];
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }else if(filesize.size > 1048576){
        alert('Please upload less then 1MB');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('singleimagepvtwo').innerHTML = '<img src="'+e.target.result+'" class="img-responsive"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
function singlfileValidation(){
    var fileInput = document.getElementById('singleimage');
    var file = fileInput.files[0];
    var filePath = fileInput.value;

    // Remove any previous error messages
    $('#image-error').remove();

    // Validate file extension
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';  // Clear the input if invalid
        return false;
    }

    // Validate file size (limit: 1MB)
    if (file.size > 1048576) { // 1MB = 1048576 bytes
        alert('Please upload an image less than 1MB.');
        fileInput.value = '';  // Clear the input if too large
        return false;
    }

    // Validate image dimensions (should be 720x720 px)
    if (fileInput.files && file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = new Image();
            img.src = e.target.result;

            img.onload = function() {
                if (img.width === 720 && img.height === 720) {
                    // Display the image if it's valid
                    $('#singleimageview').html('<img src="' + e.target.result + '" class="img-responsive"/>');
                } else {
                    // Show error message if dimensions are incorrect
                    $('<div id="image-error" style="color: red;">Image dimensions should be exactly 720x720 pixels.</div>')
                        .insertAfter(fileInput);
                    fileInput.value = '';  // Clear the input if dimensions are wrong
                }
            };

            img.onerror = function() {
                alert('Invalid image file. Please select a valid image.');
                fileInput.value = '';  // Clear the input on error
            };
        };
        reader.readAsDataURL(file);  // Read the file as a data URL
    }
}


$(function() {
    // Multiple images preview in browser with size validation
    var imagesPreview = function(input, placeToInsertImagePreview) {
        // Clear error messages only, not the existing images
        $('#image-error').remove();

        if (input.files) {
            var filesAmount = input.files.length;
            var validImagesCount = parseInt($(".inputmultiimages").val() || 0);  // Keep track of already valid images

            for (let i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = new Image();
                    img.src = event.target.result;

                    img.onload = function() {
                        if (this.width <= 720 && this.height <= 720) {
                            // Append the image if it meets size requirements
                            $('<img class="img-responsive set-mutli-img" style="width:100px; height:100px;">')
                                .attr('src', event.target.result)
                                .appendTo(placeToInsertImagePreview);
                            validImagesCount++;
                        } else {
                            // Show error message if size exceeds 720x720
                            if (!$('#image-error').length) {
                                $('<div id="image-error" style="color: red;">Image dimensions should not exceed 720x720 pixels.</div>')
                                    .insertAfter(input);
                            }
                            // Clear input on error
                            $('.mutliimages').val('');  // Optionally reset the input
                            return false;  // Stop further processing
                        }

                        // Update valid images count input field
                        $(".inputmultiimages").val(validImagesCount);
                    };
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    // Event listener for image input change
    $('.mutliimages').on('change', function() {
        imagesPreview(this, '#multiimagesview');
    });
});




$("#saveattbut").click(function () {
    var favorite = [];
    var selctionpart = $(".mutliselctoption").select2();

    $.each(selctionpart, function () {
        favorite.push($(this).val());
    });

    var autoids = "<?php echo $_GET['autoid']; ?>"; // Ensure this value prints correctly

    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        dataType: "json", // Expect JSON response
        data: { 
            action: "save_attbut", // Include action parameter
            save_attbut: 1, 
            attbutvalue: favorite, 
            autoids: autoids 
        },
        success: function (response) {
            console.log("Server Response:", response);

            if (response.status === "success") {
                alert(response.message);
            } else {
                alert("Error: " + response.message);
            }

            $("#loadvariations").load(" #loadvariations");
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred: " + error);
        }
    });
});

$("#addattbut").click(function () {
    var get_attbuteval = $("#attbuteval").val() || "";
    if (!get_attbuteval) {
        alert("Please select an attribute.");
        return;
    }

    var get_page_id = "<?php echo isset($_GET['pageid']) ? $_GET['pageid'] : ''; ?>";
    var get_page_autoid = "<?php echo isset($_GET['autoid']) ? $_GET['autoid'] : ''; ?>";


    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        dataType: "json", // Expect JSON response
        data: { 
             action: "add_attribute",
            attbutdata: get_attbuteval, 
            prod_pagid: get_page_id, 
            prod_pageautid: get_page_autoid 
        },
        success: function (response) {
            console.log("Server Response:", response); // Check response

            if (response.status === "exists") {
                alert(response.message);
            } else if (response.status === "success") {
                alert(response.message);
                $("#lodvalue").load(location.href + " #lodvalue"); // Reload section
            } else {
                alert("Unexpected response.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", xhr.responseText);
            alert("Error: " + xhr.status + " - " + error);
        }
    });
});

$(".saveatbutvert").click(function(){
       var vertname = [];
  var isValid = true;
    $.each(document.getElementsByName('getattbut[]'), function(index){
       var value = $(this).val().trim();
     if (!value || value === "0") { // Check for empty, "0", or invalid values
        alert('Please select value');
        isValid = false;
        return false; // Break the loop if invalid data is found
    }
    vertname.push(value);
});

if (!isValid) {
    return false; // Stop execution if validation fails
}

if (vertname.length === 0) {
    alert('Select at least one variation.');
    return false;
}else{    
        
    var quantyver  =  $(".quantyver").val();
     var lowstockvale  =  $(".lowstockvale").val();
    var regularpice = parseFloat($(".regpricever").val());
    var salepicechking = parseFloat($(".salepricever").val());
    if (!lowstockvale || isNaN(lowstockvale) || lowstockvale <= 0) {
        alert('Please enter a valid Low Stock Threshold.');
        $(".lowstockvale").focus(); // Highlight the field
        return false;
    }

    if (!quantyver || isNaN(quantyver) || quantyver <= 0) {
        alert('Please enter a valid Quantity.');
        $(".quantyver").focus();
        return false;
    }

    if (!regularpice || isNaN(regularpice) || regularpice <= 0) {
        alert('Please enter a valid Regular Price.');
        $(".regpricever").focus();
        return false;
    }

    if (!salepicechking || isNaN(salepicechking) || salepicechking <= 0) {
        alert('Please enter a valid Sale Price.');
        $(".salepricever").focus();
        return false;
    }
    if(regularpice < salepicechking){
        alert("Sales price cannot be greater than regular price.");
    }else{
    if(salepicechking == ""){
        var salepice = "0";
    }else{
        var salepice = $(".salepricever").val();
    }
    var quanity = $(".quantyver").val();
    var lowstock = $(".lowstockvale").val();
    var seccionid = "<?php echo $_GET['autoid']; ?>";
    var prodval = "new";
    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        dataType: "json",
        data : {action: "versave", selection:vertname, reglarprice:regularpice, saleprice:salepice, quntyval:quanity, lowstockvale:lowstock, productchk:prodval, sessionautis:seccionid},
        success : function(response){
            //alert(response);
            $("#loadvariations").load(" #loadvariations");
            $("#loadtableabut").load(" #loadtableabut");
            $("#alertvertion").html(response.message);
        }
    });
    }
    }
});
function deletdataval(vertionid_delect){
    //alert(vertionid);
     var deltenchk = "new";
     var getautoid = "<?php echo $_GET['autoid']; ?>";
    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        //dataType: "json",
        data : {action: "delettrem", verindiddelt:vertionid_delect, chkvaldelt:deltenchk, getautoidval:getautoid},
        success : function(response){
            //alert(response);
            $("#loadvariations").load(" #loadvariations");
            $("#loadtableabut").load(" #loadtableabut");
            $("#alertvertion").text(response.message);
        }        
    });
}
$("#vertionupdate").click(function(e){
    event.preventDefault();
    var vertname_udate = [];
     var isValid = true;
    $.each(document.getElementsByName('getattbutedit[]'), function(index) {
        var values = $(this).val().trim();
        if (!values || values === "0") { // Check for empty, "0", or invalid values
        alert('Please select value');
        isValid = false;
        return false; // Break the loop if invalid data is found
    }
    vertname_udate.push(values);
});

if (!isValid) {
    return false; // Stop execution if validation fails
}

    if (vertname_udate.length === 0) {
        alert('Select Variations.');
        return false;
    }else{    
        
    var quanity_udate  =  $(".updatequant").val();
     var lowstock_udate  =  $(".updatelowstok").val();
    var regularpice_udate = parseFloat($(".updateregul").val());
    var salepice_udate = parseFloat($(".upatesale").val());
    if (!lowstock_udate || isNaN(lowstock_udate) || lowstock_udate <= 0) {
        alert('Please enter a valid Low Stock Threshold.');
        $(".updatelowstok").focus(); // Highlight the field
        return false;
    }

    if (!quanity_udate || isNaN(quanity_udate) || quanity_udate <= 0) {
        alert('Please enter a valid Quantity.');
        $(".updatequant").focus();
        return false;
    }

    if (!regularpice_udate || isNaN(regularpice_udate) || regularpice_udate <= 0) {
        alert('Please enter a valid Regular Price.');
        $(".updateregul").focus();
        return false;
    }

    if (!salepice_udate || isNaN(salepice_udate) || salepice_udate <= 0) {
        alert('Please enter a valid Sale Price.');
        $(".upatesale").focus();
        return false;
    }
    if(regularpice_udate < salepice_udate){
        alert("Sales price cannot be greater than regular price.");
    }else{
    if(salepice_udate == ""){
        var salepice_udate = "0";
    }else{
        var salepice_udate = $(".salepice_udate").val();
    }
    
    var vertinid_udate = $("#vertinid").val();
    var regularpice_udate = $(".updateregul").val();
    var salepice_udate = $(".upatesale").val();
    var quanity_udate = $(".updatequant").val();
    var lowstock_udate = $(".updatelowstok").val();
    var productvale = "new";
    var setion_getval = "<?php echo $_GET['autoid']; ?>";
    //alert(regularpice_udate);
    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        dataType: "json",
        data : {action: "updatevertion", selection:vertname_udate, reglarprice:regularpice_udate, saleprice:salepice_udate, quntyval:quanity_udate, lowstockupdate:lowstock_udate, verttrenid:vertinid_udate, editvale:productvale, sessiongetid:setion_getval},
        success : function(response){
            //alert(response);
            $("#loadvariations").load(" #loadvariations");
            $("#loadtableabut").load(" #loadtableabut");
            $("#alertvertion").text(response.message);
            document.getElementById("clickclose").click();
            $('#exampleModal').modal('hide');
            //$('#relodvertionbox').load(" #relodvertionbox");
        }
    });
    }
    }
});



$(document).ready(function () {
    $('#search-boxx').on('keyup', function () {
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
               // showChildren($this.data('id'));
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
  /*  function showChildren(parentId) {
        $('.catgoyval[data-parent="' + parentId + '"]').each(function () {
            $(this).show();
            showChildren($(this).data('id')); // Recursive call
        });
    }*/
});
    
    
    
   $(document).ready(function () {
     $('.product-sku').on('blur', function () {
         var sku = $(this).val().trim();
         var page_id = "<?php echo isset($_GET['autoid']) ? $_GET['autoid'] : 0; ?>";
         var messageDiv = $('.sku-message'); 
        
         messageDiv.hide().text('');
        
         if (sku !== '') {
             $.ajax({
                   url:"https://testing.buyjee.com/admin-manager/customer-update.php",  
                 type: 'POST',
                 data: { sku: sku, product_id: page_id },
               
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
 
 /*validiation Regular Price and selling price*/


   $(document).ready(function(){
    $("#prodstock").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, ''); 
    });
    $(".submitbt").click(function(e){
        var regularPrice = $("#prodregprice").val().trim();
        var salePrice = $("#prodsalgprice").val().trim();
        var stock = $("#prodstock").val().trim();
        var articleCode = $("#ariticlecode").val().trim();
        var hsnCode = $("#hsnsaccode").val().trim();
        var isValid = true;
         
         
           // Article Code Validation
       /* if (!/^[a-zA-Z0-9]{6,24}$/.test(articleCode)) {
            alert("Article Code must be alphanumeric and 6–24 characters long.");
            $("#ariticlecode").focus();
            return false;
        }*/
        if (articleCode === "") {
                alert("Please enter an Article Code.");
                $("#ariticlecode").focus();
                return false;
            }
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
         this.value = this.value.replace(/[^0-9]/g, ""); // allow only digits
    });
    
});


/*variation price validiation*/
$(document).on("input", ".regpricever, .salepricever, .quantyver, .lowstockvale", function () {
    this.value = this.value.replace(/[^0-9]/g, ''); 
});

$(document).on("input", ".updateregul, .upatesale, .updatequant, .updatelowstok", function () {
    this.value = this.value.replace(/[^0-9]/g, ''); 
});


$("#hsnsaccode").on("keypress", function (e) {
    var charCode = e.which ? e.which : e.keyCode;
    if (charCode < 48 || charCode > 57) {
        e.preventDefault(); 
    }
});


$("#hsnsaccode").on("input", function () {
    this.value = this.value.replace(/\D/g, '');
});


/*$("#ariticlecode").on("keypress", function (e) {
    var regex = /^[a-zA-Z0-9]+$/;
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (!regex.test(key)) {
        e.preventDefault();
        return false;
    }
});


$("#ariticlecode").on("input", function () {
    this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
});*/




</script>
</body>
</html>