<?php

$servername = "localhost"; // Altere conforme necessário
$username = "seu_usuario"; // Altere conforme necessário
$password = "sua_senha"; // Altere conforme necessário

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Cria o banco de dados
$sql = "CREATE DATABASE IF NOT EXISTS projeto_integrador";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso";
} else {
    echo "Erro ao criar banco de dados: " . $conn->error;
}

$conn->close();
?>
