<h2>Edit this article</h2>
<form method='post' action="#">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter a title" name="title" value ="<?php if (isset($article[0]["title"])) echo $article[0]["title"];?>">
        <?php //if (isset($this->verifyPostForm($_POST)["title"])) echo $this->verifyPostForm($_POST)["title"];?>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" name="body" id="body" id="" rows="10" placeholder="Right your article here" ><?php if (isset($article[0]["body"])) echo $article[0]["body"];?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Post</button>
</form>