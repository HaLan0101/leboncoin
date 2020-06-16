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
      if(isset($_GET['action']) && $_GET['action'] == 'modification'){
        $resultat = $pdo->query("SELECT * FROM membre ORDER BY id_membre");
        $membre = $resultat->fetch(PDO::FETCH_OBJ);
        if (!empty($_POST)) {   
          $photo_bdd = "";     
          $nom_photo=$_POST['photo_actuelle'];  
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
          $nom_photo = time() . '_' .$_FILES['photo']['name']; 
          $resultat = $pdo->exec("UPDATE membre SET `photo` = '$nom_photo', `pseudo` = '$_POST[pseudo]',`mdp` = '$_POST[mdp]',`nom` = '$_POST[nom]',`prenom` = '$_POST[prenom]',`email` = '$_POST[email]'  WHERE `id_membre` = '$_GET[id_membre]';");
          header("location:profile.php");         
        }
        if(isset($_GET['action']) && ( $_GET['action'] == 'modification')) {    
          if((isset($_GET['id_membre'])) )    {        
              $resultat = $pdo->query("SELECT * FROM membre WHERE id_membre=$_GET[id_membre]");      
              $membre_new = $resultat->fetch(PDO::FETCH_OBJ);      
          }
          ?>
          <div class="regform" >
            <h1>Resgister</h1>
            <div class="main">
                <div class="form">
                    <form action='' method="post" enctype="multipart/form-data">
                      <label for="photo">Insert article picture :</label>
                      <input type="file" name="photo" placeholder="Click" id="photo"  multiple="">
                        <?php 
                            if(isset($membre_new))        {                       
                              ?>
                              <input type="hidden" name="photo_actuelle" value="<?php echo $membre_new->photo ?>"><br>
                              <?php          
                              } 
                        ?>
                      <div class="image-preview" id="imagePreview">   
                          <img src="" alt="" class="image-preview__image"> 
                          <span class="image-preview__default-text">Image Preview</span>
                      </div>
                      <div class="input_register">
                          <label for="pseudo">Username</label>
                          <input type="text" name="pseudo"  id="pseudo" value="<?php echo $membre_new->pseudo; ?>" >
                      </div>
                      <div class="input_register">
                          <label for="mdp">Password</label>
                          <input type="password" name="mdp"  id="mdp" value="<?php echo $membre_new->mdp; ?>">
                      </div>
                      <div class="input_register">
                          <label for="nom">Last Name</label>
                          <input type="text" name="nom" id="nom" value="<?php echo $membre_new->nom; ?>">
                      </div>
                      <div class="input_register">
                          <label for="prenom">First Name</label>
                          <input type="text" name="prenom" id="prenom" value="<?php echo $membre_new->prenom; ?>">
                      </div>
                      <div class="input_register">
                          <label for="email">Email</label>
                          <input type="email" name="email"  id="email" value="<?php echo $membre_new->email; ?>">
                      </div>
                      <button type="submit">Modifier</button>

                      </div>
                    </form>
                </div>
              </div>
        </div>


<?php
        }
      }
      else{
        //Afficher Profil
        $resultat = $pdo->query("SELECT * FROM membre ORDER BY id_membre");       
        while($membre = $resultat->fetch(PDO::FETCH_OBJ)) {
        if($_SESSION['membre']['email']==$membre->email){
?>
    <div class="container">
      <img src="<?php echo "photo/".$membre->photo;?>" alt="" srcset="" />
      <div class="product">
        <h1 id="pseudo"><?php echo "Pseudo :  ".$membre->pseudo ;?></h1>
        <h2 id="nom"><?php echo "Nom :  ".$membre->nom ;?></h2>
        <h2 id="prenom"><?php echo "Prenom :  ".$membre->prenom ;?></h2>
        <p id="email"><?php echo "Email :  ".$membre->email ;?></p>
      </div>
      <form action="" method="POST">
        <input type="hidden" name="deconnexion" value="1">
        <button type="submit" value="Deconnexion">Deconnexion</button>
      </form>
      <td><a href="?action=modification&id_membre=<?php echo $membre->id_membre; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
    </div>
<?php } }}}
  $destroySession = filter_input(INPUT_POST, "deconnexion");
  if ($destroySession == 1) {
    session_destroy();
    header("location:index.php"); 
  }
?>
<?php include("inc/footer.inc.php"); ?>