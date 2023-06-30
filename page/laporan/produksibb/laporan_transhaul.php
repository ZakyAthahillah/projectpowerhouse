<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Data Jalan Haul Truck</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Haul Truck</th>
                        <th>Transfer From (ICF)</th>
                        <th>Transfer To (JETTY)</th>
                        <th>Jumlah</th>
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
            GROUP_CONCAT(jumlah SEPARATOR ', ') AS jumlah_gabung
            FROM transfer
            INNER JOIN scicf ON transfer.id_rcicf = scicf.id_rcicf
            INNER JOIN scjty ON transfer.id_rcjty = scjty.id_rcjty
            INNER JOIN haultruck ON transfer.id_haultruck = haultruck.id_haultruck
            GROUP BY transfer.tanggal
            ORDER BY tanggal DESC");

                    while ($data = mysqli_fetch_assoc($sql)) {
                        $tanggal = $data['tanggal'];
                        $nama_rcicf_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcicf_gabung']) . '</li>';
                        $nama_rcjty_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_rcjty_gabung']) . '</li>';
                        $nama_haultruck_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['nama_haultruck_gabung']) . '</li>';
                        $jumlah_gabung = '<li style="list-style-type: circle;">' . str_replace(", ", "</li><li style='list-style-type: circle;'>", $data['jumlah_gabung']) . '</li>';
                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $nama_haultruck_gabung; ?></td>
                            <td><?php echo $nama_rcicf_gabung; ?></td>
                            <td><?php echo $nama_rcjty_gabung; ?></td>
                            <td><?php echo $jumlah_gabung; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <a href="../page/laporan/produksibb/extranshaul.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>

            </tbody>
            </table>
        </div>
    </div>
</div>

</div>