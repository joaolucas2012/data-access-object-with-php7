<?php

// Essa classe extende da classe nativa PDO, então ela herda tudo que o PDO faz
// como o bindParam, execute, prepare, etc
class Sql extends PDO {

  // Variável para a conexão
  private $conn;

  // Método construtor para que a classe se conecte ao banco de dados ao ser instanciada
  public function __construct(){
    // Estabelecer a conexão com o bando de dados
    $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
  }

  
  // Método que faz o bindParam
  private function bindParam($statement, $key, $value){
    $statement->bindParam($key, $value);
  }
  
  // Método para receber os parâmetros e chamar o bindParam
  private function setParams($statement, $parameters = array()){
    foreach($parameters as $key => $value){
      $this->bindParam($statement, $key, $value);
    }
  }

  // Método para executar uma consulta no banco, que recebe a query e os parâmetros
  public function query($rawQuery, $params = array()){
    $stmt = $this->conn->prepare($rawQuery);
    $this->setParams($stmt, $params);
    $stmt->execute();
    return $stmt;
  }

  // Método para o select no banco de dados
  public function select($rawQuery, $params = array()):array
  {
    $stmt = $this->query($rawQuery, $params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

?>