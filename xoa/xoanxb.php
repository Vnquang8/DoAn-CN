<?php 
  require_once "../DB/DBconnect.php";
  if ($_SERVER['REQUEST_METHOD'] == "GET")
  {
    if(isset($_GET['action']) && $_GET['action']=='delete')
    {
      $idnxb = $_GET['idnxb'];
      $pstm = $conn->prepare("delete from nhaxuatban where idnxb = :idnxb");
      $pstm->execute(array('idnxb'=>$idnxb));
      header('Location: ../nhaxuatban.php');
    }
  }
?>