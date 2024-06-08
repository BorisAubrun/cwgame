<?php
class User
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Méthode pour vérifier si l'email existe déjà
    public function emailExists($email)
    {
        $checkEmail = $this->db->prepare("SELECT COUNT(*) FROM `user` WHERE `email` = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();
        
        // On retourne true si l'email existe déjà, sinon false
        return $checkEmail->fetchColumn() > 0;
    }
      
    public function insert($email, $password, $date )
    {

        if ($this->emailExists($email)) {
            echo "<p style='font-size:25px;color:red;'>L'email existe déjà.</p>";
            return; // On arrête l'exécution de la méthode insert
        } 
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $insertUser = $this->db->prepare("INSERT INTO `user` (`email`, `password`, `date`) VALUES (:email, :password, :date)");
        $insertUser->bindParam(':email', $email);
        $insertUser->bindParam(':password', $password); 
        $insertUser->bindParam(':date', $date); 

        if ($insertUser->execute()) {
            $userId = $this->db->lastInsertId();

            return $userId;
        
        } else {
            // echo "Erreur lors de l'insertion dans la base de données.";
        }
    }
    public function selectAll()
    {
        $selectUsers = $this->db->prepare("SELECT * FROM `user`");
        $selectUsers->execute();

        return $selectUsers->fetchAll(PDO::FETCH_ASSOC);
    }
    public function select($id_user)
    {
        $selectUser = $this->db->prepare("SELECT * FROM `user` WHERE id_user = :idUser");
        $selectUser->bindParam(':idUser', $id_user);
        $selectUser->execute();

        return $selectUser->fetch(PDO::FETCH_ASSOC);
    } 


    public function login($email, $password)
    {
        // Préparation de la requête pour sélectionner l'utilisateur avec l'email fourni
        $selectUser = $this->db->prepare("SELECT * FROM `user` WHERE `email` = :email");
        $selectUser->bindParam(':email', $email);
        $selectUser->execute();
        
        // Récupération de l'utilisateur
        $user = $selectUser->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérification du mot de passe
            if (password_verify($password, $user['password'])) {
                // Connexion de l'utilisateur
                session_start();
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['success_message'] = "Connexion réussie.";
                header("Location: index.php"); // Redirige vers le tableau de bord
                exit;
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "L'utilisateur avec cet email n'existe pas.";
        }
    }

    public function logout(){

        session_unset();
        session_destroy();
        header('Location: login.php');

    }
}
