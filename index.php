<?php 
    session_start();
    require_once('lib/lib.php');

    if(empty($_SESSION)){
        header('Location: login.php');
    }
    // echo "<div style='color:black;background-color:white;'>";
    $id_user = $_SESSION['user_id'];
    // print_r( $_SESSION );

    $planets = new Planets($db);
    $glob = $planets->getPlanetsUser($id_user);
     
    $planetId = $glob[0]['id_planets'];
    $dataPlanets = $planets->getPlanetData($planetId);
 
    $building = new Building($db);
    $structures = $building->getBuilding($planetId);

    $dataP = $dataPlanets[0];
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

            <?php require_once('components/home.php');  ?>

        </div>

        <?php require_once('components/federation.php');  ?>

    </div>

    <?php require_once('components/progress.php');  ?>

    <?php require_once('components/footer.php') ?>

</body>
</html>