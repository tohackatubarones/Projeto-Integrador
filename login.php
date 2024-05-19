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
    if (!isset($_POST['username'], $_POST['password'])) {
        throw new Exception("Por favor, preencha todos os campos.");
    }

    // Obter os dados do formulário de login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar a consulta SQL para autenticar o usuário
    $stmt = $dbconn->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);

    // Verificar se o usuário foi autenticado com sucesso
    if ($stmt->rowCount() > 0) {
        // Usuário autenticado, redirecionar para página de perfil com o nome de usuário como parâmetro
        header("Location: perfil.html?username=" . urlencode($username));
        exit;
    } else {
        // Usuário não autenticado, redirecionar para página de erro
        header("Location: erro.php");
        exit;
    }
} catch (PDOException $e) {
    // Tratamento de erro em caso de falha na conexão ou consulta SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratamento de erro em caso de falha na validação dos dados do formulário
    echo "Erro: " . $e->getMessage();
}
?>
