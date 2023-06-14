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
                    $sql = mysqli_query($koneksi, "select * from transfer
                    inner join scicf on transfer.id_rcicf = scicf.id_rcicf
                    inner join scjty on transfer.id_rcjty = scjty.id_rcjty
                    inner join haultruck on transfer.id_haultruck = haultruck.id_haultruck order by tanggal
                    ");
                    while ($data = mysqli_fetch_assoc($sql)) {

                    ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['nama_haultruck'] ?></td>
                            <td><?php echo $data['nama_rcicf'] ?></td>
                            <td><?php echo $data['nama_rcjty'] ?></td>
                            <td><?php echo $data['jumlah'] ?></td>
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