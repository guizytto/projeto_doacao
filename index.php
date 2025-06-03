<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doação - Projeto</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body style="background-color: #F0EFE7;">
    <div class="pagina">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg" style="background-color: #157247;" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand">Projeto</a>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        <?php if (isset($_SESSION['usuario_id'])): ?>
                            <a class="nav-link" href="logout.php">Sair</a>
                        <?php else: ?>
                            <a class="nav-link" href="tela_de_login.php">Login</a>
                            <a class="nav-link" href="tela_de_cadastro.php">Cadastre-se</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Conteúdo principal -->
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="p-5">
                            <div class="container-fluid">
                                <h1 class="display-5 fw-bold">Bem vindo ao site Doação pra Vovó!</h1>
                                <p class="col-md-10 fs-4">
                                    Realize seu Cadastro ou faça seu Login para Doar para o Lar dos Vovôs e das Vovozinhas
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ms-5 me-5">
                    <div class="col-6 d-grid gap-2">
                        <a href="tela_de_cadastro.php" class="btn btn-success">Cadastre-se</a>
                    </div>
                    <div class="col-6 d-grid gap-2">
                        <a href="tela_de_login.php" class="btn btn-success">Login</a>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12 mt-2 text-center">
                        <a href="saiba_mais.html" class="btn btn-outline-success">Clique aqui e saiba mais sobre nosso projeto</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
