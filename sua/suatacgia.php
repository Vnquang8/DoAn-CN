<?php
session_start();
require_once "../DB/DBconnect.php";
$idtg = $_GET['idtg'];
$pstm = $conn->prepare("select * from tacgia where idtg = :idtg");
$pstm->execute(array('idtg' => $idtg));
$tacgia = $pstm->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_GET['action']) && $_GET['action'] == 'sua') {
    $idtg1 = $_POST['idtg'];
    $tentg = $_POST['tentg'];
    $pstm = $conn->prepare("update tacgia set tentg = :tentg where idtg = :idtg");
    $pstm->execute(array(
      'tentg' => $tentg,
      'idtg' => $idtg1
    ));
    header('Location: ../tacgia.php');
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
      <input type="text" name="idtg" value="<?= $tacgia['idtg'] ?>" readonly="False"><br>
      <input type="text" name="tentg" value="<?= $tacgia['tentg'] ?>"><br>
      <button type="submit" name="submit">Sửa</button>
    </form>
  </div>

  <script>
    function isEmpty(value) {
      return value.trim() === "";
    }

    function kiemtra() {
      let tentg = document.forms['myForm']['tentg'].value;
      if (isEmpty(tentg)) {
        alert("Vui lòng nhập tên thể loại");
        document.forms['myForm']['tentg'].focus();
        return false;
      }
      return true;
    }
  </script>
</body>

</html>