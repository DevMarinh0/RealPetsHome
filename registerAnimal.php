<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $idade = $_POST['idade'];
    $descricao = $_POST['descricao'];
    $genero = $_POST['genero'];
    $foto = $_FILES['foto'];

    // Verifica se o upload da foto foi 
    if ($foto['error'] == UPLOAD_ERR_OK) {
        $nomeFoto = basename($foto['name']);
        $caminhoFoto = 'uploads/' . $nomeFoto;

        // Move o arquivo enviado para o diretório de destino
        if (move_uploaded_file($foto['tmp_name'], $caminhoFoto)) {
            // Insere os dados no banco de dados
            $sql = "INSERT INTO animais (nome, especie, idade, descricao, genero, foto) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $nome, $especie, $idade, $descricao, $genero, $caminhoFoto);

            if ($stmt->execute()) {
                echo "Animal registrado com sucesso!";
            } else {
                echo "Erro ao registrar o animal: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao mover o arquivo da foto.";
        }
    } else {
        echo "Erro no upload da foto.";
    }

    $conn->close();
}
?>
