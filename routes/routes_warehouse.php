<?php
$page = $_GET['page'];
$aksi = $_GET['aksi'];


if ($page == "supplier") {
  if ($aksi == "") {
    include "../page/supplier/supplier.php";
  }
  if ($aksi == "tambahsupplier") {
    include "../page//supplier/tambahsupplier.php";
  }
  if ($aksi == "ubahsupplier") {
    include "../page/supplier/ubahsupplier.php";
  }

  if ($aksi == "hapussupplier") {
    include "../page/supplier/hapussupplier.php";
  }
}

if ($page == "po") {
  if ($aksi == "") {
    include "../page/po/po.php";
  }
  if ($aksi == "tambahpo") {
    include "../page/po/tambahpo.php";
  }
  if ($aksi == "ubahpo") {
    include "../page/po/ubahpo.php";
  }

  if ($aksi == "hapuspo") {
    include "../page/po/hapuspo.php";
  }
  if ($aksi == "simpanpo") {
    include "../page/po/simpanpo.php";
  }
}

if ($page == "barangmasuk") {
  if ($aksi == "") {
    include "../page/barangmasuk/barangmasuk.php";
  }
  if ($aksi == "tambahbarangmasuk") {
    include "../page/barangmasuk/tambahbarangmasuk.php";
  }
  if ($aksi == "batalbarangmasuk") {
    include "../page/barangmasuk/batalbarangmasuk.php";
  }

  if ($aksi == "hapusbarangmasuk") {
    include "../page/barangmasuk/hapusbarangmasuk.php";
  }
}


if ($page == "gudang") {
  if ($aksi == "") {
    include "../page/gudang/gudang.php";
  }
  if ($aksi == "tambahgudang") {
    include "../page/gudang/tambahgudang.php";
  }
  if ($aksi == "ubahgudang") {
    include "../page/gudang/ubahgudang.php";
  }

  if ($aksi == "hapusgudang") {
    include "../page/gudang/hapusgudang.php";
  }
}


if ($page == "laporan_penerima") {
  if ($aksi == "") {
    include "../page/laporan/laporan_penerima.php";
  }
  if ($aksi == "riwayatp") {
    include "../page/laporan/riwayatp.php";
  }
}

if ($page == "laporan_pengirim") {
  if ($aksi == "") {
    include "../page/laporan/laporan_pengirim.php";
  }
  if ($aksi == "riwayats") {
    include "../page/laporan/riwayats.php";
  }
  if ($aksi == "printriwayats") {
    include "../page/laporan/exriwayats.php";
  }
}



if ($page == "laporan_barangmasuk") {
  if ($aksi == "") {
    include "../page/laporan/laporan_barangmasuk.php";
  }
}

if ($page == "printbarangmasuk") {
  include "../page/laporan/exbarangmasuk.php";
}


if ($page == "laporan_gudang") {
  if ($aksi == "") {
    include "../page/laporan/laporan_gudang.php";
  }
}



if ($page == "laporan_porang") {
  if ($aksi == "") {
    include "../page/laporan/porang.php";
  }
}

if ($page == "oos") {
  if ($aksi == "") {
    include "../page/oos/oos.php";
  }
}

if ($page == "") {
  include "../home/home_warehouse.php";
}
if ($page == "home_warehouse") {
  include "../home/home_warehouse.php";
}

if ($page == "laporan_po") {
  if ($aksi == "") {
    include "../page/laporan/laporan_po.php";
  }
}

if ($page == "laporan_barangkeluar") {
  if ($aksi == "") {
    include "../page/laporan/laporan_barangkeluar.php";
  }
}

if ($page == "satuanbarang") {
  if ($aksi == "") {
    include "../page/satuanbarang/satuan.php";
  }
  if ($aksi == "tambahsatuan") {
    include "../page/satuanbarang/tambahsatuan.php";
  }
  if ($aksi == "ubahsatuan") {
    include "../page/satuanbarang/ubahsatuan.php";
  }

  if ($aksi == "hapussatuan") {
    include "../page/satuanbarang/hapussatuan.php";
  }
}

if ($page == "lokasibarang") {
  if ($aksi == "") {
    include "../page/lokasibarang/lokasi.php";
  }
  if ($aksi == "tambahlokasi") {
    include "../page/lokasibarang/tambahlokasi.php";
  }
  if ($aksi == "ubahlokasi") {
    include "../page/lokasibarang/ubahlokasi.php";
  }

  if ($aksi == "hapuslokasi") {
    include "../page/lokasibarang/hapuslokasi.php";
  }
}


if ($page == "jenisbarang") {
  if ($aksi == "") {
    include "../page/jenisbarang/jenisbarang.php";
  }
  if ($aksi == "tambahjenis") {
    include "../page/jenisbarang/tambahjenis.php";
  }
  if ($aksi == "ubahjenis") {
    include "../page/jenisbarang/ubahjenis.php";
  }

  if ($aksi == "hapusjenis") {
    include "../page/jenisbarang/hapusjenis.php";
  }
}

if ($page == "barangkeluar") {
  if ($aksi == "") {
    include "../page/barangkeluar/barangkeluar.php";
  }
  if ($aksi == "tambahbarangkeluar") {
    include "../page/barangkeluar/tambahbarangkeluar.php";
  }
  if ($aksi == "batalbarangkeluar") {
    include "../page/barangkeluar/batalbarangkeluar.php";
  }

  if ($aksi == "hapusbarangkeluar") {
    include "../page/barangkeluar/hapusbarangkeluar.php";
  }
}