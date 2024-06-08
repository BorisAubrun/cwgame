<div class="view"> 
    <div class="pl"></div>
</div>
<div class="stat">
    <p class="hidden">Planete : <?php echo $dataP['name']; ?></p>
    <p class="hidden">Superficie : <?php echo number_format($dataP['surface']); ?>km²</p>
    <p class="hidden">Batiments : <?php echo $dataP['structure']; ?>/<?php echo $dataP['max_structure']; ?> structures</p>
    <p class="hidden">Temp : <?php echo $dataP['temp']; ?>°C</p>
    <p class="hidden">Population : <?php echo $dataP['population']; ?> Milliard</p>
</div>