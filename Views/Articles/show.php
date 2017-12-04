<h1><?php echo $article[0]['title']?></h1>

<p><?php echo $article[0]['body']?></p>
<p>Written by <?php echo $author . ' the ' . $article[0]['created_at'] . " and edited the " . $article[0]['updated_at']; ?></p>

<h2>Comments</h2>
<form method='post' action="#">
    <div class="form-group">
        <label for="body">Your comment</label>
        <textarea class="form-control" name="body" id="body" rows="5" placeholder="Right your comment here"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Post</button>
</form>

<?php
    foreach ($comments as $key => $comment)
    {
        echo "<div>";
        echo "<p>" . $comment['body'] . "</p>";
        echo "<p>Author: " . $comment['username'] . "</p>";
        echo "</div>";
        echo "<br>";
    }

?>

