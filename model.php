<?php

$host = 'localhost';
$user = 'test';
$pass = 't3st3r123';
$db = 'test';
$prefix = 'ih';

$link = new mysqli($host, $user, $pass, $db);
if ($link->connect_errno) {
    printf('Error: %s', $link->connect_error);
    exit();
}

if (!$link->query('SET CHARACTER SET UTF8')) {
    printf('Error: %s', $link->error);
    exit();
}

function model_load()
{
    global $link, $prefix;

    $query = "SELECT
                kaubad.Id AS Id,
                kaubad.Nimetus AS Nimetus,
                Kogus,
                kategooriad.Nimetus AS Kategooria,
                kaubad.Kategooria AS kat
              FROM {$prefix}__kaubad AS kaubad
              LEFT JOIN {$prefix}__kategooriad AS kategooriad
                  ON kaubad.Kategooria = kategooriad.Id
              ORDER BY Nimetus ASC";

    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }

    $rows = array();
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    $result->close();

    return $rows;
}

function model_add($nimetus, $kogus, $kategooria)
{
    global $link, $prefix;

    $nimetus = $link->real_escape_string($nimetus);
    $kogus = $link->real_escape_string($kogus);
    $kategooria = $link->real_escape_string($kategooria);

    $query =
        "INSERT INTO {$prefix}__kaubad (Nimetus, Kogus, Kategooria)
            VALUES ('$nimetus', '$kogus', '$kategooria')";

    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s "%s"', $link->error, $query);
        exit();
    }
    $id = $link->insert_id;

    return $id;
}

function model_delete($id)
{
    global $link, $prefix;

    $id = $link->real_escape_string($id);

    $query = "DELETE FROM {$prefix}__kaubad WHERE Id='$id' LIMIT 1";

    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $deleted = $link->affected_rows;

    return $deleted;
}

function kategooria_model_load()
{
    global $link, $prefix;

    $query = "SELECT * FROM {$prefix}__kategooriad ORDER BY Nimetus ASC";

    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }

    $rows = array();
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    $result->close();

    return $rows;
}

function model_add_user($kasutajanimi, $parool)
{
    global $link, $prefix;

    $hash = password_hash($parool, PASSWORD_DEFAULT);

    $kasutajanimi = $link->real_escape_string($kasutajanimi);
    $hash = $link->real_escape_string($hash);

    $query = "INSERT INTO {$prefix}__kasutajad (Kasutajanimi, Parool)
                 VALUES('$kasutajanimi', '$hash')";

    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $id = $link->insert_id;

    return $id;
}

function model_get_user($kasutajanimi, $parool)
{
    global $link, $prefix;
    $kasutajanimi = $link->real_escape_string($kasutajanimi);
    $query = "SELECT Id, Parool FROM {$prefix}__kasutajad
                WHERE Kasutajanimi='$kasutajanimi' LIMIT 1";
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $kasutaja = $result->fetch_array();
    if (!$kasutaja) {
        return false;
    }
    $check_user = password_verify($parool, $kasutaja['Parool']);
    if ($check_user) {
        return $kasutaja['Id'];
    }

    return false;
}

function model_get($id) {
	global $link, $prefix;
	
	$id = $link->real_escape_string($id);
	$query = "SELECT * FROM {$prefix}__kaubad WHERE Id='$id' LIMIT 1";
	
	$result = $link->query($query);
	if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
	
    $kaup = $result->fetch_array();
    $result->close();
    
    return $kaup;
    	
}

function model_edit($id, $nimetus, $kogus, $kategooria)
{
    global $link, $prefix;
    
	$id = $link->real_escape_string($id);
    $nimetus = $link->real_escape_string($nimetus);
    $kogus = $link->real_escape_string($kogus);
    $kategooria = $link->real_escape_string($kategooria);

    $query =
        "UPDATE {$prefix}__kaubad 
        	SET 
        		Nimetus='$nimetus',
        		Kogus='$kogus',
        		Kategooria='$kategooria'
        	WHERE Id='$id' LIMIT 1";

    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s "%s"', $link->error, $query);
        exit();
    }
    return $link->affected_rows;
}