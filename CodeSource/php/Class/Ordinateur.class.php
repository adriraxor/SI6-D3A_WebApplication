<?php /**
 *
 */
class Ordinateur
{
  private $_idOrdinateur;
  private $_marque;
  private $_refProduitConstructeur;
  private $_processeur;
  private $_memoireVive;
  private $_carteGraphique;
  private $_systemeExploitation;

  function __construct()
  {
  }

  public function getidOrdinateur(){
    return $this->_idOrdinateur;
  }
  public function getmarque(){
    return $this->_marque;
  }
  public function getRefProduit(){
    return $this->_refProduitConstructeur;
  }
  public function getProcesseur(){
    return $this->_processeur;
  }
  public function getMemoireVi(){
    return $this->_memoireVive;
  }
  public function getCarteGraphique(){
    return $this->$_carteGraphique;
  }
  public function getSystExploit(){
    return $this->$_systemeExploitation;
  }
}
 ?>
