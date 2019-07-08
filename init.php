<?php
  $dropQuery = "DROP TABLE NEWS";
  mysqli_query($connection, $dropQuery);

  $createTableQuery = "CREATE TABLE NEWS (
    ID int(11) AUTO_INCREMENT,
    TITLE text,
    IMAGE text,
    BODY longtext,
    LINK text,
    PRIMARY KEY  (ID)
  )";

  $initResult = mysqli_query($connection, $createTableQuery);
?>