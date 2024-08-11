<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $idade = $_POST['idade'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;
    $opcao_compra = isset($_POST['opcao_compra']) ? $_POST['opcao_compra'] : null;

    // Lida com o upload da foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto']['name'];
        $foto_tmp = $_FILES['foto']['tmp_name'];
        // Define o diretório onde a foto será salva
        $foto_path = "uploads/$foto";
        // Move o arquivo para o diretório de uploads
        move_uploaded_file($foto_tmp, $foto_path);
    } else {
        // Se não houver foto, define uma foto padrão
        $foto = 'default.jpg'; // Coloque o nome da sua foto padrão aqui
    }

    // Prepara a consulta SQL para inserir os dados no banco
    $sql = "INSERT INTO animais (nome, especie, idade, descricao, genero, preco, foto, opcao_compra) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiss", $nome, $especie, $idade, $descricao, $genero, $preco, $foto, $opcao_compra);

    // Executa a consulta
    $stmt->execute();

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
    
    // Redireciona para a página desejada após o registro
    header("Location: ../php/index.php");
    exit();
}
?>
