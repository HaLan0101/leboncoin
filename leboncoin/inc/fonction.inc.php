<?
function internauteEstConnecte() {     
    if(!isset($_SESSION['membre'])) {
        return false; 
    }  
    else {
        return true; }
}
?>