<?php
//CONTROLER DE LA PAGE D'ACCUEIL
include 'utils/utils.php';
include '.model/model_joueurs.php';
include 'manager/manager_player.php';

//affichage des joueurs
//demander au manager de récuperer la liste des joueurs
$manager = new manager();
$data = $manager->getPlayers();

//2 formater l'affichage des données
foreach ($data as $player) {
    $userList = $userList . "<article><h2>$player['pseudo'] - {$player['score']} </article>";
}

//inscription d'un joueur
//1) vérifier si on reçoit le formulaire
if(isset $_Post['submit']){};
//2)vérifier les champ
    if(empty($_POST['pseudo']) && empty($_POST['email']) && empty($_POST['score']) && empty($_POST['password']){
        
//3)vérifier  si le format de l émail,mais aussi du score
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['score'], FILTER_VALIDATE_INT)){
            

//4)nettoyage des données
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $score = sanitize($_POST['score']);
            $password = sanitize($_POST['password']);
//5)hasher le mot de passe
            $password = password_hash($password, PASSWORD_BCRYPT);
            
//6) verifier si on peut enregistrer l'email
            $manager = new ManagerPlayer();
            $manager->setEmail($email)->getPlayerByEmail();

            if(empty($data)){
                //7)enregistrer le joueur
                $manager->setPseudo($pseudo)->setEmail($email)->setScore($score)->setPassword($password)->addPlayer();
            }else{
                $message = "Email déjà utilisé !";
            }
        }else{
            $message = "Email ou score pas au bon format !";
        }
    }else{
        $message = "Veuillez remplir tous les champs !";
    }
}
include 'view/header.php';
include 'view/Acceuil.php';
include 'view/footer.php';


?>