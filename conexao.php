<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "sistema_doacoes";

$conexao = new mysqli($host, $usuario, $senha, $banco);

 if ($conexao->connect_error) {
     die("Erro de conexão: " . $conexao->connect_error);
 }
 ?>
