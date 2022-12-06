<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=ryouko;charset=utf8", "root", "");


if(!empty($_GET['t'])) {

    $getid = (int) $_GET['id'];
    $gett = (int) $_GET['t'];
    $check = $bdd->prepare('SELECT id FROM commentaire WHERE id = ?');
    $check->execute(array($getid));

    if($check->rowCount() == 1) {
        if($gett == 2) {
            $ins = $bdd->prepare('INSERT INTO likes (id_message) VALUES (?)');
            $ins->execute(array($getid));
        }elseif($gett == 1) {
            $ins = $bdd->prepare('INSERT INTO dislikes (id_message) VALUES (?)');
            $ins->execute(array($getid));
        }
        header('Location: https://127.0.0.1:8000/pays?id='.$gett);

        }else{
            exit('Erreur. <a href="https://127.0.0.1:8000/pays/5"> Revenir à la page</a>');
    }
}