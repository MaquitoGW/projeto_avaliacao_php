<?php
require "db/conect.php";
require "include/response.php"; // Class para a reposta

$response = new Response;
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar empresas
    $select = $pdo->prepare("SELECT * FROM tbl_empresa");
    $select->execute();
    $empresas = $select->fetchAll();

    // Buscar informações da conta a pagar
    $select = $pdo->prepare("SELECT * FROM tbl_conta_pagar WHERE id_conta_pagar = :id");
    $select->bindValue(":id", $id, PDO::PARAM_INT);
    $select->execute();
    $conta = $select->fetch();

    // Verificar se a conta foi encontrada
    if (!$conta) {
        $response->create("popup", "Nenhuma conta encontrada com esse ID.");
        $response->redirect("/");
    }
} else {
    $response->create("popup", "Nenhum parâmetro foi enviado.");
    $response->redirect("/");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Conta a Pagar</title>
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
        <form action="include/actions.php?s=editar&id=<?= $conta['id_conta_pagar'] ?>" method="POST">
            <h1>Editar Conta a Pagar</h1>
            <label for="id_empresa">Empresa:</label>
            <select name="id_empresa" required>
                <option value="">Selecione uma empresa</option>
                <?php foreach ($empresas as $value): ?>
                    <option <?= $conta["id_empresa"] == $value["id_empresa"]  ? "selected" : "" ?> value="<?= $value["id_empresa"]; ?>"><?= $value["nome"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="data_pagar">Data de Pagamento:</label>
            <input type="date" name="data_pagar" value="<?= $conta['data_pagar'] ?>" required>

            <label for="valor">Valor:</label>
            <input type="text" name="valor" value="<?= number_format($conta['valor'], 2, ',', '.') ?>" required placeholder="0,00">

            <label for="pago">Pago:</label>
            <select name="pago" required>
                <option <?= $conta["pago"] ? "selected" : "" ?> value="0">Não</option>
                <option <?= $conta["pago"] ? "selected" : "" ?> value="1">Sim</option>
            </select>

            <button type="submit">Editar</button>
        </form>
    </main>
</body>

</html>