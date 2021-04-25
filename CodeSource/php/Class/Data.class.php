<?php
/**
 *
 */
class Data
{
  const HOST = '127.0.0.1';
  const DBNAME = 'application_web';
  const PORT = '3306';
  const LOGIN = 'root';
  const MDP = '';

  function __construct()
  {
  }

  public function getlesSalles(){
    try {
      $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
      $req = "SELECT idSalle, batimentSalle";
      $req .= " FROM d3a_salle";
      $result = $cnx->query($req);
      $result = $result->fetchAll();
      return $result;
    } catch (\Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

  }

  public function getLesOrdi(){
  try{
    $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
    $req = "SELECT *";
    $req .= " FROM d3a_ordinateur";
    $result = $cnx->query($req);
    $result = $result->fetchAll();
    return $result;
  } catch (\Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
  }

  public function getLesOrdibySalle($pSalle){
    try {
      $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
      $req = "SELECT *";
      $req .= " FROM d3a_ordinateur";
      $req .= " WHERE idSalle = :id";
      settype($pSalle, 'int');
      $result = $cnx->prepare($req);
      $result->execute([':id'=>$pSalle]);
      $result = $result->fetchAll();
      return $result;
    } catch (\Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function getUnOrdinateur($id){
  try{
    $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
    $req = "SELECT *";
    $req .= " FROM d3a_ordinateur";
    $req .= " WHERE idOrdinateur = :id";
    settype($id, 'int');
    $result = $cnx->prepare($req);
    $result->execute([':id'=>$id]);
    $result = $result->fetch();

    $return = array();
    foreach ($result as $key => $value) {
      if(is_string($key)){$return[$key] = $value;}
    }

    return $return;
  } catch (\Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }
  }

  public function CreateSalle($array){
    try {
      $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
      $req = "INSERT INTO d3a_salle (idSalle, batimentSalle, libelleSalle)";
      $req .= " VALUES (:id , :bat , :libelle)";
      settype($array['idSalle'], 'int');
      $result = $cnx->prepare($req);
      $result->execute([':id'=>$array['idSalle'] , ':bat'=>$array['batimentSalle'], ':libelle' => $array['libelle']]);
    } catch (\Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function AjouterOrdinateur($array){
    try {
      // on change le type de ces deux varible en integer
      settype($array['Salle'], 'int');
      settype($array['nombre'], 'int');

      // Pour cette requête nous allons concaténer à notre variable $req les valeurs pour chaque référence produit
      // Donc pour ceci on va constituer un tableau et la variable pour faire une grosse variable préparé au lieu
      // de faire plusieurs requêtes préparées (ce sera moins dur pour le serveur)
      // l'idée est donc de faire boucler avec une variable incrémenter l'ajouter de VALUE et de push dans le tableau seulement les paramètre et
      // d'ajouter à la varible req les marqeurs nominatif qui nous permettrons d'éffacer la redondance même paramètre
      $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
      $req = "INSERT INTO d3a_ordinateur";
      $req .= "(Marque, Refproduitconstructeur, processeur, memoire_vive, carte_graphique, systeme_exploitation, idSalle)";
      $req .= " VALUES";

      //on préconstitue le tableau de paramètre car ces derniers sont présent dans tous les cas d'ajout
      $Array = [':marque'=>$array['Marque'] ,
                ':proco'=>$array['Processeur'] ,
                ':memoire'=>$array['Memoire'] ,
                ':GPU'=>$array['GPU'] ,
                ':OS'=>$array['Systeme'] ,
                ':salle'=>$array['Salle']
              ];

      // Le problème c'est qu'un INSERT into de plusieurs ligne demandera de différencier toutes les ligne d'ajout de la dernière
      // et ce car le dernier est marqué à la fin d'un ";"  et tous les autres d'une "," .
      for ($i=0; $i < $array['nombre']; $i++) {
        $keyref = ':ref'.$i;
        if ($i != $array['nombre'] - 1) {
          $req .= " (:marque , ".$keyref.", :proco, :memoire , :GPU, :OS, :salle),";
        }elseif ($i == $array['nombre'] - 1) {
          $req .= " (:marque ,".$keyref.", :proco, :memoire , :GPU, :OS, :salle);";
        }
        $Array[$keyref] = $array['Ref'][$i];
      }

      //Finalement on prepare et execute la valeur avec respectivement la variable puis le tableau.
      $result = $cnx->prepare($req);
      $result->execute($Array);
    } catch (\Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function SupprimerOrdinateur($idOrdinateur){
    try {
      $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
      $req = "DELETE";
      $req .= " FROM d3a_ordinateur";
      $req .= " WHERE idOrdinateur = :id";
      settype($idOrdinateur, 'int');
      $result = $cnx->prepare($req);
      $result->execute([':id'=> $idOrdinateur]);
    } catch (\Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function editerUnOrdinateur($id, $array){
    try {
      $execute = [
                    ':id'=> $id,
                    ':marque' => $array['Marque'],
                    ':ref' => $array['Ref'][0],
                    ':proco'=>$array['Processeur'] ,
                    ':memoire'=>$array['Memoire'] ,
                    ':GPU'=>$array['GPU'] ,
                    ':OS'=>$array['Systeme'] ,
                    ':salle'=>$array['Salle']
                  ];

      $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
      $req = "UPDATE d3a_ordinateur";
      $req .= " SET ";
      $req .= "Marque = :marque, ";
      $req .= "Refproduitconstructeur = :ref, ";
      $req .= "processeur = :proco, ";
      $req .= "memoire_vive = :memoire, ";
      $req .= "carte_graphique = :GPU, ";
      $req .= "systeme_exploitation = :OS, ";
      $req .= "idSalle = :salle ";
      $req .= " WHERE idOrdinateur = :id ";
      var_dump($execute);
      var_dump($req);
      $result = $cnx->prepare($req);
      $result->execute($execute);

    } catch (\Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }
}

 ?>
