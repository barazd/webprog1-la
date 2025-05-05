<nav>
    <label for='hamburger-menu' tabindex="0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M3 15.5h18V13H3zM3 11h18V8.5H3zm0-4.5h18V4H3zM21 21V3zM3 20h18v-2.5H3z"/></svg>
        főmenü
    </label>
    <input id='hamburger-menu' type='checkbox' />
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
