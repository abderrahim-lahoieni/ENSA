<?php
class Utilisateur{
    private $pdo;
    
    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root',
            '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    public function trouverParNom($nom) {
    $stmt = $this->pdo->prepare("SELECT UTI_PASSWRD  FROM t_utilisateur WHERE UTI_NOM = ?");
    $stmt->execute([$nom]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    return $utilisateur;
    }
    public function getBillets() {
        $billets = $this->pdo->query('select BIL_ID as id, BIL_DATE as date,'
            . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
            . ' order by BIL_ID desc');
        return $billets;
    }
}
class Billet{
    private $pdo ;
    public function __construct(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root',
        '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    public function   getBillet($idBillet) {
        $billet = $this->pdo->prepare('select BIL_ID as id, BIL_DATE as date,'
                . ' BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET'
                . ' where BIL_ID=?');
        $billet->execute(array($idBillet));
        if ($billet->rowCount() == 1)
            return $billet->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }
    
    // Renvoie la liste des commentaires associés à un billet
    public function  getCommentaires($idBillet) {
        $commentaires = $this->pdo->prepare('select COM_ID as id, COM_DATE as date,'
                . ' COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE'
                . ' where BIL_ID=?');
        $commentaires->execute(array($idBillet));
        return $commentaires;
    }
}
class commentaire{
    private $pdo;
    public function __construct(){
     $this->pdo = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root',
        '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    public function ajouterCommentaire($auteur, $contenu, $idBillet) {
        $sqlstat = $this->pdo->prepare( 'insert into T_COMMENTAIRE(COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
        . ' values(?, ?, ?, ?)')  ;  
        $date = date(DATE_W3C); // Récupère la date courante  
        $sqlstat->execute(array($date, $auteur , $contenu, $idBillet));
        }
}