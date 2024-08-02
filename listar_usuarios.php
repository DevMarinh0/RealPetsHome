<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Executa uma consulta para buscar todos os dados da tabela 'usuarios'
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// Verifica se há resultados na consulta
if ($result->num_rows > 0) {
    // Loop através dos resultados e exibe cada usuário em uma linha da tabela
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td> <!-- Exibe o ID do usuário -->
                <td>{$row['nome']}</td> <!-- Exibe o nome do usuário -->
                <td>{$row['email']}</td> <!-- Exibe o email do usuário -->
                <td>{$row['telefone']}</td> <!-- Exibe o telefone do usuário -->
                <td>{$row['endereco']}</td> <!-- Exibe o endereço do usuário -->
                <td>
                    <a href='editar_usuario.php?id={$row['id']}'>Editar</a> | 
                    <a href='deletar_usuario.php?id={$row['id']}'>Deletar</a>
                </td>
              </tr>";
    }
} else {
    // Mensagem exibida se nenhum usuário for encontrado
    echo "<tr><td colspan='6'>Nenhum usuário encontrado.</td></tr>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
