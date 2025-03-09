<?php
//MANAGER POUR LA CLASS MANAGERPLAYER
class ManagerPlayer extends ModelPlayer {
    //METHOD
    public function addPlayer():string{
        //1) récupérer les données de l'objet
        $pseudo = $this->getPseudo();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $score = $this->getScore();

        //2) try catch
        try{
            //3) Préparer la requête INSERT
            $req = $this->getBdd()->prepare('INSERT INTO players (pseudo, email, score, psswrd) VALUES (?,?,?,?)');

            //4) Binding de paramètre
            $req->bindParam(1,$pseudo,PDO::PARAM_STR);
            $req->bindParam(2,$email,PDO::PARAM_STR);
            $req->bindParam(3,$score,PDO::PARAM_INT);
            $req->bindParam(4,$password,PDO::PARAM_STR);

            //5) Exécution de la requête
            $req->execute();

            //6) Retourne le message de confirmation
            return "$pseudo a été enregistré avec succès.";

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }

    public function getPlayers():array | string {
        try{
            //1) Preparer la requête
            $req = $this->getBdd()->prepare('SELECT id, pseudo, email, psswrd, score FROM players');

            //2) Exécution de la requête
            $req->execute();

            //3) Récupération de la réponse
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            //4) Retourne mon tableau de réponse
            return $data;

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }

    public function getPlayerByMail():array | string {
        try{
            //1) Preparer la requête
            $req = $this->getBdd()->prepare('SELECT id, pseudo, email, psswrd, score FROM players WHERE email = ?');

            //1.1) Récupération de l'email au sein de l'objet
            $email = $this->getEmail();

            //1.2) Binding de Param
            $req->bindParam(1,$email,PDO::PARAM_STR);

            //2) Exécution de la requête
            $req->execute();

            //3) Récupération de la réponse
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            //4) Retourne mon tableau de réponse
            return $data;

        }catch(EXCEPTION $error){
            return $error->getMessage();
        }
    }
}