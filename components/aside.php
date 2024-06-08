<?php 

foreach ($structures as $key => $val){
    if($val['id_building'] == 5 && $val['level'] > 1 || $val['id_building'] == 6 && $val['level'] > 1){
        $ingeniery = "capacited";
    }else{
        $ingeniery = "incapacited";
    }

    if($val['id_building'] == 7 && $val['level'] > 1){
        $fleet = "capacited";
    }else{
        $fleet = "incapacited";
    }

    if($val['id_building'] == 8 && $val['level'] > 1){
        $laboratory = "capacited";
    }else{
        $laboratory = "incapacited";
    }

    if($val['id_building'] == 9 && $val['level'] > 1){
        $commerce = "capacited";
    }else{
        $commerce = "incapacited";
    }

    if($val['id_building'] == 10 && $val['level'] > 1){
        $communication = "capacited";
    }else{
        $communication = "incapacited";
    }

    if($val['id_building'] == 11 && $val['level'] > 1){
        $senat = "capacited";
    }else{
        $senat = "incapacited";
    }

    if($val['id_building'] == 12 && $val['level'] > 1){
        $jedi = "capacited";
    }else{
        $jedi = "incapacited";
    }
}
?>

<div class="aside">
    <ul class="aside-list">
        <li class="aside-elem">
            <a href="index.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "index.php"){echo "active";} ?>">Overview</a>
        </li>
        <li class="aside-elem">
            <a href="building.php" class="link <?php if(basename($_SERVER['REQUEST_URI']) == "building.php"){echo "active";} ?>">Building</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $laboratory; ?>">Laboratory</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $ingeniery; ?>">Ingeniery</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $fleet; ?>">Fleet</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $ingeniery; ?>">Defense</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $commerce; ?>">Trader</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $communication; ?>">Galaxy</a>
        </li>
        <li class="aside-elem">
            <a href="#" class="link <?php echo $incapacited; ?>">Faction</a>
        </li>
    </ul>
</div>