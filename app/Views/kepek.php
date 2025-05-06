<?php include 'Partials/layout.header.php' ?>

    <div class="content">
        <?php if (isset($errors) && count($errors)) {
            print '<div class="box error"><ul>';
            foreach ($errors as $error) {
                print '<li>' . $error . '</li>';
            }
            print '</ul></div>';
        }
        ?>
        <?php if (isset($success) && $success) {
            print '<div class="box success"><ul>';
            print '<li>' . $success . '</li>';
            print '</ul></div>';
        }
        ?>
        <div class="box">
            <h2>Képek</h2>
            <div class="gallery">
                <?php
                    foreach ($photos as $photo)
                    {
                        print ' <div class="thumbnail">
                                    <a href="#" onclick="lightbox(' . $photo->title . ', ' . $photo->path . ')">
                                        <img src="' . $photo->path . '" />
                                        <p>' . $photo->title . '</p>
                                    </a>
                                </div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <aside>
        <div class="box">
            <h2>Kép feltöltése</h2>
            <form action="/kepek" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Cím" />
                <input type="file" name="file" placeholder="Tallózás..." />
                <button type="submit">Feltöltés</button>
            </form>
        </div>
    </aside>

<?php include 'Partials/layout.footer.php' ?>