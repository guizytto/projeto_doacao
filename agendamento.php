<?php
session_start();
require_once "conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: tela_de_login.php");
    exit();
}

// Busca as doações cadastradas (caso queira selecionar uma existente)
$doacoes = $conexao->query("SELECT id, categoria, observacao FROM doacoes WHERE status = 'pendente'");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendar Doação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #F0EFE7;">

            <!-- Navbar -->
        <nav class="navbar navbar-expand-lg" style="background-color: #157247;" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand">Projeto</a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" href="index2.php">Home</a>
                        <a class="nav-link" href="doacoes.php">Doações</a>
                        <a class="nav-link" href="logout.php">Sair</a>
                    </div>
                </div>
            </div>
        </nav>

    <div class="container mt-5">

        <h2 class="fw-bold mb-4">Agendamento de Doações</h2>

        <form action="processar_agendamento.php" method="POST" class="row g-3">

            <div class="col-md-12">
                <label class="form-label">Selecionar Doação Existente*</label>
                <select name="doacao_id" class="form-select">
                    <option value="">-</option>
                    <?php while($d = $doacoes->fetch_assoc()): ?>
                        <option value="<?= $d['id'] ?>">
                            <?= htmlspecialchars($d['categoria']) ?> - <?= htmlspecialchars($d['observacao']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>


            <div class="col-md-4">
                <label class="form-label">Categoria</label>
                <select name="categoria" class="form-select">
                    <option value="">-- Selecione --</option>
                    <option value="Roupas">Roupas</option>
                    <option value="Fraldas">Fraldas</option>
                    <option value="Medicamentos">Medicamentos</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Descrição da nova doação</label>
                <input type="text" name="observacao" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Data do Agendamento*</label>
                <input type="date" name="data_agendamento" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Horário*</label>
                <input type="time" name="horario" class="form-control" required>
            </div>

            <p>*Preenchimento obrigatório</p>

            <div class="col-12">
                <button type="submit" class="btn btn-success">Agendar Doação</button>
            </div>
        </form>
    </div>
</body>
</html>
