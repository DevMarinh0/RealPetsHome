<?php
// Iniciamos a sessão para poder usar as variáveis de sessão
session_start();

// Incluímos o arquivo de conexão para podermos acessar o banco de dados
include 'conexao.php';

// Verificamos se o usuário está logado. Se não estiver, redirecionamos ele para a página de login
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona para a página de login, caso o usuário não esteja logado
    header("Location: login.html");
    exit(); // Encerra o script para garantir o redirecionamento
}

// Pegamos o ID do usuário que está logado na sessão
$usuario_id = $_SESSION['usuario_id'];

// Verificamos se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pegamos os dados que o usuário preencheu no formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Criamos a consulta SQL para atualizar os dados do usuário no banco
    $sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, telefone = ?, endereco = ? WHERE id = ?";
    // Preparamos a consulta para evitar SQL injection
    $stmt = $conn->prepare($sql);
    // Ligamos as variáveis aos placeholders na consulta
    $stmt->bind_param("sssssi", $nome, $email, $senha, $telefone, $endereco, $usuario_id);

    // Tentamos executar a consulta e verificamos se deu tudo certo
    if ($stmt->execute()) {
        // Se a atualização foi bem-sucedida, atualizamos as informações do usuário na sessão
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['endereco'] = $endereco;
        // Redirecionamos o usuário para a página de perfil (ou outra página de interesse)
        header("Location: usuario.php");
    } else {
        // Caso haja algum erro, exibimos uma mensagem com o erro
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }

    // Fechamos a declaração e a conexão com o banco para liberar recursos
    $stmt->close();
    $conn->close();
}
?>
