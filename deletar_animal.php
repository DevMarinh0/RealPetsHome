<?php
// Incluímos o arquivo de conexão com o banco de dados para poder interagir com ele
include 'conexao.php';

// Verificamos se o ID do animal foi passado na URL
if (isset($_GET['id'])) {
    // Pegamos o ID do animal que está sendo passado na URL
    $id = $_GET['id'];

    // Primeiro, precisamos obter o nome do arquivo da foto do animal
    $sql = "SELECT foto FROM animais WHERE id=?";
    $stmt = $conn->prepare($sql); // Preparamos a consulta SQL para evitar SQL injection
    $stmt->bind_param("i", $id); // Associamos o ID do animal à consulta
    $stmt->execute(); // Executamos a consulta
    $result = $stmt->get_result(); // Obtemos o resultado da consulta
    $animal = $result->fetch_assoc(); // Pegamos a linha de resultado como um array associativo
    $foto = $animal['foto']; // Pegamos o nome do arquivo da foto

    // Verificamos se existe uma foto associada ao animal
    if ($foto) {
        // Se existir, tentamos excluir o arquivo da foto do diretório de uploads
        unlink("uploads/" . $foto);
    }

    // Agora, preparamos a consulta para excluir o registro do animal do banco de dados
    $sql = "DELETE FROM animais WHERE id=?";
    $stmt = $conn->prepare($sql); // Preparamos a consulta SQL
    $stmt->bind_param("i", $id); // Associamos o ID do animal à consulta

    // Tentamos executar a exclusão do registro
    if ($stmt->execute()) {
        // Se a exclusão foi bem-sucedida, redirecionamos o usuário de volta ao painel administrativo
        header("Location: admin_dashboard.php");
        exit(); // Encerra o script para garantir o redirecionamento
    } else {
        // Caso ocorra um erro, exibimos uma mensagem de erro
        echo "Erro: " . $stmt->error;
    }
}
?>
