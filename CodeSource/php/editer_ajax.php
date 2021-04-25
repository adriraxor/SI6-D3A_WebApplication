<?php
require('Class/Data.class.php');
$data = new Data;

if (isset($_GET['idOrdinateur'])) {

  $arrayUnOrdinateur = $data->getUnOrdinateur($_GET['idOrdinateur']);

  echo json_encode($arrayUnOrdinateur);

} ?>
