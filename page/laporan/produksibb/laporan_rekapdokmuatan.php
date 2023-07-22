<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Data Jalan Haul Truck</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nomor</th>
                        <th>Shift</th>
                        <th>Company</th>
                        <th>Truck No.</th>
                        <th>Time Departed</th>
                        <th>Loading Tool</th>
                        <th>Seam</th>
                        <th>Time Arrived (WB)</th>
                        <th>Time Arrived (Hopper)</th>
                        <th>Location (Loading)</th>
                        <th>Location (Dumping)</th>
                        <th>Tonnes (1)</th>
                        <th>Tonnes (2)</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $no = 1;
                    $sql = $koneksi->query("SELECT dokmuatan.*, dumptruck.* 
                        FROM dokmuatan
                        INNER JOIN dumptruck ON dokmuatan.id_dumptruck = dumptruck.id_dumptruck
                        ORDER BY dokmuatan.tanggal DESC");
                    while ($data = $sql->fetch_assoc()) {

                    ?>

                        <tr>
                            <td><?php echo $data['tanggal'] ?></td>
                            <td><?php echo $data['nomor'] ?></td>
                            <td><?php echo $data['shift'] ?></td>
                            <td><?php echo $data['company'] ?></td>
                            <td><?php echo $data['nama_dumptruck'] ?></td>
                            <td><?php echo $data['tdepart'] ?></td>
                            <td><?php echo $data['ltool'] ?></td>
                            <td><?php echo $data['seam'] ?></td>
                            <td><?php echo $data['wb'] ?></td>
                            <td><?php echo $data['hopper'] ?></td>
                            <td><?php echo $data['loading'] ?></td>
                            <td><?php echo $data['dumping'] ?></td>
                            <td><?php echo $data['tonnes1'] ?></td>
                            <td><?php echo $data['tonnes2'] ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <a href="../page/laporan/produksibb/exrekapdokmuatan.php" class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i></a>
        </div>
    </div>
</div>

</div>