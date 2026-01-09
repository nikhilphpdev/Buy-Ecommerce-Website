<?php
error_reporting(0);
ini_set("display_errors", 0);
header("Content-Type: application/json; charset=UTF-8");
include('../dis-setting/config-settings/config.php');

date_default_timezone_set("Asia/Kolkata");  

/*****************************Luckydraw********************************/
if (isset($_POST['luckydrawfilter'])) {
try {
    $url = "https://testing.buyjee.com";
    $limit = 10;
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $start = ($page - 1) * $limit;

    // Build WHERE conditions
    $where = [];

    if (!empty($_POST['name'])) $where[] = "CONCAT(ul.user_first_name, ' ', ul.user_lastname) LIKE '%" . $contdb->real_escape_string($_POST['name']) . "%'";
    if (!empty($_POST['email'])) $where[] = "ul.user_email LIKE '%" . $contdb->real_escape_string($_POST['email']) . "%'";
    if (!empty($_POST['mobile'])) $where[] = "ul.user_mobileno LIKE '%" . $contdb->real_escape_string($_POST['mobile']) . "%'";
    if (!empty($_POST['bill'])) $where[] = "cl.bill_number LIKE '%" . $contdb->real_escape_string($_POST['bill']) . "%'";
    if (!empty($_POST['lucky'])) $where[] = "cl.luckydraw_code LIKE '%" . $contdb->real_escape_string($_POST['lucky']) . "%'";
    if (isset($_POST['status']) && $_POST['status'] !== "") $where[] = "cl.status = '" . $contdb->real_escape_string($_POST['status']) . "'";
    if (!empty($_POST['date_from']) && !empty($_POST['date_to'])) $where[] = "DATE(cl.created_at) BETWEEN '" . $contdb->real_escape_string($_POST['date_from']) . "' AND '" . $contdb->real_escape_string($_POST['date_to']) . "'";

    $whereSQL = count($where) > 0 ? "WHERE " . implode(" AND ", $where) : "";

    // Fetch data
    $query = "
        SELECT cl.*, ul.user_first_name, ul.user_lastname, ul.user_email, ul.user_mobileno, ul.user_auto
        FROM customer_luckydraw cl
        INNER JOIN userlogntable ul ON cl.customer_ui_id = ul.user_auto
        $whereSQL
        ORDER BY cl.created_at DESC
        LIMIT $start, $limit
    ";

    $result = $contdb->query($query);

    // Build table HTML
    $table = "
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Mobile</th>
                <th>Luckydraw Code</th><th>Bill No.</th><th>Image</th>
                <th>Remark</th><th>Status</th><th>Date</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
    ";

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            $fullname = $row['user_first_name'] . ' ' . $row['user_lastname'];
   if ($row['status'] === 0 || $row['status'] === "0" ) {
    $row_style = "";  // No background
} else {
    $row_style = ($row['status'] == 1)
        ? "background:#d4edda;"
        : (($row['status'] == 2)
            ? "background:#f8d7da;"
            : "background:#f7d87b;");
}
$status_label = ($row['status'] == 1 
    ? "Approved" 
    : ($row['status'] == 2 
        ? "Rejected" 
        : ($row['status'] == 3 
            ? "Re-apply" 
            : "Pending"
        )
    )
);
            $date = !empty($row['created_at']) ? date("d-m-Y h:i A", strtotime($row['created_at'])) : '';
            $remarks = !empty($row['remark']) ? $row['remark'] : 'N/A';
            $img = !empty($row['image']) ? "<img src='{$url}/luckydraw/{$row['image']}' width='60px' height='60px' 
class='billImage' style='cursor:pointer;'   data-src='{$url}/luckydraw/{$row['image']}'
 title='Double click to download' width='60'>" : "";
$disabled = in_array((int)$row['status'], [1, 2]) ? 'disabled' : '';
            $table .= "
                <tr style='{$row_style}'>
                    <td>{$fullname}</td>
                    <td>{$row['user_email']}</td>
                    <td>{$row['user_mobileno']}</td>
                    <td>{$row['luckydraw_code']}</td>
                    <td>{$row['bill_number']}</td>
                    <td>{$img}</td>
                    <td>{$remarks}</td>
                    <td>{$status_label}</td>
                    <td>{$date}</td>
                    <td>
                       
                        <button type='button' class='btn btn-sm btn-primary openRemarkModal generateTokenBtn'
                        data-toggle='modal' data-target='#exampleModal' data-id='{$row['user_auto']}' title='Update Status & Remark' {$disabled} >
                   <i class='fa fa-pencil'></i>
                </button>
                    </td>
                </tr>
            ";
        }
    } else {
        $table .= "<tr><td colspan='10' class='text-center'>No record found</td></tr>";
    }

    $table .= "</tbody>";

    // Pagination
    $countQuery = "SELECT COUNT(*) AS total FROM customer_luckydraw cl INNER JOIN userlogntable ul ON cl.customer_ui_id = ul.user_auto $whereSQL";
    $total = $contdb->query($countQuery)->fetch_assoc()['total'];
    $total_pages = ceil($total / $limit);

$limit = 10;
$totalPages = ceil($total / $limit);

// current page
$currentPage = $page;

// calculate range
$startPage = max(1, $currentPage - 2);
$endPage = min($totalPages, $currentPage + 2);

$pagination = '<ul class="pagination mt-3">';

// Previous Button (Go 1 page back)
if ($currentPage > 1) {
    $prevPage = $currentPage - 1;
    $pagination .= "<li class='page-item'>
                        <a class='page-link pagination-link' href='#' data-page='$prevPage'>Prev</a>
                    </li>";
}

// Previous Set Button
if ($startPage > 1) {
    $prevSetPage = $startPage - 1;
    $pagination .= "<li class='page-item'>
                        <a class='page-link pagination-link' href='#' data-page='$prevSetPage'>...</a>
                    </li>";
}

// Page Numbers
for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = ($i == $currentPage) ? "active" : "";
    $pagination .= "<li class='page-item $activeClass'>
                        <a class='page-link pagination-link' href='#' data-page='$i'>$i</a>
                    </li>";
}

// Next Set Button
if ($endPage < $totalPages) {
    $nextSetPage = $endPage + 1;
    $pagination .= "<li class='page-item'>
                        <a class='page-link pagination-link' href='#' data-page='$nextSetPage'>...</a>
                    </li>";
}

// Next Button (Go 1 page forward)
if ($currentPage < $totalPages) {
    $nextPage = $currentPage + 1;
    $pagination .= "<li class='page-item'>
                        <a class='page-link pagination-link' href='#' data-page='$nextPage'>Next</a>
                    </li>";
}

$pagination .= '</ul>';


    echo json_encode([
        "success" => true,
        "table" => $table,
        "pagination" => $pagination,
        "totalluckydrawcustomer" => $total
    ]);
    exit;

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
    exit;
}
}



?>