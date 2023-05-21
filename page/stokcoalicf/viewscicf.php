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


    <br>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">LOADING</h6>
        <br>
    </div>
    <table id="" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>$1,200,000</td>
            </tr>
            <tr>
                <td>Suki Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>$114,500</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Timothy Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>$136,200</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>$356,250</td>
            </tr>
            <tr>
                <td>Lael Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>$103,500</td>
            </tr>
        </tbody>
    </table>
</div>