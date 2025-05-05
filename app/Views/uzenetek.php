<?php include 'Partials/layout.header.php' ?>

    <div class="content">
        <div class="box">
            <h2>Üzenetek</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Név</th>
                        <th>E-mail</th>
                        <th>Létrehozva</th>
                        <th>Üzenet</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($messages as $message)
                {
                    print ' <tr>
                                <td>' . ($message->getSenderDetails()['registered'] ? 'regisztrált' : 'vendég') . '</td>
                                <td>' . $message->getSenderDetails()['name'] . '</td>
                                <td>' . $message->getSenderDetails()['email'] . '</td>
                                <td>' . $message->created_at . '</td>
                                <td>' . $message->message . '</td>
                            </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'Partials/layout.footer.php' ?>