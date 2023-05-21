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
				    if ($aksi == "ubahsupplier") {
					   include "../page/supplier/ubahsupplier.php";
				   }
				   
				    if ($aksi == "hapussupplier") {
					   include "../page/supplier/hapussupplier.php";
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
				
				
			   if ($page == "laporan_gudang") {
				if ($aksi == "") {
				  include "../page/laporan/laporan_gudang.php";
				}
			  }
			     
			   if ($page == "") {
				   include "../home_user.php";
			   }
			   if ($page == "home_user") {
				   include "../home_user.php";
			   }
			   ?>