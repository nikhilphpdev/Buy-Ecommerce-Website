 <?php
	include_once('popup-main.php');
	include_once('form-action.php');
	error_reporting(1);
ini_set("display_errors", 1);
?>
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-<?php //echo date('Y'); ?> <a href="#">Karyamitra Associates Private Limited. All Rights Reserved.</a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.1
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/dist/js/adminlte.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/dist/js/demo.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/chart.js/Chart.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/dist/js/adminlte.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/dist/js/domenu.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/script.main.js"></script>
<script src="<?php echo $url; ?>/admin-manager/admin_dist/includes/table2excel.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightpick@1.6.2/lightpick.min.js"></script>

<!-- <script src="<?php //echo $url; ?>/admin-manager/admin_dist/strip-disk.js"></script> -->
<script type="text/javascript">
$("body").delegate(".deletebtn", "click", function(){
  var seturl = $(this).data('id');

  $("#deleteurl").attr("href", seturl);
});
$(document).ready(function() {
    $("#fupForm").click(function() {
        var fd = new FormData();
        var files = $('#imagefile')[0].files[0];
        fd.append('file', files);
        /*alert(fd);*/
        $.ajax({
            url: '<?php echo $url; ?>/admin-manager/ajax-data-file',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              //alert(response);
              //$("#imagefile")[0].reset();
              $("#loaddata").load(" #loaddata");
              $("#secondtab").addClass('active');
              $("#seconddata").addClass('active');
              $("#firstatg").removeClass('active');
              $("#first").removeClass('active');
              $("#firsttab").removeClass('active');
            },
        });
    });
    $('#loaddata .clickactivecl').on('click', function(){
      var get_data_id = $(this).data('id');
      $.ajax({
            url: '<?php echo $url; ?>/admin-manager/ajax-data-file',
            type: 'post',
            dataType: 'JSON',
            data: {imgdatset:1, imgvaledat:get_data_id},
            success: function(response){
              var len = response.length;
              for(var i=0; i<len; i++){
                $("#img_nameval").attr("src", "<?php echo $url; ?>/images/" + response[i].imgname);
                $("#ftitle").text(response[i].imgoldnam);
                $("#titleimg").val(response[i].imgtitle);
                $("#aletimg").val(response[i].imgalt);
                $("#catipimg").val(response[i].imgcapt);
                $("#fdate").text(response[i].imgdate + " " + response[i].imgtime);
                $("#deletval").attr("data-id", get_data_id);
              }
            },
        });
    });
    $('#deletval').on('click', function(){
      var get_deleteimg = $(this).data('id');
      var get_deleteid = $("#ftitle").text();
      $.ajax({
            url: '<?php echo $url; ?>/admin-manager/ajax-data-file',
            type: 'post',
            dataType: 'JSON',
            data: {deletimgset:1, imgvaledelt:get_deleteimg, imgnamevale:get_deleteid},
            success: function(response){
              $("#loaddata").load(" #loaddata");
              $("#load_demoshow").load(" #load_demoshow");
            },
        });
    });

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
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
        dataType: "json",  
        data: {
            action: "add_attribute", 
            attbutdata: get_attbuteval,
            prod_pagid: get_page_id,
            prod_pageautid: get_page_autoid
        },
        
        success: function (response) {
            //alert(response);
            console.log("Server Response:", response);

            if (response.status === "exists") {
                alert(response.message);  
            } else if (response.status === "success") {
                alert(response.message); 
                $("#lodvalue").load(" #lodvalue");  
            } else {
                alert("Unexpected response.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred: " + error);  
        }
    });
});

});

</script>
<script type="text/javascript">

$("#saveattbut").click(function () {
    var favorite = [];
    var selctionpart = $(".mutliselctoption").select2();

    $.each(selctionpart, function () {
        favorite.push($(this).val());
    });

    var autoids = "<?php echo $_GET['autoid']; ?>";

    $.ajax({
        type: "POST",
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
        dataType: "json", 
        data: { 
            action: "save_attbut", 
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




$(".saveatbutvert").click(function(){
    var vertname = [];
  var isValid = true;
    $.each(document.getElementsByName('getattbut[]'), function(index){
       var value = $(this).val().trim();
     if (!value || value === "0") { 
        alert('Please select value');
        isValid = false;
        return false; 
    }
    vertname.push(value);
});

if (!isValid) {
    return false; 
}

if (vertname.length === 0) {
    alert('Select at least one variation.');
    return false;
}
     else{    
        
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
    data: {
        action: "versave",
        selection: vertname,
        reglarprice: regularpice,
        saleprice: salepice,
        quntyval: quanity,
        lowstockvale: lowstock,
        productchk: prodval,
        sessionautis: seccionid
    },
    success: function(response) {
        alert(response.message); 
        $("#loadvariations").load(" #loadvariations");
        $("#loadtableabut").load(" #loadtableabut");
        $("#alertvertion").html(response.message);
    },
    error: function(xhr, status, error) {
        console.error("AJAX Error:", status, error);
    }
});
    }
    }
});

$("#vertionupdate").click(function(e) {

    e.preventDefault(); 
    
    var vertname_udate = [];
     var isValid = true;
    $.each(document.getElementsByName('getattbutedit[]'), function(index) {
        var values = $(this).val().trim();
        if (!values || values === "0") { 
        alert('Please select value');
        isValid = false;
        return false; 
    }
    vertname_udate.push(values);
});

if (!isValid) {
    return false;
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
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
       dataType: "json",
        data: {
            action: "updatevertion", 
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


function deletdataval(vertionid_delect){
    
     var deltenchk = "new";
     var getautoid = "<?php echo $_GET['autoid']; ?>";
    $.ajax({
        type: "POST",
        url: "<?php echo $url; ?>/admin-manager/ajax-data-file.php",
        dataType: "json",
        data : { action: "delettrem", verindiddelt:vertionid_delect, chkvaldelt:deltenchk, getautoidval:getautoid},
        success : function(response){
            //alert(response);
            $("#loadvariations").load(" #loadvariations");
            $("#loadtableabut").load(" #loadtableabut");
            $("#alertvertion").text('Successfully Deleted');
        }        
    });
}





function imagesPreview(input, placeToInsertImagePreview) {
    if (input.files) {
        var filesAmount = input.files.length;
        var validImagesCount = parseInt($(".inputmultiimages").val() || 0);

        for (let i = 0; i < filesAmount; i++) {
            var file = input.files[i];
            var fileType = file.type;

            // Clear previous errors
            $('#file-type-error, #image-error, #file-size-error').remove();

            // Check file type
            if (fileType === "image/jpeg" || fileType === "image/png") {

                // ✅ Check file size (max 1MB)
                if (file.size > 1048576) {
                    $('<div id="file-size-error" style="color: red;">Please upload an image less than 1MB.</div>')
                        .insertAfter(input);
                    $('.mutliimages').val('');
                    return false;
                }

                var reader = new FileReader();

                reader.onload = function(event) {
                    var img = new Image();
                    img.src = event.target.result;

                    img.onload = function() {
                        // ✅ Check image dimensions
                        if (img.width === 720 && img.height === 720) {
                            $('<img class="img-responsive set-mutli-img" style="width:100px; height:100px;">')
                                .attr('src', event.target.result)
                                .appendTo(placeToInsertImagePreview);
                            validImagesCount++;
                        } else {
                            $('<div id="image-error" style="color: red;">Image dimensions should be exactly 720x720 pixels.</div>')
                                .insertAfter(input);
                            $('.mutliimages').val('');
                            return false;
                        }

                        $(".inputmultiimages").val(validImagesCount);
                    };
                };

                reader.readAsDataURL(file);
            } else {
                // Invalid file type
                $('<div id="file-type-error" style="color: red;">Only .jpg and .png files are allowed.</div>')
                    .insertAfter(input);
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


/*Promo code adds *****************/
function singlfileprivewilPromo() {
    var fileInput = document.getElementById('multisinlpromo');
    var file = fileInput.files[0];
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    } else if (file.size > 1048576) {
        alert('Please upload less than 1MB.');
        fileInput.value = '';
        return false;
    } else {
       
        var reader = new FileReader();
        reader.onload = function(e) {  
            var img = new Image();
            img.onload = function() {
                 if (img.width == 720 || img.width == 384) {
        document.getElementById('singleimagepvone').innerHTML =
            '<img src="' + e.target.result + '" class="img-responsive" style="max-width:100%; height:auto;"/>';
    }  else {
                  alert('Image size 720x384 px');
                fileInput.value = '';
                return false;
            }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}



function singlfileprivewildone() {
    var fileInput = document.getElementById('multisinlpvone');
    var file = fileInput.files[0];
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    } else if (file.size > 1048576) {
        alert('Please upload less than 1MB.');
        fileInput.value = '';
        return false;
    } else {
        
        var reader = new FileReader();
        reader.onload = function(e) {  
            var img = new Image();
            img.onload = function() {
                 if (img.width >= 450 && img.width <= 550 && img.height >= 540 && img.height <= 660) {
        document.getElementById('singleimagepvone').innerHTML =
            '<img src="' + e.target.result + '" class="img-responsive" style="max-width:100%; height:auto;"/>';
    }  else {
                  alert('Image size must be between 450x540 px and 550x660 px');
                fileInput.value = '';
                return false;
            }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}


function singlfileprivewiltwo() {
    var fileInput = document.getElementById('multisinlpvtwo');
    var file = fileInput.files[0];
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return;
    }

    if (file.size > 1048576) {
        alert('Please upload less than 1MB.');
        fileInput.value = '';
        return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
            if (img.width >= 1500 && img.width <= 1700 && img.height >= 500 && img.height <= 550) {
                document.getElementById('singleimagepvtwo').innerHTML =
                    '<img src="' + e.target.result + '" class="img-responsive"/>';
            } else {
                 alert("Image size must be between 1500x500 px and 1700x550 px.");
                fileInput.value = '';
                   return false;
            }
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

/*Product Category Image*/
function categoryimg() {
    var fileInput = document.getElementById('multisinlpvtwo');
    var file = fileInput.files[0];
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return;
    }

    if (file.size > 1048576) {
        alert('Please upload less than 1MB.');
        fileInput.value = '';
        return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
            if (img.width === 120 && img.height === 120) {
                document.getElementById('singleimagepvtwo').innerHTML =
                    '<img src="' + e.target.result + '" class="img-responsive"/>';
            } else {
                 alert("Image size must be 120x120px.");
                
                   return false;
            }
        };
        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

/*Slider validation Image*/
let imageValid = false;
let lastValidImageSrc = '';

function sliderfileprivewildone() {
    const fileInput = document.getElementById('multisliderone');
    const previewDiv = document.getElementById('sliderimagepve');
    const file = fileInput.files[0];

    
    imageValid = false; // Reset on every file select
    previewDiv.innerHTML = ''; // Clear old preview
    if (!file) return false;
    

    const filePath = file.name;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Please upload a file with extension .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
    }
    if (file.size > 1048576) {
        alert('Please upload a file smaller than 1MB.');
       // fileInput.value = '';
        return false;
    }
    const reader = new FileReader();
    reader.onload = function (e) {
        const img = new Image();
        img.onload = function () {
            if (img.width === 1920 && img.height === 767) {

                previewDiv.innerHTML = `<img src="${e.target.result}" class="img-responsive"/>`;
                lastValidImageSrc = e.target.result; 
                imageValid = true;
            } else {
                alert("Image size must be exactly 1920x767 px.");
                fileInput.value = '';
                    }
        };
        img.onerror = function () {
            alert("Invalid image file.");
            previewDiv.innerHTML = '';
            fileInput.value = '';
            imageValid = false;
        };

        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}


/*Mobile slider image*/

function sliderfileprivewiltwo() {
    var fileInput = document.getElementById('multsliderimg');
    const previewDiv = document.getElementById('singleimagepvtwo');
    var file = fileInput.files[0];
      imageValid = false; // Reset on every file select
    previewDiv.innerHTML = ''; // Clear old preview
    if (!file) return false;
    var filePath = file.name;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
          alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
      fileInput.value = '';
      return false;
    }

    if (file.size > 1048576) {
         alert('Please upload a file smaller than 1MB.');
      fileInput.value = '';
      return false;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
        var img = new Image();
        img.onload = function() {
                if (img.width === 650 && img.height === 420) {
                 previewDiv.innerHTML ='<img src="' + e.target.result + '" class="img-responsive"/>';
                  lastValidImageSrc = e.target.result; 
                imageValid = true;
            } else {
               alert("Image size must be exactly 1920x767 px.");
          fileInput.value = '';
            }
        };
          img.onerror = function () {
            alert("Invalid image file.");
            previewDiv.innerHTML = '';
            fileInput.value = '';
            imageValid = false;
        };

        img.src = e.target.result;
    };
    reader.readAsDataURL(file);
}


</script>
<script type="text/javascript">
        $(function () {
            $("#btnExport").click(function () {
             $(".tableexportcsv td").each(function () {
            $(this).html($(this).html().replace(/<br\s*\/?>|\n|\r/g, " "));
        });

                $(".tableexportcsv").table2excel({
                    filename: "<?php echo $date; ?>-<?php echo $time; ?>-data.xls"
                });
            });
        });
        $(".sidebar-mini .navbar-nav").click(function(){
            $(".sidebar-mini").toggleClass("sidebar-collapse");
        });
        $("#sidebar-overlay").click(function(){
            $(".sidebar-mini").addClass("sidebar-collapse").removeClass("sidebar-open");
        });
    </script>
     <script>
    /******************RESET data PAssword admmin panel for vendor***************************/

$(document).ready(function () {
  // Toggle password visibility
  $('.toggle-password, .toggle-password-new').on('click', function (e) {
    e.preventDefault();
    const passwordInput = $(this).closest('.input-group').find('input');
    const icon = $(this).find('i');

    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      icon.removeClass('fa-eye-slash').addClass('fa-eye');
    } else {
      passwordInput.attr('type', 'password');
      icon.removeClass('fa-eye').addClass('fa-eye-slash');
    }
  });


  function isValidPassword(password) {
    const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return pattern.test(password);
  }

  
  $('#passwordForm').on('submit', function (e) {
    let isValid = true;
    const newPassword = $('#newPassword').val().trim();
    const retypePassword = $('#retypePassword').val().trim();

  
    $('.error-message').hide();

   
    if (!isValidPassword(newPassword)) {
      $('#newPassError')
        .text('Password must be at least 8 characters and include uppercase, lowercase, number, and special character.')
        .show();
      isValid = false;
    }

    
    if (newPassword !== retypePassword) {
      $('#retypePassError').text('Passwords do not match. Please try again.').show();
      isValid = false;
    }

   
    if (!isValid) {
      e.preventDefault(); 
    }
  
  });
  $('#resetpassword').on('hidden.bs.modal', function () {
    $('#passwordForm')[0].reset(); 
    $('.error-message').hide(); 
  });
  
 $('.btn-secondary[data-dismiss="modal"]').on('click', function () {
    $('#passwordForm')[0].reset();
    $('.error-message').hide(); 
  });
 

  
  $('input').on('input', function () {
    $(this).closest('.form-group').find('.error-message').hide();
  });
});




$(document).ready(function() {
        $('#datapegination').DataTable();
    });
    
   /******Review Section**/
   
    $(document).ready(function() {
    $('#review').DataTable();
  });
  
  
   $('.gstno').keypress(function (e) {
       if (!String.fromCharCode(e.keyCode).match(/[a-zA-Z0-9]/)) {
    e.preventDefault(); 
  }
      });
$('#example1233').DataTable({
    order: [[6, 'desc']]
});


    $('#produtattr').DataTable({
    order: [[1, 'desc']]
});
   $(document).ready(function () {
      $('.select-search').select2({
        placeholder: "Select a parent category",
       
      });
    });   


    // Submit remark
   
    $(document).on("click", ".openRemarkModal", function () {
    var id = $(this).data("id");
    $("#luckydraw_id").val(id);
    $("#remarkModal").modal("show");
});
$("#remarkForm").submit(function(e) {
    e.preventDefault();

    $.ajax({
        url: "luckydraw_remark.php",
        type: "POST",
        data: $(this).serialize(), // action is included now
        dataType: "json",
        success: function(res) {

            if (res.status === "success") {
                $("#remarkMsg")
                    .removeClass("d-none alert-danger")
                    .addClass("alert alert-success")
                    .html(res.message);

                setTimeout(function() {
                    $("#remarkModal").modal("hide");
                    $("#remarkForm")[0].reset();
                    location.reload();
                }, 900);

            } else {
                $("#remarkMsg")
                    .removeClass("d-none alert-success")
                    .addClass("alert alert-danger")
                    .html(res.message);
            }
        },
        error: function() {
            alert("Something went wrong!");
        }
    });
});
// Reset form when modal is closed manually
$('#exampleModal').on('hidden.bs.modal', function () {
    $("#remarkForm")[0].reset();                   // Reset form fields
    $("#remarkMsg").addClass("d-none")             // Hide message
        .removeClass("alert-success alert-danger")
        .html('');                                 // Clear message text
});

// double-click / double-tap se image download

$(document).on("dblclick", ".billImage", function () {
    let imgUrl = $(this).data("src");

    // Create temp link & download
    let link = document.createElement("a");
    link.href = imgUrl;
    link.download = imgUrl.split("/").pop(); // image filename
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
  </script>
</body>
</html>