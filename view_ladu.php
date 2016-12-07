<!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Laoprogramm</title>
</head>

<body>

    <h1>Laoprogramm</h1>

    <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Logi välja</button>
    </form>

    <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="lisa">
        <table>
            <tr>
                <td>Nimetus</td>
                <td><input type="text" name="nimetus" id="nimetus" value=""></td>
            </tr>
            <tr>
                <td>Kogus</td>
                <td><input type="number" name="kogus" id="kogus" value=""></td>
            </tr>
            <tr>
                <td>Kategooria</td>
                <td>
                    <select name="kategooria">
                        <option value=""> -- Vali nimekirjast -- </option>
                        <?php foreach (kategooria_model_load() as $rida): ?>

                            <option value="<?= $rida['Id']; ?>">
                                <?= htmlspecialchars($rida['Nimetus']); ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        <p> <button type="submit">Lisa kirje</button> </p>
    </form>

    <table id="ladu" border="1">
        <thead>
            <tr>
                <th>Nimetus</th>
                <th>Kogus</th>
                <th>Kategooria</th>
                <th>Tegevused</th>
            </tr>
        </thead>
        <tbody>

        <?php
            // väljastame tsükli abil ükshaaval kõik salvestatud read

            // tsükli algus
            foreach (model_load() as $rida):
        ?>

            <tr>
                <td> <?= htmlspecialchars($rida['Nimetus']) ?> </td>
                <td> <?= htmlspecialchars($rida['Kogus']) ?> </td>
                <td> <?= htmlspecialchars($rida['Kategooria']) ?> </td>
                <td>
                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="action" value="kustuta">
                        <input type="hidden" name="id" value="<?= $rida['Id']; ?>">
                        
                        <a href="<?=$_SERVER['PHP_SELF'] ?>?view=modify&amp;id=<?=$rida['Id'] ?>"> Muuda </a>
                        
                        <button type="submit">Kustuta</button>
                    </form>
                </td>
            </tr>

        <?php
            endforeach;
            // tsükli lõpp
        ?>

        </tbody>
    </table>

</body>

</html>
