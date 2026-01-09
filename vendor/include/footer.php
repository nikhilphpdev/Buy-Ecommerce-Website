
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
<script>
    /*function singlfileprivewildone(){
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
}*/
/*function singlfileprivewiltwo(){
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
}*/



function imagesPreview(input, placeToInsertImagePreview) {
    if (input.files) {
        var filesAmount = input.files.length;
        var validImagesCount = parseInt($(".inputmultiimages").val() || 0); // Keep track of already valid images

        for (let i = 0; i < filesAmount; i++) {
            var file = input.files[i];
            var fileType = file.type;
            if (fileType === "image/jpeg" || fileType === "image/png") {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = new Image();
                    img.src = event.target.result;

                    img.onload = function() {
                        if (img.width === 720 && img.height === 720) {

                            $('<img class="img-responsive set-mutli-img" style="width:100px; height:100px;">')
                                .attr('src', event.target.result)
                                .appendTo(placeToInsertImagePreview);
                            validImagesCount++;
                        } else {
                       
                            if (!$('#image-error').length) {
                                $('<div id="image-error" style="color: red;">Image dimensions should not exceed 720x720 pixels.</div>')
                                    .insertAfter(input);
                            }
                            // Clear input on error
                            $('.mutliimages').val(''); 
                            return false; 
                        }

                        $(".inputmultiimages").val(validImagesCount);
                    };
                };

                reader.readAsDataURL(file);
            } else {
              
                if (!$('#file-type-error').length) {
                    $('<div id="file-type-error" style="color: red;">Only .jpg and .png files are allowed.</div>')
                        .insertAfter(input);
                }

                $('.mutliimages').val(''); 
                return false; 
            }
        }
    }
}

$('.mutliimages').on('change', function() {
 
    $('#image-error, #file-type-error').remove();
    imagesPreview(this, '#multiimagesview');
});

//// Single image validation
function singlfileValidation(){
    var fileInput = document.getElementById('singleimage');
    var file = fileInput.files[0];
    var filePath = fileInput.value;

    // Remove any previous error messages
    $('#image-error').remove();
    // Validate file extension
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
         $('<div id="image-error" style="color: red;">Please upload file having extensions .jpeg/.jpg/.png/.gif only.</div>')
                        .insertAfter(fileInput);
        fileInput.value = '';  // Clear the input if invalid
        return false;
    }

    // Validate file size (limit: 1MB)
    if (file.size > 1048576) { 
           $('<div id="image-error" style="color: red;">Please upload an image less than 1MB.</div>')
                        .insertAfter(fileInput);
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


    
$(document).ready(function() { 
$("#addattbut").click(function () {
    var get_attbuteval = $(".selctoption").val() || "";
    if (!get_attbuteval) {
        alert("Please select an attribute.");
        return false;
    }

    var get_page_id = "<?php echo isset($_GET['pageid']) ? $_GET['pageid'] : ''; ?>";
    var get_page_autoid = "<?php echo isset($_GET['autoid']) ? $_GET['autoid'] : ''; ?>";

/*   console.log("Attribute Value:", get_attbuteval);
console.log("Page ID:", get_page_id);
console.log("Page Auto ID:", get_page_autoid);*/

    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        dataType: "json",  // Expect JSON response
        data: {
            action: "add_attribute", // Consistent action parameter
            attbutdata: get_attbuteval,
            prod_pagid: get_page_id,
            prod_pageautid: get_page_autoid
        },
        
        success: function (response) {
            //alert(response);
            console.log("Server Response:", response); // Check if the response is correctly parsed

            if (response.status === "exists") {
                alert(response.message);  // Show alert with server message
            } else if (response.status === "success") {
                alert(response.message);  // Show success message
                $("#lodvalue").load(" #lodvalue");  // Reload section
            } else {
                alert("Unexpected response.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred: " + error);  // Alert the user in case of error
        }
    });
});
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

$("#vertionupdate").click(function(e) {

    e.preventDefault(); // Use `e.preventDefault()` instead of `event.preventDefault()`
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

    $.ajax({
        type: "POST",
        url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
       dataType: "json",
        data: {
            action: "updatevertion", // Pass 'updatevertion' as a string
            selection: vertname_udate,
            reglarprice: regularpice_udate,
            saleprice: salepice_udate,
            quntyval: quanity_udate,
            lowstockupdate: lowstock_udate,
            verttrenid: vertinid_udate,
            editvale: productvale,
            sessiongetid: setion_getval
        },
        success: function(response) {
            console.log(response);
            $("#loadvariations").load(" #loadvariations");
            $("#loadtableabut").load(" #loadtableabut");
            $("#alertvertion").text(response.message);
            document.getElementById("clickclose").click();
            $('#exampleModal').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + error);
            console.log(xhr.responseText);
        }
    });
    }
    }
});
/********notify functionality code*************/



$(document).on('click', '.change-status', function () {
    const productId = $(this).data('id');
    const newStatus = $(this).data('status');
    // Send an AJAX request to update the status
    $.ajax({
       url: "https://testing.buyjee.com/admin-manager/ajax-data-file.php",
        type: 'POST',
        data: {
             actionn: 'notify', 
            id: productId,
            status: newStatus
        },
        success: function (response) {
            // Handle success response
            alert(response.message);
           location.reload(); // Optionally reload the page to reflect changes
        },
        error: function (xhr, status, error) {
            // Handle error
            console.error(error);
            alert('Error updating status');
        }
    });
});



</script>
</body>
</html>