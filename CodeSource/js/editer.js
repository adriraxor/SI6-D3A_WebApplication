//Quand on a pas d'idée de nom
var idOrdinateur;


function MyFunction(idOrdinateur){

  document.getElementById('editbtn').value = idOrdinateur;

  getUnOrdinateur(idOrdinateur);


}

function getUnOrdinateur(idOrdinateur){

var xhr = new XMLHttpRequest();


  var value1 = encodeURIComponent(idOrdinateur);
  xhr.open('GET', 'editer_ajax.php?idOrdinateur='+value1);


xhr.onreadystatechange = function() {
if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
  var objOrdinateur = JSON.parse(xhr.responseText);

  document.getElementById('inputMarque').value = objOrdinateur.Marque;
  document.getElementById('inputRef').value = objOrdinateur.Refproduitconstructeur;
  document.getElementById('inputProcesseur').value = objOrdinateur.processeur;
  document.getElementById('inputMemoire').value = objOrdinateur.carte_graphique;
  document.getElementById('inputGPU').value = objOrdinateur.memoire_vive;
  document.getElementById('inputSyst').value = objOrdinateur.systeme_exploitation;
  document.getElementById('inputSalle').value = objOrdinateur.idSalle;
}
};

xhr.send(null);
}
