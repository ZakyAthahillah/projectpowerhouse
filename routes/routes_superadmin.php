<?php
            $page = $_GET['page'];
            $aksi = $_GET['aksi'];


            if ($page == "pengguna") {
              if ($aksi == "") {
                include "../page/pengguna/pengguna.php";
              }
              if ($aksi == "tambahpengguna") {
                include "../page/pengguna/tambahpengguna.php";
              }
              if ($aksi == "ubahpengguna") {
                include "../page/pengguna/ubahpengguna.php";
              }

              if ($aksi == "hapuspengguna") {
                include "../page/pengguna/hapuspengguna.php";
              }
            }


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


            if ($page == "jenisbarang") {
              if ($aksi == "") {
                include "../page/jenisbarang/jenisbarang.php";
              }
              if ($aksi == "tambahjenis") {
                include "../page//jenisbarang/tambahjenis.php";
              }
              if ($aksi == "ubahsupplier") {
                include "../page/supplier/ubahsupplier.php";
              }

              if ($aksi == "hapussupplier") {
                include "../page/supplier/hapussupplier.php";
              }
            }

            if ($page == "satuanbarang") {
              if ($aksi == "") {
                include "../page/satuanbarang/satuan.php";
              }
              if ($aksi == "tambahsatuan") {
                include "../page//satuanbarang/tambahsatuan.php";
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


            if ($page == "barangmasuk") {
              if ($aksi == "") {
                include "../page/barangmasuk/barangmasuk.php";
              }
              if ($aksi == "tambahbarangmasuk") {
                include "../page/barangmasuk/tambahbarangmasuk.php";
              }
              if ($aksi == "ubahbarangmasuk") {
                include "../page/barangmasuk/ubahbarangmasuk.php";
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


            if ($page == "barangkeluar") {
              if ($aksi == "") {
                include "../page/barangkeluar/barangkeluar.php";
              }
              if ($aksi == "tambahbarangkeluar") {
                include "../page/barangkeluar/tambahbarangkeluar.php";
              }
              if ($aksi == "ubahbarangkeluar") {
                include "../page/barangkeluar/ubahbarangkeluar.php";
              }

              if ($aksi == "hapusbarangkeluar") {
                include "../page/barangkeluar/hapusbarangkeluar.php";
              }
            }

            if ($page == "pegawai") {
              if ($aksi == "") {
                include "../page/pegawai/pegawai.php";
              }
              if ($aksi == "tambahpegawai") {
                include "../page/pegawai/tambahpegawai.php";
              }
              if ($aksi == "ubahpegawai") {
                include "../page/pegawai/ubahpegawai.php";
              }
              if ($aksi == "hapuspegawai") {
                include "../page/pegawai/hapuspegawai.php";
              }
            }

            if ($page == "pegawair") {
              if ($aksi == "") {
                include "../page/laporan/pegawair.php";
              }
              if ($aksi == "riwayatp") {
                include "../page/laporan/riwayatp.php";
              }
            }


            if ($page == "laporan_supplier") {
              if ($aksi == "") {
                include "../page/laporan/laporan_supplier.php";
              }
            }
            if ($page == "laporan_barangmasuk") {
              if ($aksi == "") {
                include "../page/laporan/laporan_barangmasuk.php";
              }
            }

            if ($page == "laporan_gudang") {
              if ($aksi == "") {
                include "../page/laporan/laporan_gudang.php";
              }
            }
            if ($page == "laporan_barangkeluar") {
              if ($aksi == "") {
                include "../page/laporan/laporan_barangkeluar.php";
              }
            }

            if ($page == "laporan_solarkeluar") {
              if ($aksi == "") {
                include "../page/laporan/laporan_solarkeluar.php";
              }
            }


            if ($page == "laporan_solarmasuk") {
              if ($aksi == "") {
                include "../page/laporan/laporan_solarmasuk.php";
              }
            }


            if ($page == "solar") {
              if ($aksi == "") {
                include "../page/solar/solar.php";
              }
              if ($aksi == "tambahsolar") {
                include "../page/solar/tambahsolar.php";
              }
              if ($aksi == "ubahsolar") {
                include "../page/solar/ubahsolar.php";
              }

              if ($aksi == "hapussolar") {
                include "../page/solar/hapussolar.php";
              }
            }

            if ($page == "solarmasuk") {
              if ($aksi == "") {
                include "../page/solarmasuk/solarmasuk.php";
              }
              if ($aksi == "tambahsolarmasuk") {
                include "../page/solarmasuk/tambahsolarmasuk.php";
              }
              if ($aksi == "hapussolarmasuk") {
                include "../page/solarmasuk/hapussolarmasuk.php";
              }
            }

            if ($page == "solarkeluar") {
              if ($aksi == "") {
                include "../page/solarkeluar/solarkeluar.php";
              }
              if ($aksi == "tambahsolarkeluar") {
                include "../page/solarkeluar/tambahsolarkeluar.php";
              }
              if ($aksi == "hapussolarkeluar") {
                include "../page/solarkeluar/hapussolarkeluar.php";
              }
            }

            if ($page == "unit") {
              if ($aksi == "") {
                include "../page/unit/unit.php";
              }
              if ($aksi == "tambahunit") {
                include "../page/unit/tambahunit.php";
              }
              if ($aksi == "ubahunit") {
                include "../page/unit/ubahunit.php";
              }

              if ($aksi == "hapusunit") {
                include "../page/unit/hapusunit.php";
              }
            }


            if ($page == "") {
              include "../home_superadmin.php";
            }
            if ($page == "home_superadmin") {
              include "../home_superadmin.php";
            }
