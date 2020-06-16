<?php include("inc/header.inc.php"); ?>
<div class="main_search">
        <form action="" method="post">
          <div class="recherchefiltre">
          <label for="type_article">Select type of post</label>
              <select name="type_article" id="type_article" class="select" >
                  <option>Post type</option>
                  <option value="maison">Maison</option>
                  <option value="mode">Mode</option>
                  <option value="animaux">Animaux</option>
                  <option value="service">Service</option>
                  <option value="vehicules">Véhicule</option>
                  <option value="autres">Autres</option>
              </select>
          </div>
          <!-- <input type="text" placeholder="What ar you looking for ?" name="lieu"> -->
          <button type="submit">Search</button>
        </form>
    </div>  
<?php 
    if (!empty($_POST)){
      $resultat = $pdo->query("SELECT * from annonce where type_article like '%". $_POST["type_article"]. "%' order by date_publication");  
      while($annonce = $resultat->fetch(PDO::FETCH_OBJ)) {
        ?>
      <div class="box">
          <div class="imgBx">
            <a href="article.php?id_annonce= <?php echo $annonce->id_annonce; ?>">
              <img src="<?php echo "photo/".$annonce->photo;?>" alt="" />
            </a>
          </div>
          <div class="content">
          <a href="article.php?id_annonce= <?php echo $annonce->id_annonce; ?>">
            <h2 id="title"><?php echo $annonce->titre ;?></h2>
          </a>
            <p id="type"><?php echo "Type: " .$annonce->type_article ;?></p>
            <p id="price"><?php echo "Prix: ". $annonce->prix."€" ;?></P2>
            <p id="location"><?php echo "Adresse: " .$annonce->lieu;?></p>
            <p id="status"><?php echo "Statut: " .$annonce->statut;?></p>
            <p id="date_pub"><?php echo "Date: " .$annonce->date_publication ;?></p>
          </div>
      </div>
  <?php }
    }
    else {
    $resultat = $pdo->query("SELECT * FROM annonce ORDER BY id_annonce DESC");        
    while($annonce = $resultat->fetch(PDO::FETCH_OBJ)) {
?>
<div class="box">
    <div class="imgBx">
      <a href="article.php?id_annonce= <?php echo $annonce->id_annonce; ?>">
        <img src="<?php echo "photo/".$annonce->photo;?>" alt="" />
      </a>
    </div>
    <div class="content">
    <a href="article.php?id_annonce= <?php echo $annonce->id_annonce; ?>">
      <h2 id="title"><?php echo $annonce->titre ;?></h2>
    </a>
      <p id="type"><?php echo "Type: " .$annonce->type_article ;?></p>
      <p id="price"><?php echo "Prix: ". $annonce->prix."€" ;?></P2>
      <p id="location"><?php echo "Adresse: " .$annonce->lieu;?></p>
      <p id="status"><?php echo "Statut: " .$annonce->statut;?></p>
      <p id="date_pub"><?php echo "Date: " .$annonce->date_publication ;?></p>
    </div>
</div>
<?php }} ?>
<?php include("inc/footer.inc.php"); ?>
