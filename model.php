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
		$staatus ='';
		$order = '';
		$show = empty($_GET['show']) ? '0' : $_GET['show'];
		switch ($show) {

        case 'Avatud':
            $staatus = '0';
						$order = 'koned.Kriitilisus ASC, Tahtaeg ASC';
						break;
				case 'Suletud':
						$staatus = '1';
						$order = 'koned.lisatud ASC';
						break;
				default:
						$staatus = '0 OR koned.Kas_lahendatud=1';
						$order = 'koned.Kas_lahendatud ASC, koned.Kriitilisus ASC, Tahtaeg ASC';
						break;
					}

    $query = "SELECT 	koned.Id ,
    					koned.Kirjeldus ,
    					kriitilisus.Nimetus ,
							koned.Lisatud ,
							Tahtaeg,
							kasutajad.Kasutajanimi ,
							koned.Kas_lahendatud ,
							koned.Kriitilisus
    			FROM  {$prefix}__koned AS koned
					LEFT JOIN {$prefix}__kriitilisus AS kriitilisus
					ON  koned.Kriitilisus = kriitilisus.Id
					LEFT JOIN {$prefix}__kasutajad AS kasutajad
					ON koned.Kasutaja = kasutajad.Id
					WHERE koned.Kas_lahendatud=$staatus
                    ORDER BY $order";

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

function model_add($kirjeldus, $tahtaeg, $kriitilisus, $kasutaja){
    global $link, $prefix;

    $kirjeldus = $link->real_escape_string($kirjeldus);
    $tahtaeg = $link->real_escape_string($tahtaeg);
    $kriitilisus = $link->real_escape_string($kriitilisus);
		$kasutaja = $link->real_escape_string($kasutaja);

    $query = "INSERT INTO {$prefix}__koned (Kirjeldus, Tahtaeg, Kriitilisus, Kasutaja)
							VALUES ('$kirjeldus','$tahtaeg','$kriitilisus','$kasutaja')";

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
