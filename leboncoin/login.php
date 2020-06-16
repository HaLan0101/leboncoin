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
    if(internauteEstConnecte()) {
      header("location:profile.php"); }
    if(isset($_GET['action']) && $_GET['action'] == "deconnexion") {    
        session_destroy(); 
    } 
    if($_POST) {
        $req = "SELECT * FROM membre WHERE email='$_POST[email]' AND mdp='$_POST[mdp]'";    
        $resultat = $pdo->query($req);        
        $membre = $resultat->fetch(PDO::FETCH_OBJ);    
        if(!empty($membre))    
        {        
        echo '<h1>Vous êtes bien reconnu par le site web pour vous connecter...</h1></div>'; 
        foreach($membre as $indice => $element){                
            if($indice != 'mdp'){                    
                $_SESSION['membre'][$indice] = $element;                
                }            
            }            
            header("location:profile.php"); 
        }               
        else{        
            echo '<h1>Erreur d\'identification</h1></div>';    
        } 
        }
 ?>
    <div class="regform">
        <h1>Login</h1>
        <div class="main">
            <div class="form">
                <form action="" method="post">
                <div class="input_register">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email" id="email" required="">
                </div>
                <div class="input_register">
                    <label for="mdp">Password</label>
                    <input type="password" name="mdp" placeholder="Password" id="mdp" required="">
                </div>
                <button type="submit">Login</button>
                <a href="registration.php">Register</a>

                </div>
                </form>
            </div>
          </div>
    </div>

<?php include("inc/footer.inc.php"); ?>  