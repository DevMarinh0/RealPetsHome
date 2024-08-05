<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $idade = $_POST['idade'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $opcao = isset($_POST['opcao']) ? $_POST['opcao'] : null; // Captura o valor de 'opcao' ou define como null
    $preco = isset($_POST['preco']) && $_POST['preco'] !== '' ? $_POST['preco'] : null; // Usa null se o preço não for definido


    // Trata o upload da imagem
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);

    // Verifica se o upload do arquivo foi bem-sucedido
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Prepara a consulta SQL para inserção
        $sql = "INSERT INTO animais (nome, especie, idade, descricao, genero, foto, opcao_compra, preco) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt) {
            $stmt->bind_param("ssisssis", $nome, $especie, $idade, $descricao, $genero, $foto, $opcao, $preco);

            // Executa a consulta
            if ($stmt->execute()) {
                echo "Novo registro criado com sucesso";
                header("Location: index.php");
                exit();
            } else {
                echo "Erro ao executar a consulta: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        echo "Erro ao mover o arquivo da foto.";
    }

    $conn->close();
}
?>
