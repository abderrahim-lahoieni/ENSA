<?php 
require 'control/controleur.php';
require 'vue/vueErreur.php';
class Routeur{
    private $ctrlAccueil;
    private $ctrlBillet;
    private $err;
    public function __construct(){
        $this->ctrlAccueil=new AuthentificationController();
        $this->ctrlBillet=new BilletController();
        $this->err=new VueErreur();
    }
   public function Router(){
try{
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'billet') {
    $idBillet = intval($_GET['id']);
    if ($idBillet != 0) {
    $this->ctrlBillet->detailbillet($idBillet);
    }
    else
    throw new Exception("Identifiant de billet non valide");
    }
    else if ($_GET['action'] == 'commenter') {
    $auteur = $_POST['auteur'];
    $contenu = $_POST['contenu'];
    $idBillet= $_POST['id'];
    $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
    }
    else
    throw new Exception("Action non valide");
    }
    else { // aucune action définie : affichage de l'accueil
    $this->ctrlAccueil->authentifier();
    }
}
catch (Exception $e) {
    $msgErreur = $e->getMessage();
    $this->err->vErreur($msgErreur);
    }
   }
}