<?php
$erreur = "";
require 'lib/autoloader.php';
autoloader::register();
require 'lib/pdo.php';

session_start();
$persoManager = new personnageManager($pdo);
$liste = $persoManager->listPersos();
if (isset($_GET['fermer'])) {
    session_destroy();
    setcookie(session_name(), session_id(), time() - 10, '/', null, null, true);
    header('Location: index.php');
}
if (isset($_SESSION['current'])) {
    $perso = $_SESSION['current'];
    $image = $perso->getImage();

    if (isset($_POST['lance'])) {
        if ($_POST['choixAttaque'] != "none") {

            if(isset($lastAttack)){
                if(time() < $lastAttack ){
                    $erreur .= "Attendez " . $time . " secondes";
                }
            }else{

            $cible = $persoManager->getPersoById($_POST['choixAttaque']);
            $attaque = $perso->attaquer($cible);
            $pvRestants = 100-$cible->getDegats();
                $lastAttack = time() + 20;
            if($attaque == 1){

                $persoManager->update($cible);
                $erreur .= 'update';


            }

            elseif ($attaque == 2){
                $erreur .= $persoManager->delete($cible);
            }
        }
        } else $erreur .= "Choisissez un adversaire";
    }
    var_dump(time());
    if (isset($lastAttack))var_dump($lastAttack);
   // if (isset($time))var_dump($time);
    include 'vue/combat.html.php';
} else {
    if (isset($_POST['new'])) {
        $perso = new personnage($_POST);
        if ($perso->getErreur() == []) {

            if ($persoManager->persoExist($perso)) {
                $erreur .= "Déjà enregistré";
            } else {
                $perso = $persoManager->insertPerso($perso);
                $_SESSION['current'] = $perso;
                header('Location: index.php');
            }
        } else {
            $erreur .= implode(", ", $perso->getErreur());
        }
    } elseif (isset($_POST['charge'])) {
        if($_POST['choix'] != "none"){
        $perso = $persoManager->getPersoById($_POST['choix']);
        $_SESSION['current'] = $perso;
        header('Location: index.php');
        exit;
    }else $erreur .="Choisissez un personnage";
    }
    include 'vue/creation.html.php';
}