<h1><?php echo $article[0]['title']?></h1>

<p><?php echo $article[0]['body']?></p>


<p>Written by <?php echo $author . ' the ' . $article[0]['created_at'] . " and edited the " . $article[0]['updated_at']; ?></p>