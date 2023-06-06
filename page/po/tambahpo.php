<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pre-Order<a href="?page=po" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">

            <form action="?page=po&aksi=simpanpo" method="POST">
                <div id="form-container">
                    <label for="">Tanggal</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="date" name="tanggal" class="form-control" id="tanggal" />
                        </div>
                    </div>
                    <label for="">Nomor PO</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" name="nopo" class="form-control" id="nopo" />
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="item">Nama Barang :</label>
                        <select name="item[]" class="select2">
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

                            // Mengambil data dari tabel options
                            $sql = "SELECT * FROM gudang";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row["kode_barang"];
                                    $name = $row["nama_barang"];
                                    echo "<option value='$id'>$name</option>";
                                }
                            }

                            $conn->close();
                            ?>
                        </select>
                        <input type="text" name="input[]" placeholder="Jumlah">
                        <button type="button" onclick="removeForm(this)">Hapus</button>
                    </div>
                </div>
                <button type="button" onclick="addForm()">Tambah Form</button>
                <button type="submit">Simpan</button>
            </form>

            <script>
                $(document).ready(function() {
                    // Inisialisasi Select2 pada form pertama
                    $('.select2').select2();
                });

                function addForm() {
                    const formContainer = document.getElementById("form-container");
                    const formRow = document.createElement("div");
                    formRow.className = "form-row";
                    formRow.innerHTML = `
                <label for="item">Nama Barang :</label>
                <select name="item[]" class="select2">
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

                    // Mengambil data dari tabel options
                    $sql = "SELECT * FROM gudang";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["kode_barang"];
                            $name = $row["nama_barang"];
                            echo "<option value='$id'>$name</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
                <input type="text" name="input[]" placeholder="Jumlah">
                <button type="button" onclick="removeForm(this)">Hapus</button>
            `;
                    formContainer.appendChild(formRow);
                    $('.select2').select2(); // Menginisialisasi Select2 pada form baru
                }

                function removeForm(button) {
                    const formRow = button.parentNode;
                    formRow.remove();
                }
            </script>