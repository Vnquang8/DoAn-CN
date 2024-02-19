<?php 
  require_once "../DB/DBconnect.php";
  if ($_SERVER['REQUEST_METHOD'] == "GET")
  {
    if(isset($_GET['action']) && $_GET['action']=='delete')
    {
      $idsach = $_GET['idsach'];
      $pstm = $conn->prepare("delete from sach where idsach = :idsach");
      $pstm->execute(array('idsach'=>$idsach));
      header('Location: ../quanly.php');
    }
  }
?>