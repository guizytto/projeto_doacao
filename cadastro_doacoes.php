<?php
session_start();
require_once "conexao.php";

// Verifica se o usuário está logado e se é admin ou instituição
if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] !== 'admin' && $_SESSION['usuario_tipo'] !== 'instituicao')) {
    header("Location: tela_de_login.php");
    exit();
}

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $categoria = $_POST['categoria'];
    $observacao = $_POST['observacao'];
    $quantidade = $_POST['quantidade'];
    $local_entrega = $_POST['local_entrega'];

    // Validação simples
    if (!empty($categoria) && !empty($observacao) && !empty($quantidade)) {
        $stmt = $conexao->prepare("INSERT INTO doacoes (categoria, observacao, quantidade, local_entrega) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $categoria, $observacao, $quantidade, $local_entrega);
        if ($stmt->execute()) {
            $mensagem = "Doação cadastrada com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar doação.";
        }
        $stmt->close();
    } else {
        $mensagem = "Preencha todos os campos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #F0EFE7;">
    <nav class="navbar navbar-expand-lg" style="background-color: #157247;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">Admin</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <a class="nav-link active">Painel</a>
                    <a class="nav-link" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="fw-bold">Cadastro de Doações</h1>

        <?php if (isset($mensagem)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <form action="cadastro_doacoes.php" method="POST" class="row g-3">
            <div class="col-md-4">
                <label for="categoria" class="form-label">Categoria</label>
                <select name="categoria" id="categoria" class="form-select" required>
                    <option value="Roupas">Roupas</option>
                    <option value="Fraldas">Fraldas</option>
                    <option value="Medicamentos">Medicamentos</option>
                    <option value="Outros">Outros</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="observacao" class="form-label">Observação</label>
                <input type="text" name="observacao" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" required>
            </div>

            <input type="hidden" name="local_entrega" value="R. Araguaia, 589 - Jardim Agari, Londrina - PR">

            <div class="col-12">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>

        <hr class="my-5">
        <h2 class="fw-bold">Doações Cadastradas</h2>

        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success text-center">
                <tr>
                    <th>ID</th>
                    <th>Observação</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'listar_doacoes.php'; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
