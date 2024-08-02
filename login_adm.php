<?php
// Inicia a sessão do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o email e a senha enviados pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para encontrar um usuário com o email fornecido
    $sql = "SELECT id, nome, email, telefone, endereco, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se um usuário foi encontrado
    if ($result->num_rows > 0) {
        // Obtém os dados do usuário
        $usuario = $result->fetch_assoc();
        
        // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
        if ($senha == $usuario['senha']) {  
            // Inicia a sessão do usuário e armazena informações relevantes
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            
            // Redireciona o usuário para a página de perfil
            header("Location: usuario.php");
            exit();
        } else {
            // Exibe uma mensagem de erro se a senha estiver incorreta
            echo "Senha incorreta!";
        }
    } else {
        // Exibe uma mensagem de erro se o usuário não for encontrado
        echo "Usuário não encontrado!";
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
