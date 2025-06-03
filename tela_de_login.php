<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Projeto</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="background-color: #F0EFE7;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #157247;" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">Projeto</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link active" href="tela_de_login.php">Login</a>
                    <a class="nav-link" href="tela_de_cadastro.php">Cadastre-se</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulário de Login -->
    <div class="container py-5">
        <h1 class="fw-bold mb-4">Login</h1>
        <form action="login.php" method="POST" class="row g-3">
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Entrar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
