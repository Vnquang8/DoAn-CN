<?php
session_start();
require_once "../DB/DBconnect.php";
$idsach = $_GET['idsach'];
$pstm = $conn->prepare("select * from sach join tacgia on sach.idtg = tacgia.idtg join theloai on sach.idtl = theloai.idtl join nhaxuatban on sach.idnxb = nhaxuatban.idnxb where idsach = :idsach");
$pstm->execute(array('idsach' => $idsach));
$sach = $pstm->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_GET['action']) && $_GET['action'] == 'sua') {
    $idsach1 = $_POST['idsach'];
    $tensach = $_POST['tensach'];
    $mota = $_POST['motasach'];
    $gia = $_POST['giasach'];
    $tl = $_POST['theloai'];
    $tg = $_POST['tacgia'];
    $nxb = $_POST['nxb'];

    $target_dir = "uploads/";
    $image = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
      $hinhanh = $image;
    } else {
      $hinhanh = $sach['hinhanh'];
    }

    $pstm = $conn->prepare("update sach set tensach = :tensach, gia = :gia, hinhanh = :hinhanh, mota = :mota, idtg=:idtg, idtl=:idtl, idnxb = :idnxb where idsach = :idsach");
    $pstm->execute(array(
      'tensach' => $tensach,
      'gia' => $gia,
      'hinhanh' => $hinhanh,
      'mota' => $mota,
      'idtg' => $tg,
      'idtl' => $tl,
      'idnxb' => $nxb,
      'idsach' => $idsach1
    ));
    header('Location: ../quanly.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sửa Sách</title>
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
    <form method="post" enctype="multipart/form-data" name="myForm" onsubmit="return kiemtra()">
      <input type="text" name="idsach" value="<?= $sach['idsach'] ?>" readonly="False"><br>
      <input type="text" name="tensach" value="<?= $sach['tensach'] ?>"><br>
      <input type="text" name="motasach" value="<?= $sach['mota'] ?>"><br>
      <input type="text" name="giasach" value="<?= $sach['gia'] ?>"><br>
      <img src="../<?= $sach['hinhanh'] ?>" alt="Hình ảnh sách" width="100px"><br>
      <input type="file" name="image" style="height:35px"> <br>
      <select name="tacgia" id="tacgia">
        <?php
        $pstm = $conn->prepare("select * from tacgia");
        $pstm->execute();
        $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $item) {
          $selected = ($item['idtg'] == $sach['idtg']) ? 'selected' : '';
        ?>
          <option value="<?= $item['idtg'] ?>" <?= $selected ?>>
            <?= $item['tentg'] ?>
          </option>
        <?php
        }
        ?>
      </select><br>
      <select name="theloai" id="theloai">
        <?php
        $pstm = $conn->prepare("select * from theloai");
        $pstm->execute();
        $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $item) {
          $selected = ($item['idtl'] == $sach['idtl']) ? 'selected' : '';
        ?>
          <option value="<?= $item['idtl'] ?>" <?= $selected ?>>
            <?= $item['tentl'] ?>
          </option>
        <?php
        }
        ?>
      </select><br>
      <select name="nxb" id="nxb">
        <?php
        $pstm = $conn->prepare("select * from nhaxuatban");
        $pstm->execute();
        $data = $pstm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $item) {
          $selected = ($item['idnxb'] == $sach['idnxb']) ? 'selected' : '';
        ?>
          <option value="<?= $item['idnxb'] ?>" <?= $selected ?>>
            <?= $item['tennxb'] ?>
          </option>
        <?php
        }
        ?>
      </select><br>
    
      <button type="submit" name="submit">Sửa Sách</button>
    </form>
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