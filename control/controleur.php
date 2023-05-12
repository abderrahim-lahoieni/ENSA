<?php
require 'model/model.php';
require 'vue/VueAuthentification.php';
require 'vue/vueAcceuil.php';
require 'vue/vueBillet.php';
class AuthentificationController {
    private $utilisateur;
    private $vueAuth;
    private $vueAcc;

    public function __construct() {
        $this->utilisateur=new Utilisateur();
        $this->vueAuth=new VueAuthentification();
        $this->vueAcc=new VueAcceuil();
    }
    public function authentifier() {
        if (isset($_POST["nom"]) && isset($_POST["mot_de_passe"])) {
        $nom = $_POST["nom"];
        $mot_de_passe = $_POST["mot_de_passe"];
        $utilisateur = $this->utilisateur->trouverParNom($nom);
        if ($utilisateur && $mot_de_passe==$utilisateur["UTI_PASSWRD"]) {
            // L'utilisateur est authentifié
            $billets=$this->utilisateur->getBillets();
            $this->vueAcc->accueil($billets);
         
        } else {
            $this->vueAuth->afficherErreur();
        }
    }
    else{
        $this->vueAuth->afficherFormulaire(); 
    }
}
}
class BilletController{
    private $billet ;
    private $vuebil;
    private $commentaire;
    public function __construct() {
        $this->billet=new Billet();
        $this->vuebil=new vueBillet();
        $this->commentaire=new commentaire();
    }
    public function detailbillet($idBillet){
        $billet=$this->billet->getBillet($idBillet);
       $commentaires = $this->billet->getCommentaires($idBillet);
        $this->vuebil->vueDetail($billet,$commentaires);
    }
    public function commenter($auteur, $contenu, $idBillet) {
        // Sauvegarde du commentaire
        $this->commentaire->ajouterCommentaire($auteur, $contenu, $idBillet);
        $billet=$this->billet->getBillet($idBillet);
        $commentaires = $this->billet->getCommentaires($idBillet);
        // Actualisation de l'affichage du billet
        $this->vuebil->vueDetail($billet,$commentaires);
        }
}