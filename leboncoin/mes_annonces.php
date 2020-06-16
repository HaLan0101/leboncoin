<?php include("inc/header.inc.php"); ?>
<?php 
session_start();
function internauteEstConnecte() {     
    if(!isset($_SESSION['membre'])){
      return false; 
    }    
    else {
      return true;
    } 
}
if(!internauteEstConnecte()) {
  header("location:login.php"); 
}
else{
    //Supprimer mes annonces
    if(isset($_GET['action']) && $_GET['action'] == "suppression") {   
         $resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce=$_GET[id_annonce]");       
         $produit_a_supprimer = $resultat->fetch(PDO::FETCH_OBJ);    
         $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer->photo;    
         if(!empty($produit_a_supprimer->photo) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);    
         $pdo->query("DELETE FROM annonce WHERE id_annonce=$_GET[id_annonce]");     
         header("location:mes_annonces.php"); 
    } 
    //Modifier mes annonces
    elseif(isset($_GET['action']) && $_GET['action'] == 'modification')    {   
        $resultat = $pdo->query("SELECT * FROM annonce ORDER BY id_annonce");       
        while($annonce = $resultat->fetch(PDO::FETCH_OBJ)) {
            if($_GET['id_annonce']==$annonce->id_annonce){
            ?>
            <div class="box">
                <div class="imgBx">
                <a href="article.php">
                    <img src="<?php echo "photo/".$annonce->photo;?>" alt="" />
                </a>
                </div>
                <div class="content">
                <h2 id="title"><?php echo $annonce->titre ;?></h2>
                <p id="type"><?php echo "Type: " .$annonce->type_article ;?></p>
                <p id="price"><?php echo "Prix: ". $annonce->prix."€" ;?></P2>
                <p id="location"><?php echo "Adresse: " .$annonce->lieu;?></p>
                <p id="status"><?php echo "Statut: " .$annonce->statut;?></p>
                <p id="description"><?php echo "Description: " .$annonce->description_article;?></p>
                <p id="date_pub"><?php echo "Date: " .$annonce->date_publication ;?></p>
                </div>
            </div>
        <?php } ?>
        <?php } 
        if (!empty($_POST)) {   
            $photo_bdd = "";     
            $nom_photo=$_POST['photo_old'];  
            if(!empty($_FILES['photo']['name']))    
            {      
                $nom_photo = time() . '_' .$_FILES['photo']['name'];       
                $photo_bdd =  "leboncoin/leboncoin/photo/$nom_photo"; 
                $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . "/leboncoin/leboncoin/photo/$nom_photo";                
                copy($_FILES['photo']['tmp_name'],$photo_dossier); 
            }
            foreach($_POST as $indice => $valeur)    
            {        
                $_POST[$indice] = htmlEntities(addSlashes($valeur));    
            } 
            $auteur=$_SESSION['membre']['email'];
            $date=date("Y/m/d");
            $nom_photo = time() . '_' .$_FILES['photo']['name']; 
            $resultat = $pdo->exec("UPDATE annonce SET `photo` = '$nom_photo', `type_article` = '$_POST[type_article]',`statut` = '$_POST[statut]',`titre` = '$_POST[titre]',`prix` = '$_POST[prix]',`lieu` = '$_POST[lieu]',`description_article` = '$_POST[description_article]',`date_publication` = '$date'  WHERE `id_annonce` = '$_GET[id_annonce]';");
            header("location:mes_annonces.php"); 
        }
        if(isset($_GET['action']) && ( $_GET['action'] == 'modification')) {    
            if((isset($_GET['id_annonce'])) )    {        
                $resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce=$_GET[id_annonce]");      
                $annonce_old = $resultat->fetch(PDO::FETCH_OBJ);      
            }
            ?>
                    <div class="contentform">
                    <form method="post" enctype="multipart/form-data"  >
                        <label for="photo">Insert article picture :</label>
                        <input type="file" name="photo" placeholder="Click" id="photo"  multiple="">
                        <?php 
                             if(isset($annonce_old))        {                       
                                 ?>
                                 <input type="hidden" name="photo_old" value="<?php echo $annonce_old->photo ?>"><br>
                                 <?php          
                                } 
                        ?>

                        <div class="image-preview" id="imagePreview">   
                            <img src="" alt="" class="image-preview__image"> 
                            <span class="image-preview__default-text">Image Preview</span>
                        </div>

                        <div class="article_description">
                            <div class="input_register">
                                <label for="type_article">Select type of post</label>
                                <select name="type_article" id="type_article" class="select" >
                                    <option>Post type</option>
                                    <option value="maison" <?php if($annonce_old->type_article == 'maison'){ echo "selected ";} ?>>Maison</option>
                                    <option value="mode" <?php if($annonce_old->type_article== 'mode'){ echo "selected ";} ?>>Mode</option>
                                    <option value="animaux" <?php if($annonce_old->type_article == 'animaux') { echo "selected ";} ?>>Animaux</option>
                                    <option value="service" <?php if($annonce_old->type_article == 'service') { echo "selected ";} ?>>Service</option>
                                    <option value="vehicules" <?php if($annonce_old->type_article== 'véhicules') { echo "selected ";} ?>>Véhicule</option>
                                    <option value="autres" <?php if($annonce_old->type_article == 'autres') { echo "selected ";} ?>>Autres</option>
                                </select>
                            </div>
                            <div class="input_register">
                                <label for="statut">Statut</label>
                                <select name="statut" id="statut" class="select" >
                                    <option>Actif/Inactif</option>
                                    <option value="actif" <?php if($annonce_old->statut == 'actif') { echo "selected ";} ?>>Actif</option>
                                    <option value="inactif" <?php if($annonce_old->statut == 'inactif') { echo "selected ";} ?>>Inactif</option>
                                </select>
                            </div>
                            <div class="input_register">
                                <label for="titre">Post title</label>
                                <input type="text" name="titre" id="titre" value="<?php echo $annonce_old->titre; ?>">
                            </div>
                            <div class="input_register">
                                <label for="prix">Price</label>
                                <input type="text" name="prix" id="prix" value="<?php echo $annonce_old->prix; ?>" >
                            </div>
                            <div class="input_register">
                                <label for="lieu">Address</label>
                                <input type="text" name="lieu" id="lieu" value="<?php echo $annonce_old->lieu; ?>">
                            </div>
                            <div class="input_register">
                                <label for="description_article">Description</label>
                                <input type="text" name="description_article" id="description_article" value="<?php echo $annonce_old->description_article; ?>">
                            </div>
                        </div>
                        <button type="submit" name="upload">Post</button>
                    </form>
                    </div>
        <?php } 
    }
    else{
    // Affichier mes annonces
    $resultat = $pdo->query("SELECT * FROM annonce ORDER BY id_annonce DESC");       
    while($annonce = $resultat->fetch(PDO::FETCH_OBJ)) {
        if($_SESSION['membre']['email']==$annonce->auteur){
?>
<div class="box">
    <div class="imgBx">
      <a href="">
        <img src="<?php echo "photo/".$annonce->photo;?>" alt="" />
      </a>
    </div>
    <div class="content">
      <h2 id="title"><?php echo $annonce->titre ;?></h2>
      <p id="type"><?php echo "Type: " .$annonce->type_article ;?></p>
      <p id="price"><?php echo "Prix: ". $annonce->prix."€" ;?></P2>
      <p id="location"><?php echo "Adresse: " .$annonce->lieu;?></p>
      <p id="status"><?php echo "Statut: " .$annonce->statut;?></p>
      <p id="description"><?php echo "Description: " .$annonce->description_article;?></p>
      <p id="date_pub"><?php echo "Date: " .$annonce->date_publication ;?></p>
    </div>
    <div class="fonction">
        <td><a href="?action=modification&id_annonce=<?php echo $annonce->id_annonce; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
        <td><a href="?action=suppression&id_annonce=<?php echo $annonce->id_annonce; ?>" ><i class="fa fa-trash-o" ></i></a></td>
    </div>
</div>
<?php } ?>
<?php } ?>
<?php } ?>

<?php } ?>
<?php include("inc/footer.inc.php"); ?>
