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
    if (!isset($_POST['materia'], $_POST['enunciado'], $_POST['alternativa_a'], $_POST['alternativa_b'], $_POST['alternativa_c'], $_POST['alternativa_d'], $_POST['alternativa_e'], $_POST['alternativa_correta'])) {
        throw new Exception("Por favor, preencha todos os campos.");
    }

    // Obter os dados do formulário
    $materia = $_POST['materia'];
    $enunciado = $_POST['enunciado'];
    $alternativa_a = $_POST['alternativa_a'];
    $alternativa_b = $_POST['alternativa_b'];
    $alternativa_c = $_POST['alternativa_c'];
    $alternativa_d = $_POST['alternativa_d'];
    $alternativa_e = $_POST['alternativa_e'];
    $alternativa_correta = $_POST['alternativa_correta'];

    // Preparar a consulta SQL para inserir a questão no banco de dados
    $stmt = $dbconn->prepare("INSERT INTO questoes (materia, enunciado, alternativa_a, alternativa_b, alternativa_c, alternativa_d, alternativa_e, alternativa_correta) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$materia, $enunciado, $alternativa_a, $alternativa_b, $alternativa_c, $alternativa_d, $alternativa_e, $alternativa_correta]);

    // Redirecionar para página de sucesso após a inserção da questão
    header("Location: quest.html?success=true");
    exit;
} catch (PDOException $e) {
    // Tratamento de erro em caso de falha na conexão ou consulta SQL
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Tratamento de erro em caso de falha na validação dos dados do formulário
    echo "Erro: " . $e->getMessage();
}
?>
