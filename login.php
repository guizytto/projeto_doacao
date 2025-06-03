<?php
require_once "conexao.php";
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

// Previne SQL Injection
$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        $_SESSION['usuario_tipo'] = $usuario['tipo'];

        // Redirecionamento com base no tipo
        if ($usuario['tipo'] === 'admin') {
            echo "<script>alert('Login como ADMIN realizado com sucesso!'); window.location.href='home_admin.php';</script>";
        } elseif ($usuario['tipo'] === 'instituicao') {
            echo "<script>alert('Login como INSTITUIÇÃO realizado com sucesso!'); window.location.href='home_admin.php';</script>";
        } else {
            echo "<script>alert('Login realizado com sucesso!'); window.location.href='index2.php';</script>";
        }

    } else {
        echo "<script>alert('Senha incorreta.'); window.location.href='tela_de_login.php';</script>";
    }
} else {
    echo "<script>alert('E-mail não encontrado.'); window.location.href='tela_de_login.php';</script>";
}

$stmt->close();
$conexao->close();
?>
