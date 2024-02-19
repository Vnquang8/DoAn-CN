<?php 
  session_start();
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
  <link rel="stylesheet" href="css/login.css">
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
    </div>
  </nav>
  <div class="login-container">
    <div>
      <h2>Đăng nhập</h2>
      <p style="text-align: center;color:red">
        <?php 
          if(isset($_SESSION["thongbao"]))
          {
            echo $_SESSION["thongbao"];
            unset($_SESSION["thongbao"]);
          }
        ?>
      </p>
      <form action="login_submit.php" method="post" class="formData">
        <div class="children-form">
          <div class="form-input">
            <label for="">Tài Khoản</label><br>
            <input type="text" name="username">
          </div>
          <div class="form-input">
            <label for="">Mật Khẩu</label><br>
            <input type="password" name="password">
            
          </div>
          <div class="form-input end">
            <a href="register.php">Đăng Ký</a>
          </div>
          <button type="submit" class="btn" name="submit">Đăng nhập</button>
        </div>
      </form>
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