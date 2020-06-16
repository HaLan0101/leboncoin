<?php require_once("inc/header.inc.php"); ?>
<?php 
if (!empty($_POST)) {
  $email = $_POST['email'];
  function existeEmail($email)
{   
    global $pdo;
     
    $req = "SELECT * FROM membre WHERE email='$_POST[email]'"; 
     
    $res = $pdo->query($req);
    $row = $res->fetch();
     
    return !empty($row);
}
  if(existeEmail($email) )
  {          
  ?>
  <?php
    echo '<h1>Email déjà utilisé</h1>'; 
  }
  else{
    foreach($_POST as $indice => $valeur){                
      $_POST[$indice] = htmlEntities(addSlashes($valeur));            
      }            
      $resultat=$pdo->exec("INSERT INTO membre (pseudo, mdp, nom, prenom, email) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]')");              
    } 
    if(!empty($membre))    {        
      echo '<h1>Vous êtes bien entregistré, Merci</h1>'; }                 
  }
?>
    <div class="regform" >
      <h1>Resgister</h1>
      <div class="main">
          <div class="form">
              <form action='' method="post">
                <div class="input_register">
                    <label for="pseudo">Username</label>
                    <input type="text" name="pseudo" placeholder="Username" id="pseudo" required="">
                </div>
                <div class="input_register">
                    <label for="mdp">Password</label>
                    <input type="password" name="mdp" placeholder="Password" id="mdp" required="">
                </div>
                <div class="input_register">
                    <label for="nom">Last Name</label>
                    <input type="text" name="nom" placeholder="" id="nom" required="">
                </div>
                <div class="input_register">
                    <label for="prenom">First Name</label>
                    <input type="text" name="prenom" placeholder="" id="prenom" required="">
                </div>
                <div class="input_register">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" id="email" required="">
                </div>
                <button type="submit">Login</button>
                <a href="login.php">Already have an account ?</a>

                </div>
              </form>
          </div>
        </div>
  </div>
<?php require_once("inc/footer.inc.php"); ?>