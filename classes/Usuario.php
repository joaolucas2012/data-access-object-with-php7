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

  // Método construtor do Usuário
  public function __construct($login, $password){
    $this->setDesLogin($login);
    $this->setDessenha($password);
  }

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
      $this->setData($resultado[0]);
    }
  }

  // Método para inserir dados a um usuário
  public function setData($data){
    $this->setIdUsuario($data['idusuario']);
    $this->setDesLogin($data['deslogin']);
    $this->setDessenha($data['dessenha']);
    $this->setDtCadastro(new DateTime($data['dtcadastro']));
  }

  // Método para listar todos os usuários do banco de dados
  public static function getListUsuarios(){ 
    // Função estática pode ser chamada assim -> Usuario::getListUsuarios()
    $sql = new Sql();
    return json_encode($sql->select("SELECT * FROM tb_usuarios ORDER BY idusuario"));
  }

  // Método para buscar um usuário específico no banco de dados pelo nome
  public static function searchUserByName($login){
    $sql = new Sql();
    return json_encode($sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY idusuario", array(
      ':SEARCH'=>"%".$login."%"
    )));
  }

  // Método para inserir um novo usuário no banco de dados
  public function insertUser(){
    $sql = new Sql();
    $resultado = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
      ":LOGIN"=>$this->getDesLogin(),
      ":PASSWORD"=>$this->getDessenha()
    ));
    if(count($resultado) > 0){
      $this->setData($resultado[0]);
    }
  }

  // Método para obter os dados do usuário autenticado
  public function login($login, $password){
    $sql = new Sql();
    $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
      ":LOGIN"=>$login,
      ":PASSWORD"=>$password
    ));
    // Validando o resultado
    if(count($resultado) > 0){
      $this->setData($resultado[0]);
      echo "$login conectado com sucesso!";
      // echo json_encode($resultado);
    }else{
      throw new Exception("Login e/ou senha inválidos!");
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