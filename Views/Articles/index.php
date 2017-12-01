<?php
foreach ($article as $key => $value)
{
    echo "<h2><a href='/PHP_Rush_MVC/articles/index/" . $value['id'] . "'>" . $value['title'] . "</a></h2>";
    echo "<p>" . $value['body'] . "</p>";
}
?>