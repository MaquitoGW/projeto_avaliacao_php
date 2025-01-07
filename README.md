# Avaliação PHP com MySQL

Este projeto foi desenvolvido utilizando **PHP 8.2** e integra um sistema de contas a pagar com base de dados em MySQL.

### Banco de Dados

O script SQL necessário para criar as tabelas do banco de dados está localizado no seguinte caminho:

- **Arquivo SQL**: [SQL/financeiro.sql](SQL/financeiro.sql)

### 🛠️ Configuração do Banco de Dados

Para conectar o projeto ao banco de dados MySQL, é necessário editar o arquivo de configuração de conexão. Siga os passos abaixo:

1. Acesse o arquivo de configuração:
   - **Arquivo de Conexão**: [db/conect.php](db/conect.php)

2. Edite os seguintes valores de acordo com sua configuração local ou remota:

```php
$dbName = "financeiro"; // Nome do banco de dados
$host = "localhost";    // Endereço do servidor (localhost, se estiver rodando localmente)
$user = "root";         // Nome do usuário do banco de dados
$password = "maicon2107"; // Senha do usuário do banco
```

> **Nota**: Certifique-se de que o banco de dados esteja criado antes de executar o projeto. Você pode importar o arquivo `financeiro.sql` para gerar as tabelas e dados necessários.

### 💻 Executando o Projeto

1. Faça o download ou clone o repositório.
   ```bash
   git clone https://github.com/MaquitoGW/projeto_avaliacao_php.git
   ```

2. Certifique-se de que o servidor PHP esteja rodando (pode ser através do XAMPP, WAMP, ou via linha de comando):
   ```bash
   php -S localhost:8000
   ```

3. Acesse o sistema no navegador em: `http://localhost:8000`.
