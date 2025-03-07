<?php
class Manager_Player extends ModelPlayer {

    private PDO $bdd;

    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

    //METHOD
    public function addPlayer(): string{
        $Pseudo = $this->getPseudo();
        $email = $this->getEmail();
        $score = $this->getScore();
        $password = $this->getPassword();
        try {

            // echo "<p>Connexion réussie à la base de données !</p>";
            // Requête SQL pour sélectionner tous les utilisateurs
            //  1) méthode prepare()
            $req = $this->getBdd()->prepare("INSERT INTO players (pseudo, email, score, psswrd) VALUES (?,?,?)");
            //  2) compléter les ? avec un binding des paramètres
            $req->bindParam(1, $nickname, PDO::PARAM_STR);
            $req->bindParam(2, $email, PDO::PARAM_STR);
            $req->bindParam(3, $score, PDO::PARAM_STR);
            $req->bindParam(4, $password, PDO::PARAM_STR);

            //  3) exécuter la requête avec execute()
            $req->execute();
            return "Ajout de l'utilisateur à la table users réussi !";
        } catch(PDOException $e) {
            return "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function getPLayers(){
        try {
            
            $play = $this->getBdd()->prepare("SELECT nickname, email, score, psswrd FROM users");
            $play->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $e) {
            return "Erreur de connexion à la base de données : ". $e->getMessage();
        }
    }

    public function getPlayerByEmail(){
        $email = $this->getEmail();
        try {
            
            $stmt = $this->getBdd()->prepare("SELECT id, nickname, email, score, psswrd FROM users WHERE ? = email LIMIT 1");
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch(PDOException $e) {
            echo "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>
