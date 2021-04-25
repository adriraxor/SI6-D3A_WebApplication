<?php
require('requires_/BDDconnect.php'); // Connexion BDD


//**verifie si formlulaire de connexion est bien rempli
//if (isset($_POST['connect']))
if(isset($_POST['connectUsername']) && isset($_POST['connectPassword']))
{

	$Username = $_POST['connectUsername'];
	$Password = $_POST['connectPassword'];
    //**verifier si le usser et paswwd existent
	$sql = ("SELECT * FROM d3a_user where pseudo  = '$Username' and password = '$Password'  ");
	$result = $bdd->prepare($sql);
	$result->execute();
	//** si la ligne a été trouvé dans la base
	if($result->rowCount() > 0)
	{
         $data = $result->fetchAll();
         session_start(); //**on demarre la session ici !
         $_SESSION['pseudo'] = $Username;

         header('Location: Application_Web.php'); //puis on va sur accueil
	}
	//** pas de ligne trouvé, donc user et passwd inconnus = retour formulaire
	else
	{
		header('location: index.php');

	}
}

?>
