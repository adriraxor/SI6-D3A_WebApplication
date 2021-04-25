<?php
require('Class/Data.class.php');
$data = new Data();

settype($_POST['Ordinateur']['idOrdinateur'], 'int');
settype($_POST['Ordinateur']['Salle'], 'int');
settype($_POST['Ordinateur']['nombre'], 'int');

var_dump($_POST);

$id = $_POST['Ordinateur']['idOrdinateur'];

  if($id == 0){
    $verif_ajout = false;
    unset($_POST['Ordinateur']['idOrdinateur']);
    foreach ($_POST['Ordinateur'] as $firstValue) {
      if (is_array($firstValue)) {
        foreach ($firstValue as $secondValue) {
          if (empty($secondValue)) {
            $verif_ajout = true;
            echo "string1";
          }
        }
      }elseif(empty($firstValue)){
        $verif_ajout = true;
        echo "string";
      }
    }
  }else {
    $verif_ajout = true;
  }
  if($verif_ajout == false){
    $data->AjouterOrdinateur($_POST['Ordinateur']);
  }


  if($id != 0){
    $verif_edit = false;
    unset($_POST['Ordinateur']['idOrdinateur']);
    foreach ($_POST['Ordinateur'] as $firstValue) {
      if (is_array($firstValue)) {
        foreach ($firstValue as $secondValue) {
          if (empty($secondValue)) {
            $verif_edit = true;
          }
        }
      }elseif(empty($firstValue)){
        $verif_edit = true;
      }
    }
  }else {
    $verif_edit = true;
  }
  if($verif_edit == false){
    $data->editerUnOrdinateur($id , $_POST['Ordinateur']);
  }

header('Location: Application_Web.php');

?>
