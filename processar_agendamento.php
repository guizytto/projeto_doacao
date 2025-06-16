<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: tela_de_login.php");
    exit();
}

// Dados do formulário
$doacao_id = $_POST['doacao_id'];
$categoria = $_POST['categoria'];
$observacao = $_POST['observacao'];
$quantidade = $_POST['quantidade'];
$data_agendamento = $_POST['data_agendamento'];
$horario = $_POST['horario'];
$usuario_id = $_SESSION['usuario_id'];

// Se nenhuma doação existente foi selecionada, criamos uma nova
if (empty($doacao_id)) {
    if (empty($categoria) || empty($observacao) || empty($quantidade)) {
        echo "<script>alert('Preencha os campos da nova doação.'); window.history.back();</script>";
        exit();
    }

    $stmt = $conexao->prepare("INSERT INTO doacoes (observacao, quantidade, categoria, status) VALUES (?, ?, ?, 'pendente')");
    $stmt->bind_param("sss", $observacao, $quantidade, $categoria);
    
    if ($stmt->execute()) {
        $doacao_id = $stmt->insert_id; // pegamos o ID da nova doação
    } else {
        echo "<script>alert('Erro ao cadastrar nova doação.'); window.history.back();</script>";
        exit();
    }
    $stmt->close();
}

// Agora cadastramos o agendamento
$stmt = $conexao->prepare("INSERT INTO agendamentos (usuario_id, doacao_id, data_agendamento, horario) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $usuario_id, $doacao_id, $data_agendamento, $horario);

if ($stmt->execute()) {
    // Redireciona para página que abrirá o mapa
    header("Location: abrir_mapa.php?sucesso=1");
    exit();
} else {
    echo "<script>alert('Erro ao agendar doação.'); window.history.back();</script>";
}


$stmt->close();
$conexao->close();