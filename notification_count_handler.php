<?php

include 'koneksi.php';

function getNotificationCount($table, $status) {
    global $koneksi;

    $sql = "SELECT COUNT(*) as count FROM $table WHERE status = '$status'";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        mysqli_free_result($result);
        return $count;
    }

    return 0;
}

$countUploadBaru = getNotificationCount('sbp', 'Upload Baru');
$countWarehouse = getNotificationCount('po', 'P-O akan diproses oleh warehouse');

$response = array(
    "countUploadBaru" => $countUploadBaru,
    "countWarehouse" => $countWarehouse
);

echo json_encode($response);

?>
