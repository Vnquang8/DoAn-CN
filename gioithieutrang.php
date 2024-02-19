<?php
session_start();
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
  <title>Sun</title>
  <style>
    #abcd {
      margin-left: 100px;
      margin-top: 10px;
      display: flex;
      justify-content: flex-start;
      width: 80%;
      align-items: center;
    }
  </style>
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
      <a href="#">Giới thiệu</a>
    </div>
    <div class="navbar-item">
      <div class="search">
        <form action="search.php" method="get">
          <input type="text" name="keyword" id="" class="search-1">
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

  <div id="abcd">
    <div>
      <p>
        <b>Sứ Mệnh:</b>"Sun Bookstore" không chỉ là một cửa hàng sách đơn thuần mà còn là ngôi nhà của những tâm hồn yêu sách. Chúng tôi cam kết mang lại trải nghiệm đặc biệt, từ không gian thân thiện cho đến sự đa dạng về nội dung sách, đảm bảo đáp ứng mọi đam mê và sở thích đọc sách của độc giả.
      </p>
      <br>
      <p> <b>Đa Dạng Thể Loại:</b>
        Với hơn hàng nghìn tựa sách và đa dạng thể loại, từ những cuốn tiểu thuyết trinh thám hấp dẫn, những tác phẩm giáo trình chất lượng đến những cuốn sách hài hước mang đến nụ cười sảng khoái, chúng tôi tự hào cung cấp một bảng sách phong phú, phản ánh sự đa dạng và sâu sắc của văn hóa và tri thức.</p>
    </div>
    <div>
      <img src="img/img-sgk/HH1.JPG" height="200px" width="200px">
    </div>
  </div>

  <div id="abcd">
    <div>
      <img src="img/img-sgk/HH5.JPG" height="200px" width="200px">
    </div>

    <div>
      <p><b>Không Gian Trang Nhã:</b>
        Không gian tại "Sun Bookstore" được thiết kế để tạo nên một cảm giác trang nhã, thoải mái và ấm cúng. Đèn vàng nhẹ nhàng, kệ sách được bài trí một cách tinh tế, tạo nên không gian lý tưởng cho việc lựa chọn và thưởng thức sách.</p>
      <br>
      <p><b>Cộng Đồng Đọc Sách:</b>
        Chúng tôi xây dựng cộng đồng đọc sách năng động và sáng tạo, nơi mọi người có thể chia sẻ đam mê, trao đổi ý kiến và tận hưởng những sự kiện văn hóa, tri thức được tổ chức thường xuyên. "Sun Bookstore" mong muốn hỗ trợ việc mở rộng tầm nhìn và kiến thức của cộng đồng thông qua việc đọc sách.</p>
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
</body>

</html>