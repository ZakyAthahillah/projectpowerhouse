<?php
$id = $_GET['id_rcicf'];
$sql2 = $koneksi->query("select * from scicf where id_rcicf = '$id'");
$data = mysqli_fetch_assoc($sql2);
?>

<div class="container">
    <br>
    <br>
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary text-center">RANGKUMAN RIWAYAT STOCK COAL ICF <?= $data['nama_rc']; ?></h4>
        <br>
        <a href="?page=stokcoalicf" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a>
    </div>

    <br>

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
            $sql = mysqli_query($koneksi, "select * from crushingicf where id_rcicf = $id");
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
                <th>Jumlah Keluar</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $no = 1;
            $sql = mysqli_query($koneksi, "select * from transfer where id_rcicf = $id");
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
</div>