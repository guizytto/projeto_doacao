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
                        <a class="nav-link active" href="index2.php">Home</a>
                        <a class="nav-link" href="doacoes.php">Doações</a>
                        <a class="nav-link" href="logout.php">Sair</a>
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
                                <h1 class="display-5 fw-bold">Bem-vindo ao site Doação pra Vovó!</h1>
                                <p class="col-md-10 fs-4">
                                    Vamos doar? Clique no botão abaixo para ser direcionado à tela de doação.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ms-5 me-5">
                    <div class="col-12 d-grid gap-2 text-center">
                        <button class="btn btn-lg btn-success"
                            onclick="window.location.href='doacoes.php'">Realizar Doação</button>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" class="btn btn-outline-success"
                            onclick="window.location.href='saiba_mais.html'">Clique aqui e saiba mais sobre nosso projeto</button>
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
