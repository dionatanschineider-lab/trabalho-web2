# Relatório Técnico — Decisões e Implementação

**Resumo**
Este projeto entregou um sistema web minimalista em PHP + MySQL atendendo aos requisitos do enunciado: autenticação, CRUD, sessões, validação, geração de relatórios e medidas básicas de segurança.

**Decisões técnicas**
- **PDO**: Para uso de prepared statements e melhor tratamento de erros.
- **password_hash / password_verify**: Padronização para armazenar senhas com segurança.
- **Estrutura MVC simples**: Separação mínima entre controllers, models e views para organização do código.
- **Exportação CSV**: Implementada para geração de relatório portátil (pode ser aberto em Excel).
- **Proteções**: Escape com `htmlspecialchars` ao renderizar dados do usuário.

**Como testar**
1. Importar `sql/script.sql`.
2. Ajustar `config.php`.
3. Rodar servidor e navegar até `/`.
4. Testar fluxo de registro/login e CRUD de produtos.
5. Gerar relatório via `Relatórios > Exportar CSV` ou visualizar relatório HTML.

**Limitações**
- Sistema de recuperação de senha é demonstrativo (envia instrução em tela; não envia e-mail).
- Geração de PDF não foi adicionada por dependência (pode ser adicionada com FPDF/MPDF via Composer).

