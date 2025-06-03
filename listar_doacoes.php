<?php
require_once "conexao.php";

// Consulta todas as doações
$sql = "SELECT * FROM doacoes";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr class='text-center'>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . htmlspecialchars($row['observacao']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantidade']) . "</td>";
        echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
        echo "<td><a href='https://www.google.com/maps/dir/?api=1&destination=R.%20Araguaia%2C%20589%20-%20Jardim%20Agari%2C%20Londrina%20-%20PR%2C%2086025-720' target='_blank' class='btn btn-success'>Doar</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>Nenhuma doação disponível.</td></tr>";
}

$conexao->close();
?>
