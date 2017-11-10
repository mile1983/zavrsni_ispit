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

    if(!empty($_POST['author']) && !empty($_POST['text']) && !empty($_POST['post_id'])) {

    header("Location: single-post.php?post_id={$_POST['post_id']}");
   
   $createComment = "INSERT INTO comments (author,text, post_id) VALUES ('{$_POST['author']}', '{$_POST['text']}', '{$_POST['post_id']}')";
        $statement = $connection->prepare($createComment);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $singlePost = $statement->fetch();          
    }else{
        header("Location: single-post.php?post_id={$_POST['post_id']}&error=true");
}

?>