<?php
foreach ($article as $key => $value)
{
    echo "<h2><a href='/PHP_Rush_MVC/articles/show/" . $value['id'] . "'>" . $value['title'] . "</a></h2>";
    echo "<p>" . $value['body'] . "</p>";
}
?>