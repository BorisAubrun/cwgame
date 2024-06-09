<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/style.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap" rel="stylesheet">

<?php 
    $page="";
    if(!empty(basename($_SERVER['REQUEST_URI']))){
        $page = basename($_SERVER['REQUEST_URI']);
        if($page == "register.php"){
            echo "<style> body{ background-image: url(assets/images/login.jpg);    background-repeat: no-repeat;
                background-size: cover; } </style>";
        }
    }
    if(!empty(basename($_SERVER['REQUEST_URI']))){
        $page = basename($_SERVER['REQUEST_URI']);
        if($page == "login.php"){
            echo "<style> body{ background-image: url(assets/images/login.jpg);    background-repeat: no-repeat;
                background-size: cover; } </style>";
        }
    }
    if(!empty(basename($_SERVER['REQUEST_URI']))){
        $page = basename($_SERVER['REQUEST_URI']);
        if($page == "building.php"){
            echo "<style> .main{ background-image: url(assets/images/bg2.webp)!important; } </style>";
        }
    }
?>