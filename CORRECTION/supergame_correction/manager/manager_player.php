<?php
include 'model/model_joueurs.php';
include 'utils/utils.php';
class Manager_Player extends ModelPlayer {

    // METHOD
    public function addPlayer(): string {
        $Pseudo = $this->getPseudo();
        $email = $this->getEmail(); 
        $score = $this->getScore();
        $password = $this->getPassword();

        try {

                // Préparation de la requête
                $req = $this->getBdd->prepare("INSERT INTO players (pseudo, email, score, psswrd) VALUES (?, ?, ?, ?)");
                //bind des paramètres
                $req->bindParam(1, $Pseudo, PDO::PARAM_STR);
                $req->bindParam(2, $email, PDO::PARAM_STR);
                $req->bindParam(3, $score, PDO::PARAM_INT);
                $req->bindParam(4, $password, PDO::PARAM_STR);


                $req->execute([$Pseudo, $email, $score, $password]);

                return "Ajout de l'utilisateur à la table players réussi !";
            }
        } catch (PDOException $e) {
            return $e->getMessage();
            
        }
    }

    public function getPlayers() {
        try {
            $req = $this->getBdd()->prepare("SELECT pseudo, email, score, psswrd FROM players");

            $req->execute();
            $data =$play->fetchAll(PDO::FETCH_ASSOC);
            return $data ;
            
        } catch (PDOException $e) {
            return "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }

    public function getPlayerByEmail(string $email) {
        try {
            $req = $this->getBdd()->prepare("SELECT id, pseudo, email, score, psswrd FROM players WHERE email = ? LIMIT 1");
            $req->execute([$email]);

            return $req->fetch(PDO::FETCH_ASSOC) ?: "Aucun joueur trouvé.";
        } catch (PDOException $e) {
            return "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>
