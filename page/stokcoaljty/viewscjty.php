<?php
$id = $_GET['id_rcjty'];
$sql2 = $koneksi->query("select * from scjty where id_rcjty = '$id'");
$data = mysqli_fetch_assoc($sql2);
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <h4 class="m-0 font-weight-bold text-primary text-center">RANGKUMAN RIWAYAT STOCK COAL JETTY <?= $data['nama_rc']; ?> (<?= $data['warna']; ?>)
        </h6>
        <br>
        <a href="?page=stokcoaljty" class="btn btn-success float-right"><i class="fas fa-arrow-left">Kembali</i></a>
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
                $coba = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM crushingjty WHERE id_rcjty = $id");
                $tamps = mysqli_fetch_assoc($coba);
                $total = $tamps['jum'];

                $coba2 = mysqli_query($koneksi, "SELECT SUM(jumlah) AS jum  FROM transfer WHERE id_rcjty = $id");
                $tamps2 = mysqli_fetch_assoc($coba2);
                $total2 = $tamps2['jum'];

                $hasil = $total + $total2;
                ?>
                <tr>
                    <td><?php echo  $hasil; ?></td>
                    <td><?php echo  $hasil; ?></td>
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
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $sql = mysqli_query($koneksi, "select * from crushingjty where id_rcjty = $id");
                while ($data = mysqli_fetch_assoc($sql)) {

                ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['start'] ?></td>
                        <td><?php echo $data['finish'] ?></td>
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
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $sql = mysqli_query($koneksi, "select * from transfer where id_rcjty = $id");
                while ($data = mysqli_fetch_assoc($sql)) {

                ?>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['start'] ?></td>
                        <td><?php echo $data['finish'] ?></td>
                        <td><?php echo $data['jumlah'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>


        <br>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">LOADING</h6>
            <br>
        </div>
        <table id="" class="display" style="width:100%">
            <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Start</th>
                <th>Finish</th>
                <th>Loading From</th>
                <th>Warna</th>
                <th>Loading To</th>
                <th>Belstscale</th>
                <th>Catatan</th>
            </thead>
            <tbody>
                <?php

                $no = 1;
                $sql = mysqli_query($koneksi, "select * from loading
            inner join barge on loading.id_barge = barge.id_barge
            inner join scjty on loading.id_rcjty = scjty.id_rcjty
            ");
                while ($data = mysqli_fetch_assoc($sql)) {

                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal'] ?></td>
                        <td><?php echo $data['start'] ?></td>
                        <td><?php echo $data['finish'] ?></td>
                        <td><?php echo $data['nama_rc'] ?></td>
                        <td><?php echo $data['warna'] ?></td>
                        <td><?php echo $data['nama_barge'] ?></td>
                        <td><?php echo $data['beltscale'] ?></td>
                        <td><?php echo $data['catatan'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>