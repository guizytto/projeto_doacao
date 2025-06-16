<?php
session_start();
require_once "conexao.php";

// Verifica se o usuário está logado e tem permissão
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] !== 'admin' && $_SESSION['usuario_tipo'] !== 'instituicao')) {
    header("Location: tela_de_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoria = $_POST['categoria'] ?? '';
    $observacao = $_POST['observacao'] ?? '';
    $quantidade = $_POST['quantidade'] ?? '';

    if (!empty($categoria) && !empty($observacao) && !empty($quantidade)) {
        $stmt = $conexao->prepare("INSERT INTO doacoes (categoria, observacao, quantidade) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $categoria, $observacao, $quantidade);

        if ($stmt->execute()) {
            $_SESSION['mensagem_sucesso'] = "Doação cadastrada com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao cadastrar doação.";
        }
        $stmt->close();
    } else {
        $_SESSION['mensagem_erro'] = "Preencha todos os campos!";
    }
} else {
    $_SESSION['mensagem_erro'] = "Requisição inválida.";
}

header("Location: home_admin.php");
exit();
?>
