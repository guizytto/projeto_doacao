<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] !== 'admin' && $_SESSION['usuario_tipo'] !== 'instituicao')) {
    header("Location: tela_de_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['doacao_id'])) {
    $doacao_id = intval($_POST['doacao_id']);

    $stmt = $conexao->prepare("UPDATE doacoes SET status = 'doada' WHERE id = ?");
    $stmt->bind_param("i", $doacao_id);
    $stmt->execute();

    $_SESSION['msg_sucesso'] = "Doação confirmada com sucesso!";

    header("Location: doacoes.php");
    exit();
} else {
    header("Location: doacoes.php");
    exit();
}
