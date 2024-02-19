<?php
session_start();
require_once "../DB/DBconnect.php";
$idnxb = $_GET['idnxb'];
$pstm = $conn->prepare("select * from nhaxuatban where idnxb = :idnxb");
$pstm->execute(array('idnxb' => $idnxb));
$nxb = $pstm->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_GET['action']) && $_GET['action'] == 'sua') {
    $idnxb = $_POST['idnxb'];
    $tennxb = $_POST['tennxb'];
    $quocgia = $_POST['quocgia'];
    $pstm = $conn->prepare("update nhaxuatban set tennxb = :tennxb, quocgia = :quocgia where idnxb = :idnxb");
    $pstm->execute(array(
      'tennxb' => $tennxb,
      'quocgia' => $quocgia,
      'idnxb' => $idnxb
    ));
    header('Location: ../nhaxuatban.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa Tác Giả</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="../css/dropdown.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../css/suasach.css">
</head>

<body>
  <nav>
    <div>
      <a href="../quanly.php">Sách</a>
      <a href="../theloai.php">Thể loại</a>
      <a href="../tacgia.php">Tác giả</a>
      <a href="../nhaxuatban.php">Nhà Xuất Bản</a>
      <a href="#">Đơn hàng</a>
      <a href="#">Khách hàng</a>

    </div>
    <a href="../logout.php" style="margin-right: 23px;border: 1px solid;background: #EEEEEE;">Đăng xuất</a>
  </nav>

  <div class="sua-sach">
    <form method="post" name="myForm" onsubmit="return kiemtra()">
      <input type="text" name="idnxb" value="<?= $nxb['idnxb'] ?>" readonly="False"><br>
      <input type="text" name="tennxb" value="<?= $nxb['tennxb'] ?>"><br>
      <input type="text" name="quocgia" value="<?= $nxb['quocgia'] ?>"><br>
      <button type="submit" name="submit">Sửa</button>
    </form>
  </div>

  <script>
    function isEmpty(value) {
      return value.trim() === "";
    }

    function kiemtra() {
      let tentg = document.forms['myForm']['tennxb'].value;
      let tenqg = document.forms['myForm']['quocgia'].value;
      if (isEmpty(tentg)) {
        alert("Vui lòng nhập tên nhà xuất bản");
        document.forms['myForm']['tennxb'].focus();
        return false;
      }
      if (isEmpty(tenqg)) {
        alert("Vui lòng nhập tên quốc gia");
        document.forms['myForm']['quocgia'].focus();
        return false;
      }
      return true;
    }
  </script>
</body>

</html>