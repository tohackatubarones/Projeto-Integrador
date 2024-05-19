<!-- link_prova.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link de Acesso à Prova</title>
</head>
<body>
    <h1>Link de Acesso à Prova</h1>

    <?php
    $link_acesso = $_GET['link'];
    echo "<p>Link de acesso à prova: <a href='$link_acesso'>$link_acesso</a></p>";
    ?>

    <p>Envie este link para os participantes acessarem a prova.</p>
</body>
</html>
