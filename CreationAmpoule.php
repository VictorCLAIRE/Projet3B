
<?php
//Ici $title de template.php dans la balise <title><?= $title ></title>
$title = "CREATION AMPOULE";
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

<h1 class="d-flex justify-content-center">Nouvelle ampoule enregitrée</h1>
<?php


$date_ampoule = $_POST['date_changement_ajoute'];
$etage_ampoule = $_POST['etage_ajoute'];
$position_ampoule = $_POST['position_ajoute'];
$prix_ampoule = $_POST['prix_ajoute'];

echo $date_ampoule;
echo $etage_ampoule;
echo $position_ampoule;
echo $prix_ampoule;


$sql ="INSERT INTO ampoules (date_changement, etage_id, position_id, prix) VALUE (?,?,?,?)";
$requete_insertion = $db->prepare($sql);
$requete_insertion->bindParam(1, $date_ampoule);
$requete_insertion->bindParam(2, $etage_ampoule);
$requete_insertion->bindParam(3, $position_ampoule);
$requete_insertion->bindParam(4, $prix_ampoule);

$requete_insertion->execute(array($date_ampoule, $etage_ampoule, $position_ampoule, $prix_ampoule));

if($requete_insertion){
    $date_formater = new DateTime($date_ampoule);
    echo "<p class='alert-success'>Votre produit à bien été ajouté !</p>";
    ?>
    <ul>
        <li><?php echo "DATE :" . $date_formater->format('d/m/Y à H:i:s');?></li>
        <li><?php echo "ETAGE :" . $etage_ampoule;?></li>
        <li><?php echo "POSITION :" . $position_ampoule;?></li>
        <li><?php echo "PRIX :" . $prix_ampoule;?></li>
    </ul>
    <?php

}else{
    echo "<p class='alert-danger'>Erreur: Merci de remplir tous les champs</p>";
}

?>

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