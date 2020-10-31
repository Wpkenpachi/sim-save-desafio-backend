
# Teste Back-End SimSave
Teste para candidatura para vaga de desenvolvedor back-end da SimSave

## Setup inicial

Clone o projeto em sua máquina local.

Crie uma tabela no seu banco de dados MySQL com o nome `teste_simsave` ou qualquer outro nome que desejar.

Configure o arquivo `.env` com os dados de conexão do seu banco de dados MySQL local.

Instale as dependencias do projeto com o comando `composer install`

Rode o comando `php artisan migrate` para criar as tabelas iniciais no seu bd.

Rode o comando `php artisan db:seed --class=CompanySeeder` para popular a tabela `companies`.

Sirva sua API com o comando `php artisan serve`

Pronto, você está pronto para iniciar os teste.


## Instruções

O objetivo deste teste é avaliar a sua familiaridade com o framework Laravel/Lumen para a criação de API's Restful.

O setup inicial desse projeto já conta com uma tabela chamada `companies` e contém um registro. As rotas para listagem, cadastro, edição e remoção da tabela já estão criadas:

- **Listagem**: `GET` http://127.0.0.1:8000/api/company
- **Cadastro**: `POST` http://127.0.0.1:8000/api/company
- **Detalhes**: `GET` http://127.0.0.1:8000/api/company/{id}
- **Edição**: `POST` http://127.0.0.1:8000/api/company/{id}
- **Remoção**: `DELETE` http://127.0.0.1:8000/api/company/{id}

Neste teste, precisamos de uma tabela para **cadastro dos funcionários da empresa**, essa tabela deve conter os campos `nome, cargo, email, telefone e data de admissão`. Lembrando que a empresa pode ter mais de um funcionário, logo o relacionamento deverá ser `One To Many`
Além da tabela, também é necessário criar as rotas para criar, editar e remover os funcionários na empresa. Também é necessário alterar o rota da empresa para que liste todos os funcionários ao solicitar os detalhes da mesma.

Ao finalizar, suba o projeto em seu GitHub e nos envie o link para avaliação.

**Prazo para realização do teste:** 5 dias

## O que será avaliado
 - Conhecimento geral do framework
 - Criação e utilização de API's no framework
 - Conhecimento geral sobre relacionamento de tabelas
 - Utilização básica do GitHub
