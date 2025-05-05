<?php include 'Partials/layout.header.php' ?>

    <div class="content">
        <div class="box">
            <h2>Üzenetek</h2>
            <?php
            foreach ($messages as $message)
            {
                var_dump($message);
            }
            ?>
        </div>
    </div>

<?php include 'Partials/layout.footer.php' ?>