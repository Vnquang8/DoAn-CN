<?php
session_start();
require_once "DB/DBconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $tentg = $_POST['tentg'];
  $pstm = $conn->prepare("INSERT INTO tacgia values (null,:tentg)");
  $pstm->execute(array(
    'tentg' => $tentg,
  ));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý | Tác Giả</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="css/dropdown.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/table-form-admin.css">
</head>

<body>
  <nav>
    <div>
      <a href="quanly.php">Sách</a>
      <a href="theloai.php">Thể loại</a>
      <a href="tacgia.php">Tác giả</a>
      <a href="nhaxuatban.php">Nhà Xuất Bản</a>
      <a href="#">Đơn hàng</a>
      <a href="#">Khách hàng</a>
    
    </div>
    <a href="logout.php" style="margin-right: 23px;border: 1px solid;background: #EEEEEE;">Đăng xuất</a>
  </nav>


  <div>
  <div class="them-sach">
    <form method="post" name="myForm" onsubmit="return kiemtra()">
      <input type="text" name="tentg" placeholder="Ten Tac Gia ..."><br>
      <button type="submit" name="submit">Thêm</button>
    </form>
  </div>



  <div id="form">
    <table border="1">
      <tr>
        <th>Mã Tác Giả</th>
        <th>Tên Tác Giả</th>
        <th>Action</th>
      </tr>

      <?php
      $pstm = $conn->prepare("select * from tacgia");
      $pstm->execute();
      $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
      foreach ($data as $tacgia) {
      ?>
        <tr>
          <td><?= $tacgia['idtg'] ?></td>
          <td><?= $tacgia['tentg'] ?></td>
          <td>
            <a class="button" href="./xoa/xoatacgia.php?action=delete&idtg=<?=$tacgia['idtg']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không');">Xoa</a>   |   
            <a class="button" href="./sua/suatacgia.php?action=sua&idtg=<?=$tacgia['idtg']?>">Edit</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
  </div>
  <script>
    function isEmpty(value) {
      return value.trim() === "";
    }

    function kiemtra() {
      let tentg = document.forms['myForm']['tentg'].value;
      if (isEmpty(tentg)) {
        alert("Vui lòng nhập tên tác giả");
        document.forms['myForm']['tentg'].focus();
        return false;
      }
      return true;
    }
  </script>
</body>

</html>