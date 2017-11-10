<aside class="col-sm-3 ml-sm-auto blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
    <h4>Latest posts</h4>  
     <?php
        $sqlLast = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 5";
        $statementCom = $connection->prepare($sqlLast);
        $statementCom->execute();
        $statementCom->setFetchMode(PDO::FETCH_ASSOC);
        $latestPosts = $statementCom->fetchAll();
        // print_r($latestPosts);
        foreach ($latestPosts as $lastPost) {
      ?>
      <h6>
        <a href="single-post.php?post_id=<?php echo ($lastPost['id']); ?> "> 
          <?php echo $lastPost['title']?>
        </a>
      </h6>

     <?php
      }
      ?>
  </div>
</aside>