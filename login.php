<?php
// Inicia a sessão do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o email e a senha fornecidos pelo usuário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta para encontrar o usuário com o email fornecido
    $sql = "SELECT id, nome, email, telefone, endereco, senha FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário com o email fornecido foi encontrado
    if ($result->num_rows > 0) {
        // Obtém os dados do usuário encontrado
        $usuario = $result->fetch_assoc();
        
        // Verifica se a senha fornecida corresponde à senha armazenada
        if ($senha == $usuario['senha']) { // A senha precisa estar correta
            // Armazena as informações do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['telefone'] = $usuario['telefone'];
            $_SESSION['endereco'] = $usuario['endereco'];
            
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

    // Fecha a declaração SQL e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
