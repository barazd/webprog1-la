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
            <h2>Belépés</h2>
            <form action="/belepes" method="post" class="formatted-form">
                <div class="form-value">
                    <div class="label"><label for="login_username">Felhasználónév</label></div>
                    <div class="input"><input type="text" name="username" id="login_username" /></div>
                </div>
                <div class="form-value">
                    <div class="label"><label for="login_password">Jelszó</label></div>
                    <div class="input"> <input type="password" name="password" id="login_password" /></div>
                </div>
                <div class="form-value">
                    <div class="label"></div>
                    <div class="input"><button type="submit">Bejelentkezés</button></div>
                </div>  
            </form>
        </div>
        <div class="box">
            <h2>Regisztráció</h2>
            <p>Ha még nincs felhasználói fiókod, hozz egyet létre!</p>
            <form action="/regisztracio" method="post" class="formatted-form">
                <div class="form-value">
                    <div class="label"><label for="register_username">Felhasználónév</label></div>
                    <div class="input"><input type="text" name="username" id="register_username" required /></div>
                </div>
                <div class="form-value">
                    <div class="label"><label for="register_password">Jelszó</label></div>
                    <div class="input col">
                        <input type="password" name="password" id="register_password" required />
                        <p><em>A jelszónak 8-20 karakter hosszúnak kell lennie, és legalább 1 db kisbetűt, 1 db nagybetűt, 1 db számot és 1 db speciális karaktert (!@#$%) kell tartalmaznia!</em></p>
                    </div>
                </div>
                <div class="form-value">
                    <div class="label"><label for="register_password_confirm">Jelszó megerősítése</label></div>
                    <div class="input"><input type="password" name="password_confirm" id="register_password_confirm" required /></div>
                </div>
                <div class="form-value">
                    <div class="label"><label for="register_email">E-mail cím</label></div>
                    <div class="input"><input type="text" name="email" id="register_email" required /></div>
                </div>
                <div class="form-value">
                    <div class="label"><label for="register_last_name">Vezetéknév</label></div>
                    <div class="input"><input type="text" name="last_name" id="register_last_name" required /></div>
                </div>
                <div class="form-value">
                    <div class="label"><label for="register_first_name">Keresztnév</label></div>
                    <div class="input"><input type="text" name="first_name" id="register_first_name" required /></div>
                </div>
                <div class="form-value">
                    <div class="label"></div>
                    <div class="input"><button type="submit">Regisztráció</button></div>
                </div>   
            </form>
        </div>
    </div>

<?php include 'Partials/layout.footer.php' ?>