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
                include "../page/jenisbarang/tambahjenis.php";
              }
              if ($aksi == "ubahjenis") {
                include "../page/jenisbarang/ubahjenis.php";
              }

              if ($aksi == "hapusjenis") {
                include "../page/jenisbarang/hapusjenis.php";
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
              if ($aksi == "scjtyin") {
                include "../page/stokcoaljty/scjtyin.php";
              }
              if ($aksi == "scjtyout") {
                include "../page/stokcoaljty/scjtyout.php";
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
              if ($aksi == "scicfin") {
                include "../page/stokcoalicf/scicfin.php";
              }
              if ($aksi == "scicfout") {
                include "../page/stokcoalicf/scicfout.php";
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

            if ($page == "transfer") {
              if ($aksi == "") {
                include "../page/transfer/transfer.php";
              }
              if ($aksi == "tambahtransfer") {
                include "../page/transfer/tambahtransfer.php";
              }
            }


            if ($page == "crushingjty") {
              if ($aksi == "") {
                include "../page/crushingjty/crushing.php";
              }
              if ($aksi == "tambahcrushing") {
                include "../page/crushingjty/tambahcrushing.php";
              }
            }

            if ($page == "crushingicf") {
              if ($aksi == "") {
                include "../page/crushingicf/crushing.php";
              }
              if ($aksi == "tambahcrushing") {
                include "../page/crushingicf/tambahcrushing.php";
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


            if ($page == "laporan_supplier") {
              if ($aksi == "") {
                include "../page/laporan/laporan_supplier.php";
              }
              if ($aksi == "infosupplier") {
                include "../page/laporan/infosupplier.php";
              }
            }

            
            if ($page == "laporan_barangmasuk") {
              if ($aksi == "") {
                include "../page/laporan/laporan_barangmasuk.php";
              }
            }

            if ($page == "laporan_pegawai") {
              if ($aksi == "") {
                include "../page/laporan/laporan_pegawai.php";
              }
              if ($aksi == "infopegawai") {
                include "../page/laporan/infopegawai.php";
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
              include "../home_admin.php";
            }
            if ($page == "home_admin") {
              include "../home_admin.php";
            }
            ?>