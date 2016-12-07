<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Loo konto</title>
    </head>
    <body>
        <h1>Loo konto</h1>
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
                    <td>Parooli kordus</td>
                    <td>
                        <input type="password" name="parool2">
                    </td>
                </tr>
            </table>
            <button type="submit">Loo konto</button>
        </form>
    </body>
</html>
