<?php
$file = $_GET['url'];

if (file_exists($file)) {
    $file_extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    // Cek apakah file adalah PDF
    if ($file_extension === 'pdf') {
        $file_with_timestamp = $file . '?t=' . time();
        echo '<iframe src="' . $file_with_timestamp . '" width="100%" height="1000px"></iframe>';
    } else {
        echo 'File bukan berkas PDF.';
    }
} else {
    echo 'File tidak ditemukan.';
}
?>
