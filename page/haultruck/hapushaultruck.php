<?php

$id = $_GET['id_haultruck'];
$sql = $koneksi->query("delete from haultruck where id_haultruck = '$id'");

if ($sql) {

    echo "
<script>
    Swal.fire({
        title: 'SUKSES!',
        text: 'Data Berhasil Dihapus',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '?page=haultruck';
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
        window.location.href = '?page=haultruck';
    });
</script>
";
}
?>