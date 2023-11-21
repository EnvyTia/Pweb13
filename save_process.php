<html>
<head>
  <title>CRUD APP PICTURE UPLOAD</title>
</head>
<body>
  <h1>STUDENT</h1>
  <a href="save_form.php">ADD DATA</a><br><br>
  <table border="1" width="100%">
  <tr>
    <th>PICTURE</th>
    <th>NRP</th>
    <th>NAME</th>
    <th>GENDER</th>
    <th>PHONE</th>
    <th>ADDRESS</th>
    <th colspan="2">act</th>
  </tr>
  <?php
  // Load file connection.php
  include "connection.php";
  // Buat query untuk menampilkan semua data STUDENT
  $sql = $pdo->prepare("SELECT * FROM STUDENT");
  $sql->execute(); // Eksekusi querynya
  while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
    echo "<tr>";
    echo "<td><img src='images/".$data['foto']."' width='100' height='100'></td>";
    echo "<td>".$data['NRP']."</td>";
    echo "<td>".$data['NAME']."</td>";
    echo "<td>".$data['GENDER']."</td>";
    echo "<td>".$data['PHONE']."</td>";
    echo "<td>".$data['ADDRESS']."</td>";
    echo "<td><a href='update_form.php?id=".$data['id']."'>Update</a></td>";
    echo "<td><a href='delete_process.php?id=".$data['id']."'>Delete</a></td>";
    echo "</tr>";
  }
  ?>
  </table>
</body>
</html>