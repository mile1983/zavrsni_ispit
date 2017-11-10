<?php

   header("Location: single-post.php?post_id={$_POST['post_id']}");

   $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";

   try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

   $deleteid = $_POST['id'];
    $post_id = $_POST['post_id'];

   $deleteComm = "DELETE FROM comments where id = $deleteid LIMIT 1";

   $statement = $connection->prepare($deleteComm);
    $statement->execute();

?>