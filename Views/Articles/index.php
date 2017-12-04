<?php
foreach ($article as $key => $value)
{
    echo "<h2><a href='/PHP_Rush_MVC/articles/show/" . $value['id'] . "'>" . $value['title'] . "</a></h2>";
    echo "<p>" . substr($value['body'], 0, 1000) . "..." . "</p>";
}
?>
<nav aria-label="...">
    <ul class="pagination">
        <?php
            if ($page == 1)
            {
                echo "<li class='page-item disabled'>";
                echo "<span class='page-link'>Previous</span>";
                echo "</li>";
            }
            else
            {
                echo "<li class='page-item'>";
                echo "<a class='page-link' href='/PHP_Rush_MVC/articles/index/" . ($page-1) . "'>Previous</a>";
                echo "</li>";
            }

            for ($i = 1; $i <= $pages; $i++)
            {
                if ($i == $page)
                {
                    echo "<li class='page-item active'><a class='page-link' href='/PHP_Rush_MVC/articles/index/$i'>$i</a></li>";
                }
                else
                {
                    echo "<li class='page-item'><a class='page-link' href='/PHP_Rush_MVC/articles/index/$i'>$i</a></li>";
                }

            }

            if ($page == $pages)
            {
                echo "<li class='page-item disabled'>";
                echo "<span class='page-link'>Next</span>";
                echo "</li>";
            }
            else
            {
                echo "<li class='page-item'>";
                echo "<a class='page-link' href='/PHP_Rush_MVC/articles/index/" . ($page+1) . "'>Next</a>";
                echo "</li>";
            }
            ?>
    </ul>
</nav>
