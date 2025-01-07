<?php
require "db/conect.php";

// Buscar empresas
$select = $pdo->prepare("SELECT * FROM tbl_empresa WHERE id_empresa");
$select->execute();
$empresas = $select->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Conta a Pagar</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="options">
            <a href="/">Voltar ao início</a>
            <a href="new_empresa.php">Adicionar empresa</a>
        </div>
    </header>
    <main class="container none-columns">
        <form action="include/add.php?s=conta" method="POST">
            <h1>Adicionar Conta a Pagar</h1>
            <label for="id_empresa">Empresa:</label>
            <select name="id_empresa" required>
                <option value="">Selecione uma empresa</option>
                <?php foreach ($empresas as $value): ?>
                    <option value="<?= $value["id_empresa"]; ?>"><?= $value["nome"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="data_pagar">Data de Pagamento:</label>
            <input type="date" name="data_pagar" required>

            <label for="valor">Valor:</label>
            <input type="text" name="valor" required placeholder="0,00">

            <button type="submit">Inserir</button>
        </form>
    </main>
</body>

</html>