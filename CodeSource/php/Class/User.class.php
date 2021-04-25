<?php
/**
 *
 */
class User
{
  const HOST = '127.0.0.1';
  const DBNAME = 'application_web';
  const PORT = '3306';
  const LOGIN = 'root';
  const MDP = '';

  private $_id;
  private $_pseudo;
  private $_password;
  private $_email;
  private $_statut;

  function __construct($pseudo)
  {
    $cnx = new PDO('mysql:host='. self::HOST.';dbname='. self::DBNAME.';port='.self::PORT.';charset=utf8', self::LOGIN, self::MDP);
    $req = 'SELECT * FROM d3a_user WHERE pseudo = :pseudo';
    $result = $cnx->prepare($req);
    $result->execute([':pseudo'=>$pseudo]);
    $result = $result->fetchAll();
    settype($result[0]['id'] ,'int');
    settype($result[0]['statut'] ,'int');
    $this->_id = $result[0]['id'];
    $this->_pseudo = $result[0]['pseudo'];
    $this->_password = $result[0]['password'];
    $this->_email = $result[0]['email'];
    $this->_statut = $result[0]['statut'];
  }

  public function getId(){
    return $this->_id;
  }
  public function getPseudo(){
    return $this->_pseudo;
  }
  public function getPassword(){
    return $this->_password;
  }
  public function getEmail(){
    return $this->_email;
  }
  public function getStatut(){
    return $this->_statut;
  }
}

 ?>
