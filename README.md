Devnology

Projecto de Loja Online para teste.

## Pré-requisitos

- PHP >= 8.1
- Composer
- Banco de Dados Mysql

## Instalação

1. Clone este repositório
2. Instale as dependências do PHP executando `composer install`
3. Crie um arquivo `.env` a partir do `.env.example` e preencha com as informações de configuração do seu banco de dados
4. Execute `php artisan key:generate` para gerar a chave da aplicação
5. Execute `php artisan migrate` para criar as tabelas no banco de dados
6. Execute `php artisan db:seed` para criar as tabelas no banco de dados

## Uso

Execute `php artisan serve` para iniciar o servidor local. Acesse `http://localhost:8000` em seu navegador para acessar a aplicação.
