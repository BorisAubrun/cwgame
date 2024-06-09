<?php

session_start();
require_once('../lib/lib.php');
 
$id_user = $_SESSION['user_id']; 

$planets = new Planets($db);
$glob = $planets->getPlanetsUser($id_user);
 
$planetId = $glob[0]['id_planets'];
$dataPlanets = $planets->getPlanetData($planetId);

$building = new Building($db);
$structures = $building->getBuilding($planetId);

$dataP = $dataPlanets[0];

$automate = new Automate($db);
$automate->refreshRsc($dataP, $structures, $planetId);