<?php

$id = $_GET['id_haultruck'];
$sql = $koneksi->query("delete from haultruck where id_haultruck = '$id'");

if ($sql) {

?>


    <script type="text/javascript">
        alert("Data Berhasil Dihapus");
        window.location.href = "?page=haultruck";
    </script>

<?php

}

?>