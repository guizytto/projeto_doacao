<?php
require_once "conexao.php";

// Receber dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$telefone = $_POST['telefone'];
$tipo = 'usuario';

// Gerar hash seguro da senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// Verificar se o e-mail já está cadastrado (usando prepared statement)
$stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<script>alert('E-mail já cadastrado. Tente outro.'); window.location.href='tela_de_cadastro.php';</script>";
} else {
    // Inserir novo usuário de forma segura
    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha, telefone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $senhaHash, $telefone);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='tela_de_login.php';</script>";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
}

$stmt->close();
$conexao->close();
?>
