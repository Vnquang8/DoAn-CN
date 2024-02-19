<?php
session_start();
require_once "DB/DBconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $tennxb = $_POST['tennxb'];
  $qg = $_POST['qg'];
  $pstm = $conn->prepare("INSERT INTO nhaxuatban values (null,:tennxb,:quocgia)");
  $pstm->execute(array(
    'tennxb' => $tennxb,
    'quocgia'=>$qg
  ));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý | Nhà Xuất Bản</title>
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
      <input type="text" name="tennxb" placeholder="Ten Nha Xuat Ban ..."><br>
      <input type="text" name="qg" placeholder="Ten Quoc Gia ..."><br>
      <button type="submit" name="submit">Thêm</button>
    </form>
  </div>



  <div id="form">
    <table border="1">
      <tr>
        <th>Mã Nhà Xuất Bản</th>
        <th>Tên Nhà Xuất Bản</th>
        <th>Quốc Gia</th>
        <th>Action</th>
      </tr>

      <?php
      $pstm = $conn->prepare("select * from  nhaxuatban");
      $pstm->execute();
      $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
      foreach ($data as $nxb) {
      ?>
        <tr>
          <td><?= $nxb['idnxb'] ?></td>
          <td><?= $nxb['tennxb'] ?></td>
          <td><?= $nxb['quocgia'] ?></td>
          <td>
            <a class="button" href="./xoa/xoanxb.php?action=delete&idnxb=<?=$nxb['idnxb']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không');">Xoa</a>   |   
            <a class="button" href="./sua/suanxb.php?action=sua&idnxb=<?=$nxb['idnxb']?>">Edit</a>
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
      let tentg = document.forms['myForm']['tennxb'].value;
      let tenqg = document.forms['myForm']['qg'].value;
      if (isEmpty(tentg)) {
        alert("Vui lòng nhập tên nhà xuất bản");
        document.forms['myForm']['tennxb'].focus();
        return false;
      }
      if (isEmpty(tenqg)) {
        alert("Vui lòng nhập tên quốc gia");
        document.forms['myForm']['qg'].focus();
        return false;
      }
      return true;
    }
  </script>
</body>

</html>