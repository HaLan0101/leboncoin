<?php include("inc/header.inc.php"); ?>
<?php  
  $resultat = $pdo->query("SELECT * FROM annonce WHERE id_annonce=$_GET[id_annonce]"); 
  while($annonce = $resultat->fetch(PDO::FETCH_OBJ)) {
?>
<div class="article_container">
  <div class="container">
    <img src="<?php echo "photo/".$annonce->photo;?>" alt="" srcset="" />
    <div class="product">
      <h1 id="type"><?php echo $annonce->titre ;?></h1>
      <h2 id="title"><?php echo "Type: " .$annonce->type_article ;?></h2>
      <h2 id="price"><?php echo "Prix: ". $annonce->prix."€" ;?></h2>
      <p id="description"><?php echo "Description: " .$annonce->description_article;?></p>
      <p id="date_pub"><?php echo "Date: " .$annonce->date_publication ;?></p>
      <p id="location"><?php echo "Adresse: " .$annonce->lieu;?></p>
      <p id="status"><?php echo "Statut: " .$annonce->statut;?></p>
    </div>
  </div>
<?php 
  $result = $pdo->query("SELECT * FROM membre");       
  while($membre = $result->fetch(PDO::FETCH_OBJ)) {
    if($annonce->auteur==$membre->email){
?>
  <div class="article_card-container">
    <div class="upper-container">
      <div class="image-container">
          <img src="<?php echo "photo/".$membre->photo;?>" />
      </div>
    </div>
    <div class="lower-container">
      <div>
        <h3 id="name"><?php echo "Name :  ".$membre->pseudo ;?></h3>
      </div>
    <div> 
    <div>
      <a href="message.php?id_membre= <?php echo $membre->id_membre; ?>" class="btn">Envoyer un message</a>
    </div>
    <div class="email">
      <a href="envoyer_email.php?id_membre= <?php echo $membre->id_membre; ?>" class="btn">Envoyer un email</a>
    </div>
  </div>
</div>
<?php }} }?>
<?php include("inc/footer.inc.php"); ?>