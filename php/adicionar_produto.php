

<?php
// Habilitar o relato de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir o script de conexão
include 'conexao.php'; // Ajuste o caminho conforme necessário

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $foto = $_FILES['foto']['name'];

    $target_dir = "../uploadsPatrocinador/";
    $target_file = $target_dir . basename($foto);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        $sql = 'INSERT INTO produtosPatrocinadores (nome, preco, descricao, foto) VALUES (?, ?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sdds', $nome, $preco, $descricao, $foto);
        
        if ($stmt->execute()) {
            header("Location: produto.php");
            exit();
        } else {
            echo 'Erro ao adicionar produto: ' . $stmt->error;
        }
    } else {
        echo 'Erro ao enviar a imagem.';
    }
} else {
    header("Location: adicionar_produto.php");
    exit();
}

$conn->close();
?>