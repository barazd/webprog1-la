<nav>
    <ul>
        <?php 
            foreach (MAIN_MENU as $item)
            {
                if (!isset($item['authenticated']) || $item['authenticated'] === $auth['authenticated'])
                    print '<li><a href="' . $item['path'] . '" ' . ($item['path'] !== $route ?: 'class="active"' ) . '>' . $item['title'] . '</a></li>';
            }
        ?>
    </ul>
</nav>
