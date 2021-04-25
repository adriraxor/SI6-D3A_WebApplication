var Type , expanded = false;

function show(Type) {
  var hidden = document.getElementById(Type);
  expanded ? (expanded = false) : (hidden.style.display = "block" , expanded = true);
  var nbOrdi = document.getElementById('inputNbOrdinateur').value;
  getHTMLRefProduit(nbOrdi);
}

function getHTMLRefProduit(nbOrdi){
  var last = document.getElementById('AllinputRefProduit');
  while(last.firstChild){
    last.removeChild(last.firstChild);
  }

  for (var i = 0; i < nbOrdi; i++) {
    var html = '<div id="rowRefProduit" class="form-group row"><label for="inputRef" class="col-sm-4 col-form-label">Reférence constructeur</label><div class="col-sm-8"><input class="form-control" id="inputRef" type="text" name="Ordinateur[Ref]['+ i +']" value=""></div></div>';
    last.insertAdjacentHTML('afterbegin', html);
  }
}
