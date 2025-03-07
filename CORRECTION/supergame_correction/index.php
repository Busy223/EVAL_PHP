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


include 'view/header.php';
include 'view/Acceuil.php';
include 'view/footer.php';


?>