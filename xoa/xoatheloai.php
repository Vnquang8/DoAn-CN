<?php 
  require_once "../DB/DBconnect.php";
  if ($_SERVER['REQUEST_METHOD'] == "GET")
  {
    if(isset($_GET['action']) && $_GET['action']=='delete')
    {
      $idtl = $_GET['idtl'];
      $pstm = $conn->prepare("delete from theloai where idtl = :idtl");
      $pstm->execute(array('idtl'=>$idtl));
      header('Location:../theloai.php');
      exit();
    }
  }
?>