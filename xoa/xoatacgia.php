<?php 
  require_once "../DB/DBconnect.php";
  if ($_SERVER['REQUEST_METHOD'] == "GET")
  {
    if(isset($_GET['action']) && $_GET['action']=='delete')
    {
      $idtg = $_GET['idtg'];
      $pstm = $conn->prepare("delete from tacgia where idtg = :idtg");
      $pstm->execute(array('idtg'=>$idtg));
      header('Location:../tacgia.php');
      exit();
    }
  }
?>