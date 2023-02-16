<?php
//include file koneksi.php
include 'koneksi.php' ;

//jika benar mendapatkan GET id_ph dari URL
if(isset($_GET['id_ph'])){
	//membuat variabel $id_ph yang menyimpan nilai dari $_GET['id_ph']
	$id_ph = $_GET['id_ph'];
	
	//query ke database DELETE untuk menghapus data dengan kondisi id_ph=$id_ph
	$del = mysqli_query($koneksi, "DELETE FROM ph WHERE id_ph='$id_ph'") or die(mysqli_error($koneksi));
	if($del){
		echo '<script>alert("Berhasil menghapus data."); document.location="kadar_air_minum.php";</script>';
	}else{
		echo '<script>alert("Gagal menghapus data."); document.location="kadar_air_minum.php";</script>';
	}
}else{
	echo '<script>alert("id_ph tidak ditemukan di database."); document.location="kadar_air_minum.php";</script>';
}

?>