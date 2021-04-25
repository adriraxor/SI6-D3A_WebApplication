<?php
// Start the session
session_start();

//connexion BDD
//$bdd = new PDO('mysql:host=localhost;dbname=application_web','root','');
require('requires_/BDDconnect.php');

if(isset($_POST['valider']))
{
	//if(!empty($_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['Nom-Salle']) AND !empty($_POST['incidents']) AND !empty($_POST['Priorite-Urgence']) AND !empty($_POST['dateOuverture']))
  
	if (1 == 1) {

		$destinataire = htmlspecialchars($_POST['destinataire']);    
		$message = htmlspecialchars($_POST['message']);
		$nomSalle = settype($_POST['Nom-Salle'], 'int');
		$incidents = htmlspecialchars($_POST['incidents']);
		$prioriteUrgence = htmlspecialchars($_POST['Priorite-Urgence']);
		$dateOuverture = htmlspecialchars($_POST['dateOuverture']);
		$expediteur = $_SESSION['pseudo'];
		$pseudo_destinataire = $bdd->prepare("SELECT pseudo FROM d3a_user WHERE pseudo ='".$destinataire."'");
		$pseudo_destinataire->execute(array($destinataire));
		$pseudo_destinataire = $pseudo_destinataire->fetch();
		$pseudo_destinataire = $pseudo_destinataire['pseudo'];

		//$sql = "INSERT INTO d3a_ticket(id_expediteur,id_destinataire,message,nom_salle,incidents,priorite_ticket,dateOuverture) VALUES(?,?,?,?,?,?,?,?)";
		$sql = 'INSERT INTO d3a_ticket VALUES(0,:expediteur,:destinataire, :message, :nomSalle, :incidents, :prioriteUrgence, :dateOuverture)';
		//echo $sql;
		//echo "INSERT INTO membres VALUES(0,".$valueUsername.", ".$valuePassword.", ".$valueemail.", ".$valuenumTelephone.", ".$key.", 0)";
		$pdoStat = $bdd->prepare($sql);
		//$ins->execute(array($_SESSION['id'],$id_destinataire,$message,$nomSalle,$incidents,$prioriteUrgence,$dateOuverture));
		$pdoStat->bindValue(':expediteur', $expediteur, PDO::PARAM_STR);
		$pdoStat->bindValue(':destinataire', $destinataire, PDO::PARAM_STR);
    $pdoStat->bindValue(':message', $message, PDO::PARAM_STR);
    $pdoStat->bindValue(':nomSalle', $nomSalle, PDO::PARAM_STR);
    $pdoStat->bindValue(':incidents', $incidents, PDO::PARAM_INT);
    $pdoStat->bindValue(':prioriteUrgence', $prioriteUrgence, PDO::PARAM_INT);
    $pdoStat->bindValue(':dateOuverture', $dateOuverture);
    $InsertIsOk = $pdoStat->execute();

		$error = "Votre message a bien été envoyé";
	}
	else
	{
		$error = "Veuillez compléter tous les champs";
	}
 }

$destinataire = $bdd->query('SELECT pseudo FROM d3a_user ORDER BY pseudo')
?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../Style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/css/Application_Web.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <title>D3A</title>
  </head>
  <body>
  <?php
    require('requires_/BDDconnect.php');
  ?>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">D3A</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="Application_Web.php">Parc
              <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Assistance.php">Assistance</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="BoiteReception.php">Boite de Reception</a>
            </li>
            <?php
            //affiche la page Admin concernant les tickets uniquements pour les utilisateur ayant le statut = 1 (Qui signifie le plus haut statut)
            
            $pseudo = $_SESSION['pseudo'];
            $sql = "SELECT * FROM d3a_user WHERE statut = 1 AND pseudo = '$pseudo'";
            $req = $bdd->prepare($sql);
            $req->execute();

            if($req->rowCount() > 0)
            {

              echo "<a class='nav-link' href='AdminPage.php'>TicketAdminResponse</a>";

            }

            ?>
          </ul>
        </div>
      </div>
    </nav>


      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-3 text-center" id="menu">
          <h2>Parc</h2>
          <div class="sous-menu">
            <ul class="list-group">
              <li class="item">Plan</li>
              <li class="item">Assistance</li>
              <li class="item">Administration</li>
            </ul>
          </div>
        </div>
        <!-- col-lg-2 -->
        <div class="col-lg-9 col-md-9 col-sm-9 mx-auto" id="C-Salle">
            <h2 class="text-center">Assistance</h2>
          <div class="row">
            <form class="col form" action="" method="POST">
              <div class="Create-Ticket">
                <h4>Creation d'un ticket</h4>


                <!--------SELECTION DESTINATAIRE------------>
                 <label for="destinataire">Destinataire</label>
                    <select class="form-control" id="destinataire" name="destinataire">
                    	<?php while($d = $destinataire->fetch()){
                    		echo "<option value='".$d['pseudo']."'>".$d['pseudo']."</option>";
                     } ?>
            		</select>
            	</br>

              <!-----------DATE OUVERTURE-------------->
                <div class="form-group">
                  <span data-placeholder="Date d'ouverture du ticket"></span>
                  <input type="date" class="form-control" name="dateOuverture" value="">
                </div>
              </div>

          </div>
          <!-- row -->

          <div class="row">
            <!---------------------SELECTION SALLE---------------------->
                <div class="Choix-Salle">
                    <label for="Nom-Salle">Choisissez votre salle</label>
                    <select class="form-control" id="Nom-Salle" name="Nom-Salle">
                        <option value="">----Choix de la salle----</option>
                        <option value="116">Salle 116</option>
                        <option value="117">Salle 117</option>
                    </select>
                </div>
          </div>
            </br>

            <!-------SELECTION INCIDENT(S)---------->
                <input type="checkbox" name="incidents" id="Panne-Reseau" value="1">
                  <label for="Incident-Select">Panne réseau</label>
                  <input type="checkbox" name="incidents" id="Panne-Software" value="2">
                  <label for="Incident-Select">Panne Software</label>
                  <input type="checkbox" name="incidents" id="Panne-Hardware" value="3">
                  <label for="Incident-Select">Panne Hardware</label>


                </br></br>


                <!-----------------MESSAGE DU TICKET-------------------->
                <div class="Message">
                  <label for="message">Message</label>
                </br>
                  <textarea class="form-control Ticket-Message" id="Description-Ticket-Message" name="message" rows="5" cols="33">

                  </textarea>
</br>


            <!-------------PRIORITE DU TICKET---------------->
                <div class="Priorite">

                   <label for="Urgence-Select">Urgence</label>
                    </br>
                    <select class="form-control Priorite"name="Priorite-Urgence" id="Urgence-Select">
                      <option value="">----Priorité du Ticket----</option>
                      <option value="1">Normal</option>
                      <option value="2">Moyen</option>
                      <option value="3">Important</option>
                      <option value="4">Urgent</option>
                    </select>
                </div>
            </div>
                </br>

                <!---------------BOUTON ENVOYER----------------->
                <input type="submit" value="Envoyer" name="valider" />
                </br></br>
                <?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>';}




                //echo "INSERT INTO d3a_ticket VALUES(0,".$id_expediteur.", ".$id_destinataire.", ".$dateOuverture.", ".$message.", ".$incidents.",0)";
                ?>
              </form>

          </div>

 
        </div>
      </div>




    <!-- Bootstrap core JavaScript -->
    <script src="../Style/jquery/jquery.min.js"></script>
    <script src="../Style/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
