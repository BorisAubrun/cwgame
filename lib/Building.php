<?php 
class Building {

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function initBuildingPlanet( $id_planet ){

        $init = $this->db->prepare('INSERT INTO planet_buildings (id_planets, id_building, level) SELECT :id_planets, id_building, 0 FROM buildings');
        $init->bindParam(':id_planets',$id_planet);
        
        
        if ($init->execute()) {
           
            // echo "Assimilation réussie"; 
        
        } else {

            // echo "Erreur lors de l'Assimilation.";
        }
    }

    public function getBuilding($planetId){

        $getBuilding = $this->db->prepare("
            SELECT b.id_building, b.building_name, b.img , pb.level,rsc,rsc2,rsc3,rsc4
            FROM buildings b
            LEFT JOIN planet_buildings pb ON b.id_building = pb.id_building
            WHERE pb.id_planets = :planetId
        ");
        $getBuilding->bindParam(':planetId',$planetId);
        $getBuilding->execute();
        return $getBuilding->fetchAll(PDO::FETCH_ASSOC);

    }

    public function displayBuilding($structures, $dataP){
        // echo "<pre style='background-color:white;color:black;'>";
        // print_r($dataP);
        // echo "</pre>";

        function rscLevel($val, $dataP){
            if($val['level'] == 0){
                if (   $val['rsc']  > $dataP['rsc'] 
                || $val['rsc2'] > $dataP['rsc2'] 
                || $val['rsc3'] > $dataP['rsc3'] 
                || $val['rsc4'] > $dataP['rsc4'] ) {
                    return true;

                }else{
                    return false;

                }
            }else{
                if (   ($val['rsc'] * $val['level'] * $val['level'])  > $dataP['rsc'] 
                || ($val['rsc2'] * $val['level'] * $val['level']) > $dataP['rsc2'] 
                || ($val['rsc3'] * $val['level'] * $val['level']) > $dataP['rsc3'] 
                || ($val['rsc4'] * $val['level'] * $val['level']) > $dataP['rsc4'] ) {
                    return true;

                }else{
                    return false;

                }
            }   
        }

        function checkRsc($valRsc, $dataPRsc) {
            return $valRsc > $dataPRsc ? 'color:red;' : '';
        }

        function checkCtaRsc($valRsc, $dataPRsc) {
            return $valRsc > $dataPRsc ? 'disabled' : '';
        }

        foreach( $structures as $key => $val ) {
            
            if ( rscLevel($val, $dataP) ) {
                echo '<div class="list-element cant ">';

            }else{
                echo '<div class="list-element  ">';

            }
            


                if ( rscLevel($val, $dataP) ) {
                    echo '<div class="list-img ban rsc1" style="background-image:url(assets/images/building/' . $val['img'] . ')"></div>';
                }else{
                    echo '<div class="list-img rsc1" style="background-image:url(assets/images/building/' . $val['img'] . ')"></div>';
                }
                
                if ( rscLevel($val, $dataP) ) {
                    echo '<div class="disabled"></div>';
                }
                
                echo '<p class="list-p">' . $val['building_name'] . '<br>';
                    if ( $val['level'] == 0 ) {
                        echo '<span class="level levelZero"> Niveau ' . $val['level'] . '</span>';
                    }else{
                        echo '<span class="level"> Niveau ' . $val['level'] . '</span>';
                    }
                echo '</p>';
                echo '</div>';
                $lvl = $val['level'];
                if($val['level'] == 0){
                    $val['level'] = 1;
                }

                echo '<div class="filter buildingN' . $val['id_building'] . '">';
                echo '    <div class="dataBuilding info">';
                echo '        <div class="data-body">';
                echo '            <div class="img" style="background-image:url(assets/images/building/' . $val['img'] . ')"></div>';
                echo '            <div class="text">';
                echo '                <p class="title">' . $val['building_name'] . '</p>';
                echo '                <p class="level">Niveau ' . $lvl . '</p>';
                echo '                <div class="rsc-list">';
                echo '                   <div class="rsc-elem">';
                echo '                        <img class="img-responsive" src="assets/images/rs1.jpg" width="80px" height="40px" alt="logo">';
                echo '                        <p class="nbr-elements" style="' . checkRsc(($val['rsc']*$val['level']*$val['level']), $dataP['rsc']) . '">'. ($val['rsc']*$val['level']*$val['level']) .'</p>';
                echo '                    </div>';
                echo '                    <div class="rsc-elem">';
                echo '                        <img class="img-responsive" src="assets/images/rs2.jpg" width="80px" height="40px" alt="logo">';
                echo '                        <p class="nbr-elements" style="' . checkRsc(($val['rsc2']*$val['level']*$val['level']), $dataP['rsc2']) . '">'. ($val['rsc2']*$val['level']*$val['level']) .'</p>';
                echo '                    </div>';
                echo '                    <div class="rsc-elem">';
                echo '                        <img class="img-responsive" src="assets/images/rs3.avif" width="80px" height="40px" alt="logo">';
                echo '                        <p class="nbr-elements" style="' . checkRsc(($val['rsc3']*$val['level']*$val['level']), $dataP['rsc3']) . '">'. ($val['rsc3']*$val['level']*$val['level']) .'</p>';
                echo '                    </div>';
                echo '                    <div class="rsc-elem">';
                echo '                        <img class="img-responsive" src="assets/images/rs4.webp" width="80px" height="40px" alt="logo">';
                echo '                        <p class="nbr-elements" style="' . checkRsc(($val['rsc4']*$val['level']*$val['level']), $dataP['rsc4']) . '">'. ($val['rsc4']*$val['level']*$val['level']) .'</p>';
                echo '                    </div>';
                echo '                </div>';
                echo '                <p class="description">Améliorer ce bâtiment pour augmenter ses capacités de collecte, de construction ou d\'amélioration.</p>';
                echo '            </div>';
                echo '        </div>';
                echo '        <div class="closeForm"></div>';
                echo '        <div class="data-footer">';
                echo '            <form method="post">';
                echo '                <input type="hidden" name="id_buildng" value="' . $val['id_building'] . '">';
                echo '                <input type="hidden" name="mode" value="up">';
                echo '                <input type="hidden" name="rsc1" value="'. ($val['rsc']*$val['level']*$val['level']) .'">';
                echo '                <input type="hidden" name="rsc2" value="'. ($val['rsc2']*$val['level']*$val['level']) .'">';
                echo '                <input type="hidden" name="rsc3" value="'. ($val['rsc3']*$val['level']*$val['level']).'">';
                echo '                <input type="hidden" name="rsc4" value="'. ($val['rsc4']*$val['level']*$val['level']).'">';
               
                echo '                <input type="hidden" name="level" value="' . ($lvl) . '">';
               
               
                if ( rscLevel($val, $dataP) ){
                       


                echo '                <input type="submit" class="upgrade disabled" disabled="disabled" value="Amélioration" name="submitUP">';
                }else{
                echo '                <input type="submit" class="upgrade " value="Amélioration" name="submitUP">';
                    
                }
               
                echo '            </form>';
                echo '            <form method="post">';
                echo '                <input type="hidden" name="id_buildng" value="' . $val['id_building'] . '">';
                echo '                <input type="hidden" name="mode" value="down">';
                echo '                <input type="hidden" name="rsc1" value="'. ($val['rsc']*$val['level']) .'">';
                echo '                <input type="hidden" name="rsc2" value="'. ($val['rsc2']*$val['level']) .'">';
                echo '                <input type="hidden" name="rsc3" value="'. ($val['rsc3']*$val['level']) .'">';
                echo '                <input type="hidden" name="rsc4" value="'. ($val['rsc4']*$val['level']) .'">';
                echo '                <input type="hidden" name="level" value="' . $lvl . '">';

                if( $val['level'] > 1){
                echo '                <input type="submit" class="downgrade" value="Régression" name="submitDOWN">';

                }else{

                echo '                <input type="submit" class="downgrade disabled" disabled="disabled" value="Régression" name="submitDOWN">';
                }
                echo '            </form>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
        }
    }

    public function upgradeBuilding($array, $planetId){

        $array['level'] = $array['level'] + 1;
        
        $changeDataBuilding = $this->db->prepare("UPDATE planet_buildings
        SET level = :level
        WHERE id_planets = :id_planets AND id_building = :id_building;");
        $changeDataBuilding->bindParam(':level', $array['level'] );;
        $changeDataBuilding->bindParam(':id_planets', $planetId);
        $changeDataBuilding->bindParam(':id_building', $array['id_buildng']);
        if($changeDataBuilding->execute()){
            // echo "Upgrade successful";
            header('Location: building.php');
        }else{
            // echo "error :(";
        }
    }
    public function downgradeBuilding($array, $planetId){

        $array['level'] = $array['level'] - 1;
        
        $changeDataBuilding = $this->db->prepare("UPDATE planet_buildings
        SET level = :level
        WHERE id_planets = :id_planets AND id_building = :id_building;");
        $changeDataBuilding->bindParam(':level', $array['level'] );;
        $changeDataBuilding->bindParam(':id_planets', $planetId);
        $changeDataBuilding->bindParam(':id_building', $array['id_buildng']);
        if($changeDataBuilding->execute()){
            // echo "downgrade successful";
            header('Location: building.php');
        }else{
            // echo "error :(";
        }
    }
    public function economyTransaction($array, $dataP, $id_planet){ 
        $majRsc1 = ( $dataP['rsc'] - $array['rsc1']);
        $majRsc2 = ( $dataP['rsc2'] - $array['rsc2']);
        $majRsc3 = ( $dataP['rsc3'] - $array['rsc3']);
        $majRsc4 = ( $dataP['rsc4'] - $array['rsc4']);
  
        $economyTransaction = $this->db->prepare("UPDATE planets SET rsc = :rsc, rsc2 = :rsc2, rsc3 = :rsc3, rsc4 = :rsc4 WHERE id_planets = :id_planets;");
        
        $economyTransaction->bindParam(':rsc', $majRsc1);
        $economyTransaction->bindParam(':rsc2', $majRsc2);
        $economyTransaction->bindParam(':rsc3', $majRsc3);
        $economyTransaction->bindParam(':rsc4', $majRsc4);
        $economyTransaction->bindParam(':id_planets', $id_planet);
        
        if($economyTransaction->execute()){
            // echo "gg";
            // exit;
        }else{
            // echo "nope:(";
            // exit;
        } 
    } 

    public function economyRegretion($array, $dataP, $id_planet){ 
        $majRsc1 = ( $dataP['rsc'] + $array['rsc1']);
        $majRsc2 = ( $dataP['rsc2'] + $array['rsc2']);
        $majRsc3 = ( $dataP['rsc3'] + $array['rsc3']);
        $majRsc4 = ( $dataP['rsc4'] + $array['rsc4']);
  
        $economyTransaction = $this->db->prepare("UPDATE planets SET rsc = :rsc, rsc2 = :rsc2, rsc3 = :rsc3, rsc4 = :rsc4 WHERE id_planets = :id_planets;");
        
        $economyTransaction->bindParam(':rsc', $majRsc1);
        $economyTransaction->bindParam(':rsc2', $majRsc2);
        $economyTransaction->bindParam(':rsc3', $majRsc3);
        $economyTransaction->bindParam(':rsc4', $majRsc4);
        $economyTransaction->bindParam(':id_planets', $id_planet);
        
        if($economyTransaction->execute()){
            // echo "gg";
            // exit;
        }else{
            // echo "nope:(";
            // exit;
        } 
    } 
    
 
}

 