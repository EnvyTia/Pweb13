<?php
// Load file connection.php
include "connection.php";
// Ambil data ID yang dikirim oleh update_form.php melalui URL
$ID = $_GET['ID'];
// Ambil Data yang Dikirim dari Form
$NRP = $_POST['NRP'];
$NAME = $_POST['NAME'];
$GENDER = $_POST['GENDER'];
$PHONE = $_POST['PHONE'];
$ADDRESS = $_POST['ADDRESS'];
// Ambil data foto yang dipilih dari form
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
// Cek apakah user ingin mengubah fotonya atau tIDak
if(empty($foto)){ // Jika user tIDak memilih file foto pada form
  // Lakukan proses update tanpa mengubah fotonya
  // Proses ubah data ke Database
  $sql = $pdo->prepare("UPDATE STUDENT SET NRP=:NRP, NAME=:NAME, GENDER=:jk, PHONE=:PHONE, ADDRESS=:ADDRESS WHERE ID=:ID");
  $sql->bindParam(':NRP', $NRP);
  $sql->bindParam(':NAME', $NAME);
  $sql->bindParam(':jk', $GENDER);
  $sql->bindParam(':PHONE', $PHONE);
  $sql->bindParam(':ADDRESS', $ADDRESS);
  $sql->bindParam(':ID', $ID);
  $execute = $sql->execute(); // Eksekusi / Jalankan query
  if($sql){ // Cek jika proses simpan ke database sukses atau tIDak
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
  }else{
    // Jika Gagal, Lakukan :
    echo "updating failed";
    echo "<br><a href='update_form.php'>back to form</a>";
  }
}else{ // Jika user memilih foto / mengisi input file foto pada form
  // Lakukan proses update termasuk mengganti foto sebelumnya
  // Rename NAME fotonya dengan menambahkan tanggal dan jam upload
  $fotobaru = date('dmYHis').$foto;
  // Set path folder tempat menyimpan fotonya
  $path = "images/".$fotobaru;
  // Proses upload
  if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tIDak
    // Query untuk menampilkan data STUDENT berdasarkan ID yang dikirim
    $sql = $pdo->prepare("SELECT foto FROM STUDENT WHERE ID=:ID");
    $sql->bindParam(':ID', $ID);
    $sql->execute(); // Eksekusi query insert
    $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
    // Cek apakah file foto sebelumnya ada di folder images
    if(is_file("images/".$data['foto'])) // Jika foto ada
      unlink("images/".$data['foto']); // Hapus file foto sebelumnya yang ada di folder images
    // Proses ubah data ke Database
    $sql = $pdo->prepare("UPDATE STUDENT SET NRP=:NRP, NAME=:NAME, GENDER=:jk, PHONE=:PHONE, ADDRESS=:ADDRESS, foto=:foto WHERE ID=:ID");
    $sql->bindParam(':NRP', $NRP);
    $sql->bindParam(':NAME', $NAME);
    $sql->bindParam(':jk', $GENDER);
    $sql->bindParam(':PHONE', $PHONE);
    $sql->bindParam(':ADDRESS', $ADDRESS);
    $sql->bindParam(':foto', $fotobaru);
    $sql->bindParam(':ID', $ID);
    $execute = $sql->execute(); // Eksekusi / Jalankan query
    if($sql){ // Cek jika proses simpan ke database sukses atau tIDak
      // Jika Sukses, Lakukan :
      header("location: index.php"); // Redirect ke halaman index.php
    }else{
      // Jika Gagal, Lakukan :
      echo "updating failed";
      echo "<br><a href='update_form.php'>back to form</a>";
    }
  }else{
    // Jika gambar gagal diupload, Lakukan :
    echo "updating failed";
    echo "<br><a href='update_form.php'>back to form</a>";
  }
}
?>







