<?php 

Class Automate{

    private $db;


    public function __construct( $db ){
        $this->db = $db;
    }

    public function refreshRsc(   $dataP, $structures, $id_planet){

   
        $rsc1_level = $structures[0]['level'];
        $rsc2_level = $structures[1]['level'];
        $rsc3_level = $structures[2]['level'];
        $rsc4_level = $structures[3]['level'];

        // Current resource values from dataP
        $current_rsc = $dataP['rsc'];
        $current_rsc2 = $dataP['rsc2'];
        $current_rsc3 = $dataP['rsc3'];
        $current_rsc4 = $dataP['rsc4'];

        // Initialize increments
        $rsc_increment = $rsc1_level >= 1 ? $rsc1_level : 0;
        $rsc2_increment = $rsc2_level >= 1 ? $rsc2_level : 0;
        $rsc3_increment = $rsc3_level >= 1 ? $rsc3_level : 0;
        $rsc4_increment = $rsc4_level >= 1 ? $rsc4_level : 0;

        // Calculate new values
        $new_rsc = $current_rsc + $rsc_increment;
        $new_rsc2 = $current_rsc2 + $rsc2_increment;
        $new_rsc3 = $current_rsc3 + $rsc3_increment;
        $new_rsc4 = $current_rsc4 + $rsc4_increment;
 
        $sql = "UPDATE planets 
                SET rsc = :new_rsc, 
                    rsc2 = :new_rsc2, 
                    rsc3 = :new_rsc3, 
                    rsc4 = :new_rsc4 
                WHERE id_planets = :id_planet";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute([
            ':new_rsc' => $new_rsc,
            ':new_rsc2' => $new_rsc2,
            ':new_rsc3' => $new_rsc3,
            ':new_rsc4' => $new_rsc4,
            ':id_planet' => $id_planet
        ]) ){
            echo json_encode(['status' => 'success', 'message' => 'Resources updated successfully GG.']);
        }else{
            echo json_encode(['status' => 'error', 'message' => ' :( Fail : ']);
        }

    }



}







?>