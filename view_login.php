<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Logi sisse</title>
    </head>
    <body>
        <h1>Logi sisse</h1>
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="action" value="login">
            <table>
                <tr>
                    <td>Kasutajanimi</td>
                    <td><input type="text" name="kasutajanimi"></td>
                </tr>
                <tr>
                    <td>Parool</td>
                    <td><input type="password" name="parool"></td>
                </tr>
            </table>
            <button type="submit">Logi sisse</button>
        </form>
		<p>
		Ei ole kontot? <a href="<?= $_SERVER['PHP_SELF']?>?view=register">loo see siin</a>
		</p>
    </body>
</html>
