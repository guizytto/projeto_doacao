<?php
require_once "conexao.php";

// INFORMAÇÕES A SEREM PERSONALIZADAS
$nome = "Guilherme";
$email = "guilherme@admin.com";
$telefone = "(43) 99999-8888";
$senha_plana = "123";
$tipo = "admin"; // "instituicao ou admin"

// CRIPTOGRAFAR A SENHA
$senha_hash = password_hash($senha_plana, PASSWORD_DEFAULT);

$stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, telefone, senha, tipo) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome, $email, $telefone, $senha_hash, $tipo);

if ($stmt->execute()) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
