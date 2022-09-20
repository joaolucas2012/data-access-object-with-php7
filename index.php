<?php

// Requer todas as classes que forem necessárias
require_once("config.php");

// Cria uma instância da classe Sql
$sql = new Sql();
// Executa uma quey no banco de dados apenas com o método select da instância
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

// Exibe os dados retornados do banco de dados em json
echo json_encode($usuarios);

?>