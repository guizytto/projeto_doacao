<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: tela_de_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #F0EFE7;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #157247;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">Projeto</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <a class="nav-link" href="index2.php">Home</a>
                    <a class="nav-link active" href="doacoes.php">Doações</a>
                    <a class="nav-link" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <h2 class="fw-bold mb-4">Lista de Doações</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>#</th>
                        <th>Observação</th>
                        <th>Quantidade</th>
                        <th>Categoria</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include "listar_doacoes.php"; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
