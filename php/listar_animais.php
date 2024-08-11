<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Executa uma consulta para buscar todos os dados da tabela 'animais'
$sql = "SELECT * FROM animais";
$result = $conn->query($sql);

// Verifica se há resultados na consulta
if ($result->num_rows > 0) {
    // Loop através dos resultados e exibe cada animal em uma linha da tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td> 
                <td>{$row['nome']}</td> 
                <td>{$row['especie']}</td> 
                <td>{$row['idade']}</td> 
                <td>{$row['descricao']}</td> 
                <td>{$row['genero']}</td> 
                <td><img src='uploads/{$row['foto']}' alt='Foto' style='width: 100px;'></td> <!-- Exibe a foto do animal com largura de 100px -->
                <td>{$row['opcao_compra']}</td> 
                <td>{$row['preco']}</td> 
                <td>
                    <a href='editar_animal.php?id={$row['id']}'>Editar</a> | 
                    <a href='deletar_animal.php?id={$row['id']}'>Deletar</a>
                </td>
              </tr>";
    }
} else {
    // Mensagem exibida se nenhum animal for encontrado
    echo "<tr><td colspan='10'>Nenhum animal encontrado.</td></tr>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
