<?php
include("../../koneksibarang.php");
$tamp = $_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$id_rcjty = $pecah_bar[0];
$sql = "SELECT *
    FROM scjty
    where id_rcjty = '$id_rcjty'";
$result = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {

?>

    <label for="stok">Stok</label>
    <div class="form-group">
      <div class="form-line">
        <input readonly="readonly" id="stokin" type="number" class="form-control" value="<?php echo $row["stok"]; ?>">




        </input>


      </div>
    </div>
<?php
  }
} else {
  echo "0 results";
}

mysqli_close($koneksi);

?>