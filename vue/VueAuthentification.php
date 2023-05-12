<?php
class VueAuthentification {
    public function afficherFormulaire() {
        // Afficher le formulaire d'authentification
        echo '
        <link rel="stylesheet" href="Contenu/login.css" />
        </form>
        </body>
        <body>
        <section>
        <form action="index.php"    method="post"   > 
            <input type="text" name="nom"  placeholder="NOM UTILISATEUR"> 
            <input type="password" name="mot_de_passe"  placeholder="MOT DE PASSE">
            <input type="submit" name="entrer" value="se connecter" >
        </form>
    </section>
    </body>
</html>

        ';
    }

    public function afficherErreur() {
        // Afficher un message d'erreur si les identifiants sont incorrects
        echo '<link rel="stylesheet" href="Contenu/login.css" />
        </form>
        </body>
        <body>
        <section>
        <form action="index.php"    method="post"   > 
            <input type="text" name="nom"  placeholder="NOM UTILISATEUR"> 
            <input type="password" name="mot_de_passe"  placeholder="MOT DE PASSE">
            <input type="submit" name="entrer" value="se connecter" >
            <h4 align="center">  Nom utiliateur ou le Mot de passe est incorrecte. ressayez</h4>
        </form>
    </section>
    </body>
</html>
        <p>Le nom d\'utilisateur ou le mot de passe est incorrect.</p>';
    }
}