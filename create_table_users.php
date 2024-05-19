<?php

$servername = "localhost"; // Altere conforme necessário
$username = "seu_usuario"; // Altere conforme necessário
$password = "sua_senha"; // Altere conforme necessário
$dbname = "projeto_integrador"; // Altere conforme necessário

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Cria a tabela de usuários
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela de usuários criada com sucesso";
} else {
    echo "Erro ao criar tabela de usuários: " . $conn->error;
}

$conn->close();
?>
