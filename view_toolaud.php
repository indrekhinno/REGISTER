<!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stiil.css">
    <title>Kõnekeskus</title>
</head>

<body>

    <h1>Kõnekeskuse register</h1>

    <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Logi välja</button>
    </form>
<p>


    <form id="lisa-vorm" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="action" value="lisa">
        <table>
          <thead class="sisestuspealdis">
              <tr>
                <td>Kirjeldus</td>
                <td>Tähtaeg</td>
                <td>Kriitilisus</td>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td><input type="textarea" name="kirjeldus" id="kirjeldus" value=""></td>
                <td><input type="date" name="tahtaeg" id="tahtaeg" value=""></td>
                <td><select name="kriitilisus" id="tase">
                	<option value= ""> -- Vali tase -- </option>
                	<?php foreach (kriitilisus_model_load() as $rida):?>

                	<option value="<?=$rida['Id']; ?>">
                		<?= htmlspecialchars($rida['Nimetus']);?>
                	</option>

                	<?php endforeach;?>
                	</select>
                </td>
            </tr>
          </tbody>
        </table>
        <p> <button type="submit">Registreeri pöördumine</button> </p>
    </form>

    <form>

  <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <?php $value = empty($_GET['show']) ? 'Koik': $_GET['show']  ?>
    <div class="filtrivalik">
    <?php $sel1 = ($value == "Avatud") ? 'checked="checked"' : ''; ?>
    <input type="radio" name="show" value="Avatud" <?= $sel1; ?> >Näita ainult avatuid<br>
    <?php $sel2 = ($value == "Suletud") ? 'checked="checked"' : ''; ?>
    <input type="radio" name="show" value="Suletud" <?= $sel2; ?> >Näita ainult suletuid<br>
    <?php $sel3 = ($value == "Koik") ? 'checked="checked"' : ''; ?>
    <input type="radio" name="show" value="Koik" <?= $sel3; ?> >Näita kõiki kirjeid<br>
    <br>
    <button type="submit">Filtreeri</button>
  </div>



  </form>
  <p>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th class="tabelitekst">Kirjeldus</th>
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
                <td> <?= htmlspecialchars($rida['Nimetus']) ?> </td>
                <td> <?= htmlspecialchars($rida['Lisatud']) ?></td>
                <td> <?= htmlspecialchars($rida['Tahtaeg']) ?></td>
                <td> <?= htmlspecialchars($rida['Kasutajanimi']) ?></td>
                <td> <?php if($rida['Kas_lahendatud'] == '0'){ ?>

                    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="action" value="muuda">
                        <input type="hidden" name="id" value="<?= $rida['Id']; ?>">
                        <button type="submit" >Märgi lahendatuks</button>
                    </form><?php } ?>

                </td>
            </tr>

        <?php
            endforeach;
            // ts?kli l?pp
            ?>

        </tbody>
    </table>

<script src="kontrolli.js"></script>
</body>
</html>
