<?php
// listar_agendamentos.php
require_once "conexao.php";

$sql = "
    SELECT 
        a.id, 
        u.nome AS usuario_nome, 
        d.observacao AS doacao_observacao, 
        d.id AS doacao_id,
        a.data_agendamento, 
        a.horario
    FROM agendamentos a
    INNER JOIN usuarios u ON a.usuario_id = u.id
    INNER JOIN doacoes d ON a.doacao_id = d.id
    WHERE d.status <> 'doada'  -- Exclui agendamentos já confirmados
    ORDER BY a.data_agendamento DESC, a.horario DESC
";

$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='text-center'>{$row['id']}</td>";
        echo "<td>" . htmlspecialchars($row['usuario_nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['doacao_observacao']) . "</td>";
        echo "<td class='text-center'>{$row['data_agendamento']}</td>";
        echo "<td class='text-center'>{$row['horario']}</td>";

        // Botão confirmar doação
        echo "<td class='text-center'>";
        echo "<form action='confirmar_doacao.php' method='POST' style='margin:0;'>";
        echo "<input type='hidden' name='doacao_id' value='{$row['doacao_id']}'>";
        echo "<input type='hidden' name='agendamento_id' value='{$row['id']}'>";
        echo "<button type='submit' class='btn btn-success btn-sm' onclick=\"return confirm('Confirmar recebimento desta doação?')\">Confirmar</button>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Nenhum agendamento encontrado.</td></tr>";
}
?>
