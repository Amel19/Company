<?php
  ### Session check ###
  session_start();
    #Session variables
    $userId = $_SESSION['zaposlenik_id'];
    $credentials = $_SESSION['zaposlenik_credentials'];
      isset($_SESSION['zaposlenik_id']) && !empty($_SESSION['zaposlenik_id']) ? : header("Location:../index.php");
      #$credentials == 2 ? : header("Location:../login.php?e=3");
    #End session check
  session_destroy(); //destroy the session
  header("location:index.php"); //to redirect back to "index.php" after logging out
  exit();
?>