<?php

$host='localhost';
$user = 'test';
$pass = 't3st3r123';
$db = 'test';
$prefix = 'ih';

$link= new mysqli($host, $user, $pass, $db);
if( $link->connect_errno){
	printf('Error: %s', $link->connect_error);
	exit();
	}

	if(! $link->query('SET CHARACTER SET UTF8')) {
		printf('Error: %s', $link->error );
		exit();
		}

function model_load()
{
    global $link, $prefix;


    $query = "SELECT 	koned.Id AS Id,
    					koned.Kirjeldus AS Kirjeldus,
    					kriitilisus.Nimetus AS Kriitilisus,
							koned.Lisatud AS Registreeritud,
							Tahtaeg,
							kasutajad.Kasutajanimi AS Kasutaja,
							koned.Kas_lahendatud AS Staatus
							koned.Kriitilisus AS kriitiline
    			FROM {$prefix}__koned AS koned
    			LEFT JOIN {$prefix}__kriitilisus AS kriitilisus
					AND {prefix}__kasutajad AS kasutajad
    			ON  koned.Kriitilisus = kriitilisus.Id
					AND koned.Kasutaja = kasutajad.ID
    			WHERE 1
    			ORDER By Id ASC";

    $result = $link->query($query);
    if (!$result) {
	    printf('Error: %s', $link->error);
	    exit();
	    }

    $rows = array();
    while ($row=$result->fetch_array()) {
	    $rows[]=$row;
	    }
	    $result ->close();

	    return $rows;
}

function model_add($kirjeldus, $tahtaeg, $kriitilisus){
    global $link, $prefix;

    $kirjeldus = $link->real_escape_string($kirjeldus);
    $tahtaeg = $link->real_escape_string($tahtaeg);
    $kriitilisus = $link->real_escape_string($kriitilisus);

    $query = "INSERT INTO {$prefix}__koned (Kirjeldus, Tahtaeg, Kriitilisus)
							VALUES ('$kirjeldus','$tahtaeg','$kriitilisus')";

    $result = $link->query($query);
    	if(!$result){
	    	printf('Error: %s', $link->error);
	    	exit();
	    }
	   $id=$link->insert_id;

	   return $id;
}

function model_resolve($id) {
	global $link, $prefix;

	$id= $link->real_escape_string($id);

	$query = "UPDATE {$prefix}__koned SET Kas_lahendatud='1' WHERE Id='$id' LIMIT 1";

	$result = $link->query($query);
	if(!$result){
	    	printf('Error: %s', $link->error);
	    	exit();
	    }
	$resolved = $link->affected_rows;
	return $resolved;

	}

function kriitilisus_model_load(){
	global $link, $prefix;

	$query = "SELECT * FROM {$prefix}__kriitilisus ORDER BY Id ASC";

	$result = $link->query($query);
	if(!$result ) {
		printf('Error: %s', $link->error);
		exit();
		}

		$rows = array();
		while ($row = $result->fetch_array()) {
	    $rows[]=$row;
	    }
	    $result->close();

	    return $rows;

	}

function model_add_user($kasutajanimi,$parool){
	global $link, $prefix;

	$hash = password_hash($parool, PASSWORD_DEFAULT);

	$kasutajanimi = $link->real_escape_string($kasutajanimi);
	$hash = $link->real_escape_string($hash);

	$query = "INSERT INTO {$prefix}__kasutajad (Kasutajanimi, Parool) VALUES ('$kasutajanimi','$hash')";

	$result = $link->query($query);
	if(!$result) {
		printf('Error: %s', $link->error);
		exit();
		}
	$id = $link->insert_id;
	return id;

	 }

function model_get_user($kasutajanimi,$parool){
	global $link, $prefix;

	$kasutajanimi = $link->real_escape_string($kasutajanimi);

	$query = "SELECT Id, Parool FROM {$prefix}__kasutajad WHERE Kasutajanimi='$kasutajanimi' LIMIT 1";

	$result = $link->query($query);
	if(!$result) {
		printf('Error: %s', $link->error);
		exit();
		}

	$kasutaja = $result->fetch_array();
	if(!$kasutaja) {
		return false;
		}

	$check_user = password_verify($parool, $kasutaja['Parool']);
	if ($check_user){
		return $kasutaja['Id'];
		}
	return false;
	}
