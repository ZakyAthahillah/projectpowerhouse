<?php
$id = $_GET['id_optht'];
$sql2 = $koneksi->query("select * from operatorht where id_optht = '$id'");
$data = mysqli_fetch_assoc($sql2);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <h4 class="m-0 font-weight-bold text-primary text-center">Rangkuman Riwayat Transfer <?= $data['nama_optht']; ?>
            </h6>
            <br>
            <a href="?page=optht" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mengambil tanggal dari form
            $tanggal = $_POST["tanggal"];
            $query = "SELECT SUM(jumlah) AS jum FROM transfer WHERE id_optht = $id AND Tanggal = '$tanggal'";
            $result = mysqli_query($koneksi, $query);
            $row = mysqli_fetch_assoc($result);
            $total = $row['jum'];
        }


        $tanggalhi = date("Y-m-d"); // Mendapatkan tanggal saat ini

        $queryhi = "SELECT SUM(jumlah) AS jum FROM transfer WHERE id_optht = $id AND Tanggal = '$tanggalhi'";
        $result = mysqli_query($koneksi, $queryhi);

        if (mysqli_num_rows($result) > 0) {
            $hi = mysqli_fetch_assoc($result);
            $totalhi = $hi['jum'];
            if ($totalhi === null) {
                $totalhi = 0;
            }
        } else {
            $totalhi = 0;
        }


        ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title font-weight-bold text-primary text-center">Total Transfer Hari Ini Tanggal <?= $tanggalhi ?> adalah <span class="badge badge-danger"><?= $totalhi ?> Ton</span></h5>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="card-title font-weight-bold text-primary">Total Transfer Per Tanggal</h6>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="tanggal">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="form-group">
                            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
                                <label for="hasil">Jumlah Transfer Tanggal <?= $tanggal ?></label>
                                <input type="text" class="form-control" id="hasil" name="hasil" value="<?= $total ?> MT">
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Hitung</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Transfer</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Start</th>
                                <th>Finish</th>
                                <th>Transfer From (ICF)</th>
                                <th>Transfer To (JETTY)</th>
                                <th>Jumlah</th>
                                <th>Haul Truck</th>
                                <th>Konfirmator</th>
                                <th>Status</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php

                            $no = 1;
                            $sql = mysqli_query($koneksi, "SELECT transfer.id_transfer, tanggal, 
                            GROUP_CONCAT(start SEPARATOR ', ') AS start_gabung,
                            GROUP_CONCAT(finish SEPARATOR ', ') AS finish_gabung,
                            GROUP_CONCAT(nama_rcicf SEPARATOR ', ') AS nama_rcicf_gabung,
                            GROUP_CONCAT(nama_rcjty SEPARATOR ', ') AS nama_rcjty_gabung,
                            GROUP_CONCAT(nama_haultruck SEPARATOR ', ') AS nama_haultruck_gabung,
                            GROUP_CONCAT(catatan SEPARATOR ', ') AS catatan_gabung,
                            GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung,
                            GROUP_CONCAT(nama_optht SEPARATOR ', ') AS nama_optht_gabung,
                            GROUP_CONCAT(nama SEPARATOR ', ') AS nama_gabung,
                            GROUP_CONCAT(id_transfer SEPARATOR ', ') AS id_transfer_gabung
                            FROM transfer
                            INNER JOIN users ON transfer.id_users = users.id_users
                            INNER JOIN operatorht ON transfer.id_optht = operatorht.id_optht
                            INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
                            INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
                            INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
                            WHERE catatan='Selesai' AND transfer.id_optht='$id'
                            GROUP BY transfer.tanggal
                            ORDER BY tanggal DESC");


                            while ($data = mysqli_fetch_assoc($sql)) {
                                $tanggal = $data['tanggal'];
                                $start_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['start_gabung']) . '</li>';
                                $finish_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['finish_gabung']) . '</li>';
                                $nama_rcicf_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcicf_gabung']) . '</li>';
                                $nama_rcjty_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcjty_gabung']) . '</li>';
                                $nama_haultruck_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_haultruck_gabung']) . '</li>';
                                $catatan_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['catatan_gabung']) . '</li>';
                                $nama_optht_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_optht_gabung']) . '</li>';
                                $jumlah_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_gabung']) . '</li>';
                                $nama_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_gabung']) . '</li>';
                                $id_transfer_gabung = $data['id_transfer_gabung'];
                            ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tanggal; ?></td>
                                    <td><?php echo $start_gabung; ?></td>
                                    <td><?php echo $finish_gabung; ?></td>
                                    <td><?php echo $nama_rcicf_gabung; ?></td>
                                    <td><?php echo $nama_rcjty_gabung; ?></td>
                                    <td><?php echo $jumlah_gabung; ?></td>
                                    <td><?php echo $nama_haultruck_gabung; ?></td>
                                    <td><?php echo $nama_gabung; ?></td>
                                    <td><?php echo $catatan_gabung; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>