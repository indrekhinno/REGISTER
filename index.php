<?php

session_start();


// laeme sisse funktsioonid andmete laadimiseks ja salvestamiseks
require 'model.php';

// laeme funktsioonid andmete manipuleerimiseks
require 'controller.php';

// POST ruuter
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = false;

    // valime tegevuse vastavalt <input name=action> elemendi väärtusele
    switch ($_POST['action']) {

        case 'lisa':
            $kirjeldus = $_POST['kirjeldus'];
            $tahtaeg = $_POST['tahtaeg'];
            $kriitilisus = intval($_POST['kriitilisus']);
            $kasutaja = intval($_SESSION['user']);
            $result = controller_add($kirjeldus, $tahtaeg, $kriitilisus,$kasutaja);
            break;

        case 'muuda':
            $id = intval($_POST['id']);
            $result = controller_resolve($id);
            break;

        case 'login':
            $kasutajanimi = $_POST['kasutajanimi'];
            $parool = $_POST['parool'];
            $result = controller_login($kasutajanimi, $parool);
            break;

        case 'register':
            $kasutajanimi = $_POST['kasutajanimi'];
            $parool = $_POST['parool'];
            $parool2 = $_POST['parool'];
            $result = controller_add_user($kasutajanimi, $parool, $parool2);
            break;

        case 'logout':
            $result = controller_logout();
            break;



    }

    if ($result) {
        header('Location: '.$_SERVER['PHP_SELF']);
    } else {
        echo 'Viga!';
    }

    exit;
}

$view = empty($_GET['view']) ? 'toolaud' : $_GET['view'];

switch ($view) {

    case 'toolaud':
        check_login();
        require 'view_toolaud.php';
        break;
    case 'login':
        require 'view_login.php';
        break;
    case 'register':
    	require 'view_register.php';
    	break;
    default:
        echo 'Viga!';
}

function check_login()
{
    if (!controller_user()) {
        header('Location: '.$_SERVER['PHP_SELF'].'?view=login');
        exit;
    }
}
