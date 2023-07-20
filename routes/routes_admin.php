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

            if ($page == "barge") {
              if ($aksi == "") {
                include "../page/barge/barge.php";
              }
              if ($aksi == "tambahbarge") {
                include "../page/barge/tambahbarge.php";
              }
              if ($aksi == "ubahbarge") {
                include "../page/barge/ubahbarge.php";
              }

              if ($aksi == "hapusbarge") {
                include "../page/barge/hapusbarge.php";
              }
            }

            if ($page == "optht") {
              if ($aksi == "") {
                include "../page/optht/optht.php";
              }
              if ($aksi == "tambahoptht") {
                include "../page/optht/tambahoptht.php";
              }
              if ($aksi == "ubahoptht") {
                include "../page/optht/ubahoptht.php";
              }
              if ($aksi == "hapusoptht") {
                include "../page/optht/hapusoptht.php";
              }
              if ($aksi == "viewoptht") {
                include "../page/optht/viewoptht.php";
              }
            }

            if ($page == "dumptruck") {
              if ($aksi == "") {
                include "../page/dumptruck/dumptruck.php";
              }
              if ($aksi == "tambahdumptruck") {
                include "../page/dumptruck/tambahdumptruck.php";
              }
              if ($aksi == "ubahdumptruck") {
                include "../page/dumptruck/ubahdumptruck.php";
              }

              if ($aksi == "hapusdumptruck") {
                include "../page/dumptruck/hapusdumptruck.php";
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


            if ($page == "crushingjty") {
              if ($aksi == "") {
                include "../page/crushingjty/crushing.php";
              }
              if ($aksi == "tambahcrushing") {
                include "../page/crushingjty/tambahcrushing.php";
              }
              if ($aksi == "batalcrushingjty") {
                include "../page/crushingjty/batalcrushingjty.php";
              }
            }

            if ($page == "crushingicf") {
              if ($aksi == "") {
                include "../page/crushingicf/crushing.php";
              }
              if ($aksi == "tambahcrushing") {
                include "../page/crushingicf/tambahcrushing.php";
              }
              if ($aksi == "batalcrushingicf") {
                include "../page/crushingicf/batalcrushingicf.php";
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

            if ($page == "printbarangmasuk") {
              include "../page/laporan/exbarangmasuk.php";
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

            if ($page == "printbarangkeluar") {
              include "../page/laporan/exbarangkeluar.php";
              if ($aksi == "hasilprintbk") {
                include "../page/laporan/hasilprintbk.php";
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
              include "../home/home_admin.php";
            }
            if ($page == "home_admin") {
              include "../home/home_admin.php";
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

            if ($page == "laporan_crushingjty") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_crushingjty.php";
              }
            }

            if ($page == "laporan_crushingicf") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_crushingicf.php";
              }
            }

            if ($page == "laporan_transfer") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_transfer.php";
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

            if ($page == "laporan_transhaul") {
              if ($aksi == "") {
                include "../page/laporan/produksibb/laporan_transhaul.php";
              }
            }

            if ($page == "laporan_po") {
              if ($aksi == "") {
                include "../page/laporan/laporan_po.php";
              }
            }
