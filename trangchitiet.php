<?php
session_start();
require_once('DB/DBconnect.php');
$idsach = $_GET['idsach'];
$pstm = $conn->prepare("select * from sach join tacgia on sach.idtg = tacgia.idtg join theloai on sach.idtl = theloai.idtl join nhaxuatban on sach.idnxb = nhaxuatban.idnxb where idsach = :idsach");
$pstm->execute(array(
  'idsach'=>$idsach
));
$sach = $pstm->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/tanggiamsl.css">
  <link rel="stylesheet" href="css/chitietsp.css">
  <title>Sun</title>
</head>

<body>
  <nav>
    <a href="index.php" class="logo">Sun</a>
    <div>
      <a href="index.php">Trang chủ</a>
      <a href="sanpham.php">Sản phẩm</a>
      <div class="dropdown">
        <a href="#">Thể loại</a>
        <div class="dropdown-content">
          <?php
          require_once "DB/DBconnect.php";
          $pstm = $conn->prepare("SELECT * FROM theloai");
          $pstm->execute();
          $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
          foreach ($data as $item) { ?>
            <a href="theloai/maintl.php?idtl=<?= $item['idtl'] ?>"><?= $item['tentl'] ?></a>
          <?php
          }
          ?>
        </div>
      </div>
      <a href="#">Đơn hàng</a>
      <a href="gioithieutrang.php">Giới thiệu</a>
    </div>
    <div class="navbar-item">
      <div class="search">
        <form action="search.php" method="get">
          <input type="text" name="keyword" id="" class="search-1" placeholder="Nhập tìm kiếm">
          <button type="submit"><img src="img/icon-navbar/search.png" alt=""></button>
        </form>
      </div>
      <a href="#"><img src="img/icon-navbar/cart.png" alt=""></a>

      <div class="dropdown login-a">
        <a href="login.php"><img src="img/icon-navbar/user.png" alt=""></a>
        <div class="dropdown-content">
          <?php
          if (isset($_SESSION["islogin"])) {
          ?>
            <a href="logout.php">Đăng xuất</a>
            <a href="">Tài Khoản</a>
          <?php
          } else {
          ?>
            <a href="login.php">Đăng nhập</a>
          <?php
          }
          ?>
        </div>
      </div>
  </nav>
  <div class="show-sp">
    <div class="show-div">
      <div>
        <img class="show-img" src="<?= $sach['hinhanh']?>" alt="">
      </div>
      <div class="show-a">
        <a class="show-div-a" href="">Mua ngay</a>
        <a class="show-div-b" href="">Thêm vào giỏ hàng</a>
      </div>
    </div>
    <div class="show-item">
      <h1><?= $sach['tensach']?></h1><br>
      <div style="display: flex; justify-content: space-between;">
        <p>Nhà xuất bản: <b><?= $sach['tennxb']?></b></p>
        <p>Tác giả: <b><?= $sach['tentg']?></b></p>
      </div><br>
      <p>Thể loại: <b><?= $sach['tentl']?></b></p><br>
      <p style="font-size: 50px;color:red;"> <?= $sach['gia']?>  <span style="color: red;">đ</span></p><br><br>
      <div class="wrapper-b">
        <p>Số lượng: </p>
        <div class="wrapper-a">
          <span class="minus">-</span>
          <span class="number">1</span>
          <span class="plus">+</span>
        </div>
      </div>
    </div>
  </div>
  <div id="footer">
    <p>&copy; 2023 Sun Bookstore. All Rights Reserved.</p>
    <div>
      <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
      <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>
    <p>Contact: contact@sunbookstore.com</p>
  </div>
  <script src="js/slide.js"></script>
  <script src="js/tanggiamsp.js"></script>
</body>

</html>