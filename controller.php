<?php

function controller_add($nimetus, $kogus, $kategooria)
{
    if ($nimetus == '' || $kogus <= 0 || $kategooria <= 0) {
        return false;
    }

    return model_add($nimetus, $kogus, $kategooria);
}

function controller_delete($id)
{
    if ($id <= 0) {
        return false;
    }

    return model_delete($id);
}

function controller_user()
{
    if (empty($_SESSION['user'])) {
        return false;
    }

    return $_SESSION['user'];
}

function controller_login($kasutajanimi, $parool)
{
    if ($kasutajanimi == '' || $parool == '') {
        return false;
    }

    $id = model_get_user($kasutajanimi, $parool);

    if (!$id) {
        return false;
    }

    session_regenerate_id();
    $_SESSION['user'] = $id;

    return $id;
}

function controller_logout()
{
    session_destroy();

    return true;
}

function controller_add_user($kasutajanimi, $parool, $parool2)
{
    if ($kasutajanimi == '' || $parool == '' || $parool != $parool2) {
        return false;
    }

    return model_add_user($kasutajanimi, $parool);
}

function controller_edit($id, $nimetus, $kogus, $kategooria){
	if($id<=0 || $nimetus =='' || $kogus<=0 || $kategooria <=0)
	{return false;
		}
		return model_edit($id, $nimetus, $kogus, $kategooria);
	}