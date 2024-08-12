<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome_do_produto = $_POST['nome_do_produto'];
    $descricao_do_produto = $_POST['descricao_do_produto'];
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;

    // Lida com o upload da foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        
        // Validação básica do tipo de arquivo
        $valid_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['foto']['type'], $valid_types)) {
            $foto_unique = uniqid() . '-' . basename($foto);
            $foto_path = "uploads/$foto_unique";

            // Move o arquivo para o diretório de uploads
            if (!move_uploaded_file($foto_tmp, $foto_path)) {
                die('Erro ao mover o arquivo para o diretório de uploads.');
            }
        } else {
            die('Tipo de arquivo não permitido.');
        }
    } else {
        // Se não houver foto, define uma foto padrão
        $foto_unique = 'default.jpg'; // Coloque o nome da sua foto padrão aqui
    }

    // Prepara a consulta SQL para inserir os dados no banco
    $sql = "INSERT INTO produtosPatrocinadores (nome_do_produto, descricao_do_produto, preco, foto) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Erro na preparação da consulta SQL: ' . $conn->error);
    }

    // Vincula os parâmetros à consulta
    $stmt->bind_param("ssss", $nome_do_produto, $descricao_do_produto, $preco, $foto);

    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta SQL: ' . $stmt->error);
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    
    // Redireciona para a página desejada após o registro
    header("Location: ../php/index.php");
    exit();
}
?>
