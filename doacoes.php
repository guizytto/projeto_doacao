<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_tipo'] !== 'admin' && $_SESSION['usuario_tipo'] !== 'instituicao')) {
    header("Location: tela_de_login.php");
    exit();
}

$doacoes = $conexao->query("SELECT * FROM doacoes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Doações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#f8f9fa;">
    <div class="container py-4">
        <h2 class="mb-4 text-center text-success">Doações Cadastradas</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Categoria</th>
                        <th>Observação</th>
                        <th>Quantidade</th>
                        <th>Status</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($doacoes->num_rows > 0): ?>
                        <?php while ($d = $doacoes->fetch_assoc()): ?>
                            <tr>
                                <td><?= $d['id'] ?></td>
                                <td><?= htmlspecialchars($d['categoria']) ?></td>
                                <td><?= htmlspecialchars($d['observacao']) ?></td>
                                <td><?= $d['quantidade'] ?></td>
                                <td><?= ucfirst($d['status']) ?></td>
                                <td>
                                    <?php if ($d['status'] !== 'doada'): ?>
                                        <form action="confirmar_doacao.php" method="POST" onsubmit="return confirm('Confirmar esta doação?');">
                                            <input type="hidden" name="doacao_id" value="<?= $d['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-success">Confirmar</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">Confirmada</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Nenhuma doação encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="home_admin.php" class="btn btn-outline-secondary">Voltar ao Painel</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
