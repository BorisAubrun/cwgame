
<nav class="navbar navbar-default navbar-fixed-top">
        <ul class="nav nav1 navbar-nav navbar">
            <li class="item-list">
                <a href="index.php" class="link">RTS Clone Wars</a>
                <!-- <a href="#" class="link">Player: Amogus PTS</a> -->
            </li>
        </ul>
        <ul class="nav nav2 navbar-nav navbar">
            <li class="item-list">
                <a href="highscore.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "highscore.php"){echo "active";} ?>">Highscore(XXX)</a>
            </li>
            <?php if( empty($_SESSION)){ ?>
            <li class="item-list">
                <a href="login.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "login.php"){echo "active";} ?>">Login</a>
            </li>
            <li class="item-list">
                <a href="register.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "register.php"){echo "active";} ?>">Register</a>
            </li>
                <?php } else { ?>
            <li class="item-list">
                <a href="logout.php" class="link">Logout</a>
            </li>
                <?php }  ?>
            <li class="item-list">
                <a href="support.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "support.php"){echo "active";} ?>">Support</a>
            </li>
            <li class="item-list">
                <a href="option.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "option.php"){echo "active";} ?>">Option</a>
            </li>
            <li class="item-list">
                <a href="search.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "search.php"){echo "active";} ?>">Search</a>
            </li>
        </ul>
    </nav>