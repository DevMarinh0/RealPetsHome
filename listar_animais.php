<?php
include 'conexao.php';

$sql = "SELECT * FROM animais";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['especie']}</td>
                <td>{$row['idade']}</td>
                <td>{$row['descricao']}</td>
                <td>{$row['genero']}</td>
                <td><img src='uploads/{$row['foto']}' alt='Foto' style='width: 100px;'></td>
                <td>{$row['opcao_compra']}</td>
                <td>{$row['preco']}</td>
                <td>
                    <a href='editar_animal.php?id={$row['id']}'>Editar</a> | 
                    <a href='deletar_animal.php?id={$row['id']}'>Deletar</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='10'>Nenhum animal encontrado.</td></tr>";
}

$conn->close();
?>
