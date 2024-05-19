<?php
// Parâmetros de conexão com o banco de dados PostgreSQL
$host = 'localhost';
$dbname = 'projetointegrador';
$username = 'postgres'; // Insira o nome de usuário do seu banco de dados PostgreSQL
$password = 'mgmc';   // Insira a senha do seu banco de dados PostgreSQL

try {
    // Conexão com o banco de dados PostgreSQL usando PDO
    $dbconn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se os dados do formulário foram recebidos corretamente
    if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
        throw new Exception("Por favor, preencha todos os campos.");
    }

    // Obter os dados do formulário de inscrição
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Verificar se os campos obrigatórios não estão vazios
    if (empty($username) || empty($password) || empty($email)) {
        throw new Exception("Por favor, preencha todos os campos obrigatórios.");
    }

    // Preparar a consulta SQL para inserir um novo usuário
    $stmt = $dbconn->prepare("INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)");

    // Executar a consulta SQL
    $stmt->execute([$username, $password, $email]);

    // Redirecionar para página de sucesso após a inscrição
    header("Location: sucesso.php");
} catch (PDOException $e) {
    // Tratamento de erro em caso de falha na conexão ou consulta SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratamento de erro em caso de falha na validação dos dados do formulário
    echo "Erro: " . $e->getMessage();
}
?>
