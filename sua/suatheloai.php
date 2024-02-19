<?php
session_start();
require_once "../DB/DBconnect.php";
$idtl = $_GET['idtl'];
$pstm = $conn->prepare("select * from theloai where idtl = :idtl");
$pstm->execute(array('idtl' => $idtl));
$theloai = $pstm->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_GET['action']) && $_GET['action'] == 'sua') {
    $idtl1 = $_POST['idtl'];
    $tentl = $_POST['tentl'];
    $pstm = $conn->prepare("update theloai set tentl = :tentl where idtl = :idtl");
    $pstm->execute(array(
      'tentl' => $tentl,
      'idtl' => $idtl1
    ));
    header('Location: ../theloai.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa thể loại</title>
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
    <form method="post">
      <input type="text" name="idtl" value="<?= $theloai['idtl'] ?>" readonly="False"><br>
      <input type="text" name="tentl" value="<?= $theloai['tentl'] ?>"><br>
      <button type="submit" name="submit">Sửa</button>
    </form>
  </div>
</body>

</html>