<?php 



session_start();
require_once('../lib/lib.php');
 
$id_user = $_SESSION['user_id']; 

$planets = new Planets($db);
$glob = $planets->getPlanetsUser($id_user);
 
$planetId = $glob[0]['id_planets'];
$dataPlanets = $planets->getPlanetData($planetId);
 
$dataP = $dataPlanets[0];
echo json_encode($dataP);