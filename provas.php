<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'projetointegrador';
$username = 'postgres';
$password = 'mgmc';

try {
    $dbconn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para buscar as questões no banco de dados
    $stmt = $dbconn->query("SELECT * FROM questoes ORDER BY RANDOM() LIMIT 10"); // Exemplo: seleciona 10 questões aleatórias
    $questoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro de banco de dados: " . $e->getMessage();
    exit;
}

// HTML da página da prova
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova</title>
</head>
<body>
    <h1>Prova</h1>
    
    <form action="processar_prova.php" method="post">
        <?php foreach ($questoes as $questao): ?>
            <h2><?php echo $questao['enunciado']; ?></h2>
            <label><input type="radio" name="resposta_<?php echo $questao['id']; ?>" value="a"> <?php echo $questao['alternativa_a']; ?></label><br>
            <label><input type="radio" name="resposta_<?php echo $questao['id']; ?>" value="b"> <?php echo $questao['alternativa_b']; ?></label><br>
            <label><input type="radio" name="resposta_<?php echo $questao['id']; ?>" value="c"> <?php echo $questao['alternativa_c']; ?></label><br>
            <label><input type="radio" name="resposta_<?php echo $questao['id']; ?>" value="d"> <?php echo $questao['alternativa_d']; ?></label><br>
            <label><input type="radio" name="resposta_<?php echo $questao['id']; ?>" value="e"> <?php echo $questao['alternativa_e']; ?></label><br><br>
        <?php endforeach; ?>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
