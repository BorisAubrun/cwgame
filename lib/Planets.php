<?php 


class Planets {

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getPlanetsUser( $id_user ){
        
        $planetsUser = $this->db->prepare("SELECT * FROM `users_planets` WHERE id_user = :idUser");
        $planetsUser->bindParam(':idUser', $id_user);
        $planetsUser->execute(); 

        return $planetsUser->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPlanetData( $idPlanets ){
 
        $planetUser = $this->db->prepare("SELECT * FROM `planets` WHERE id_planets = :idPlanets");
        $planetUser->bindParam(':idPlanets', $idPlanets);
        $planetUser->execute(); 

        return $planetUser->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getPlanetsAlone(){

        $planetUser = $this->db->prepare("SELECT p.* FROM planets p LEFT JOIN users_planets up ON p.id_planets = up.id_planets WHERE up.id_user IS NULL");
        $planetUser->bindParam(':idPlanets', $idPlanets);
        $planetUser->execute(); 

        return $planetUser->fetchAll(PDO::FETCH_ASSOC);

    }

    public function assignPlanetToUser(  $id_user, $id_planets){

        
        $planetUser = $this->db->prepare("INSERT INTO `users_planets` (`id_user`, `id_planets`) VALUES (:id_user, :id_planets)");
        $planetUser->bindParam(':id_user', $id_user);
        $planetUser->bindParam(':id_planets', $id_planets);

        if ($planetUser->execute()) {
           
            // echo "Assignation réussie";
            header("Location: login.php");
        
        } else {
            // echo "Erreur lors de l'insertion dans la base de données.";
        }

    }

}




?>