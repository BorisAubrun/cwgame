<?php 
    require_once('lib/lib.php');
    $user = new User($db);
    $planet = new Planets($db);
    $build = new Building($db);
    $planetAlone = $planet->getPlanetsAlone();
    // print_r($planetAlone);
    // Sélectionner une planète aléatoire
    
    if(!empty($_POST)){
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $date = date('Y-m-d H:i:s');
        if( !empty($email) && !empty($password1) && $password1 == $password2 ){
            $lastId = $user->insert($email, $password1, $date);
            $randomPlanet = $planetAlone[array_rand($planetAlone)];
            $build->initBuildingPlanet($randomPlanet['id_planets']);
            $planet->assignPlanetToUser($lastId, $randomPlanet['id_planets']);
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
            <img class="img-responsive" src="assets/images/cw.webp" alt="logo">
        </a>
    </div>
    <?php require_once('components/nav.php'); ?>

    <form class="form register" method="POST">
        <div class="mb-3">
            <h2>Register</h2>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Repeat Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password2">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>


</body>
</html>