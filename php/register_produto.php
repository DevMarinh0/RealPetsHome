<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;

    // Lida com o upload da foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        // Define o diretório onde a foto será salva
        $foto_path = "../uploads/$foto";
        // Move o arquivo para o diretório de uploads
        if (!move_uploaded_file($foto_tmp, $foto_path)) {
            die('Erro ao mover o arquivo para o diretório de uploads.');
        }
    } else {
        // Se não houver foto, define uma foto padrão
        $foto = 'produto.jpg'; // Coloque o nome da sua foto padrão aqui
    }

    // Prepara a consulta SQL para inserir os dados no banco
    $sql = "INSERT INTO produtospatrocinadores (nome, descricao, preco, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Erro na preparação da consulta SQL: ' . $conn->error);
    }

    // Vincula os parâmetros à consulta
    $stmt->bind_param("ssds", $nome, $descricao, $preco, $foto);

    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta SQL: ' . $stmt->error);
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    
    // Redireciona para a página desejada após o registro
    header("Location: ../php/patrocinador.php");
    exit();
}
?>
