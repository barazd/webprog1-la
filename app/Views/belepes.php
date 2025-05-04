<?php include 'Partials/layout.header.php' ?>

    <div class="content">
        <?php if (isset($errors) && count($errors)) 
            {
                print '<div class="box"><ul class="errors">';
                foreach ($errors as $error)
                {
                    print '<li>' . $error . '</li>';
                }
                print '</ul></div>';
            }
        ?>
        <div class="box">
            <h2>Belépés</h2>
            <form action="/belepes" method="post">
                <label for="login_username">Felhasználónév</label>
                <input type="text" name="username" id="login_username" />
                <label for="login_password">Jelszó</label>
                <input type="password" name="password" id="login_password" />
                <button type="submit">Bejelentkezés</button>
            </form>
        </div>
        <div class="box">
            <h2>Regisztráció</h2>
            <p>Ha még nincs felhasználói fiókod, hozz egyet létre!</p>
            <form action="/regisztracio" method="post">
                <label for="register_username">Felhasználónév</label>
                <input type="text" name="username" id="register_username" required />
                <label for="register_password">Jelszó</label>
                <input type="password" name="password" id="register_password" required />
                <label for="register_password_confirm">Jelszó megerősítése</label>
                <input type="password_confirm" name="password_confirm" id="register_password_confirm" required />
                <label for="register_email">E-mail cím</label>
                <input type="text" name="register_email" id="register_email" required />
                <label for="register_last_name">Vezetéknév</label>
                <input type="text" name="register_last_name" id="register_last_name" required />
                <label for="register_first_name">Keresztnév</label>
                <input type="text" name="register_first_name" id="register_first_name" required />
                <button type="submit">Regisztráció</button>
            </form>
        </div>
    </div>

<?php include 'Partials/layout.footer.php' ?>