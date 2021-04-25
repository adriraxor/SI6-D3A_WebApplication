<div class="modal fade" id="ModalAddOrdinateur" tabindex="-1" role="dialog" aria-labelledby="ModalLabelAddOrdinateur" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="FormModal" action="ajouter_ordinateur.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabelAddOrdinateur">Fiche ordinateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="form-group row">
            <label for="inputMarque" class="col-sm-4 col-form-label">Marque</label>
            <div class="col-sm-8">
              <input class="form-control" id="inputMarque" type="text" name="Ordinateur[Marque]" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputRef" class="col-sm-4 col-form-label">Reférence constructeur</label>
            <div class="col-sm-8">
              <input class="form-control" id="inputRef" type="text" name="Ordinateur[Ref][0]" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputProcesseur" class="col-sm-4 col-form-label">Processeur</label>
            <div class="col-sm-8">
              <input class="form-control" id="inputProcesseur" type="text" name="Ordinateur[Processeur]" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputMemoire" class="col-sm-4 col-form-label">Memoire vive</label>
            <div class="col-sm-8">
              <input class="form-control" id="inputMemoire" type="text" name="Ordinateur[Memoire]" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputGPU" class="col-sm-4 col-form-label">Carte graphique</label>
            <div class="col-sm-8">
              <input class="form-control" id="inputGPU" type="text" name="Ordinateur[GPU]" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputSyst" class="col-sm-4 col-form-label">Système d'exploitation</label>
            <div class="col-sm-8">
              <input class="form-control" id="inputSyst" type="text" name="Ordinateur[Systeme]" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputSalle" class="col-sm-2 col-form-label">Salle</label>
            <div class="col-sm-3">
              <select class="form-control" id="inputSalle" name="Ordinateur[Salle]" value="">
                <?php $result = $data->getlesSalles();
                foreach ($result as $value) { ?>
                  <option value="<?= $value['idSalle'] ?>"><?= $value['batimentSalle']." ".$value['idSalle'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <input type="hidden" name="Ordinateur[nombre]" value="1">
          <input type="hidden" id="inputidOrdinateur" name="Ordinateur[idOrdinateur]" value="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary ">Envoyer</button>
      </div>
    </div>
  </form>
  </div>
</div>
