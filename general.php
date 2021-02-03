<style>
.TopBoard{
    background-color: rgb(165, 165, 165);
    text-align: center;
}
body{
    background-color: rgb(211, 211, 211);
}
.BTNAjout{
    text-align: center;
}
.ligne_produit{
    background-color: rgb(182, 181, 181);;
    border-top: solid grey 1px;
    text-align: center;
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
<?php
$sql = "SELECT * FROM ampoules";
$req = $db->query($sql);
$res = $req->fetch(PDO::FETCH_ASSOC);
$sql2 = "SELECT * FROM ampoules INNER JOIN table_position ON ampoules.position_id = table_position.position INNER JOIN table_etage ON ampoules.etage_id = table_etage.etage ORDER BY date_changement DESC";
$req2 = $db->query($sql2);
$res2 = $req2->fetch(PDO::FETCH_ASSOC);
?>

<h1 class="d-flex justify-content-center">Maintenance ampoule BOARD</h1>
<div class="col-3 container">
    <a class="btn btn-danger btn-lg m-1" data-toggle="modal" data-target="#AjoutAmpoule">Ajout d'une ampoule</a>
     <!-- Modal AJOUT D'UNE AMPOULE -->
        <div class="modal fade" id="AjoutAmpoule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajout d'une nouvelle ampoule</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="CreationAmpoule.php" method="post">
                            <div class="form-group">
                                <label for="date_changement">Date</label>
                                <input value="" class="form-control" required type="date" id="date_changement" name="date_changement_ajoute"  >
                            </div>
                            <div class="form-group">
                                <label for="etage">Etage de l'ampoule</label>
                                <select value="" class="form-control" required type="text" id="etage" name="etage_ajoute">
                                <?php
                                foreach($db->query("SELECT * FROM table_etage")
                                    as $row){
                                ?>
                                    <option value="<?= $row['id_etage']?>"><?= $row['etage']?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                                
                            <div class="form-group">
                                <label for="position">Position de l'ampoule</label>
                                <select class="form-control" required type="text" id="position" name="position_ajoute">
                                <?php
                                foreach($db->query("SELECT * FROM table_position")
                                    as $row){
                                ?>
                                    <option value="<?= $row['id_position']?>"><?= $row['position']?></option>
                                <?php
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prix">Prix de l'ampoule</label>
                                <input value="" class="form-control" required type="number" id="prix" name="prix_ajoute"  >
                            </div>
                            <button type="submit" class="btn btn-success">AJoute de la nouvelle ampoule</button>
                        </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php
$sql = "SELECT * FROM ampoules";
$req = $db->query($sql);
$res = $req->fetch(PDO::FETCH_ASSOC);
$sql2 = "SELECT * FROM ampoules INNER JOIN table_position ON ampoules.position_id = table_position.position INNER JOIN table_etage ON ampoules.etage_id = table_etage.etage ORDER BY date_changement DESC";
$req2 = $db->query($sql2);
$res2 = $req2->fetch(PDO::FETCH_ASSOC);
?>
<!------------------------------------------TOP BOARD ----------------->
<div class="container TopBoard">
    <div class="row">
        <div class="col-2 container">
            <p>Id Ampoule</p>
        </div>
        <div class="col-3 container">
            <p>Date</p>
        </div>
        <div class="col-1 container">
            <p>Etage</p>
        </div>
        <div class="col-1 container">
            <p>Position</p>
        </div>
        <div class="col-1 container">
            <p>Prix</p>
        </div>
        <div class="col-1 container">
            <p>DETAILS</p>
        </div>
        <div class="col-1 container">
            <p>MODIFIER</p>
        </div>
        <div class="col-2 container">
            <p>SUPPRIMER</p>
        </div>
    </div>
</div>
<!------------------------------------TABLEAU DES VALEURS DE LA BASE DE DONNEE--------------------->
<?php
foreach($db->query("SELECT * FROM ampoules INNER JOIN table_position ON ampoules.position_id = table_position.position INNER JOIN table_etage ON ampoules.etage_id = table_etage.etage ORDER BY date_changement DESC")
    as $row){
        $date_formater = new DateTime($row['date_changement']);
?>
    <div class="container ligne_produit"> 
        <div class="row">
            <div class="col-2 container">
                <?php echo $row['id_ampoule'] ?>
            </div>
            <div class="col-3 container">
                <?php echo $date_formater->format('d/m/Y') ?>
            </div>
            <div class="col-1 container">
                <?php echo $row['etage'] ?>
            </div>
            <div class="col-1 container">
                <?php echo $row['position'] ?> 
            </div>
            <div class="col-1 container">
                <?php echo $row['prix'] ?> 
            </div>
            <div class="col-1 container">
                <a class="btn btn-info m-1" data-toggle="modal" data-target="#detailsAmpoule<?= $row['id_ampoule'] ?>">Détails</a>
                
                 <!---------------------------------- Modal DETAIL -------------------------->
                
                 <div class="modal fade" id="detailsAmpoule<?= $row['id_ampoule'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Détail de l'ampoule N° <?= $row['id_ampoule'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    <li><?= "ID de opération : " .$row['id_ampoule'] ?></li>
                                    <li><?= "Date de changement : " .$date_formater->format('d/m/Y '); ?></li>
                                    <li><?= "Étage : " .$row['etage'] ?></li>
                                    <li><?= "Position ampoule : " .$row['position'] ?></li>
                                    <li><?= "Prix : " .$row['prix'] ?> €</li>
                                </ul>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 container">
            <a class="btn btn-success m-1" data-toggle="modal" data-target="#modificationAmpoule<?= $row['id_ampoule'] ?>">Modifier</a>
                 
                 <!------------------------------------------ Modal UPDATE -------------------->

                 <div class="modal fade" id="modificationAmpoule<?= $row['id_ampoule'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Détail de l'ampoule N° <?= $row['id_ampoule'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="ValidationModification.php" method="post">
                                <div class="form-group">
                                    <label for="id_ampoule"></label>
                                    <input type="hidden" value="<?= $row['id_ampoule'] ?>" class="form-control" required type="text" id="id_ampoule" name="id_ampoule_modifie"  >
                                </div>
                                <div class="form-group">
                                    <label for="date_changement">Date</label>
                                    <input value="" class="form-control" required type="date" id="date_changement" name="date_changement_modifie"  >
                                </div>
                                <div class="form-group">
                                    <label for="etage">Etage de l'ampoule</label>
                                    <select value="" class="form-control" required type="text" id="etage" name="etage_modifie">
                                        <option><?= $row['etage']?></option>
                                    <?php
                                    foreach($db->query("SELECT * FROM table_etage")
                                        as $row){
                                    ?>
                                       <option value="<?= $row['id_etage']?>"><?= $row['etage']?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="position">Position de l'ampoule</label>
                                    <select class="form-control" required type="text" id="position" name="position_modifie">
                                        <option value="<?= $row['position']?>"><?= $row['position']?></option>
                                    <?php
                                    foreach($db->query("SELECT * FROM table_position")
                                        as $row){
                                    ?>
                                       <option value="<?= $row['id_position']?>"><?= $row['position']?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>                  
                                </div>
                                <div class="form-group">
                                    <label for="prix">Prix de l'ampoule</label>
                                    <input value="<?= $res['prix']?>" class="form-control" required type="text" id="prix" name="prix_modifie"  >
                                </div>
                                <button type="submit" class="btn btn-success">Modifier les données de l'ampoule</button>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 container">
            <a class="btn btn-warning m-1" href="EnregistrementSuppression.php" data-toggle="modal" data-target="#suppressionAmpoule<?= $row['id_ampoule'] ?>">>Supprimer</a>
            <div class="modal fade" id="suppressionAmpoule<?= $row['id_ampoule'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Détail de l'ampoule N° <?= $row['id_ampoule'] ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="ValidationModification.php" method="post">
                                <div class="form-group">
                                    <label for="id_ampoule"></label>
                                    <input type="hidden" value="<?= $row['id_ampoule'] ?>" class="form-control" required type="text" id="id_ampoule" name="id_ampoule_modifie"  >
                                </div>

                                <button type="submit" class="btn btn-success">Modifier les données de l'ampoule</button>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
//$content de template.php definis ce qui ce trouve dans le body
//Retourne le contenu du tampon de sortie et termine la session de temporisation. 
//Si la temporisation n'est pas activée, alors false sera retourné.
$content = ob_get_clean();
//Rappel du template sur chaque page
require "template.php";
?>