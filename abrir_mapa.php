<?php
session_start();

// Verifica se está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: tela_de_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Redirecionando...</title>
  <script>
    window.onload = function () {
      alert("Agendamento realizado com sucesso!");

      // Abrir o Maps em nova aba
      window.open("https://www.google.com/maps/dir/?api=1&destination=R.+Araguaia,+589+-+Jardim+Agari,+Londrina+-+PR,+86025-720", "_blank");

      // Redirecionar para a home do usuário
      setTimeout(function () {
        window.location.href = "index2.php";
      }, 500);
    };
  </script>
</head>
<body style="background-color: #F0EFE7; display: flex; justify-content: center; align-items: center; height: 100vh;">
  <h3>Redirecionando...</h3>
</body>
</html>
