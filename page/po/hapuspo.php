<?php

$id_po = $_GET['id'];
$sql = $koneksi->query("delete from po where id = '$id_po'");

if ($sql) {

    echo "
<script>
    Swal.fire({
        title: 'SUKSES!',
        text: 'Data Berhasil Dihapus',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = '?page=po';
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
        window.location.href = '?page=po';
    });
</script>
";
}

?>