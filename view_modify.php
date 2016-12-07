<!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Kannete muutmine</title>
</head>

<body>

    <h1>Kannete muutmine</h1>

    <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Logi välja</button>
    </form>

    <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="muuda">
        <input type="hidden" name="Id" value="<?=$kaup['Id'] ?>">
        <table>
            <tr>
                <td>Nimetus</td>
                <td><input type="text" name="nimetus" id="nimetus" value="<?= htmlspecialchars($kaup['Nimetus']) ?>"></td>
            </tr>
            <tr>
                <td>Kogus</td>
                <td><input type="number" name="kogus" id="kogus" value="<?= htmlspecialchars($kaup['Kogus']) ?>"></td>
            </tr>
            <tr>
                <td>Kategooria</td>
                <td>
                    <select name="kategooria">
                        <option value=""> -- Vali nimekirjast -- </option>
                        <?php foreach (kategooria_model_load() as $rida): ?>

                            <option value="<?= $rida['Id']; ?>"
                            	<?php if($kaup['Kategooria'] == $rida['Id']):?>
                            selected
                             <?php endif ?>
                             >
                                <?= htmlspecialchars($rida['Nimetus']); ?>
                            </option>

                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        <p> <button type="submit">Muuda kirjet</button> </p>
    </form>



</body>

</html>


// xampp keskkond