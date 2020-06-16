<?php include("inc/header.inc.php"); ?>
<?php 
$resultat = $pdo->query("SELECT * FROM membre WHERE id_membre=$_GET[id_membre]"); 
while($membre = $resultat->fetch(PDO::FETCH_OBJ)) {
    if(!empty($_POST)){
        $destinataire=$membre->email;
        $headers  = 'MIME-Version: 1.0' . "\n";    
        $headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";    
        $headers .= 'Reply-To: ' . $_POST['expediteur'] . "\n";    
        $headers .= 'From: "' . ucfirst(substr($_POST['expediteur'], 0, strpos($_POST['expediteur'], '@'))) . '"<'.$_POST['expediteur'].'>' . "\n";    
        $headers .= 'Delivered-to: ' . $destinataire . "\n"; 
        mail($destinataire, $_POST['sujet'], $_POST['message'], $headers); 
    }

?>
<div class="regform">
        <h1>Envoyer Email</h1>
        <div class="main">
            <div class="form">
                <form action="" method="post">
                <div class="input_register">
                    <label for="expediteur">Expediteur</label>
                    <input type="email" name="expediteur" placeholder="" id="expediteur" required="">
                </div>
                <div class="input_register">
                    <label for="sujet">Sujet</label>
                    <input type="text" name="sujet" placeholder="" id="sujet" required="">
                </div>
                <div class="input_register">
                    <label for="message">Message</label>
                    <input type="text" name="message" placeholder="" id="message" required="">
                </div>
                <button type="submit">Envoyer</button>
                </div>
                </form>
            </div>
          </div>
</div>
<?php }?>
<?php include("inc/footer.inc.php"); ?>