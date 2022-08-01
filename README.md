# PROJETO Ordens de Serviço

## Versões utilizadas para o desenvolvimento
- Apache 2.4.47
- PHP 7.4.19
- MySQL CE 5.7

## Softwares obrigatórios
- PHP: https://www.php.net/
- MySQL CE (Commnunity Edition): https://dev.mysql.com/community/

# Instalação

## Clonar o PROJETO do seguinte repositótio: https://github.com/s-apps/ordens-de-servico.git
- git clone https://github.com/s-apps/ordens-de-servico.git

## Configurar o acesso ao banco de dados
- No PROJETO, acesse o diretório util e edite o arquivo connection.php informando o NOMEDOBANCO, o USUARIO e a SENHA
```
    $conexao = new \PDO(
        'mysql:host=localhost;dbname=NOMEDOBANCO;charset=utf8',
        'USUARIO',
        'SENHA'
    ); 
    return $conexao;
```

## Criar o banco de dados com o NOMEDOBANCO, USUARIO com todos os privilégios e informar a SENHA
```
mysql -u root -p
GRANT ALL PRIVILEGES ON *.* TO 'USUARIO'@'localhost' IDENTIFIED BY 'SENHA';
mysql -u USUARIO -p
CREATE DATABASE NOMEDOBANCO; 
```

## Criar a estrutura do banco de dados e importar 
Os arquivos para criação do banco e importação dos dados inseridos para teste, encontram-se no diretorio scripts_sql do PROJETO.
- Arquivo para criação da estrutura: create_database_tables.sql 
- Arquivo para importação dos dados inseridos para teste: dados_inseridos.sql
- Obs: execute primeiro a criação da estrutura para depois importar os dados inseridos para teste

## Para executar o Ordens de Serviço
- Acesse o diretório onde o Ordens de Serviço foi clonado
- Na raiz do projeto, execute o comando `php -S localhost:8000`
- Execute um browser de sua preferência e informe na barra de endereços http://localhost:8000
- O LOGIN e a SENHA são respectivamente: tecnico1 e 1234 ou tecnico2 e 1234
- Se caso você possuir o servidor web Apache, copie todos os arquivos do projeto para o diretório root e acesse com o endereço de acordo com sua configuração, geralmente http://localhost


