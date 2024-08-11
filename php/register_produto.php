<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o método de requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $tipo = $_POST['especie'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $preco = isset($_POST['preco']) ? $_POST['preco'] : null;


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
    $sql = "INSERT INTO animais (nome, tipo, descricao, preco, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiss", $nome, $tipo, $descricao,$preco, $foto);

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
