<html>
<head>
  <title>CRUD APP</title>
</head>
<body>
  <h1>UPDATING STUDENT'S DATA</h1>
  <?php
  // Load file connection.php
  include "connection.php";
  // Ambil data NRP yang dikirim oleh index.php melalui URL
  $ID = $_GET['ID'];
  // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
  $sql = $pdo->prepare("SELECT * FROM STUDENT WHERE ID=:ID");
  $sql->bindParam(':ID', $ID);
  $sql->execute(); // Eksekusi query insert
  $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
  ?>
  <form method="post" action="update_process.php?ID=<?php echo $ID; ?>" enctype="multipart/form-data">
    <table cellpadding="8">
      <tr>
        <td>NRP</td>
        <td><input type="text" name="NRP" value="<?php echo $data['NRP']; ?>"></td>
      </tr>
      <tr>
        <td>NAME</td>
        <td><input type="text" name="NAME" value="<?php echo $data['NAME']; ?>"></td>
      </tr>
      <tr>
        <td>GENDER</td>
        <td>
        <?php
        if($data['GENDER'] == "M"){
          echo "<input type='radio' name='GENDER' value='M' checked='checked'> M";
          echo "<input type='radio' name='GENDER' value='F'> F";
        }else{
          echo "<input type='radio' name='GENDER' value='M'> M";
          echo "<input type='radio' name='GENDER' value='F' checked='checked'> F";
        }
        ?>
        </td>
      </tr>
      <tr>
        <td>PHONE</td>
        <td><input type="text" name="PHONE" value="<?php echo $data['PHONE']; ?>"></td>
      </tr>
      <tr>
        <td>ADDRESS</td>
        <td><textarea name="ADDRESS"><?php echo $data['ADDRESS']; ?></textarea></td>
      </tr>
      <tr>
        <td>PICTURE</td>
        <td>
          <input type="file" name="PICTURE">
        </td>
      </tr>
    </table>
    <hr>
    <input type="submit" value="UPDATE">
    <a href="index.php"><input type="button" value="CANCEL"></a>
  </form>
</body>
</html>