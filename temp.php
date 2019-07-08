// удалим таблицу
$query1 = "DROP TABLE NEWS";
mysqli_query($connection, $query1);

// создадим таблицу
$query = "CREATE TABLE NEWS (
          ID int(11) AUTO_INCREMENT,
          TITLE varchar(255),
          OVERVIEW varchar(255),
          IMAGE varchar(255),
          BODY varchar(2000),
          LINK varchar(255),
          PRIMARY KEY  (ID)
          )";

  $result = mysqli_query($connection, $query);


  if ($result) {
    echo $result;
  } else {
    echo 'ERROR';
  }



  $sql = "INSERT INTO `news` (`id`, `title`, `overview`, `image`, `body`, `link`) VALUES
        (NULL, '".$dataTitle."', '".$dataOverview."', '".$dataImage."', '".$dataBody."', '".$url."')";

        $result = $connection->query($sql);

        if ($result) {
        	echo $result;
        } else {
        	echo 'ERROR';
        }