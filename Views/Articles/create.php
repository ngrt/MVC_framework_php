<h2>Create an article</h2>
<form method='post' action="#">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter a title" name="title">
        <?php echo isset($errors["title"]) ? $errors["title"] : null;?>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" name="body" id="body" rows="10" placeholder="Right your article here"></textarea>
    </div>
    <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="category" name="category">
            <?php
                foreach ($categories as $category)
                {
            ?>
                    <option value="<?php echo $category["id"]; ?>"><?php echo $category["title"]; ?></option>
            <?php
                }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Post</button>
</form>