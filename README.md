# Sistema Web - Trabalho WEB 2

**Descrição**
Projeto exemplo de um sistema web em PHP + MySQL (estrutura simples MVC) com:
- Autenticação de usuários (registro, login, logout, recuperação de senha - recuperação simples).
- CRUD completo para entidade **products** (produtos).
- Relatório em HTML e exportação em CSV.
- Segurança básica: PDO com prepared statements, `password_hash`, proteção XSS (output escape).
- Script SQL para criação do banco de dados e dados iniciais.

**Requisitos**
- PHP 7.4+ com PDO MySQL
- MySQL / MariaDB
- Composer (opcional)
- Servidor web (Apache/Nginx) ou PHP built-in server

**Instalação rápida (modo local)**
1. Importe o arquivo `sql/script.sql` em seu MySQL:
   - `mysql -u root -p < sql/script.sql`
   - O script cria o banco `web_system` e tabelas `users` e `products`, além de um usuário admin (email: admin@example.com | senha: Admin@123).

2. Copie os arquivos para a raiz do seu servidor web (ou use o servidor embutido):
   - `php -S localhost:8000 -t public`
   - Abra: http://localhost:8000

3. Configure conexão com banco em `config.php` (host, dbname, user, pass).

**Pontos importantes de segurança implementados**
- Uso de PDO com prepared statements para prevenir SQL Injection.
- Hash de senhas com `password_hash`.
- Escape de saída (função `e()`) para evitar XSS.
- Validação básica no front-end (HTML5) e back-end.

**Relatórios**
- Relatório em HTML (acessível em `/report.php`) e exportação CSV (`/export_products.php`).

**Estrutura**
- public/            -> ponto de entrada (index.php, assets)
- app/Controllers    -> Controllers
- app/Models         -> Models (User, Product)
- app/Views          -> Views (templates)
- sql/               -> script.sql
- README.md
- relatório_tecnico.md

**Observações**
Este projeto é um template educacional para atender os requisitos do trabalho. Ajuste caminhos, permissões e configurações conforme seu ambiente.

Bom trabalho! 
