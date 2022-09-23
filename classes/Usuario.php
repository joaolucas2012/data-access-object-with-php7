<?php

class Usuario{
  // Atributos
  private $idusuario;
  private $deslogin;
  private $dessenha;
  private $dtcadastro;

  // Getters
  public function getIdusuario(){
    return $this->idusuario;
  }
  public function getDeslogin(){
    return $this->deslogin;
  }
  public function getDessenha(){
    return $this->dessenha;
  }
  public function getDtCadastro(){
    return $this->dtcadastro;
  }

  // Setters
  public function setIdUsuario($value){
    $this->idusuario = $value;
  }
  public function setDesLogin($value){
    $this->deslogin = $value;
  }
  public function setDessenha($password){
    $this->dessenha = $password;
  }
  public function setDtCadastro($date){
    $this->dtcadastro = $date;
  }

  // Métodos //

  // Método para retornar usuário pelo Id //
  public function loadById($id){
    // Fazer a conexão com o Banco de dados
    $sql = new Sql();

    // Consultar o banco
    $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
      ":ID"=>$id
    ));

    // Validando o resultado
    if(count($resultado) > 0){
      $row = $resultado[0];
      $this->setIdUsuario($row['idusuario']);
      $this->setDesLogin($row['deslogin']);
      $this->setDessenha($row['dessenha']);
      $this->setDtCadastro(new DateTime($row['dtcadastro']));
    }
  }

  // Método para rertornar um json //
  public function __toString(){
    return json_encode(array(
      "idusuario"=>$this->getIdusuario(),
      "deslogin"=>$this->getDeslogin(),
      "dessenha"=>$this->getDessenha(),
      "dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
    ));
  }
}

?>