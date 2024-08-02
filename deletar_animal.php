<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primeiro, obtenha o nome do arquivo da foto
    $sql = "SELECT foto FROM animais WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $animal = $result->fetch_assoc();
    $foto = $animal['foto'];

    // Exclua o arquivo da foto se existir
    if ($foto) {
        unlink("uploads/" . $foto);
    }

    // Exclua o registro do banco de dados
    $sql = "DELETE FROM animais WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>
