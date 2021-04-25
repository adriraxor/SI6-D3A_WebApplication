<?php
require('Class/Data.class.php');
$data = new Data;

$lesOrdinateurs = (!isset($_POST['AdministrerSalle']['idSalle']) || $_POST['AdministrerSalle']['idSalle'] == "Tous") ? ($data->getLesOrdi()) : ($data->getLesOrdibySalle($_POST['AdministrerSalle']['idSalle']));

  if (isset($_POST['CreateSalle'])) {
    $data->CreateSalle($_POST['CreateSalle']);
  }
  
 ?>
