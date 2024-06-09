<?php 
    require_once('lib/lib.php');
    $user = new User($db);
    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password']; 
        $date = date('Y-m-d H:i:s');
        if( !empty($email) && !empty($password)){
            $user->login($email, $password);
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

    <form class="form login" method="POST">
        <div class="mb-3">
            <h2>Login</h2>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
            <div id="emailHelp" class="form-text" style="color:white;">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" name="password">
        </div> 
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>


</body>
</html>