<?php

$id_blending = $_GET['id_blending'];
$sql2 = $koneksi->query("select * from blending where id_blending = '$id_blending'");

$tampil = $sql2->fetch_assoc();


$tfq = 0;
$total = 0;
$yellowResult = 0;
$greenResult = 0;
$blueResult = 0;

if (isset($_POST['hitung'])) {
    $ycrush = isset($_POST['ycrush']) ? (float)$_POST['ycrush'] : 0;
    $gcrush = isset($_POST['gcrush']) ? (float)$_POST['gcrush'] : 0;
    $bcrush = isset($_POST['bcrush']) ? (float)$_POST['bcrush'] : 0;
    $tfq = isset($_POST['tfq']) ? (float)$_POST['tfq'] : 0;

    $total = $ycrush + $gcrush + $bcrush;

    if ($total != 0) {
        $yellowResult = round($ycrush / $total * $tfq, 2);
        $greenResult = round($gcrush / $total * $tfq, 2);
        $blueResult = round($bcrush / $total * $tfq, 2);
    }
}
?>


<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Flow Quantity Counter<a href="?page=blending" class="btn btn-success float-right"><i class="fas fa-arrow-left"> Kembali</i></a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="body">
                    <form method="POST" enctype="multipart/form-data">

                        <label for="">Yellow Crushed</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="ycrush" class="form-control" value="<?= $tampil['ycrush'] ?>" readonly />
                            </div>
                        </div>

                        <label for="">Green Crushed</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="gcrush" class="form-control" value="<?= $tampil['gcrush'] ?>" readonly />
                            </div>
                        </div>

                        <label for="">Blue Crushed</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="bcrush" class="form-control" value="<?= $tampil['bcrush'] ?>" readonly />
                            </div>
                        </div>

                        <label for="">TFQ</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tfq" class="form-control" value="<?= $tfq ?>" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-line">
                                <input type="submit" name="hitung" value="Hitung" class="btn btn-primary">
                            </div>
                        </div>

                        <div class="list-group">
                            <p class="list-group-item list-group-item-action active text-center font-weight-bold">
                                HASIL
                            </p>
                            <?php
                            $rckuning = mysqli_query($koneksi, "SELECT nama_rcjty FROM scjty WHERE warna = 'KUNING'");
                            $kuning_namarcjty = array();
                            while ($row_kuning = mysqli_fetch_assoc($rckuning)) {
                                $kuning_namarcjty[] = $row_kuning['nama_rcjty'];
                            }

                            
                            $rchijau = mysqli_query($koneksi, "SELECT nama_rcjty FROM scjty WHERE warna = 'HIJAU'");
                            $hijau_namarcjty = array();
                            while ($row_hijau = mysqli_fetch_assoc($rchijau)) {
                                $hijau_namarcjty[] = $row_hijau['nama_rcjty'];
                            }

                            $rcbiru = mysqli_query($koneksi, "SELECT nama_rcjty FROM scjty WHERE warna = 'BIRU'");
                            $biru_namarcjty = array();
                            while ($row_biru = mysqli_fetch_assoc($rcbiru)) {
                                $biru_namarcjty[] = $row_biru['nama_rcjty'];
                            }
                            
                            $kuning_namarcjty_tampil = implode(' / ', $kuning_namarcjty);
                            $hijau_namarcjty_tampil = implode(' / ', $hijau_namarcjty);
                            $biru_namarcjty_tampil = implode(' / ', $biru_namarcjty);
                            ?>

                            <p class="list-group-item list-group-item-action font-weight-bold">Total : <?= $total ?></p>
                            <p class="list-group-item list-group-item-action font-weight-bold"><button type="button" class="btn btn-warning"></button> Yellow Crushed ( <?= $kuning_namarcjty_tampil ?> ) : <span class="text-danger"><?= $yellowResult ?></span> TON</p>
                            <p class="list-group-item list-group-item-action font-weight-bold"><button type="button" class="btn btn-success"></button> Green Crushed ( <?= $hijau_namarcjty_tampil ?> ) : <span class="text-danger"><?= $greenResult ?></span> TON</p>
                            <p class="list-group-item list-group-item-action font-weight-bold"><button type="button" class="btn btn-primary"></button> Blue Crushed ( <?= $biru_namarcjty_tampil ?> ) : <span class="text-danger"><?= $blueResult ?></span> TON</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>