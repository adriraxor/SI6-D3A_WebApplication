<?php
// Start the session
session_start();

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
    require('requires_/BDDconnect.php'); //Permet la connexion à la BDD 
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
            
            //affiche la page Admin concernant les tickets uniquements pour les utilisateur ayant le statut = 1 (Qui signifie le plus haut statut soit les Administrateurs)//
            
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
              <li class="item">Boite de Reception</li>
            </ul>
          </div>
        </div>
        <!-- col-lg-2 -->

        <div class="col-lg-9 col-md-9 col-sm-9 mx-auto" id="C-Salle">
            <h2 class="text-center">Administration</h2>
          <div class="row">


            <!-------------NOUS ALLONS AFFICHER SOUS FORMES DE TABLEAU TOUTES LES TICKETS EN COURS---------------------->
              <div class="list-ticket">
                <h4>Liste des tickets</h4>
              </div>
              <?php

          

          //On va chercher tous les enregistrement de la table d3a_ticket
          $reqperso = "SELECT * FROM d3a_ticket";

          $reponse = $bdd->query($reqperso); //Lecture de la requête 

         echo "
         <table class='table table-striped table-bordered table-hover'>"; //Création de la tableau (Utilisation de bootstrap)

         /////////////////////////////////////////////////////////////////////////////////////////////////////
         ////Création des colonnes (Prenom/Nom/Date de naissance/EMAIL/Numero TEL) toujours avec bootstrap////
        //////////////////////////////////////////////////////////////////////////////////////////////////////

         echo "<thead><tr class='table-primary'><th scope='col'>#</th><th scope='col'>EXPEDITEUR</th><th scope='col'>DESTINATAIRE</th><th scope='col'>MESSAGE</th><th scope='col'>SALLE</th><th scope ='col'>INCIDENTS</th><th>PRIORITE TICKET</th><th scope='col'>Date Ouverture</th><th scope='col'>Actions</th></tr></thead>";
         
         while ($donnees = $reponse->fetch()) //Insertion des données dans notre tableau sur le site
         {
            echo "<tr><td>".$donnees['id']."</td><td>".$donnees['expediteur']."</td><td>".$donnees['destinataire']."</td><td>".$donnees['message']."</td><td>".$donnees['nom_salle']."</td><td>".$donnees['incidents']."</td><td>".$donnees['priorite_ticket']."</td><td>".$donnees['dateOuverture']."</td>"."<td><a href='response.php'><button type='button' class='supprimer'>Répondre</button></a></td></tr>";
         }
          echo "</table>"; //Fin du tableau

          $reponse->closeCursor();





            ?>

          </div>
        </div>
      </div>


    <!-- Bootstrap core JavaScript -->
    <script src="../Style/jquery/jquery.min.js"></script>
    <script src="../Style/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
