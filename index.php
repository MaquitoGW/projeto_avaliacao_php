<?php
require "db/conect.php";
require "include/response.php";
require "include/get.php"
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle financeiro de contas a pagar</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div class="options">
            <a href="new_conta.php">Adicionar Conta a Pagar</a>
            <a href="new_empresa.php">Adicionar empresa</a>
        </div>
    </header>
    <main class="container">
        <form method="post" action="" id="filters">
            <h2>Filtrar</h2>
            <label for="filter_empresa">Empresa:</label>
            <select name="filter_empresa">
                <option value="">Selecione uma empresa</option>
                <?php foreach ($empresas as $value): ?>
                    <option <?= isset($_POST["filter_empresa"]) && $_POST["filter_empresa"] == $value["id_empresa"]  ? "selected" : "" ?> value="<?= $value["id_empresa"]; ?>"><?= $value["nome"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="filter_valor">Valor:</label>
            <input type="text" name="filter_valor" placeholder="0,00">
            <select name="filter_valor_condicao">
                <option <?= isset($_POST["filter_valor_condicao"]) && $_POST["filter_valor_condicao"] == "igual"  ? "selected" : "" ?> value="igual">Igual</option>
                <option <?= isset($_POST["filter_valor_condicao"]) && $_POST["filter_valor_condicao"] == "maior"  ? "selected" : "" ?> value="maior">Maior</option>
                <option <?= isset($_POST["filter_valor_condicao"]) && $_POST["filter_valor_condicao"] == "menor"  ? "selected" : "" ?> value="menor">Menor</option>
            </select>

            <label for="filter_data_pagar">Data de Pagamento:</label>
            <input type="date" name="filter_data_pagar" value="<?= isset($_POST["filter_data_pagar"]) ? $_POST["filter_data_pagar"] : ""; ?>">

            <button type="submit">Filtrar</button>
            <a href="/" class="cancel">Remover filtros</a>
        </form>

        <section>
            <h1>Contas a Pagar</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Valor</th>
                        <th>Data de Pagamento</th>
                        <th>Pago</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contas as $conta): ?>
                        <tr>
                            <td><?= $conta['nome'] ?></td>
                            <td>R$ <?= number_format($conta['valor'], 2, ',', '.') ?></td>
                            <td><?= date_format(date_create($conta['data_pagar']), 'd/m/Y') ?></td>
                            <td><?= $conta['pago'] ? 'Sim' : 'Não' ?></td>
                            <td>
                                <a href="edit_conta.php?id=<?= $conta['id_conta_pagar'] ?>">Editar</a> |
                                <a href="include/actions.php?s=pago&id=<?= $conta['id_conta_pagar'] ?>">Marcar como Paga</a> |
                                <a href="include/actions.php?s=delete&id=<?= $conta['id_conta_pagar'] ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <?php
    echo $response->get("popup") ? '<p id="popup">' . $response->get("popup") . '</p>' : "";
    $response->delete("popup");
    ?>
    <script src="js/script.js"></script>
</body>

</html>