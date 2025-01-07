<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar empresa</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="options">
            <a href="/">Voltar ao início</a>
            <a href="new_conta.php">Adicionar Conta a Pagar</a>
        </div>
    </header>
    <main class="container none-columns">
        <form action="include/add.php?s=empresa" method="POST">
            <h1>Adicionar empresa</h1>
            <label for="nome">Empresa:</label>
            <input type="text" name="nome" required placeholder="Insirar o nome da empresa">

            <button type="submit">Inserir</button>
        </form>
    </main>
</body>

</html>