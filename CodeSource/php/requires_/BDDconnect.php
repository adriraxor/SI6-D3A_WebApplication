<?php
/**connexion à la Base de données**/

try{
   $bdd = new PDO('mysql:host=localhost;dbname=application_web','root','');
}catch(PDOException $e){
   die('[D3A] La connexion à la base de données n/a pas été établit vérifiez les paramètres de connexion '.$e->getMessage());
}

?>