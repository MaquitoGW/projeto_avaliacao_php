<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar empresa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Adicionar empresa</h1>
    <form action="include/add.php?s=empresa" method="POST">
        <label for="nome">Empresa:</label>
        <input type="text" name="nome" required>
        
        <button type="submit">Inserir</button>
    </form>
</body>
</html>