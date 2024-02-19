<<?php 
  session_start();
  require_once "DB/DBconnect.php";
  if(isset($_POST['submit']) && $_POST['username'] != '' && $_POST['password'] != '')
  {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password = md5($password);
    $pstm = $conn->prepare("select * from user where username = :username and password = :password");
    $pstm->bindParam(':username',$username);
    $pstm->bindParam(':password',$password);
    $pstm->execute();
    $user = $pstm->fetch(PDO::FETCH_ASSOC);
    if($pstm->rowCount()>0){
      if($user['role'] == 'admin')
      {
        $_SESSION["islogin"] = 1;
        $_SESSION["user"] = $username;
        header("location: quanly.php");
      }
      else{
        $_SESSION["islogin"] = 1;
        $_SESSION["user"] = $username;
        header("location:index.php");
      }
    }
    else{
      $_SESSION["thongbao"] = "Sai ten dang nhap hoac mat khau";
      header("location:login.php");
    }
  }
  else{
    $_SESSION["thongbao"] = "Vui long nhap day du thong tin";
    header("location:login.php");
  }
?>