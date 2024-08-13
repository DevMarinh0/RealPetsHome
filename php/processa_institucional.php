<?php
// Inicia a sessão do usuário
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se os campos 'email' e 'senha' foram preenchidos
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        // Obtém os dados fornecidos pelo usuário no formulário
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Prepara a consulta SQL para buscar o usuário com o email fornecido
        $sql = "SELECT * FROM institucional WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Faz o binding do parâmetro
            $stmt->bind_param("s", $email);

            // Executa a consulta SQL
            $stmt->execute();
            $result = $stmt->get_result();

            // Verifica se um usuário foi encontrado
            if ($result->num_rows === 1) {
                // Obtém os dados do usuário
                $usuario = $result->fetch_assoc();

                // Verifica se a senha fornecida corresponde à senha armazenada (supondo que a senha esteja armazenada em texto simples.)
                if ($usuario['senha'] === $senha) {
                    // Armazena os dados do usuário na sessão
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['telefone'] = $usuario['telefone'];
                    $_SESSION['endereco'] = $usuario['endereco'];

                    // Redireciona para a página Patrocinador
                    header("Location: ../php/patrocinador.php");
                    exit();
                } else {
                    // Senha incorreta
                    echo "Senha incorreta.";
                }
            } else {
                // Usuário não encontrado
                echo "Email não encontrado.";
            }

            // Fecha a declaração SQL
            $stmt->close();
        } else {
            // Se houve um erro ao preparar a consulta
            echo "Erro ao preparar a consulta: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Se algum campo obrigatório não foi preenchido
        echo "Todos os campos são obrigatórios.";
    }
} else {
    // Se o formulário não foi enviado via POST
    echo "Método de requisição inválido.";
}
?>
