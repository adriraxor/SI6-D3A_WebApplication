<?php
require('Class/Data.class.php');
$data = new Data;

if ($_GET['id']){

  $data->SupprimerOrdinateur($_GET['id']);
  header('Location: Application_Web.php');
} ?>
