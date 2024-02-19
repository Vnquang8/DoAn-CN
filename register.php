<?php 
  session_start();
  require_once "DB/DBconnect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
  <link rel="stylesheet" href="css/dropdown.css"> 
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/register.css">
  <title>Sun</title>
  
</head>
<body>
  <nav>
    <a href="index.php" class="logo">Sun</a>
    <div>
      <a href="index.php">Trang chủ</a>
      <a href="#">Sản phẩm</a>
      <div class="dropdown">
        <a href="#">Thể loại</a>
        <div class="dropdown-content">
          <?php 
            require_once "DB/DBconnect.php";
            $pstm = $conn->prepare("SELECT * FROM theloai");
            $pstm->execute();
            $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $item)
            {?>
              <a href="theloai/maintl.php?idtl=<?= $item['idtl'] ?>"><?=$item['tentl']?></a>
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
          <input type="text" name="keyword" id="" class="search-1">
          <button type="submit"><img src="img/icon-navbar/search.png" alt=""></button>
        </form>
      </div>
      <a href="#"><img src="img/icon-navbar/cart.png" alt=""></a>
      <a href="login.html"><img src="img/icon-navbar/user.png" alt=""></a>
    </div>
  </nav>
  <div class="register-wrapper">
    <div class="register-container">
      <div>
        <h2>Đăng Ký</h2>
        <p style="text-align: center;color:red">
          <?php 
            if(isset($_SESSION["thongbao"]))
            {
              echo $_SESSION["thongbao"];
              unset($_SESSION["thongbao"]);
            }
          ?>
        </p>
        <hr>
      </div>
      <div class="register-form">
        <form class="register" method="post" action="register_submit.php">
          <label for=""><b>Tên đăng nhập</b></label>
          <input type="text" name="username"><br>
          <label for=""><b>Mật khẩu</b></label>
          <input type="password" name="password"><br>
          <label for=""><b>Nhập lại mật khẩu</b></label>
          <input type="password" name="res-password"><br>
          <label for=""><b>Số điện thoại</b></label>
          <input type="text" name="phone"><br>
          <label for=""><b>Email</b></label>
          <input type="email" name="email"><br>
          <button type="submit" name="submit">Đăng ký</button>
        </form>
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
</body>
</html>