<?php 
    session_start();
    require_once('lib/lib.php');

    if(empty($_SESSION)){
        header('Location: login.php');
    }
    $id_user = $_SESSION['user_id'];
    // print_r( $_SESSION );

    $planets = new Planets($db);
    $glob = $planets->getPlanetsUser($id_user);
     
    $planetId = $glob[0]['id_planets'];
    $dataPlanets = $planets->getPlanetData($planetId);

    $building = new Building($db);
    $structures = $building->getBuilding($planetId);

 
    $dataP = $dataPlanets[0];

    // echo "<div style='color:black;background-color:white;'>";
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    // echo "</div>";

    if(!empty($_POST)){
        $id_building = $_POST['id_buildng'];
        $rsc1 = $_POST['rsc1'];
        $rsc2 = $_POST['rsc2'];
        $rsc3 = $_POST['rsc3'];
        $rsc4 = $_POST['rsc4'];
        echo $rsc1."<br>";
        echo $rsc2."<br>";
        echo $rsc3."<br>";
        echo $rsc4."<br>";
        echo $id_building."<br>";
        if( !empty($id_building) && $_POST['mode'] == 'up' ){
            $building->economyTransaction($_POST, $dataP, $planetId);
            $building->upgradeBuilding($_POST, $planetId);
        }elseif(!empty($id_building) && $_POST['mode'] == 'down'){
            $building->economyRegretion($_POST, $dataP, $planetId);
            $building->downgradeBuilding($_POST, $planetId);
        }

    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clone Wars</title>
    <?php require_once('assets/app/app.php'); ?>
</head>
<body>
    <div class="logo">
        <a href="index.php" class="link">
            <img class="img-responsive lgg" src="assets/images/cw.webp" alt="logo">
        </a>
    </div>
    <?php require_once('components/nav.php'); ?>

    <?php require_once('components/ressources.php'); ?>
    
    <div class="content">

        <?php require_once('components/aside.php'); ?>

        <div class="main">


        </div>

        <?php require_once('components/federation.php');  ?>

    </div>

    <?php require_once('components/progress.php');  ?>

    <?php require_once('components/list.php'); ?>
 
    <?php require_once('components/footer.php') ?>

</body>
</html>