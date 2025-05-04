<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-programozás-1 Gyakorlat Házi feladat</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="mw-container header">
                <div class="head">
                    <div class="logo"></div>
                    <div class="user">
                        <?php if ($auth['authenticated'])
                        {
                            print 'Üdvözöllek ' . $auth['user']['last_name'] . ' ' . $auth['user']['first_name'] . ' (' . $auth['user']['username'] . ')';
                        }
                        else 
                        {
                            print 'Kijelentkezve';
                        } ?>
                    </div>
                </div>
                <h1>Web-programozás-1 Gyakorlat Házi feladat</h1>
                <?php include 'mainmenu.php' ?>
            </div>
        </header>
        <section>
            <div class="mw-container section">