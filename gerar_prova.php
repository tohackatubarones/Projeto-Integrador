<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'projetointegrador';
$username = 'postgres';
$password = 'mgmc';

try {
    $dbconn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se os dados do formulário foram recebidos
    if (!isset($_POST['materia'], $_POST['numero_questoes'])) {
        throw new Exception("Por favor, preencha todos os campos.");
    }

    // Parâmetros do formulário
    $materia = $_POST['materia'];
    $numero_questoes = $_POST['numero_questoes'];

    // Gerar link aleatório para acesso à prova
    $link_acesso = 'https://seusite.com/prova.php?token=' . uniqid();

    // Salvar detalhes da prova no banco de dados
    // (Você precisará de uma tabela no banco de dados para armazenar os detalhes da prova)
    $stmtProva = $dbconn->prepare("INSERT INTO provas (materia, numero_questoes, link_acesso) VALUES (?, ?, ?)");
    $stmtProva->execute([$materia, $numero_questoes, $link_acesso]);

    // Consulta para buscar as questões no banco de dados
    $stmt = $dbconn->query("SELECT * FROM questoes ORDER BY RANDOM() LIMIT $numero_questoes");
    $questoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Gerar PDF da prova
    require_once('C:\tcpdf\tcpdf.php');

    // Função para gerar o PDF da prova
    function gerarPDFProva($questoes) {
        // Criar nova instância do TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Definir informações do documento
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Prova');
        $pdf->SetHeaderData('', 0, 'Prova', '');

        // Adicionar nova página
        $pdf->AddPage();

        // Loop através das questões e adicionar ao PDF
        foreach ($questoes as $questao) {
            $pdf->SetFont('helvetica', '', 12);
            $pdf->MultiCell(0, 10, $questao['enunciado'], 0, 'L');
            $pdf->MultiCell(0, 10, 'A) ' . $questao['alternativa_a'], 0, 'L');
            $pdf->MultiCell(0, 10, 'B) ' . $questao['alternativa_b'], 0, 'L');
            $pdf->MultiCell(0, 10, 'C) ' . $questao['alternativa_c'], 0, 'L');
            $pdf->MultiCell(0, 10, 'D) ' . $questao['alternativa_d'], 0, 'L');
            $pdf->MultiCell(0, 10, 'E) ' . $questao['alternativa_e'], 0, 'L');
            $pdf->MultiCell(0, 10, 'Gabarito: ' . $questao['alternativa_correta'], 0, 'L');
            $pdf->Ln();
        }

        // Output do PDF
        $pdf->Output('prova.pdf', 'D');
    }

    // Chamar a função para gerar o PDF da prova
    gerarPDFProva($questoes);

    // Exibir o link de acesso à prova
    echo "<p>Link de acesso à prova: <a href='$link_acesso'>$link_acesso</a></p>";

} catch (PDOException $e) {
    echo "Erro de banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
