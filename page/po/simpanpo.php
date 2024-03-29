<!-- process.php -->
<?php
// Koneksi ke database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventori";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses data yang dikirim dari form
if (isset($_POST['item']) && isset($_POST['input'])) {
    $items = $_POST['item'];
    $inputs = $_POST['input'];
    $tanggal = $_POST['tanggal'];
    $status = "P-O akan diproses oleh warehouse";
    $id = $_POST['nopo'];

    // Menyimpan data ke database dengan ID yang sama
    for ($i = 0; $i < count($items); $i++) {
        $item = $conn->real_escape_string($items[$i]);
        $input = $conn->real_escape_string($inputs[$i]);

        $sql = "INSERT INTO po (kode_po, tanggal, kode_barang, jumlah_po, status) VALUES ('$id','$tanggal','$item','$input', '$status')";
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "
    <script>
        Swal.fire({
            title: 'SUKSES!',
            text: 'Data Berhasil Disimpan',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = '?page=po';
        });
    </script>
    ";
}

$conn->close();
?>