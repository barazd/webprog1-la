<?php include 'Partials/layout.header.php' ?>

    <div class="content">
        <?php if (isset($errors) && count($errors)) 
            {
                print '<div class="box error"><ul>';
                foreach ($errors as $error)
                {
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
            <h2>Kapcsolat</h2>
            <form action="/kapcsolat" method="post" class="formatted-form">
                <?php if (!$auth['authenticated']) {
                    print ' <div class="form-value">
                                <div class="label"><label for="sender_name">Név</label></div>
                                <div class="input"><input type="text" name="sender_name" id="sender_name" /></div>
                            </div>';
                    print ' <div class="form-value">
                                <div class="label"><label for="sender_email">E-mail cím</label></div>
                                <div class="input"><input type="text" name="sender_email" id="sender_email" /></div>
                            </div>';
                }
                else
                {
                    print ' <div class="form-value">
                                <div class="label"></div>
                                <div class="input"><p>Bejelentkezett felhasználóként küldesz üzenetet.</p></div>
                            </div>';
                }
                ?>
                <div class="form-value">
                    <div class="label"><label for="message">Üzenet</label></div>
                    <div class="input"> <textarea name="message" id="message"></textarea></div>
                </div>
                <div class="form-value">
                    <div class="label"></div>
                    <div class="input"><button type="submit">Küldés</button></div>
                </div>  
            </form>
        </div>
    </div>

<?php include 'Partials/layout.footer.php' ?>