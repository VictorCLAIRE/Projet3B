<style>
#login-form{
    border: solid black 2px;
}
</style>
<?php
//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "Maintenance Ampoule";
//ob_start() démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
//hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
ob_start();
    //COONEXION A LE BASE de DONNÉES
    //Stock des valeur nom utilistateur phpmyadmin et mot de passe
    $user = "root";
    $pass = "";
    //Essaie de te connecter
    try{
        //Stockage et instance de la classe PDO pour connecter php et mysql
        $db = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", "root");
        //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $exception){
    die("Erreur de connexion a PDO MySQL :" .$exception->getMessage());
}
?>

<body>
    <h1 class="text-center">Veuillez vous connecter</h1>
    <div class="text-center" id="login-form">
        <form action="general.php" method="POST">
            <div class="form-group"> 
                <label for="email">Votre email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group"> 
                <label for="password">Votre mot de passe:</label>
                <input type="password" id="password" name="password">
            </div>
            <button class="btn btn-info" type="submit"> CONNEXION </button>
        </form>
        <a href="inscription.php">Inscription</a>
    </div>
</body>


<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation. 
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>