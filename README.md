# Cadastro de Contatos

Projeto desenvolvido em Laravel 11 com PostgreSQL, utilizando Bootstrap 5 para estilização e modais interativos. Esta aplicação realiza o cadastro de contatos com exibição de endereço detalhado via modal.

## Funcionalidades

- Cadastro de contatos com:
  - Nome
  - Telefone (com máscara)
  - Idade
  - Endereço completo (CEP, Rua, Número, Complemento, Cidade, Estado)
- Listagem com paginação
- Filtro por nome (case-insensitive)
- Edição e exclusão de contatos
- Exibição do endereço via modal (sem redirecionamento)
- Layout com Bootstrap responsivo

## Tecnologias utilizadas

- Laravel 11
- PostgreSQL
- Bootstrap 5
- HTML, JavaScript e CSS
- Máscara de input para telefone e CEP

## Executando com Docker

Certifique-se de ter o Docker e o Docker Compose instalador.

### Passos para rodar o projeto:

1. Clone este repositório:
```bash
git clone https://github.com/ArthurOliv2/teste-dev.git
cd teste-dev
```

2. Instale as dependencias PHP dentro do container

```bash
docker exec -it laravel-app composer install
```

3. Copie o arquivo .env.example e crie seu .env:

```bash
cp .env.example .env
```

4. Gere a chave da aplicação:

```bash
docker exec -it laravel-app php artisan key:generate
```

5. Configure o banco no arquivo .env

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERBANE=laravel
DB_PASSWORD=secret
```

6. Execute as migrações:

```bash
docker exec -it laravel-app php artisan migrate
```

6. Inicie o servidor:

```bash
docker exec -it laravel-app php artisan serve
```
## Acesse no navegador:
```
http://localhost:8000
```
