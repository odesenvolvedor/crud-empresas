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
Caso o deploy seja feito no domínio principal, ou em um subdomínio, a raíz da aplicação deve ser apontada para a pasta public. Feito isto, basta executar o script chamando o domínio no navegador, exemplo http://localhost

Caso o deploy seja feito em uma subpasta, será necessário alterar as linhas 8 e 9, atribuindo o valor para a constante BASE_URL com o nome da subpasta e a constante PUBLIC_PATH atribuindo a ela o valor BASE_URL . 'public'. Então, a aplicação será executada no navegador, chamando http://localhost/nome-da-subpasta

##### Exemplo
```php
define('BASE_URL', 'nome-da-subpasta');
define('PUBLIC_PATH', BASE_URL . 'public');
```
