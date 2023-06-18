<?php
$id = $_GET['id_rcicf'];
$sql2 = $koneksi->query("select * from scicf where id_rcicf = '$id'");
$data = mysqli_fetch_assoc($sql2);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <h4 class="m-0 font-weight-bold text-primary text-center">RANGKUMAN RIWAYAT STOCK COAL ICF <?= $data['nama_rcicf']; ?> (<?= $data['warna']; ?>)
        </h6>
        <br>
        <a href="?page=stokcoalicf" class="btn btn-success float-right"><i class="fas fa-arrow-left">Kembali</i></a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Total Keluar</th>
                    <th>Total Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM crushingicf WHERE id_rcicf = $id");
                $tamps = mysqli_fetch_assoc($q);
                $total = $tamps['jum'];

                $q2 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM transfer WHERE id_rcicf = $id");
                $tamps2 = mysqli_fetch_assoc($q2);
                $total2 = $tamps2['jum'];

                $hasilmasuk = $total;
                $hasilkeluar = $total2;
                ?>
                <tr>
                    <td><?php echo  $hasilkeluar; ?></td>
                    <td><?php echo  $hasilmasuk; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">CRUSHING</h6>
            <br>
        </div>
        <table id="" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>Crushing To</th>
                    <th>Jumlah Masuk</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT *
            FROM crushingicf AS c
            INNER JOIN scicf AS s ON c.id_rcicf = s.id_rcicf
            WHERE c.id_rcicf = $id");
                while ($data = mysqli_fetch_assoc($sql)) {

                ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['start'] ?></td>
                        <td><?php echo $data['finish'] ?></td>
                        <td><?php echo $data['nama_rcicf'] ?></td>
                        <td><?php echo $data['jumlah'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>


        <br>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">TRANSFER</h6>
            <br>
        </div>
        <table id="" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Start</th>
                    <th>Finish</th>
                    <th>Transfer From (ICF)</th>
                    <th>Transfer To (JETTY)</th>
                    <th>Jumlah Keluar</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $sql = mysqli_query($koneksi, "SELECT * FROM transfer AS t
            INNER JOIN scicf AS c ON t.id_rcicf = c.id_rcicf
            INNER JOIN scjty AS j ON t.id_rcjty = j.id_rcjty
            WHERE c.id_rcicf = $id");
                while ($data = mysqli_fetch_assoc($sql)) {

                ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['start'] ?></td>
                        <td><?php echo $data['finish'] ?></td>
                        <td><?php echo $data['nama_rcicf'] ?></td>
                        <td><?php echo $data['nama_rcjty'] ?></td>
                        <td><?php echo $data['jumlah'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>