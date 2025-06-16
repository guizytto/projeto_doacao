<?php
include "conexao.php";

$sql = "SELECT * FROM doacoes WHERE status != 'doada' ORDER BY id DESC";
$result = mysqli_query($conexao, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>" . htmlspecialchars($row['observacao']) . "</td>";
    echo "<td>{$row['quantidade']}</td>";
    echo "<td>" . htmlspecialchars($row['categoria']) . "</td>";
    echo "<td class='text-center'>";

    if (isset($exibir_botao_doar) && $exibir_botao_doar === true) {
        $localEntrega = urlencode("R. Araguaia, 589 - Jardim Agari, Londrina - PR, 86025-720");
        echo "<button class='btn btn-success btn-sm' onclick='confirmarDoacao({$row['id']}, \"{$localEntrega}\")'>Doar</button>";
    } else {
        echo "-";
    }

    echo "</td>";
    echo "</tr>";
}
?>
