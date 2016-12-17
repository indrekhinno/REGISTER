<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="stiil.css">
        <title>Registreeri konto!</title>
    </head>
    <body>
        <h1>Logi sisse</h1>
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <input type="hidden" name="action" value="register">
            <table>
                <tr>
                    <td>Kasutajanimi</td>
                    <td><input type="text" name="kasutajanimi"></td>
                </tr>
                <tr>
                    <td>Parool</td>
                    <td><input type="password" name="parool"></td>
                </tr>
               <tr>
                    <td>Korda parooli</td>
                    <td><input type="password" name="parool2"></td>
                </tr>

            </table>
            <button type="submit">Loo konto</button>
        </form>

    </body>
</html>
