<?php
require_once('../DB/DBconnect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="../css/dropdown.css">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="stylesheet" href="../css/sanpham.css">
  <title>Sun</title>
</head>

<body>
  <nav>
    <a href="../index.php" class="logo">Sun</a>
    <div>
      <a href="../index.php">Trang chủ</a>
      <a href="../sanpham.php">Sản phẩm</a>
      <div class="dropdown">
        <a href="#">Thể loại</a>
        <div class="dropdown-content">
          <?php 
            $pstm = $conn->prepare("SELECT * FROM theloai");
            $pstm->execute();
            $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $item)
            {?>
              <a href="maintl.php?idtl=<?= $item['idtl'] ?>"><?=$item['tentl']?></a>
            <?php
            }
          ?>
        </div>
      </div>
      <a href="#">Đơn hàng</a>
      <a href="../gioithieutrang.php">Giới thiệu</a>
    </div>
    <div class="navbar-item">
      <div class="search">
        <form action="../search.php" method="get">
          <input type="text" name="keyword" id="" class="search-1">
          <button type="submit"><img src="../img/icon-navbar/search.png" alt=""></button>
        </form>
      </div>
      <a href="#"><img src="../img/icon-navbar/cart.png" alt=""></a>

      <div class="dropdown login-a">
        <a href="login.php"><img src="../img/icon-navbar/user.png" alt=""></a>
        <div class="dropdown-content">
          <?php
          if (isset($_SESSION["islogin"])) {
          ?>
            <a href="../logout.php">Đăng xuất</a>
            <a href="">Tài Khoản</a>
          <?php
          } else {
          ?>
            <a href="../login.php">Đăng nhập</a>
          <?php
          }
          ?>
        </div>
      </div>
  </nav>
  <div id="content">
    <?php
    $idtl = isset($_GET['idtl']) ? $_GET['idtl'] : null;
    $pstm = $conn->prepare("SELECT * FROM sach JOIN theloai ON sach.idtl = theloai.idtl WHERE theloai.idtl = :idtl");
    $pstm->execute(array(
      'idtl'=>$idtl,
    ));
    $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $item) {
    ?>
      <div class="book">
        <div class="img-content">
          <img src="../<?= $item['hinhanh'] ?>" alt="">
        </div>
        <div class="name-book">
          <p class="nsach"><?= $item['tensach'] ?></p>
        </div>
        <div class="price">
          <p><?= $item['gia'] ?>₫</p>
          <p style="text-decoration: line-through;">30.000₫</p>
        </div>
        <div class="click-item">
          <div class="click-a"><a href="../trangchitiet.php?idsach=<?=$item['idsach']?>">Xem chi tiết</a></div>
          <div class="click-a"><a href="">Thêm giỏ hàng</a></div>
        </div>
      </div>
    <?php
    }
    ?>
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
</body>

</html>