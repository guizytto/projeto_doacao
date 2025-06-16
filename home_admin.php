<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] !== 'admin' && $_SESSION['usuario_tipo'] !== 'instituicao')) {
    header("Location: tela_de_login.php");
    exit();
}

$total = $conexao->query("SELECT COUNT(*) FROM doacoes")->fetch_row()[0];
$doada = $conexao->query("SELECT COUNT(*) FROM doacoes WHERE status = 'doada'")->fetch_row()[0];
$pendente = $total - $doada;
$agendados = $conexao->query("SELECT COUNT(DISTINCT doacao_id) FROM agendamentos WHERE status = 'pendente'")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Painel do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f0efeb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 1rem;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.15);
        }
        h2 {
            border-bottom: 3px solid #157247;
            padding-bottom: 0.3rem;
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-success {
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            font-size: 1.1rem;
        }
        .table-responsive {
            margin-bottom: 3rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="#">Painel Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item me-3">
                        <span class="nav-link text-light">Olá, <?= htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário') ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <section class="mb-5">
            <h2>DASHBOARD</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card border-success shadow-sm p-3 text-center">
                        <i class="bi bi-box-seam fs-1 text-success mb-2"></i>
                        <h5 class="card-title text-success">Total de Doações</h5>
                        <p class="fs-3 fw-bold"><?= $total ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-primary shadow-sm p-3 text-center">
                        <i class="bi bi-hourglass-split fs-1 text-primary mb-2"></i>
                        <h5 class="card-title text-primary">Doações Pendentes</h5>
                        <p class="fs-3 fw-bold"><?= $pendente ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-secondary shadow-sm p-3 text-center">
                        <i class="bi bi-check-circle fs-1 text-secondary mb-2"></i>
                        <h5 class="card-title text-secondary">Doações Confirmadas</h5>
                        <p class="fs-3 fw-bold"><?= $doada ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-warning shadow-sm p-3 text-center">
                        <i class="bi bi-calendar-check fs-1 text-warning mb-2"></i>
                        <h5 class="card-title text-warning">Doações Agendadas</h5>
                        <p class="fs-3 fw-bold"><?= $agendados ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <h2>Cadastro Manual de Doações</h2>
            <form action="cadastro_doacoes.php" method="POST" class="row g-3 mt-2">
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
                    <input type="text" name="observacao" id="observacao" class="form-control" required placeholder="Descreva a doação" />
                </div>
                <div class="col-md-2">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" name="quantidade" id="quantidade" class="form-control" required min="1" />
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success btn-lg px-4">Cadastrar</button>
                </div>
            </form>
        </section>

        <section class="mb-5">
            <h2>Agendamentos de Doações</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-info">
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Doação</th>
                            <th>Data</th>
                            <th>Horário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'listar_agendamentos.php'; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section>
            <h2>Doações Cadastradas</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Observação</th>
                            <th>Quantidade</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'listar_doacoes.php'; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
