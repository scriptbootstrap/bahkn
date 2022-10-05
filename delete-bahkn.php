<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location:../../../auth/login");
  exit;
}

require('../../../funct/functions.php');


// SESSION USER LOGIN
if (isset($_SESSION["login"])) {

  $userSession = $_SESSION["username"];
  $resultSession = $conn->query("SELECT * FROM tb_users WHERE username = '$userSession' ");
  $rowSession = mysqli_fetch_assoc($resultSession);
  $idSession = $rowSession["id"];
}

// DELETE/HAPUS DATA BAHKN
if (isset($_GET["id_del_bahkn"])) {

  $id = $_GET["id_del_bahkn"];
  if (deleteBAHKN($id) > 0) {
    echo "
    <script>
      alert('Data berhasil di hapus!');
      document.location.href = 'bahkn';
    </script>";
  } else {
    echo "
    <script>
      alert('Data gagal di hapus!');
      document.location.href = 'bahkn';
    </script>";
  }
}


// CEK LEVEL
include("../../../include/check-level.php");

if (($rowSession["level"] === $levelPPK)) {
  header("Location:../../");
  exit;
}
