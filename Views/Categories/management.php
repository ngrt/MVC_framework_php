<div class="container">
    <div class="row col-md-6 col-md-offset-2 custyle">
        <table class="table table-striped custab">
            <thead>
            <tr>
                <th>#Id</th>
                <th>Title</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <?php
            foreach($categories as $key => $category)
            {
                echo "<tr>";
                echo "<td>" . $category['id'] . "</td>";
                echo "<td>" . $category['title'] . "</td>";
                echo "<td class='text-center'><a class='btn btn-info btn-xs' href='" . WEBROOT . "categories/edit/" . $category['id'] . "'><span class='glyphicon glyphicon-edit.php'></span> Edit</a> <a href='". WEBROOT . "categories/delete/" . $category['id'] . "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Del</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>