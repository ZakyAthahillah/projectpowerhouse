<?php
            $page = $_GET['page'];
            $aksi = $_GET['aksi'];



            if ($page == "barge") {
              if ($aksi == "") {
                include "../page/barge/barge_pegawai.php";
              }
            }

            if ($page == "optht") {
              if ($aksi == "") {
                include "../page/optht/optht_pegawai.php";
              }
              if ($aksi == "viewoptht") {
                include "../page/optht/viewoptht.php";
              }
            }

            if ($page == "haultruck") {
              if ($aksi == "") {
                include "../page/haultruck/haultruck_pegawai.php";
              }
            }

            if ($page == "po") {
              if ($aksi == "") {
                include "../page/po/po_pegawai.php";
              }
              if ($aksi == "tambahpo") {
                include "../page/po/tambahpo.php";
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
                include "../page/gudang/gudang_pegawai.php";
              }
              if ($aksi == "tambahgudang") {
                include "../page/gudang/tambahgudang.php";
              }           
            }


            if ($page == "stokcoaljty") {
              if ($aksi == "") {
                include "../page/stokcoaljty/stokcoal_pegawai.php";
              }
            }

            if ($page == "stokcoalicf") {
              if ($aksi == "") {
                include "../page/stokcoalicf/stokcoal_pegawai.php";
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

            if ($page == "transfer") {
              if ($aksi == "") {
                include "../page/transfer/transfer.php";
              }
              if ($aksi == "tambahtransfer") {
                include "../page/transfer/tambahtransfer.php";
              }
              if ($aksi == "bataltransfer") {
                include "../page/transfer/bataltransfer.php";
              }
              if ($aksi == "konfirmtransfer") {
                include "../page/transfer/konfirmtransfer.php";
              }
              if ($aksi == "ubahtransfer") {
                include "../page/transfer/ubahtransfer.php";
              }
              if ($aksi == "hapustransfer") {
                include "../page/transfer/hapustransfer.php";
              }
            }
  

            if ($page == "oos") {
              if ($aksi == "") {
                include "../page/oos/oos.php";
              }
            }

            if ($page == "") {
              include "../home/home_pegawai.php";
            }
            if ($page == "home_pegawai") {
              include "../home/home_pegawai.php";
            }

