<?php
 
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
?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<body>

<?php
    include("header.php");
?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

   <?php
                if (isset($_GET['post_id'])) {
                    $sql = "SELECT * FROM posts  WHERE id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $singlePost = $statement->fetch();
                }
            ?>

            <div class="blog-post">
                <a href = ""<h2 class="blog-post-title"><?php echo($singlePost['title']) ?></h2></a>
                <p class="blog-post-meta"><?php echo $singlePost['created_at'] . ' by ' . $singlePost['author']?> </p>

                <p><?php echo $singlePost['body'] ?></p>


                <?php if(isset($_GET['error'])){
                echo "<h2>Sva polja su obavezna</h2>" ;}
                ?>

            <form action="create-comment.php" method="post">
                <label>Your name</label>
                <input type="Text" name="author"  ><br>
                <textarea name="text" rows='5' cols='28' placeholder="Comment"></textarea><br>

               <button type="Submit">Send</button><br>
                <input type="Hidden" name="post_id" value=" <?php echo ($_GET['post_id']); ?>">
                <!-- <input type="Text" name="Text"><br> -->
            </form>


            </div>
            <div class="container">
                <button id= buton type="button" class="btn btn-default" onclick=toogleButon()>hide comments</button>
            </div>
            

             <?php
                if (isset($_GET['post_id'])) {
                    $sql = "SELECT * FROM comments  WHERE post_id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);
                    $statement->execute();
                    $statement->setFetchMode(PDO::FETCH_ASSOC);
                    $comments = $statement->fetchAll();
                }
            ?>

            <ul id ="comments">
            <?php 
            foreach ($comments as $comment)
                                            {          
    ?>
                <li><p><?php
                echo $comment["author"]
                ?>
                </p><?php echo $comment["text"]?></li><hr>
                <form class="deleteComm" method="post" action='delete-comments.php'>
                            <input type="submit" name="delete" value="Delete">
                            <input type="hidden" name="id" value="<?php echo $comment['id'] ?>">
                            <input type="hidden" name="post_id" value="<?php echo $_GET['post_id'] ?>">
                        </form>
                


             <?php
}
?>

            </ul>


            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.blog-main -->

        <?php
    include("sidebar.php");
?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php
    include("footer.php");
?>
<script>
    function toogleButon() {
        var buton = document.getElementById("buton");
        var comments = document.getElementById("comments");
        if (comments.classList.contains("hiden"))
         {
            comments.classList.remove("hiden");
            buton.innerHTML="Hide comments";
        }else{
            comments.classList.add("hiden");
            buton.innerHTML="Show comments";
        }
        
    }
</script>
</body>
</html>