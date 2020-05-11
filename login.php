<?php

if(isset($_POST['username']) && !empty($_POST['username'])){
  if(isset($_POST['password']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
      require "Classes/UserClass.php";
      $login = new User;
      $login->login($username, $password);
  }
}
?>