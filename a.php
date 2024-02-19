<?php
require_once "./DB/DBconnect.php";
session_start();
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $pstm = $conn->prepare("select * from user where username =:username");
  $pstm->execute(array(
    "username"=>$user
  ));
  $data = $pstm->fetch(PDO::FETCH_ASSOC);
  echo $data['username'];
  echo $data['iduser'];
}
