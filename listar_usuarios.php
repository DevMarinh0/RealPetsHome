<?php
include 'conexao.php';

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telefone']}</td>
                <td>{$row['endereco']}</td>
                <td>
                    <a href='editar_usuario.php?id={$row['id']}'>Editar</a> | 
                    <a href='deletar_usuario.php?id={$row['id']}'>Deletar</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>Nenhum usuário encontrado.</td></tr>";
}

$conn->close();
?>
    