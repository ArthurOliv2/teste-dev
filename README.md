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

## Instalação

1. Clone este repositório
2. Acesse a pasta do projeto no terminal

```bash
composer install
```

3. Copie o arquivo `.env.example` e crie o `.env`

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure seu banco de dados PostgreSQL no `.env`

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=seu_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```
# Utilize os mesmos valores definidos no docker-compose.yml

5. Execute as migrações:

```bash
php artisan migrate
```

6. Inicie o servidor:

```bash
php artisan serve
```
>>>>>>> 78ca839 (Entrega final do projeto)
