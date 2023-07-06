<?php

$id_transfer = $_GET['id_transfer'];
$sql = $koneksi->query("delete from transfer where id_transfer = '$id_transfer'");

if ($sql) {

    echo "
<script>
    Swal.fire({
        title: 'SUKSES!',
        text: 'Data Berhasil Dihapus',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '?page=transfer';
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
        window.location.href = '?page=transfer';
    });
</script>
";
}

?>