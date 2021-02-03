<?php
//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "Update_ampoule -";
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

<h1 class="d-flex justify-content-center">Modification de l'ampoule validée</h1>
<!--Récupération de l'ID dans l'URL et lecture du produit by ID-->
<?php
$ID = $_POST['id_ampoule_modifie'];
$update_date = $_POST['date_changement_modifie'];
$update_etage = $_POST['etage_modifie'];
$update_position = $_POST['position_modifie'];
$update_prix = $_POST['prix_modifie'];
$req= $db->prepare("UPDATE `ampoules` SET `date_changement`= '$update_date',`etage_id`= '$update_etage',`position_id`= '$update_position',`prix`= '$update_prix' WHERE `id_ampoule` = ?");
$req->execute(array($ID));
?>

    <!--RESULTAT AFFICHE-->
    <div class="container modification">
        <p>VOTRE MODIFICATION:</p>
        <p><?php echo "DATE :" . " " . $update_date?></p>
        <p><?php echo "ETAGE :" . " " . $update_etage?></p>
        <p><?php echo "POSITION :" . " " . $update_position?></p>
        <p><?php echo "PRIX :" . " " . $update_prix?></p>
    </div>

    <div class="btnBack"> 
        <a href="general.php" class="btn btn-primary">Retour Accueil</a>
    </div>    

<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation. 
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>