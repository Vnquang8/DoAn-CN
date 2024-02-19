<?php
session_start();
require_once "DB/DBconnect.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $tensach = $_POST['tensach'];
  $mota = $_POST['motasach'];
  $gia = $_POST['giasach'];
  $tl = $_POST['theloai'];
  $tg = $_POST['tacgia'];
  $nxb = $_POST['nxb'];

  $target_dir = "uploads/";
  $image = $target_dir . basename($_FILES["image"]["name"]);

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
    $pstm = $conn->prepare("INSERT INTO sach values (null,:tensach,:gia,:hinhanh,:mota,:idtg,:idtl,:idnxb)");

    $pstm->execute(array(
      'tensach' => $tensach,
      'gia' => $gia,
      'hinhanh' => $image,
      'mota' => $mota,
      'idtg' => $tg,
      'idtl' => $tl,
      'idnxb' => $nxb
    ));
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý | Sách</title>
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
    <form method="post" enctype="multipart/form-data" name="myForm" onsubmit="return kiemtra()">
      <input type="text" name="tensach" placeholder="Ten Sach ..."><br>
      <input type="text" name="motasach" placeholder="Mo Ta Sach ..."><br>
      <input type="text" name="giasach" placeholder="Gia Sach ..."><br>
      <input type="file" name="image" style="height:35px" required> <br>
      <select name="tacgia" id="tacgia">
        <!-- Goi database -->
        <?php
        $pstm = $conn->prepare("SELECT * FROM tacgia");
        $pstm->execute();
        $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $item) {
        ?>
          <option value="<?= $item["idtg"] ?>">
            <?= $item["tentg"] ?>
          </option>
        <?php
        }
        ?>
      </select> <br>
      <select name="theloai" id="theloai">
        <!-- Goi database -->
        <?php
        $pstm1 = $conn->prepare("SELECT * FROM theloai");
        $pstm1->execute();
        $data2 = $pstm1->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data2 as $item) {
        ?>
          <option value="<?= $item["idtl"] ?>">
            <?= $item["tentl"] ?>
          </option>
        <?php
        }
        ?>
      </select> <br>
      <select name="nxb" id="nxb">
        <!-- Goi database -->
        <?php
        $pstm1 = $conn->prepare("SELECT * FROM nhaxuatban");
        $pstm1->execute();
        $data2 = $pstm1->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data2 as $item) {
        ?>
          <option value="<?= $item["idnxb"] ?>">
            <?= $item["tennxb"] ?>
          </option>
        <?php
        }
        ?>
      </select> <br>
      <button type="submit" name="submit">Thêm sách</button>
    </form>
  </div>
  <div id="form">
    <table border="1">
      <tr>
        <th>Mã sách</th>
        <th>Tên sách</th>
        <th>Giá sách</th>
        <th>Hình ảnh</th>
        <th>Mô tả</th>
        <th>Tên tác giả</th>
        <th>Thể loại</th>
        <th>Nhà xuất bản</th>
        <th>Action</th>
      </tr>

      <?php
      $pstm = $conn->prepare("select * from sach join tacgia on sach.idtg = tacgia.idtg join theloai on sach.idtl = theloai.idtl join nhaxuatban on sach.idnxb = nhaxuatban.idnxb");
      $pstm->execute();
      $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
      foreach ($data as $sach) {
      ?>
        <tr>
          <td><?= $sach['idsach'] ?></td>
          <td><?= $sach['tensach'] ?></td>
          <td><?= $sach['gia'] ?></td>
          <td>
            <img src="<?= $sach['hinhanh'] ?>" alt="" width="100px" height="100px">
          </td>
          <td><?= $sach['mota'] ?></td>
          <td><?= $sach['tentg'] ?></td>
          <td><?= $sach['tentl'] ?></td>
          <td><?= $sach['tennxb'] ?></td>
          <td>
            <a class="button" href="./xoa/xoasach.php?action=delete&idsach=<?= $sach["idsach"] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không');">Xoa</a> |
            <a class="button" href="./sua/suasach.php?action=sua&idsach=<?= $sach["idsach"] ?>">Edit</a>
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
      let tensach = document.forms['myForm']['tensach'].value;
      let motasach = document.forms['myForm']['motasach'].value;
      let giasach = document.forms['myForm']['giasach'].value;
      if (isEmpty(tensach)) {
        alert("Vui lòng nhập tên sách");
        document.forms['myForm']['tensach'].focus();
        return false;
      }
      if (isEmpty(motasach)) {
        alert("Vui lòng nhập mô tả sách");
        document.forms['myForm']['motasach'].focus();
        return false;
      }
      if (isEmpty(giasach)) {
        alert("Vui lòng nhập giá sách");
        document.forms['myForm']['giasach'].focus();
        return false;
      }
      if (isNaN(giasach)) {
        alert("Giá sách phải là một số.");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>