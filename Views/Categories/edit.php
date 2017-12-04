<div class="container">
    <div class="row col-sm-8 col-sm-offset-2 custyle">
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>#Id</th>
                <th>Title</th>
                <th class="">Action</th>
            </tr>
            </thead>
            <?php
            foreach($articles as $key => $article)
            {
                echo "<tr>";
                echo "<td>" . $article['id'] . "</td>";
                echo "<td>" . $article['title'] . "</td>";
                echo "<td><a href='". WEBROOT . "categories/delete/" . $article['id'] . "' class='btn btn-danger'>Del</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <h2>Add an article</h2>
    <form method='post' action="#">
    <div class="form-group">
        <label for="article_id">Articles not in this category:</label>
        <select class="form-control" id="article_id" name="article_id">
            <?php
            foreach ($articlesNotInCat as $article)
            {
                ?>
                <option value="<?php echo $article["id"]; ?>"><?php echo $article["title"]; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
    </form>

</div>
