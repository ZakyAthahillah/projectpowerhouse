<?php
            $page = $_GET['page'];
            $aksi = $_GET['aksi'];


            if ($page == "sbp") {
              if ($aksi == "") {
                include "../page/blending/sbp.php";
              }
              if ($aksi == "file") {
                include "../page/blending/file";
              }
              if ($aksi == "tambahsbp") {
                include "../page/blending/tambahsbp.php";
              }
              if ($aksi == "ubahsbp") {
                include "../page/blending/ubahsbp.php";
              }
              if ($aksi == "uploadsbp") {
                include "../page/blending/uploadsbp.php";
              }
              if ($aksi == "downloadsbp") {
                include "../page/blending/downloadsbp.php";
              }
              if ($aksi == "hapussbp") {
                include "../page/blending/hapussbp.php";
              }
            }

            if ($page == "blending") {
              if ($aksi == "") {
                include "../page/blending/blending.php";
              }
              if ($aksi == "tambahblending") {
                include "../page/blending/tambahblending.php";
              }
              if ($aksi == "ubahblending") {
                include "../page/blending/ubahblending.php";
              }
              if ($aksi == "hapusblending") {
                include "../page/blending/hapusblending.php";
              }
            }


            if ($page == "stokcoaljty") {
              if ($aksi == "") {
                include "../page/stokcoaljty/stokcoal.php";
              }
              if ($aksi == "tambahsc") {
                include "../page/stokcoaljty/tambahsc.php";
              }
              if ($aksi == "viewscjty") {
                include "../page/stokcoaljty/viewscjty.php";
              }
              if ($aksi == "ubahscjty") {
                include "../page/stokcoaljty/ubahscjty.php";
              }
            }

            if ($page == "stokcoalicf") {
              if ($aksi == "") {
                include "../page/stokcoalicf/stokcoal.php";
              }
              if ($aksi == "tambahsc") {
                include "../page/stokcoalicf/tambahsc.php";
              }
              if ($aksi == "viewscicf") {
                include "../page/stokcoalicf/viewscicf.php";
              }
              if ($aksi == "ubahscicf") {
                include "../page/stokcoalicf/ubahscicf.php";
              }
            }
    

            if ($page == "loading") {
              if ($aksi == "") {
                include "../page/loading/loading.php";
              }
              if ($aksi == "tambahloading") {
                include "../page/loading/tambahloading.php";
              }
              if ($aksi == "batalloading") {
                include "../page/loading/batalloading.php";
              }
            }

            if ($page == "") {
              include "../home/home_qc.php";
            }
            if ($page == "home_qc") {
              include "../home/home_qc.php";
            }

            if ($page == "laporan_stockcoaljty") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_stockcoaljty.php";
              }
            }

            if ($page == "laporan_stockcoalicf") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_stockcoalicf.php";
              }
            }

            if ($page == "laporan_blending") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_blending.php";
              }
            }

            if ($page == "laporan_loading") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_loading.php";
              }
            }

