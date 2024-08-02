<?php
session_start();
include 'conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar na tabela de administradores
    $sql = "SELECT id FROM adms WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Administrador encontrado
        $adm = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $adm['id'];
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = true; // Marca como administrador
        header("Location: admin_dashboard.php"); // Redireciona para o painel de administração
        exit();
    } else {
        // Nenhum administrador encontrado
        header("Location: lost.html");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
