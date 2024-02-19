<?php
session_start();
require_once "DB/DBconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['tentl'] != '') {
  $tentl = $_POST['tentl'];
  $pstm = $conn->prepare("INSERT INTO theloai values (null,:tentl)");
  $pstm->execute(array(
    'tentl' => $tentl,
  ));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý | Thể Loại</title>
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

  <div class="them-sach">
    <form method="post" name="myForm" onsubmit="return kiemtra()">
      <input type="text" name="tentl" placeholder="Ten Thể Loại ..."><br>
      <button type="submit" name="submit">Thêm</button>
    </form>
  </div>



  <div id="form">
    <table border="1">
      <tr>
        <th>Mã thể loại</th>
        <th>Tên thể loại</th>
        <th>Action</th>
      </tr>

      <?php
      $pstm = $conn->prepare("select * from theloai");
      $pstm->execute();
      $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
      foreach ($data as $theloai) {
      ?>
        <tr>
          <td><?= $theloai['idtl'] ?></td>
          <td><?= $theloai['tentl'] ?></td>
          <td>
            <a class="button" href="./xoa/xoatheloai.php?action=delete&idtl=<?= $theloai['idtl'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không');">Xoa</a> |
            <a class="button" href="./sua/suatheloai.php?action=sua&idtl=<?= $theloai['idtl'] ?>">Edit</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
  <script>
    function isEmpty(value) {
      return value.trim() === "";
    }

    function kiemtra() {
      let tentl = document.forms['myForm']['tentl'].value;
      if (isEmpty(tentl)) {
        alert("Vui lòng nhập tên thể loại");
        document.forms['myForm']['tentl'].focus();
        return false;
      }
      return true;
    }
  </script>
</body>

</html>