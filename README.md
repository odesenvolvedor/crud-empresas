# crud-empresas
Listagem e manutenção de empresas, com consulta de dados da empresa na api do site receitaws.

### Requerimentos
- PHP >= 5.6

### Instruções para execução

#### Passo 1

Criar um banco de dados e realizar as configurações de conexão no arquivo config/database.php

##### Exemplo
```php
return array(
    'host' => 'localhost',
    'dbname' => 'crud_empresas',
    'dbuser' => 'root',
    'dbpassword' => ''
);
```
#### Passo 2
Executar o script de criação do banco de dados database.sql

#### Passo 3
Executar o script de importação da tabela cnae, no arquivo cnae.sql

#### Passo 4
Caso o deploy seja feito na raíz da aplicação, basta executar o script, exemplo http://localhost
Caso o deploy seja feito em uma subpasta, será necessário alterar a linha 8, atribuindo o valor para a constante BASE_URL com o nome da subpasta. Então, a aplicação será executada no navegador, chamando http://localhost/nome-da-subpasta

##### Exemplo
```php
define('BASE_URL', 'crud-empresas');
```
