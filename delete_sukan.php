<?php
//include file koneksi.php
include 'koneksi.php' ;

//jika benar mendapatkan GET id_temp dari URL
if(isset($_GET['id_temp'])){
	//membuat variabel $id_temp yang menyimpan nilai dari $_GET['id_temp']
	$id_temp = $_GET['id_temp'];
	
	//query ke database DELETE untuk menghapus data dengan kondisi id_temp=$id_temp
	$del = mysqli_query($koneksi, "DELETE FROM temperature WHERE id_temp='$id_temp'") or die(mysqli_error($koneksi));
	if($del){
		echo '<script>alert("Berhasil menghapus data."); document.location="suhu_kandang.php";</script>';
	}else{
		echo '<script>alert("Gagal menghapus data."); document.location="suhu_kandang.php";</script>';
	}
}else{
	echo '<script>alert("id_temp tidak ditemukan di database."); document.location="suhu_kandang.php";</script>';
}

?>