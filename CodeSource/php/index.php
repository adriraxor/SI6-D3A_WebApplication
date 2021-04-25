<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>D3A - Connexion</title>
  <link rel="stylesheet" href="../style/css/connexion.css">
  <script src="script.js"></script>
</head>
<body>
    <!---------------------------------FORMULAIRE CONNEXION------------------------------>
    <div class="container">  
        <div class="row">    
            <div class="col-md-6" id="rectangle">
                <form action="login.php" method="post" class="login">

                    <h2 class="connexion">Connexion</h2>

                    <div class="emailBox">
                        <div class="connectInputUsername">
                          <input class="username" name="connectUsername" type="text" placeholder="Username" autocomplete="off"/>
                      </div>
                  </div>
              </br>
              <div class="passwordBox">
                <div class="connectInputPassword">
                    <input class="connectPassword" name="connectPassword" type="password" placeholder="Mot De Passe" autocomplete="off"/>
                </div>
            </div>
        </br>
        <div class="connectButton">
            <button class="Connect" type="submit" name="connect">
              Se connecter
          </button>
      </div>
  </form>  
</br>
<div class="indexButton">
    <form action="../index.php">
        <button class="retourIndex">Revenir à la page d'accueil</button>
    </form>
</div>


</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/main.js"></script>

</body>
</html>