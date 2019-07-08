


  $sql = "INSERT INTO `news` (`id`, `title`, `overview`, `image`, `body`, `link`) VALUES
        (NULL, '".$dataTitle."', '".$dataOverview."', '".$dataImage."', '".$dataBody."', '".$url."')";

        $result = $connection->query($sql);

        if ($result) {
        	echo $result;
        } else {
        	echo 'ERROR';
        }