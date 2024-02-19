<?php 
  session_start();
  require_once "DB/DBconnect.php";
  if(isset($_POST['submit']) && $_POST['username'] != '' && $_POST['password'] != '' && $_POST['res-password'] != '' && $_POST['phone'] != '' && $_POST['email'] != '')
  {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $respassrod = $_POST["res-password"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $role = 'user';
    if( $password != $respassrod){
      $_SESSION["thongbao"] = "Password nhập không chính xác";
      header("location:register.php");
    }
    $password = md5($password);
    $pstm =$conn->prepare("select * from user where username = :username");
    $pstm->bindParam(':username',$username);
    $pstm->execute();
   
    if($pstm->rowCount()>0){
      $_SESSION["thongbao"]="Tai khoan da ton tai";
      header("location:register.php");
    }
    else{
      $pstm = $conn->prepare("INSERT INTO user (iduser,username, password,sdt,email,role) VALUES (null,:username, :password,:phone,:email,:role)");
      $pstm->bindParam(':username', $username);
      $pstm->bindParam(':password', $password);
      $pstm->bindParam(':phone',$phone);
      $pstm->bindParam(':email',$email);
      $pstm->bindParam(':role',$role);
      $pstm->execute();
      $_SESSION["thongbao"]="Da dang ky thanh cong";
      header("location:login.php");
    }
  }
  else{
    $_SESSION["thongbao"] = "Vui lòng nhập đầy đủ thông tin";
    header("location:register.php");
  }
?>