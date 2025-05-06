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
                        print ' <a href="#" onclick="lightbox(\'' . $photo->title . '\', \'' . $photo->path . '\')" style="background-image: url(' . $photo->path . ');" class="thumbnail">
                                    <img src="' . $photo->path . '" />
                                    <p>' . $photo->title . '</p>
                                </a>';
                    }
                ?>
            </div>
        </div>
    </div>
    <aside>
        <div class="box">
            <h2>Kép feltöltése</h2>
            <?php if ($auth['authenticated']): ?>
            <form action="/kepek" method="post" enctype="multipart/form-data" class="formatted-form">
                <div class="input">
                    <input type="text" name="title" placeholder="Cím" />
                </div>
                <div class="input">
                    <input type="file" name="file" placeholder="Tallózás..." />
                </div>
                <p>Max 10MB, .jpg, .png vagy .webp.</p>
                <div class="input">
                    <button type="submit">Feltöltés</button>
                </div>
            </form>
            <?php else: ?>
            <p>Csak bejelentkezett felhasználó tölthet fel képet!</p>
            <?php endif; ?>
        </div>
    </aside>
    
    <div class="lightbox-wrapper hidden" id="lightbox" onclick="closeLightbox()">
        <div class="box">

        </div>
    </div>

    <script src="/assets/lightbox.js"></script>

<?php include 'Partials/layout.footer.php' ?>