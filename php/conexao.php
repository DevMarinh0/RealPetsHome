<?php
$servername = "localhost";
$username = "root";  // nome de usuario
$password = "";  // senha
$dbname = "sistema_cadastro";

// criando conexãox
$conn = new mysqli($servername, $username, $password, $dbname);

// verificando conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>