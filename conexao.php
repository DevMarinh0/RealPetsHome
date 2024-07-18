<?php
$servername = "localhost";
$username = "root";  // nome de usuario
$password = "";  // senha
$dbname = "sistema_login";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
