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
    $resultat = $pdo->query("SELECT * FROM membre WHERE id_membre=$_GET[id_membre]"); 
    while($membre = $resultat->fetch(PDO::FETCH_OBJ)) {
      if(!empty($_POST)){
        $f=fopen("data/data.txt","a");
        fwrite($f,$_POST["message"]. "|");
        fwrite($f,date("Y/m/d"). "\n");

        fclose($f);
    }
?>
<div class="chat_container">
      <div class="message_search_container">
        <input type="text" placeholder="Search" id="name_filter" />
      </div>

      <div class="conversation_list">
        <div class="conversation">
          <img src="<?php echo "photo/".$membre->photo;?>" alt="Teba" />
          <div class="title-text" id="name">
          <?php echo $membre->pseudo;?>
          </div>
          <div class="created-date" id="date">
          <?php echo date("Y/m/d");?>
          </div>
          <div class="conversation_message" id="message">
            
          </div>
        </div>
      </div>

      <div class="chat_title" id="other_name">
        <span><?php echo $membre->pseudo;?></span>
      </div>

      <div class="chat_message_list">
      <?php 
              $fichier = file("data/data.txt");
              foreach($fichier as $key => $ligne) {
                $message_infos = explode("|", $ligne);
                ?>
        <div class="message-row you-message">
                <div class="message-text" id="your_message"><?php echo $message_infos[0] . "<br>";?></div>
                <div class="message-time" id="your_time"><?php echo $message_infos[1]; ?></div>
        </div>
        <?php }?>
        <div class="message-row other-message">
          <div class="message-text" id="other_message">How much ?</div>
          <div class="message-time" id="other_time">june 14</div>
        </div>
      </div>
      <div class="chat_form">
          <form method="post" >
            <input type="text" name="message" id="message" placeholder="Type a message" />
            <button type="submit" >Send</button>
          </form>
      </div>
    </div>
<?php }} ?>
<?php include("inc/footer.inc.php"); ?>
