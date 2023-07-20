<?php

$id = $_GET['id_dumptruck'];
$sql = $koneksi->query("delete from dumptruck where id_dumptruck = '$id'");

if ($sql) {

    echo "
<script>
    Swal.fire({
        title: 'SUKSES!',
        text: 'Data Berhasil Dihapus',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '?page=dumptruck';
    });
</script>
";
} else {
    echo "
<script>
    Swal.fire({
        title: 'ERROR!',
        text: 'Data Gagal Dihapus',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '?page=dumptruck';
    });
</script>
";
}
?>