<?php
// Inicia a sessão do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o email e a senha fornecidos pelo administrador
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta para verificar se o administrador com o email e senha fornecidos existe
    $sql = "SELECT id FROM adms WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se um administrador com as credenciais fornecidas foi encontrado
    if ($result->num_rows > 0) {
        // Administrador encontrado
        $adm = $result->fetch_assoc();
        // Armazena o ID e o email do administrador na sessão e marca como administrador
        $_SESSION['usuario_id'] = $adm['id'];
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = true; // Marca como administrador
        
        // Redireciona para o painel de administração
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Nenhum administrador encontrado com as credenciais fornecidas
        header("Location: lost.html");
        exit();
    }

    // Fecha a declaração SQL e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
