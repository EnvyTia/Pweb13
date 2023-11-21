<?php
// Load file connection.php
include "connection.php";
// Ambil data NIS yang dikirim oleh index.php melalui URL
$ID = $_GET['ID'];
// Query untuk menampilkan data STUDENT berdasarkan ID yang dikirim
$sql = $pdo->prepare("SELECT PICTURE FROM STUDENT WHERE ID=:ID");
$sql->bindParam(':ID', $ID);
$sql->execute(); // Eksekusi query insert
$data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
// Cek apakah file PICTUREnya ada di folder images
if(is_file("images/".$data['PICTURE'])) // Jika PICTURE ada
  unlink("images/".$data['PICTURE']); // Hapus PICTURE yang telah diupload dari folder images
// Query untuk menghapus data STUDENT berdasarkan ID yang dikirim
$sql = $pdo->prepare("DELETE FROM STUDENT WHERE ID=:ID");
$sql->bindParam(':ID', $ID);
$execute = $sql->execute(); // Eksekusi / Jalankan query
if($execute){ // Cek jika proses simpan ke database sukses atau tIDak
  // Jika Sukses, Lakukan :
  header("location: index.php"); // Redirect ke halaman index.php
}else{
  // Jika Gagal, Lakukan :
  echo "failed deleting data <a href='index.php'>Kembali</a>";
}
?>