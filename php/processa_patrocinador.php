<?php
// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário, garantindo que não haja erros
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $localizacao = isset($_POST['localizacao']) ? $_POST['localizacao'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Prepara a consulta para inserir ou atualizar o patrocinador
    $sql = "INSERT INTO patrocinadores (nome, email, telefone, localizacao)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            nome = VALUES(nome), telefone = VALUES(telefone), localizacao = VALUES(localizacao)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $nome, $email, $telefone, $localizacao);

        if ($stmt->execute()) {
            // Redireciona após a execução bem-sucedida
            header("Location: ../php/patrocinador.php");
            exit(); // Certifica-se de que o script não continua após o redirecionamento
        } else {
            echo "Erro ao atualizar dados: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
}
?>
