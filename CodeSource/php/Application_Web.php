<?php
session_start();
require('Class/User.class.php');                                                //SESSION + REQUIRE(S)
$User = new User($_SESSION['pseudo']);
require('Traitement.php');
 ?>


<!-----------------------------------------HTML----------------------------->
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../Style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/css/Application_Web.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>D3A</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">D3A</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="Application_Web.php">Parc</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Assistance.php">Assistance</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="BoiteReception.php">Boite de Reception</a>
            </li>
            <?php

            //Connexion BDD
            require('requires_/BDDconnect.php');
            

            //Affiche la page Admin concernant les tickets uniquements pour les utilisateur ayant le statut = 1 (Qui signifie le plus haut statut/le plus importants)
            $pseudo = $_SESSION['pseudo'];
            $sql = "SELECT * FROM d3a_user WHERE statut = 1 AND pseudo = '$pseudo'";
            $req = $bdd->prepare($sql);
            $req->execute();

            //Parcours les ligne de la table D3A_user ce qui va nous permettre de récupérer le statut de l'user qui s'est connecté ,si le statut = 1 donc la possibilité d'accéder à la page ADMIN
            if($req->rowCount() > 0)
            {

              echo "<a class='nav-link' href='AdminPage.php'>TicketAdminResponse</a>";

            }

            ?>
            <li class="nav-item">
              <a class="nav-link" href="Déconnexion.php">Déconnexion</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-3 text-center" id="menu">
          <h2>Parc</h2>
          <div class="sous-menu">
            <ul class="list-group">
              <li class="item">Affichage</li>
              <li class="item">Administration</li>
            </ul>
          </div>
        </div>
        <!-- col-lg-2 -->

        <div class="col-lg-9 col-md-9 col-sm-9 mx-auto" id="C-Salle">
            <h2 class="text-center">Administration</h2>
        <?php if($User->getStatut()< 4){ ?>
        <div class="my-5 row">
          <form class="form-inline" action="#" method="post">
            <div class="form-group">
              <label for="input_CS_bat" class="col-form-label">Créer une salle</label>
              <input type="text" class="mx-sm-3 form-control"  id="input_CS_bat" name="CreateSalle[batimentSalle]" value="" placeholder="batiment">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" name="CreateSalle[idSalle]" value="" placeholder="numéro">
            </div>
            <div class="form-group">
              <input type="text" class="ml-sm-3 form-control" name="CreateSalle[libelle]" value="" placeholder="libelle">
            </div>
            <button type="submit" class="ml-sm-3 btn btn-primary" name="Envoyer">Envoyer</button>
          </form>
        </div>
        <?php } ?>


        <div class="row">
          <form class="form-inline" id="input_select_salle" action="#" method="post">
          <div class="form-group">
            <label for="input_select_salle" class="ml-3 col-form-label">Choississez la salle</label>
          </div>
          <div class="form-group ml-3">

              <select class="form-control" name="AdministrerSalle[idSalle]">
                <option value="Tous">Toutes</option>
              <?php $result = $data->getlesSalles();
              foreach ($result as $value) { ?>
                <option value="<?= $value['idSalle'] ?>"><?= $value['batimentSalle']." ".$value['idSalle'] ?></option>
              <?php } ?>
              </select>

              <button type="submit" class="ml-3 btn btn-primary" name="button">Valider</button>
            </form>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <table class="my-5 table table-striped table-bordered">
              <caption>Ensemble des ordinateurs</caption>
              <thead class="table-info">
                <tr>
                  <th>Marque</th>
                  <th>Référence constructeur</th>
                  <th>Système d'exploitation</th>
                  <th>Localisation</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="thead-light">
                <?php foreach ($lesOrdinateurs as $value): ?>
                  <tr>
                    <th><?= $value['Marque'] ?></th>
                    <th><?= $value['Refproduitconstructeur'] ?></th>
                    <th><?= $value['systeme_exploitation'] ?></th>
                    <th><?= $value['idSalle'] ?></th>
                    <th>
                      <?php if($User->getStatut()< 4){ ?>
                      <button type="button" class="btn btn-warning" id="btnEditer" data-toggle="modal" data-target="#ModalAddOrdinateur" onclick="MyFunction(<?= $value['idOrdinateur'] ?>)"><i class="fa fa-pencil"></i> Editer </button>
                      <button type="button" class="btn btn-danger" onclick="confirmerdelete(<?= $value['idOrdinateur'] ?>)"><i class="fa fa-trash"></i> Supprimer </button>
                    <?php } ?>
                    </th>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <?php if($User->getStatut()< 4){ ?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAddOrdinateur"> <i class="fa fa-plus"></i> Ajout simple </button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalAddOrdinateurmultiple"> <i class="fa fa-plus"></i> Ajout multiple </button>
            <?php } ?>
          </div>
        </div>

        <?php
        require('requires_/Modal_simple.php');
        require('requires_/Modal_multiple.php');
         ?>


          <!-- row -->
        </div>
        <!-- col-lg-9 -->
      </div>
      <!-- row -->





    <!-- Bootstrap core JavaScript -->
    <script src="../Style/jquery/jquery.min.js"></script>
    <script src="../Style/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/modal.js"></script>
    <script src="../js/editer.js"></script>
    <script src="../js/confirmerdelete.js"></script>
    <script src="../js/showMultiple.js"></script>
  </body>
</html>
