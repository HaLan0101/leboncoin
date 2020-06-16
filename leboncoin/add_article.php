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
    if (!empty($_POST)) {
        $photo_bdd = "";     
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
        $result = $pdo->query("INSERT INTO annonce (photo, type_article, statut, titre,prix,lieu, description_article,date_publication,auteur) VALUES ('$nom_photo', '$_POST[type_article]', '$_POST[statut]', '$_POST[titre]','$_POST[prix]', '$_POST[lieu]', '$_POST[description_article]',' $date','$auteur');");
    }
 
?>

<div class="contentform">
  <form method="post" enctype="multipart/form-data"  >
    <label for="photo">Insert article picture :</label>
    <input type="file" name="photo" placeholder="Click" id="photo" multiple="">

    <div class="image-preview" id="imagePreview">   
        <img src="" alt="" class="image-preview__image"> 
        <span class="image-preview__default-text">Image Preview</span>
    </div>

    <div class="article_description">
        <div class="input_register">
            <label for="type_article">Select type of post</label>
            <select name="type_article" id="type_article" class="select" required="">
                <option>Post type</option>
                <option value="maison">Maison</option>
                <option value="mode">Mode</option>
                <option value="animaux">Animaux</option>
                <option value="service">Service</option>
                <option value="vehicules">Véhicule</option>
                <option value="autres">Autres</option>
            </select>
        </div>
        <div class="input_register">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="select" required="">
                <option>Actif/Inactif</option>
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
            </select>
        </div>
        <div class="input_register">
            <label for="titre">Post title</label>
            <input type="text" name="titre" placeholder="" id="titre" required="">
        </div>
        <div class="input_register">
            <label for="prix">Price</label>
            <input type="text" name="prix" placeholder="" id="prix" required="">
        </div>
        <div class="input_register">
            <label for="lieu">Address</label>
            <input type="text" name="lieu" placeholder="" id="lieu" required="">
        </div>
        <div class="input_register">
            <label for="description_article">Description</label>
            <input type="text" name="description_article" placeholder="" id="description_article" required="">
        </div>
    </div>
    <button type="submit" name="upload">Post</button>
  </form>
</div>
<?php } ?>
<?php include("inc/footer.inc.php"); ?>