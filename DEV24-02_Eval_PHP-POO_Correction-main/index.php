<?php
//CONTROLLER DE LA PAGE D'ACCUEIL
//Importer les Ressources nécessaire
include './utils/utils.php';
include './model/model_players.php';
include './manager/manager_players.php';

//Initalisation les variables d'affichage
$message = "";
$usersList = "";

/************************
  AFFICHAGE DES JOUEURS
************************/
//1) Demander au Manager de récupérer la liste des joueurs
$manager = new ManagerPlayer();
$data = $manager->getPlayers();

//2) Formater l'affichage des données
foreach($data as $player){
    //3) Donner ce formatage à la view grâce à la variable d'affichage
    $usersList = $usersList."<article><h2>{$player['pseudo']} - {$player['score']}</article>";
}

/************************
INSCRIPTION D'UN JOUEUR
************************/
//1) Vérifier si on reçoit le formulaire
if(isset($_POST['submit'])){

    //2) Vérifier les champs vide
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['score']) && !empty($_POST['password'])){

        //3) Vérifier le format de l'email, mais aussi du score
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['score'], FILTER_VALIDATE_INT)){

            //4) Nettoyage des données
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $score = sanitize($_POST['score']);
            $password = sanitize($_POST['password']);

            //5) Hasher le mot de passe
            $password = password_hash($password, PASSWORD_BCRYPT);

            //6) Vérifier si on peut enregistrer l'email
            $manager = new ManagerPlayer();
            $data = $manager->setEmail($email)->getPlayerByMail();

            if(empty($data)){
                //7) Enregistrer le joueur et afficher le message de confirmation
                $message = $manager->setPseudo($pseudo)->setScore($score)->setPassword($password)->addPlayer();

            }else{
                $message = "L'Email est déjà utilisé par un autre joueur.";
            }

        }else{
            $message = "Email ou Score pas au bon format.";
        }
         

    }else{
        $message = "Veuillez remplir tous les champs !";
    }

       
}

//FORMULAIRE DE CONNEXION
if(isset($_POST['submitCo'])){
    $email = $_POST['emailCo'];
    //Récupération de l'utilisateur en bdd
    $bdd = connect();
    $req = $bdd->prepare("SELECT id, pseudo, score, psswrd, email FROM players WHERE email = ?");

    bindParam(1,$email,PDO::PARAM_STR);

    $data = $req->fetchAll();

    if(empty($data)){
        echo "PAs d'utilisateur !";
    }else{
        echo "Conencté !";
    }
}

include './view/header.php';
include './view/view_home.php';
include './view/footer.php';
?>