<?php
include("../../koneksi.php");
$tamp = $_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$id_rcicf = $pecah_bar[0];
$sql = "SELECT *
    FROM scicf
    where id_rcicf = '$id_rcicf'";
$result = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result)) {

?>

    <label for="stok">Stok</label>
    <div class="form-group">
      <div class="form-line">
        <input readonly="readonly" id="stokout" type="number" class="form-control" value="<?php echo $row["stok"]; ?>"></input>
      </div>
    </div>
<?php
  }
} else {
  echo "0 results";
}

mysqli_close($koneksi);

?>