<?php

// Requer todas as classes que forem necessárias
require_once("config.php");

/* 
// TESTE INICIAL //
// Cria uma instância da classe Sql
$sql = new Sql();
// Executa uma query no banco de dados apenas com o método select da instância
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

// Exibe os dados retornados do banco de dados em json
echo json_encode($usuarios);
*/

// TESTE DE CONSULTA DE USUÁRIO PELO ID //
// $user = new Usuario();
// $user->loadById(2);
// echo $user;

// TESTE DE CONSULTA DE TODOS OS USUÁRIOS
// $user = new Usuario();
// $resultado = Usuario::getListUsuarios();
// echo $resultado;

// TESTE DE CONSULTA DE UM USUÁRIO PELO NOME DE LOGIN
// $user = new Usuario();
// $resultado = Usuario::searchUserByName('josefina');
// echo $resultado;

// TESTE DE LOGIN DE USUÁRIO
$user = new Usuario();
$user->login('josefina', 'kjwsgdjhsgdjs');
$user->login('james', 'kjwsgdjhsgdjs');

?>