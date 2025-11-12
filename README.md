# Gerenciador de Tarefas

Projeto desenvolvido para a disciplina de WEB 2, com o objetivo de criar um sistema web completo utilizando PHP puro e MySQL. Este sistema é um "To-Do List" multiusuário, onde cada pessoa pode se cadastrar e gerenciar suas próprias tarefas de forma privada.

## Funcionalidades Implementadas

O projeto atende a todos os requisitos obrigatórios da atividade:

* **Autenticação de Usuários:**
    * Cadastro de novos usuários.
    * Login seguro.
    * Logout.
* **Segurança e Privacidade de Dados:**
    * Senhas criptografadas com `password_hash()` e verificadas com `password_verify()`.
    * Proteção contra **SQL Injection** (usando PDO com *prepared statements*).
    * Proteção contra **XSS** (usando `htmlspecialchars` na exibição de dados).
    * **Controle de Acesso Total:** Um usuário só pode ver, criar, editar ou excluir as **suas próprias tarefas**. A lógica do back-end (usando `WHERE usuario_id = ?`) garante essa privacidade.
* **CRUD de Tarefas:**
    * **C**reate (Criar): Formulário para cadastrar novas tarefas.
    * **R**ead (Ler): Listagem de todas as tarefas *do usuário logado*.
    * **U**pdate (Atualizar): Formulário para editar uma tarefa existente.
    * **D**elete (Excluir): Funcionalidade para remover uma tarefa.
* **Geração de Relatórios:**
    * Geração de um relatório em **.CSV** (compatível com Excel) com a lista de tarefas do usuário. O script PHP gera o arquivo com cabeçalhos HTTP e tratamento de caracteres (UTF-8) para compatibilidade.
* **Front-end:**
    * Interface responsiva utilizando **Bootstrap 5**.
    * Validação de formulários no *client-side* (HTML5) e *server-side* (PHP).

## Tecnologias Utilizadas

* **Back-end:** PHP 8+ (Puro)
* **Banco de Dados:** MySQL
* **Conexão:** PDO (PHP Data Objects)
* **Front-end:** HTML5, CSS3, Bootstrap 5
* **Servidor:** XAMPP (Apache + MySQL)

## Instruções de Instalação e Execução

1.  **Pré-requisitos:**
    * Ter um servidor local como XAMPP ou WAMP instalado.
    * Um gerenciador de banco de dados (MySQL Workbench ou phpMyAdmin).

2.  **Clonar o Repositório:**
    ```bash
    git clone [URL_DO_SEU_REPOSITORIO_GIT]
    ```
    *Ou apenas baixe o `.zip` do projeto.*

3.  **Mover Projeto:**
    * Mova a pasta `Gerenciador-de-tarefas` para dentro do diretório `htdocs` do seu XAMPP (Ex: `C:\xampp\htdocs\`).

4.  **Configurar o Banco de Dados:**
    * Inicie os módulos **Apache** e **MySQL** no painel do XAMPP.
    * Abra o seu gerenciador de banco de dados (Ex: MySQL Workbench ou acesse `http://localhost/phpmyadmin`).
    * Execute o script `arquivosql.sql` (que está na raiz do projeto). Isso criará o *schema* `db_tarefas` e as tabelas `usuarios` e `tarefas`.

5.  **Verificar Conexão (Opcional):**
    * O arquivo `config/database.php` está configurado para o padrão XAMPP (`DB_USER = 'root'` e `DB_PASS = ''`). Se o seu MySQL tiver uma senha diferente, ajuste este arquivo.

6.  **Acessar o Sistema:**
    * Abra seu navegador e acesse: `http://localhost/Gerenciador-de-tarefas/login.php`

## Diagrama do Banco de Dados

O *schema* `db_tarefas` possui duas tabelas que se relacionam:

```sql
usuarios
- id (INT, PK, AI)
- nome (VARCHAR)
- email (VARCHAR, UNIQUE)
- senha (VARCHAR)
- data_criacao (TIMESTAMP)

tarefas
- id (INT, PK, AI)
- titulo (VARCHAR)
- descricao (TEXT)
- status (ENUM: 'pendente', 'em_andamento', 'concluida')
- data_criacao (TIMESTAMP)
- usuario_id (INT, FK)  <-- Chave Estrangeira que aponta para usuarios.id
```
**Relação:** `usuarios (1) ---- (N) tarefas` (Um usuário pode ter N tarefas)