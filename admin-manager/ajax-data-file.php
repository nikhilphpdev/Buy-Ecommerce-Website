<?php

header('Content-Type: application/json');


include('../dis-setting/config-settings/config.php');

include('../dis-setting/config-settings/functions-board.php');



date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)

$date = date('d-m-Y');

$time = date('H:i:s');

$full_path = realpath(dirname(__FILE__));

$explode_file_path = explode('/admin-manager', $full_path);

$file_path = $explode_file_path[0];
$floder_path_name = $file_path."/images";
$url = "https://testing.buyjee.com/";

if(isset($_POST['postchkingname'])){

	$_page_namedat = $_POST['postpahename'];

	echo "ok";

}


/********************Parents menu  delete code**************/

if (isset($_POST['menueremove'])) {

    try {
        if (!isset($_POST['menuremveid']) || empty($_POST['menuremveid'])) {
            throw new Exception('Invalid ID');
        }

        $remove_menu_id = intval($_POST['menuremveid']);
        $softDeleteQuery = "DELETE FROM menudatatable  WHERE id = '$remove_menu_id'";
        $queryResult = $contdb->query($softDeleteQuery);
        if ($queryResult === true) {
            echo 1;
        } else {
            throw new Exception('Delete failed');
        }
    } catch (Exception $e) {
        // Log the error if needed
        // error_log($e->getMessage());

        echo 0;
    }
    die;
}
/*Notification code */

if (isset($_POST['actionn']) && $_POST['actionn'] === 'notify') {
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

    if (function_exists('updateNotificationStatus')) {
        $response = updateNotificationStatus($id, $status);

    } else {
        $response = ['success' => false, 'message' => 'Function not found.'];
    }

    echo json_encode($response);
    if (isset($contdb)) {
        $conn->close();
    }
} 

/************Menu update*************/
if (isset($_POST['update_menu'])) {
    $id = intval($_POST['id']);               
    $menu_id = intval($_POST['menu_id']);     
    $menu_name = trim($_POST['menu_name']);  

    $update_sql = "UPDATE menudatatable 
                   SET menu_name = '$menu_name'
                   WHERE id = $id";

    $result = $contdb->query($update_sql);

    if ($result === true) {
        $update_product_cat = "UPDATE product_categories 
                               SET prd_cat_name = '$menu_name'
                               WHERE id = $menu_id";

        $contdb->query($update_product_cat);
        echo "1";
    } else {
        echo "0";
    }
    exit;
}

/****************Venodr Filters *******************************/
try {
    if (isset($_POST['vendorfilter'])) {
        $vname = trim($_POST['name'] ?? '');
        $vemail = trim($_POST['email'] ?? '');
        $vphone = trim($_POST['phone'] ?? '');
        $vgstno = trim($_POST['gstno'] ?? '');
        $vstatus = $_POST['status'] ?? 'All';

        $allVendors = GetVenderDatavale();
        if (!is_array($allVendors)) {
            echo json_encode(['success' => false, 'message' => 'Failed to get vendor data']);
            return;
        }

        $vendorfiltered = array_filter($allVendors, function ($vendor) use ($vname, $vemail, $vphone, $vgstno, $vstatus) {
            $login = GetPermissionvalData($vendor['vendor_auto'])[0] ?? [];

            if ($vstatus !== 'All') {
                if ($vstatus == '1' && ($login['user_p_block'] ?? '') != '1') return false;
                if ($vstatus == '0' && ($login['user_p_block'] ?? '') != '0') return false;
            }

            if ($vname && stripos($vendor['vendor_f_name'] . ' ' . $vendor['vendor_l_name'], $vname) === false) return false;
            if ($vphone && stripos($vendor['vendor_phone'], $vphone) === false) return false;
            if ($vgstno && stripos($vendor['gst_no'], $vgstno) === false) return false;
            if ($vemail && stripos($vendor['vendor_email'], $vemail) === false) return false;

            return ($login['user_p_email_ap'] ?? '') === '1';
        });

        $vndtotal = count($vendorfiltered);

        $page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int) $_POST['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $slicedvnd = array_slice($vendorfiltered, $offset, $limit);

        $html = "<thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Company Name</th>
                <th>Email Id</th>
                <th>Phone</th>
                <th>GST No.</th>
                <th>Date / Time</th>
                <th>Approved Status</th>
                <th>Action</th>
            </tr>
        </thead>";

        if (empty($slicedvnd)) {
            $html .= "<tbody><tr><td colspan='9' class='text-center'>Vendor data Not found.</td></tr></tbody>";
        } else {
            foreach ($slicedvnd as $vendor) {
                $login = GetPermissionvalData($vendor['vendor_auto'])[0] ?? [];

                $vendorImg = $vendor['vendor_img'];
                $imgSrc = !empty($vendorImg) ? "$url/images/$vendorImg" : "$url/customer/images/default-user-icon.jpg";

                $rowClass = ($login['user_p_block'] == "1") ? "blockvendor" : "unblockvendor";
                $statusIcon = ($login['user_p_block'] == "1")
                    ? "<a href='$url/admin-manager/vendors/?block={$vendor['vendor_auto']}&blockcation=1' title='Click to Un Block'><i class='fa fa-eye-slash'></i></a>"
                    : "<a href='$url/admin-manager/vendors/?block={$vendor['vendor_auto']}&blockcation=0' title='Click to Block'><i class='fa fa-eye'></i></a>";
                   
                   
                $html .= "<tbody><tr class='$rowClass'>
                    <td><img src='$imgSrc' style='width: 30%;'></td>
                    <td>{$vendor['vendor_f_name']} {$vendor['vendor_l_name']}</td>
                    <td>" . ($vendor['vendor_company'] ?? 'N/A') . "</td>
                    <td>" . ($vendor['vendor_email'] ?: 'N/A') . "</td>
                    <td>" . ($vendor['vendor_phone'] ?: 'N/A') . "</td>
                    <td>" . (strtoupper($vendor['gst_no']) ?: 'N/A') . "</td>
                    <td>" . USATimeZoneSettime($vendor['vendor_date']) . "<br>" . $vendor['vendor_time'] . "</td>
                    <td>$statusIcon</td>
                    <td class='text-right py-0 align-middle'>
                        <div class='btn-group btn-group-sm'>
                            <a href='$url/admin-manager/vendors-page?action=edit&id={$vendor['vendor_auto']}' class='btn btn-info'><i class='fa fa-pencil'></i></a>
                            <button type='button' class='btn btn-danger deletebtn' data-toggle='modal' data-target='#delete' data-id='$url/admin-manager/vendors/?action=delete&id={$vendor['id']}&eandid={$vendor['vendor_auto']}'><i class='fa fa-trash'></i></button>
                        </div>
                    </td>
                </tr></tbody>";
            }
        }

        // Pagination
        $pagination = '';
        if ($vndtotal > 0) {
            $totalPages = ceil($vndtotal / $limit);
            $pagination .= '<ul class="pagination mt-3">';

            if ($page > 1) {
                $pagination .= "<li class='page-item'><a class='page-link vendorpage-link' href='#' data-page='" . ($page - 1) . "'>Prev</a></li>";
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                $pagination .= "<li class='page-item $active'><a class='page-link vendorpage-link' href='#' data-page='$i'>$i</a></li>";
            }

            if ($page < $totalPages) {
                $pagination .= "<li class='page-item'><a class='page-link vendorpage-link' href='#' data-page='" . ($page + 1) . "'>Next</a></li>";
            }

            $pagination .= '</ul>';
        }

        echo json_encode([
            'success' => true,
            'html' => trim($html),
            'pagination' => trim($pagination),
            'total' => $vndtotal
        ]);
        return;
    }
} catch (Exception $e) {
    error_log("Vendor Filter Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    exit;
}



/***************Customer Filters   ***************************/


try {
    if (isset($_POST['customerfilter'])) {
   
       // $response = [];
        $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $customertype = trim($_POST['customertype'] ?? '');
    $status = $_POST['status'] ?? 'All';
  
   // Pagination variables
    $limit = 10;
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $page = max($page, 1);
  $offset = ($page - 1) * $limit;

$currentPage = $page; 
$limitPerPage = $limit;
    $allCustomers = GetCustomerDataVal();

    $filtered = array_filter($allCustomers, function ($customer) use ($name, $email, $phone,$customertype, $status) {
        if ($status !== 'All' && $customer['customer_active'] != $status) return false;
        if ($name && stripos($customer['customer_fname'] . ' ' . $customer['customer_lname'], $name) === false) return false;
         if ($customertype) {
           
        $typesArray = explode(',', $customer['customer_type']);
        if (!in_array($customertype, array_map('trim', $typesArray))) return false;
    }

        if ($phone && stripos($customer['customer_phone'], $phone) === false) return false;

        if ($email) {
            $userDetails = GetLoginUserDetails($customer['customer_ui_id']);
            $userEmail = $userDetails[0]['user_email'] ?? '';
            if (stripos($userEmail, $email) === false) return false;
        }
        return true;
    });

    $total = count($filtered);
    $sliced = array_slice($filtered, $offset, $limit);
  
$html="";
      $html= " <thead>
    <tr>
      <th>Images</th>
      <th>Joining Date</th>
      <th>Name</th>
      <th>Email Id</th>
      <th>Phone No.</th>
       <th>Customer Type</th>
      <th>Street Address</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>";
  if (empty($sliced)) {
    $html .= "<tbody><tr><td colspan='9' class='text-center'>No customer data found.</td></tr></tbody>";
} else {
    foreach ($sliced as $customer) {
     
        $login = GetLoginUserDetails($customer['customer_ui_id'])[0] ?? [];

        $statusIcon = $customer['customer_active'] == '0'
            ? "<a href='$url/admin-manager/all-customer/?block=".$customer['id']."&blockcation=0' title=' Click to Unblock' ><i class='fa fa-eye-slash'></i></a>"
            : "<a href='$url/admin-manager/all-customer/?block=".$customer['id']."&blockcation=1' title='Click to Block' ><i class='fa fa-eye'></i></a>";

        $img = $customer['customer_img'] == '0' ? "$url/customer/images/default-user-icon.jpg" : "$url/images/{$customer['customer_img']}";
        
  $customer_date = !empty($customer['customer_date'])  ? date("d-m-Y", strtotime($customer['customer_date'])) . "<br>" . date("h:i A", strtotime($customer['customer_date']))  : 'N/A';
      $html .= "<tbody><tr>
        <td style='width: 20%;'><img src='$img' style='width: 30%;'></td>
        <td>{$customer_date}</td>
        <td>{$customer['customer_fname']} {$customer['customer_lname']}</td>
        <td>" . ($login['user_email'] ?? 'N/A') . "</td>
        <td>" . ($customer['customer_phone'] ?: 'N/A') . "</td>
      <td>" . (!empty($customer['customer_type']) 
    ? str_replace(',', ',<br>', $customer['customer_type']) 
    : 'N/A') . "</td>
        <td>" . ($customer['customer_address'] ?: 'N/A') . "</td>
        <td>$statusIcon</td>
        <td class='text-right py-0 align-middle'>
          <div class='btn-group btn-group-sm'>
          <a href='" . $url . "/admin-manager/single-customer/?id=" . $customer['id'] . "&autoid=" . $customer['customer_ui_id'] . "' target='_blank' class='btn btn-info'><i class='fa fa-pencil'></i></a>
            <a href='" . $url . "/admin-manager/all-customer/?delete=action&id=" . $customer['id'] . "' class='btn btn-danger'>
              <i class='fas fa-trash'></i>
            </a>
          </div>
        </td>
    </tr></tbody>";
       
    }
}
 
    $limit =10;
   $totalPages = ceil($total / $limit); 
$startPage = max(1, $currentPage - 2);
$endPage = min($totalPages, $currentPage + 2);
    $pagination = '<ul class="pagination mt-3">';

// Previous Set Button
if ($startPage > 1) {
    $prevSetPage = max(1, $startPage - $limitPerPage);
    $pagination .= "<li class='page-item'><a class='page-link pagination-link' href='#' data-page='$prevSetPage'>Prev</a></li>";
}
// Page Numbers
for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = ($i == $currentPage) ? "active" : "";
    $pagination .= "<li class='page-item $activeClass'><a class='page-link pagination-link' href='#' data-page='$i'>$i</a></li>";
}
// Next Set Button
if ($endPage < $totalPages) {
    $nextSetPage = min($totalPages, $endPage + 1);
    $pagination .= "<li class='page-item'><a class='page-link pagination-link' href='#' data-page='$nextSetPage'>Next</a></li>";
}
$pagination .= '</ul>';
    echo json_encode([
        'success' => true,
        'html' => trim($html),
        'pagination' => trim($pagination),
        'totalcustomer' => trim($total)
    ]);
   return;
       
        }
}
catch (Exception $e) {
   
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    exit;
}

/*listing admin Product delete code */
try {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $response = [];

        // Handle Delete
       
            if ($action === 'delete' || $action === 'soft_delete') {
                
        $id = $_POST['id'] ?? null;
        $eandid = $_POST['eandid'] ?? null;
    
        if ($id && $eandid) {
            $table = 'all_product';
            if ($action === 'soft_delete') {
                $query = "UPDATE $table SET is_deleted = 2 ,product_status = 0 WHERE id='$id' AND product_auto_id='$eandid'";
            } else {
                $query = "DELETE FROM $table WHERE id='$id' AND product_auto_id='$eandid'";
            }
    
            $result = $contdb->query($query);
            $response = $result 
                ? ['success' => true, 'message' => 'Item deleted successfully']
                : ['success' => false, 'message' => 'Failed to delete item', 'error' => $contdb->error];
        } else {
            $response = ['success' => false, 'message' => 'Invalid delete parameters'];
        }
    }

        // Handle Toggle
        elseif ($action === 'togglle') {
          
            $id = $_POST['id'] ?? null;
            $eandid = $_POST['eandid'] ?? null;
             $vt = isset($_POST['vt']) && ($_POST['vt'] === '0' || $_POST['vt'] === '1') ? $_POST['vt'] : null;

            if ($id && $eandid && $vt !== null) {
                $updateQuery = "UPDATE all_product SET product_status='$vt',is_deleted = 0 WHERE id='$id' AND product_auto_id='$eandid'";
          
                $queryResult = $contdb->query($updateQuery);
                   
                $response = $queryResult 
                    ? ['success' => true, 'message' => 'Status updated successfully']
                    : ['success' => false, 'message' => 'Failed to update status', 'error' => $contdb->error];
               

            } else {
                $response = ['success' => false, 'message' => 'Invalid toggle parameters'];
                    

            }
            
        }
        // Handle Add Attribute
        elseif ($action === 'add_attribute') {
           
            $attbutdata = $_POST['attbutdata'] ?? null;
            $prod_pagid = $_POST['prod_pagid'] ?? null;
            $page_autoid = $_POST['prod_pageautid'] ?? null;

            if ($attbutdata || $prod_pagid || $page_autoid) {
                $attbut_id = explode('|', $attbutdata)[0];
               
                // Check if attribute already exists
                $checkQuery = "SELECT * FROM product_active_attbut WHERE attbut_id = '$attbut_id' AND attbut_productid = '$page_autoid'";
                $checkResult = $contdb->query($checkQuery);

                if ($checkResult && $checkResult->num_rows > 0) {
                    $response = ['status' => 'exists', 'message' => 'Attribute already exists'];
                } else {
              
                    $insertQuery = "INSERT INTO product_active_attbut (attbut_id, attbut_productid, attbut_vertionid) 
                                    VALUES ('$attbut_id', '$page_autoid', '$prod_pagid')";
                                  
                    $insertResult = $contdb->query($insertQuery);
                    $response = $insertResult 
                        ? ['status' => 'success', 'message' => 'Attribute added successfully']
                        : ['status' => 'error', 'message' => 'Failed to add attribute', 'error' => $contdb->error];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Invalid parameters for add attribute'];
            }
        }
        // Handle Save Attributes (`save_attbut`)
        elseif ($action === 'save_attbut') {
            $_Get_attbutname = $_POST['attbutvalue'] ?? []; 
     
            $autoid = $_POST['autoids'] ?? null; 

            $response = ['status' => 'success', 'inserted' => 0, 'skipped' => 0, 'message' => ''];

            if ($autoid && !empty($_Get_attbutname)) {
                foreach ($_Get_attbutname as $attbutsaveval) {
                    foreach ($attbutsaveval as $vertiondataval) {
                        $set_explodeval = explode('|', $vertiondataval);
                        $get_firstval = addslashes($set_explodeval[0]); // Variation value
                        $get_secondtval = trim($set_explodeval[1]); // Attribute ID
                        $get_threeval = trim($set_explodeval[2]); // Session ID

                        // Check if the record already exists
                        $check_query = "SELECT * FROM product_variationsdata WHERE proval_trm_value='$get_firstval' AND proval_trm_attid='$get_secondtval' AND proval_trm_seeionid='$get_threeval'";


                        $result = $contdb->query($check_query);

                        if ($result && $result->num_rows > 0) {
                         
                            $response['skipped']++;
                        } else {
                            // Insert new record
                            $insert_query = "INSERT INTO product_variationsdata 
                                (proval_trm_value, proval_trm_attid, proval_trm_seeionid, proval_trm_sku, 
                                 proval_trm_rag_price, proval_trm_sale_price, proval_trm_quanty, proval_trm_postion) 
                                VALUES ('$get_firstval', '$get_secondtval', '$get_threeval', '', '', '', '', '')";
                                
                              

                            if ($contdb->query($insert_query)) {
                                $response['inserted']++;
                            } else {
                                $response = ['status' => 'error', 'message' => 'Insert failed: ' . $contdb->error];
                                echo json_encode($response);
                                exit;
                            }
                        }
                    }
                }
                $response['message'] = "new records inserted.";
            } else {
                $response = ['status' => 'error', 'message' => 'Select  attributes'];
            }
        } 
        
         // Handle versave
        elseif ($action === 'versave') {
          $selection = $_POST['selection'];
                  
        	$rgprice = $_POST['reglarprice'];
        	$slprice = $_POST['saleprice'];
        	$quntyprc = $_POST['quntyval'];
        	$lowstock = $_POST['lowstockvale'];

            if($_POST['productchk'] == "new"){
		$sessionidvale = $_POST['sessionautis'];
	}else{
		$sessionidvale = $_POST['sessionautis'];
	}

 $blank_removl = array_filter($selection);
    if (count($blank_removl) == 1) {
        $single_value = reset($blank_removl); // Get the single value
    $implovertisavetrem = $single_value . ',0';
  
    }else{
    $implovertisavetrem = implode(',', $blank_removl);
    
       }

                    // Check if the variation already exists
                    $cehck_valt = "SELECT * FROM product_attbut_vartarry WHERE prot_trm_id='$implovertisavetrem' AND prot_trm_prodtid='$sessionidvale'";
                	$query_vale = $contdb->query($cehck_valt);

                    if ($query_vale && $query_vale->num_rows > 0) {
                        $response = ['success' => false, 'message' => 'Variation already exists.'];
                    } else {
                        // Insert the new variation
                        $update_quntyval = "INSERT INTO product_attbut_vartarry(prot_trm_id,prot_trm_regulprc,prot_trm_saleprc,prot_trm_quantity,prot_trm_prodtid,prot_trm_postion,prot_trm_lowstck)VALUES('$implovertisavetrem','$rgprice','$slprice','$quntyprc','$sessionidvale','','$lowstock')";
		          
		              	$query_insertvale = $contdb->query($update_quntyval);
                        if ($query_insertvale) {
                            $response = ['success' => true, 'message' => 'Variation saved successfully.'];
                        } else {
                            $response = ['success' => false, 'message' => 'Failed to save variation.', 'error' => $contdb->error];
                        }
                    }
              
        }
        
        elseif ($action === 'delettrem') {
            $get_vertremid = $_POST['verindiddelt'] ?? null;
            $chkvaldelt = $_POST['chkvaldelt'] ?? null;
            $seeionval_delt = $_POST['getautoidval'] ?? null;

            if ($get_vertremid && $chkvaldelt && $seeionval_delt) {
                $sessinpld_delt = $chkvaldelt === "new" ? $seeionval_delt : $seeionval_delt;

                // Retrieve the record to confirm existence
                $get_deletevale = "SELECT * FROM product_attbut_vartarry WHERE id='$get_vertremid'";
                $query_get_valedata = $contdb->query($get_deletevale);

                if ($query_get_valedata && $query_get_valedata->num_rows > 0) {
                    $get_idesname = [];
                    while ($rowget_arrayval = $query_get_valedata->fetch_array()) {
                        $get_idesname[] = $rowget_arrayval['prot_trm_id'];
                    }

                    // Delete the record
                    $delectvertm = "DELETE FROM product_attbut_vartarry WHERE id='$get_vertremid'";
                    $querydelect = $contdb->query($delectvertm);

                    $response = $querydelect
                        ? ['success' => true, 'message' => 'Successfully deleted.']
                        : ['success' => false, 'message' => 'Failed to delete.', 'error' => $contdb->error];
                } else {
                    $response = ['success' => false, 'message' => 'Record not found.'];
                }
            } else {
                $response = ['success' => false, 'message' => 'Invalid delete parameters'];
            }
        }
 
       elseif ($action === 'updatevertion') {

    $selection_udate = $_POST['selection'];
        
    $blank_removecal = array_filter($selection_udate);
    if (count($blank_removecal) == 1) {
        $single_value = reset($blank_removecal); // Get the single value
    $implodarray_udate = $single_value . ',0';
  
    }else{
    $implodarray_udate = implode(',', $blank_removecal);
    
       }
    $rgprice_udate = $_POST['reglarprice'];
    $slprice_udate = $_POST['saleprice'];
    $quntyprc_udate = $_POST['quntyval'];
    $lowstockvale_udate = $_POST['lowstockupdate'];

    if ($_POST['editvale'] == "new") {
        $sessionidvale_udate = $_POST['sessiongetid'];
    } else {
        $sessionidvale_udate = $_POST['sessiongetid'];
    }

    $vertremid_udate = $_POST['verttrenid'];

    $update_chking_vrt = "SELECT * FROM product_attbut_vartarry WHERE id='$vertremid_udate'";
    $query_vertionchk = $contdb->query($update_chking_vrt);

    if ($query_vertionchk->num_rows > 0) {
        $chking_data_vertion = "SELECT * FROM product_attbut_vartarry WHERE id='$vertremid_udate' AND prot_trm_regulprc='$rgprice_udate' AND prot_trm_saleprc='$slprice_udate' AND prot_trm_quantity='$quntyprc_udate' AND prot_trm_lowstck='$lowstockvale_udate'";
        $query_chkingvaldat = $contdb->query($chking_data_vertion);

        if ($query_chkingvaldat->num_rows > 0) {
            $response = ['success' => true, 'message' => 'Successfully Updated.'];
        } else {
            $update_quntyval_udate = "UPDATE product_attbut_vartarry SET prot_trm_id='$implodarray_udate', prot_trm_regulprc='$rgprice_udate', prot_trm_saleprc='$slprice_udate', prot_trm_quantity='$quntyprc_udate', prot_trm_lowstck='$lowstockvale_udate' WHERE id='$vertremid_udate'";
          
            $contdb->query($update_quntyval_udate);
            $response = ['success' => true, 'message' => 'Successfully Updated.'];
        }
    } 
        $update_quntyval_udate = "UPDATE product_attbut_vartarry SET prot_trm_id='$implodarray_udate', prot_trm_regulprc='$rgprice_udate', prot_trm_saleprc='$slprice_udate', prot_trm_quantity='$quntyprc_udate', prot_trm_lowstck='$lowstockvale_udate' WHERE id='$vertremid_udate'";
        
        $contdb->query($update_quntyval_udate);
        $response = ['success' => true, 'message' => 'Successfully Updated.'];
    
}
       /**************product filter code**********************/
       
     

        elseif ($action === 'filterform') {
            $pname = trim($_POST['pname']) ?? '';
            $sku = trim($_POST['sku']) ?? '';
            $vfilter = trim($_POST['vfilter']) ?? '';
           
$added_date_range = $_POST['added_date_range'] ?? '';

$rawCategory = $_POST['category'] ?? ''; 
$category = preg_replace('/^\d+\|/', '', $rawCategory);

$categoryParts = array_filter(explode('/', $category));
$categoryFilter = '';
if (!empty($category) && $category !== "All Categories") {
    $categoryParts = array_filter(explode('/', $category)); // ['up', 'test']

    if (!empty($categoryParts)) {
        $conditions = [];
        foreach ($categoryParts as $cat) {
            $cat = mysqli_real_escape_string($contdb, trim($cat));
            $conditions[] = "product_catger LIKE '%{$cat},%'";
        }

        if (!empty($conditions)) {
            $categoryFilter = " AND (" . implode(" OR ", $conditions) . ")";
        }
    }
}
        /*echo'<pre>'; print_r($categoryFilter); die;*/
            $status = $_POST['status'];
        
        $statusCondition = "";

if ($status === "2") {
 
    $statusCondition = "AND is_deleted = 2 ";
} else {
    $statusCondition = "AND is_deleted != 2 ";

    if ($status === "1" || $status === "0") {
        $statusCondition .= "AND product_status = " . (int)$status . " ";
    }
}

$vendorCondition = '';
if (!empty($vfilter)) {
    $vendorCondition = " AND product_vender_id = '" . mysqli_real_escape_string($contdb, $vfilter) . "' ";
}

$dateCondition = "";
if (!empty($added_date_range)) {
     $range = $added_date_range; 

    $dates = explode(' - ', $range);

    if(count($dates) === 2) {
        $date_from = DateTime::createFromFormat('d/m/Y', trim($dates[0]))->format('d-m-Y');
        $date_to   = DateTime::createFromFormat('d/m/Y', trim($dates[1]))->format('d-m-Y');
      $dateCondition = " AND STR_TO_DATE(product_date, '%d-%m-%Y')
                           BETWEEN STR_TO_DATE('$date_from', '%d-%m-%Y')
                           AND STR_TO_DATE('$date_to', '%d-%m-%Y') ";
                            

    }
    
}

$orderBy = '';
if (!empty($vfilter)) {
    $orderBy = " ORDER BY 
        STR_TO_DATE(
            CONCAT(p.product_date, ' ', p.product_time),
            '%d-%m-%Y %h:%i %p'
        ) DESC,
        p.id DESC";
}


            // Pagination variables
    $limit = 10;
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $page = max($page, 1); // Ensure page is at least 1
    $offset = ($page - 1) * $limit;
    
       // Query to filter products
    $query = "SELECT 
            p.*, 
            v.vendor_f_name , 
            v.vendor_l_name 
        FROM all_product p
        JOIN vendor v ON p.product_vender_id = v.vendor_auto
        WHERE 1 " .
         $statusCondition .
        (!empty($pname) ? "AND p.product_name LIKE '%" . mysqli_real_escape_string($contdb, $pname) . "%' " : "") .
        (!empty($sku) ? "AND p.product_sku LIKE '%" . mysqli_real_escape_string($contdb, $sku) . "%' " : "") .
        $vendorCondition .
        $dateCondition .
        $categoryFilter .
        "ORDER BY STR_TO_DATE(CONCAT(p.product_date, ' ', p.product_time), '%d-%m-%Y %h:%i %p')  DESC
         LIMIT $limit OFFSET $offset";

    $result = mysqli_query($contdb, $query);
          
    if (!$result) {
        die("Database Error: " . mysqli_error($contdb));
    }

   $output = "";
     $output = "<thead>
            <tr>
                <th style='width: 10%;'>Image</th>
                <th style='width: 10%;'>Product Name</th>
                 <th style='width: 10%;'>Vendor Name</th>
                <th style='width: 5%;'>SKU</th>
                <th class='cust-wid' style='width: 20%;'>Categories</th>
                <th style='width: 10%;'>MRP</th>
                <th style='width: 10%;'>Selling Price</th>
                <th style='width: 10%;'>Date/Time</th>
                 <th style='width: 10%;'>Modify(Date/Time)</th>
                <th style='width: 5%;'>Status</th>
                <th style='width: 10%;'>Action</th>
            </tr>
        </thead>";
    while ($row = mysqli_fetch_assoc($result)) {
     
$productCat = !empty($row['product_catger']) ? $row['product_catger'] : 'N/A';
$product_modifydate = !empty($row['product_modifydate'])  ? date("d-m-Y", strtotime($row['product_modifydate'])) . "<br>" . date("h:i A", strtotime($row['product_modifydate']))  : 'N/A';

      $output .= "<tbody><tr>
    <td class='setimg'><img src='$url/images/{$row['product_image']}' class='img-fluid'></td>
    <td>{$row['product_name']}</td>
    <td>{$row['vendor_f_name']} {$row['vendor_l_name']}</td>
    <td>{$row['product_sku']}</td>
    <td>$productCat</td>
    <td>₹ {$row['product_regular_price']}.00</td>
    <td>₹ {$row['product_sale_price']}.00</td>
    <td>{$row['product_date']} <br> {$row['product_time']}</td>
    <td>$product_modifydate</td>

    <td class='text-right py-0 align-middle'>
        <div class='btn-group btn-group-sm'>";
        
if ($row['product_status'] == '1') {
    $output .= "<button class='btn btn-info toggle-visibility'
                    data-id='{$row['id']}'
                    data-eandid='{$row['product_auto_id']}'
                    data-status='1'>
                    <i class='fa fa-eye'></i>
                </button>";
} else {
    $output .= "<button class='btn btn-danger toggle-visibility'
                    data-id='{$row['id']}'
                    data-eandid='{$row['product_auto_id']}'
                    data-status='0'>
                    <i class='fa fa-eye-slash'></i>
                </button>";
}

$output .= "</div></td>
<td>
    <div class='btn-group btn-group-sm'>
        <a href='/admin-manager/product/?pageid={$row['id']}&autoid={$row['product_auto_id']}'
           target='_blank'
           class='btn btn-info'>
            <i class='fa fa-pencil'></i>
        </a>";

/* ONLY THIS CONDITION ADDED */
if ($row['is_deleted'] != '2') {
    $output .= "&nbsp;&nbsp;
        <button type='button'
                class='btn btn-danger deletebtn'
                data-id='{$row['id']}'
                data-eandid='{$row['product_auto_id']}'>
            <i class='fas fa-trash'></i>
        </button>";
}

$output .= "
    </div>
</td>
</tr></tbody>";

    }

    if (mysqli_num_rows($result) == 0) {
        $output .= "<tr><td colspan='11' class='dataTables_empty' style='text-align: center;'>No products found</td></tr>";
    }
    
    /*product filtter data active && inactive query and t0tal*/
  $totalProduct =  "SELECT 
    COUNT(*) AS total_products,
    SUM(CASE WHEN product_status = 1 THEN 1 ELSE 0 END) AS active_products,
    SUM(CASE WHEN product_status = 0  THEN 1 ELSE 0 END) AS inactive_products,
     SUM(CASE WHEN is_deleted = 2 THEN 1 ELSE 0 END) AS deleted_products
	FROM all_product WHERE 1 " .$statusCondition.
    (!empty($pname) ? "AND product_name LIKE '%" . mysqli_real_escape_string($contdb, $pname) . "%' " : "") .
    (!empty($sku) ? "AND product_sku LIKE '%" . mysqli_real_escape_string($contdb, $sku) . "%' " : "") .
    $vendorCondition .
   $categoryFilter.
   $dateCondition;
    $resultData = mysqli_query($contdb, $totalProduct);
    $rowData = mysqli_fetch_assoc($resultData);

if ($rowData) {
   // echo '<pre>'; print_r($rowData);
}
   // Pagination logic
$countQuery = "SELECT COUNT(*) AS total FROM all_product WHERE 1 " . $statusCondition .
    (!empty($pname) ? "AND product_name LIKE '%" . mysqli_real_escape_string($contdb, $pname) . "%' " : "") .
    (!empty($sku) ? "AND product_sku LIKE '%" . mysqli_real_escape_string($contdb, $sku) . "%' " : "") .
    $vendorCondition.
    $categoryFilter.
    $dateCondition;

$countResult = mysqli_query($contdb, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRecords / $limit);

$currentPage = isset($_POST['page']) ? (int)$_POST['page'] : 1; // Use $_POST instead of $_GET
$limitPerPage = 10;
$currentSet = ceil($currentPage / $limitPerPage);
$startPage = max(1, ($currentSet - 1) * $limitPerPage + 1);
$endPage = min($totalPages, $startPage + $limitPerPage - 1);

$pagination = '<ul class="pagination">';

// Previous Set Button
if ($startPage > 1) {
    $prevSetPage = max(1, $startPage - $limitPerPage);
    $pagination .= "<li class='page-item'><a class='page-link pagination-link' href='#' data-page='$prevSetPage'>Prev</a></li>";
}

// Page Numbers
for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = ($i == $currentPage) ? "active" : "";
    $pagination .= "<li class='page-item $activeClass'><a class='page-link pagination-link' href='#' data-page='$i'>$i</a></li>";
}

// Next Set Button
if ($endPage < $totalPages) {
    $nextSetPage = min($totalPages, $endPage + 1);
    $pagination .= "<li class='page-item'><a class='page-link pagination-link' href='#' data-page='$nextSetPage'>Next</a></li>";
}

$pagination .= '</ul>';

echo json_encode([
    'output' => trim($output),
    'pagination' => trim($pagination),
    'ProductData' => $rowData
]);

return;
        }  
         
      

         
        else {
            $response = ['success' => false, 'message' => 'Unknown action'];
        }
    } 

    echo json_encode($response); 
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}




if(isset($_POST['page_name'])){

	$_checking_page_name = addslashes(trim($_POST['page_vale']));



	$chking_pahe_name = ChakingBlogPageTitle($_checking_page_name);

	if($chking_pahe_name == true){

		echo 1;

	}else{

		echo 2;

	}

}
if(isset($_POST['menueupdate'])){
	$get_menu_id = $_POST['menuupdveid'];
	$get_menu_valu = $_POST['menuvalue'];

	$Updatemenudata = "UPDATE menudatatable SET menu_name='$get_menu_valu' WHERE on_id='$get_menu_id'";
	$qqueryupdate = $contdb->query($Updatemenudata);
	echo 1;
}


if(isset($_POST['updatesingstatus'])){
	$sing_upstauts = explode('|', $_POST['singupdatevale']);
	$getvale = $sing_upstauts[0];
	$getmainid = $sing_upstauts[1];
	$getautoid = $sing_upstauts[2];

	$_Update_statusval = "UPDATE userpofiledatatablecont SET helar_status='$getvale' WHERE on_id='$getmainid' AND helar_auot_id='$getautoid'";
	$qury_udpatestus = $contdb->query($_Update_statusval);
	echo "1";
}

if(isset($_FILES['file']['name'])){
	$upload_image = images_upload('file');
	$insert_img = GLLImageInsertDataDl($upload_image,$_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'], "$floder_path_name/$upload_image");
	echo "0";
}


if(isset($_POST['imgdatset'])){
	$get_idimageval = $_POST['imgvaledat'];
	foreach(GLlImagesDataVale($get_idimageval) as $valeimgval){
		$imag_name = $valeimgval['image_name'];
		$imag_oldname = $valeimgval['image_old'];
		$imag_title = $valeimgval['image_title'];
		$imag_alt = $valeimgval['image_alt'];
		$imag_caption = $valeimgval['image_caption'];
		$imag_date = $valeimgval['image_date'];
		$imag_time = $valeimgval['image_time'];

		$return_arr[] = array('imgname'=>$imag_name,'imgoldnam'=>$imag_oldname,'imgtitle'=>$imag_title,'imgalt'=>$imag_alt,'imgcapt'=>$imag_caption,'imgdate'=>$imag_date,'imgtime'=>$imag_time);
	}
	echo json_encode($return_arr);
}

if(isset($_POST['deletimgset'])){
	$_delete_imgid = $_POST['imgvaledelt'];
	$deletype = "delete";
	$delet_imgname = $_POST['imgnamevale'];
	$delet_valeset = DeleteImageVale($_delete_imgid,$deletype);
	if($delet_valeset == true){
		$delete_img = $floder_path_name.'/'.$delet_imgname;
		unlink($delete_img);
	}
}



if(isset($_POST['addnewvert'])){
  
	$vertionid = $_POST['verindid'];
 
	$seeionvaldid = $_POST['sessionvale'];
		$autoid = $_POST['autoid'];

	$get_vertionvale = "SELECT * FROM all_product WHERE id='$seeionvaldid'";
	$queryvaleset = $contdb->query($get_vertionvale);
	while($rowvalest = $queryvaleset->fetch_array()){
		$catroyvetid = $rowvalest['product_color'];
		$catroyautoid = $rowvalest['product_auto_id'];
	}
	if($_POST['vertioncehck'] == "new"){
		$seeionval = $catroyvetid;
		$sessinpld = $catroyvetid;
		$commaromve = substr($catroyvetid, 1);
	}else{
		$seeionval = $catroyvetid;
	}
	$catroyvetidarray = explode(',', $catroyvetid);
	echo '<div class="datarow insert-val">';
	echo '<div class="card-header" role="tab" id="heading-A"><div class="row">';
		$chkingselectvale = "SELECT * FROM product_active_attbut WHERE attbut_productid='$sessinpld' OR attbut_productid='$catroyautoid' OR attbut_productid='$commaromve'";

		$chkingqeuy = $contdb->query($chkingselectvale);
		if($chkingqeuy->num_rows > 0){
			$get_main_attbut = "SELECT * FROM product_active_attbut WHERE attbut_productid='$sessinpld' OR attbut_productid='$catroyautoid' OR attbut_productid='$commaromve'";
			     
			$queryatbutmain = $contdb->query($get_main_attbut);
			$get_tramvalename = [];
			while($rowgetmainabtu = $queryatbutmain->fetch_array()){
				$get_sizevale = $rowgetmainabtu['attbut_id'];

				$get_nameabbut = "SELECT * FROM product_attbut WHERE id='$get_sizevale'";
			
				$queyvalabbut = $contdb->query($get_nameabbut);
				while($rowgetabbutnae = $queyvalabbut->fetch_array()){
					$get_abbutname = $rowgetabbutnae['pd_attbut_name'];

	                  	echo '<div class="col-md-3 form-group"><select class="attbuteval form-control" name="getattbutedit[]" data-id="'.$vertionid.'" required>
	                  		<option value="">Select '.$get_abbutname.'</option>';

	                  	$vertionvalue = "SELECT * FROM product_attbut_vartarry WHERE id='$vertionid'";
	             
	                  	$get_queryverval = $contdb->query($vertionvalue);
	                  	while($rowverdata = $get_queryverval->fetch_array()){
	                  		$get_vertionterid = explode(',', $rowverdata['prot_trm_id']);
	                  	}
	                  	foreach ($get_vertionterid as $termavertinovalue) {
	                  		$get_vertionvaledata = "SELECT * FROM product_variationsdata WHERE id='$termavertinovalue'";
	                  		$querytreamval = $contdb->query($get_vertionvaledata);
	                  		while ($rowget_showvale = $querytreamval->fetch_array()) {
	                  			$get_tramvalename[] = $rowget_showvale['proval_trm_value'];
	                  		}
	                  	}
	                  //	print_r($get_tramvalename); die;
	                  /*	echo $sessinpld;
	                  echo $get_sizevale;*/
	                  	$get_tramvalename = array_unique($get_tramvalename);
	              		$get_termvaleu = "SELECT * FROM product_variationsdata WHERE proval_trm_seeionid='$sessinpld' AND proval_trm_attid='$get_sizevale' OR proval_trm_seeionid='$catroyautoid' AND proval_trm_attid='$get_sizevale' OR proval_trm_seeionid='$commaromve' AND proval_trm_attid='$get_sizevale'";
						$queryvaldatul = $contdb->query($get_termvaleu);
						$added_options = []; // Array to track added options
                        
                        while ($rowvaltrmval = $queryvaldatul->fetch_array()) {
                            $value = $rowvaltrmval['proval_trm_value'];
                            $id = $rowvaltrmval['id'];
                        
                            // Ensure this value is added only once
                            if (!in_array($value, $added_options)) {
                                $selected = in_array($value, $get_tramvalename) ? "selected" : "";
                                
                                echo "<option value='$id' $selected>$value</option>";
                                $added_options[] = $value; // Track added values
                            }
                        }

	                echo '</select></div>';
				}
			}
		}else{
			foreach($catroyvetidarray as $valueset){
			$get_main_attbut = "SELECT * FROM product_active_attbut WHERE attbut_productid='$autoid' OR attbut_productid='$catroyautoid' OR attbut_productid='$commaromve' OR attbut_productid='$valueset'";
		
				$queryatbutmain = $contdb->query($get_main_attbut);
				while($rowgetmainabtu = $queryatbutmain->fetch_array()){
					$get_sizevale = $rowgetmainabtu['attbut_id'];

					$get_nameabbut = "SELECT * FROM product_attbut WHERE id='$get_sizevale'";
				
					$queyvalabbut = $contdb->query($get_nameabbut);
					$get_tramvalename = [];
					while($rowgetabbutnae = $queyvalabbut->fetch_array()){
						$get_abbutname = $rowgetabbutnae['pd_attbut_name'];

		                  	echo '<div class="col-md-3 form-group"><select class="attbuteval form-control" name="getattbutedit[]" data-id="'.$vertionid.'" required>
		                  		<option value="">Select '.$get_abbutname.'</option>';

		                  	$vertionvalue = "SELECT * FROM product_attbut_vartarry WHERE id='$vertionid'";
		                  	$get_queryverval = $contdb->query($vertionvalue);
		                  	while($rowverdata = $get_queryverval->fetch_array()){
		                  		$get_vertionterid = explode(',', $rowverdata['prot_trm_id']);
		                  		
		                  	}
		                  	foreach ($get_vertionterid as $termavertinovalue) {
		                  		$get_vertionvaledata = "SELECT * FROM product_variationsdata WHERE id='$termavertinovalue'";
		                  		$querytreamval = $contdb->query($get_vertionvaledata);
		                  		while ($rowget_showvale = $querytreamval->fetch_array()) {
		                  			$get_tramvalename[] = $rowget_showvale['proval_trm_value'];
		                  		}
		                  	}
		                  	//print_r($get_tramvalename);
		                  	//echo $sessinpld;
		                  	//echo $get_sizevale;
		                  	$get_tramvalename = array_unique($get_tramvalename);
		              		$get_termvaleu = "SELECT * FROM product_variationsdata WHERE proval_trm_seeionid='$autoid' AND proval_trm_attid='$get_sizevale' OR proval_trm_seeionid='$catroyautoid' AND proval_trm_attid='$get_sizevale' OR proval_trm_seeionid='$commaromve' AND proval_trm_attid='$get_sizevale' OR  proval_trm_seeionid='$valueset' AND proval_trm_attid='$get_sizevale'";
			
						$queryvaldatul = $contdb->query($get_termvaleu);
                        $added_options = []; // Array to track added options
                        
                        while ($rowvaltrmval = $queryvaldatul->fetch_array()) {
                            $value = $rowvaltrmval['proval_trm_value'];
                            $id = $rowvaltrmval['id'];
                        
                            if (!in_array($value, $added_options)) {
                                $selected = in_array($value, $get_tramvalename) ? "selected" : "";
                                
                                echo "<option value='$id' $selected>$value</option>";
                                $added_options[] = $value; 
                            }
                        }

		                echo '</select></div>';
					}
				}
			}
		}
	echo '</div></div>';
	$get_vertiondata = "SELECT * FROM product_attbut_vartarry WHERE id='$vertionid'";
	$query_vertdata = $contdb->query($get_vertiondata);
	while ($row_get_vertion = $query_vertdata->fetch_array()) {
		$get_trem_regulpric = $row_get_vertion['prot_trm_regulprc'];
		$get_trem_saleprc = $row_get_vertion['prot_trm_saleprc'];
		$get_trem_quntityval = $row_get_vertion['prot_trm_quantity'];
		$get_trem_lowstock = $row_get_vertion['prot_trm_lowstck'];
	echo '<div class="card-body">
             <div class="data-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Regular Price (₹)</label>
                                    <input type="hidden" id="vertinid" value="'.$vertionid.'">
                                    <input type="text" class="form-control updateregul" name="regpricever" data-id="'.$vertionid.'" value="'.$get_trem_regulpric.'">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label>Sale Price (₹)</label>
                                    <input type="text" class="form-control upatesale" name="salepricever" data-id="'.$vertionid.'" value="'.$get_trem_saleprc.'">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control updatequant" name="quantyver" data-id="'.$vertionid.'" value="'.$get_trem_quntityval.'">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label>Low stock threshold</label>
                                    <input type="number" class="form-control updatelowstok" name="updatelowstok" data-id="'.$vertionid.'" value="'.$get_trem_lowstock.'">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>';
    }
    echo '</div>';
   

}



if(isset($_POST['position'])){
	$post_getdataval = $_POST['position'];
	$i=1;
	foreach($post_getdataval as $keyvalpost => $set_postion){
		//$set_postion;
		$set_postiondata = "UPDATE product_attbut_vartarry SET prot_trm_postion='$i' WHERE prot_trm_id='$set_postion'";
		$query_set_vtionval = $contdb->query($set_postiondata);
		
		$explodetdatval = explode(',', $set_postion);
		foreach($explodetdatval as $data_valeid){
			$update_postdataval = "UPDATE product_variationsdata SET proval_trm_postion='$i' WHERE id='$data_valeid'";
			$query_set_postion = $contdb->query($update_postdataval);
		}
		$i++;
	}
}

if(isset($_POST['positionmenu'])){
	$positionmenu = $_POST['positionmenu'];
	$i=1;  
	foreach($positionmenu as $k=>$v){  
	    $sql = "UPDATE menudatatable SET menu_postion='$i' WHERE id='$v'";  
	    $contdb->query($sql);
	    $i++;  
	}
}

if(isset($_POST['postinmutipd'])){
	$positionpd = $_POST['postinmutipd'];
	$ipd=1;  
	foreach($positionpd as $kpd=>$vpd){
	    $sql = "UPDATE product_mutli_image SET img_postion='$ipd' WHERE id='$vpd'";  
	    $contdb->query($sql);
	    $ipd++;  
	}
}

if(isset($_POST['imageremovmulti'])){
	$get_exodeal = explode('|', $_POST['imageremovmulti']);
	$image_id = $get_exodeal[0];
	$image_name = $floder_path_name.'/'.$get_exodeal[1];

	$deletvale = DeleteALlDataVlae("product_mutli_image","id='$image_id'");
	unlink($image_name);
}

if(isset($_POST['tvsetval'])){
	$valueset = $_POST['tvsetval'];
	$ipddt=1;  
	foreach($valueset as $kpdvalu=>$vpdsrt){
	    $sql = "UPDATE gllnewstv_section SET tvnews_poestion='$ipddt' WHERE id='$vpdsrt'";  
	    $contdb->query($sql);
	    $ipddt++;
	}
}

if(isset($_POST['tablevale'])){
	$valueset = $_POST['tablevale'];
	/*$explodedata = explode(',', $valueset);
	$firstvale = explode(',', $explodedata[0]);*/
	$ipddt=1;
	foreach($valueset as $mutlivalset){
		$explodesata = explode('-', $mutlivalset);
		$explodeoneval = explode(',', $explodesata[0]);
		$explodetwoval = explode(',', $explodesata[1]);
		foreach($explodeoneval as $kpdvalu=>$vpdsrt){
		    $sql = "UPDATE product_attbut_vartarry SET prot_trm_postion='$ipddt' WHERE id='$vpdsrt'";  
		    $contdb->query($sql);
		}

		$ipddttwo=1;
		foreach($explodetwoval as $newval=>$vpdsrtteo){
			$sql = "UPDATE product_variationsdata SET proval_trm_postion='$ipddt' WHERE id='$vpdsrtteo'";
		    $contdb->query($sql);
		}
		$ipddt++;
	}
}

if(isset($_POST['sliderpostion'])){
	$slid_valueset = $_POST['sliderpostion'];
	$slide_ipddt=1;
	foreach($slid_valueset as $slid_kpdvalu=>$slide_vpdsrt){
	    $slid_sql = "UPDATE slideres_table_content SET slid_postion='$slide_ipddt' WHERE id='$slide_vpdsrt'";  
	    $contdb->query($slid_sql);
	    $slide_ipddt++;
	}
}

if(isset($_POST['promoads'])){
	$ads_valueset = $_POST['promoads'];
	$ads_ipddt=1;
	foreach($ads_valueset as $ads_kpdvalu=>$ads_vpdsrt){
	    $ads_sql = "UPDATE ads_imagesection SET adsimg_postion='$ads_ipddt' WHERE id='$ads_vpdsrt'";  
	    $contdb->query($ads_sql);
	    $ads_ipddt++;
	}
}

if(isset($_POST['removeabut'])){
	$get_vartionvae = explode('|', $_POST['abutid']);
	$get_autid = $get_vartionvae[0];
	$get_mainid = $get_vartionvae[1];
	$get_mainidsize = $get_vartionvae[2];

	$deletevale = DeleteALlDataVlae("product_active_attbut","id='$get_mainid' AND attbut_productid='$get_autid'");
	$deletevalesecond = DeleteALlDataVlae("product_variationsdata","proval_trm_attid='$get_mainidsize' AND proval_trm_seeionid='$get_autid'");
	echo 0;
}


if(isset($_POST['quickedivl'])){
	$get_seravl = explode('/', $_POST['quickid']);
	$get_autoid = $get_seravl[0];
	$get_mainid = $get_seravl[1];
	foreach (GetProductDataValTab($get_autoid) as $valueproduct) {
		echo '<div class="col-md-8">
				<input type="hidden" name="pageid" value="'.$get_mainid.'">
				<input type="hidden" name="autoid" value="'.$get_autoid.'">
	          	<div class="edit-product">
	            	<div class="row">
	            		<div class="col-sm-2">
	              			Vendor
	            		</div>
	            		<div class="col-sm-10">
	              			<select class="form-control" name="setvendordat" id="setvendordat" required>';
	              			foreach(GetVenderDatavale() as $vendername){
					          	foreach(GetPermissionvalData($vendername['vendor_auto']) as $vendorpermision){
					            	if($vendorpermision['user_p_block'] == "0"){
					              		if($valueproduct['product_vender_id'] == $vendername['vendor_auto']){
					              			echo '<option value="'.$vendername['vendor_auto'].'" selected>'.$vendername['vendor_f_name'].' '.$vendername['vendor_l_name'].'</option>';
					              		}else{
					              			echo '<option value="'.$vendername['vendor_auto'].'">'.$vendername['vendor_f_name'].' '.$vendername['vendor_l_name'].'</option>';
					              		}
					        		}
					    		}
					    	}
	    echo	 			'</select>
	            		</div>
	          		</div>
	          		<div class="row">
	            		<div class="col-sm-2">
	              			Title
	            		</div>
			            <div class="col-sm-10">
			              <input type="text" name="tilepded" id="tilepded" value="'.$valueproduct['product_name'].'" class="form-control" required>
			            </div>
	          		</div>
		          	<div class="row">
		            	<div class="col-sm-2">
		              		Slug
		            	</div>
		            	<div class="col-sm-10">
		              		<input type="text" name="slugprd" id="slugprd" value="'.$valueproduct['product_page_name'].'" class="form-control" required>
		            	</div>
		          	</div>
	          		<div class="row">
	            		<div class="col-sm-2">
	              			SKU
	            		</div>
	            		<div class="col-sm-10">
	              			<input type="tex" name="skupdtvl" id="skupdtvl" value="'.$valueproduct['product_sku'].'" class="form-control">
	            	</div>
	          	</div>
	        </div>
	    </div>
	    <div class="col-md-4">
           <div class="product-category">
            <h5>Product categories</h5>
            <div class="category-list">
              <div class="cat-row">';
                ProductInnercategoryTree($valueproduct['product_catger_ids'],$parent_id = 0, $sub_mark = '');
            echo '</div>
            </div>
           </div>
         </div>';
	}
}






?>