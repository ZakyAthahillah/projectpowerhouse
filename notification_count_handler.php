<?php

function getNotificationCount() {
    include 'koneksi.php';

    $sql = "SELECT COUNT(*) as count FROM sbp WHERE status = 'Upload Baru'";


    $result = mysqli_query($koneksi, $sql);


    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];


        mysqli_free_result($result);


        return $count;
    }

    return 0;
}

$count = getNotificationCount();
echo json_encode(array("count" => $count));
?>
