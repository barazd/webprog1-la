<nav>
    <ul>
        <?php 
            foreach (MAIN_MENU as $item)
            {
                print '<li><a href="' . $item['path'] . '" ' . ($item['path'] === $route['path'] ?? 'class="active"' ) . '>' . $item['title'] . '</a></li>';
            }
        ?>
    </ul>
</nav>
