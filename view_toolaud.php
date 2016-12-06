<!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Kõnekeskus</title>
</head>

<body>

    <h1>Kõnekeskuse register</h1>

    <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Logi välja</button>
    </form>

    <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="lisa">
        <table>
            <tr>
                <td>Kirjeldus</td>
                <td>Tähtaeg</td>
                <td>Kriitilisus</td>
            </tr>
            <tr>
                <td><input type="text" name="kirjeldus" id="kirjeldus" value=""></td>
                <td><input type="datetime" name="tahtaeg" id="tahtaeg" value=""></td>
                <td><select name="kriitilisus">
                	<option value= ""> -- Vali tase -- </option>
                	<?php foreach (kriitilisus_model_load() as $rida):?>

                	<option value="<?=$rida['Id']; ?>">
                		<?= htmlspecialchars($rida['Nimetus']);?>
                	</option>

                	<?php endforeach;?>
                	</select>
                </td>
            </tr>
        </table>
        <p> <button type="submit">Registreeri pöördumine</button> </p>
    </form>

    <table id="nimekiri" border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Kirjeldus</th>
                <th>Kriitilisus</th>
                <th>Registreeritud</th>
                <th>Tähtaeg</th>
                <th>Registreeris</th>
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
                <td> <?= htmlspecialchars($rida['Id']) ?> </td>
                <td> <?= htmlspecialchars($rida['Kirjeldus']) ?></td>
                <td>
                <a href="<?= $_SERVER['PHP_SELF']?>?Kriitilisus=<?= $rida['kat']?>">
                <?= htmlspecialchars($rida['Kriitilisus']) ?>
                </a>
                </td>
                <td> <?= htmlspecialchars($rida['Registreeritud']) ?></td>
                <td> <?= htmlspecialchars($rida['Tahtaeg']) ?></td>
                <td> <?= htmlspecialchars($rida['Kasutaja']) ?></td>
                <td>
                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="action" value="muuda">
                        <input type="hidden" name="id" value="<?= $rida['Id']; ?>">
                        <button type="submit">Märgi lahendatuks</button>
                    </form>
                </td>
            </tr>

        <?php
            endforeach;
            // ts?kli l?pp
        ?>

        </tbody>
    </table>

</body>

</html>
