<?php
  $host = 'localhost';
  $base = 'dbnews';
  $user = 'root';
  $pass = 'root';

  $connection = @new mysqli($host, $user, $pass, $base);



  if (mysqli_connect_errno()) {
      die(mysqli_connect_error());
  }
  $connection->query('SET NAMES "UTF-8"');
?>