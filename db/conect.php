<?php
try {
    $pdo = new PDO("mysql:dbname=financeiro;host=localhost", "root", "maicon2107");
} 
catch (PDOException $e){
    echo "Erro no banco de dados: ". $e->getMessage();
}
catch (Exception $e) {
    echo $e->getMessage();
}