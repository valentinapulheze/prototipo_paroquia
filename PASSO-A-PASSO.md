# Paróquia Prototipo — instalação e correções

## Requisitos
- XAMPP com Apache, PHP 8.1+ e MySQL/MariaDB.
- Extensões PHP PDO, PDO_MySQL e mbstring habilitadas.

## Instalação no XAMPP
1. Extraia a pasta `paroquia_prototipo` em `C:\xampp\htdocs\`.
2. Inicie Apache e MySQL pelo painel do XAMPP.
3. Abra o phpMyAdmin e crie/import o banco usando `bd/paroquia_prototipo.sql`.
4. Confira a conexão em `app/core/Database.php` (padrão XAMPP: host `localhost`, banco `paroquia_prototipo`, usuário `root`, senha vazia).
5. Acesse `http://localhost/paroquia_prototipo/`.

## Banco já existente
Se o banco já estava criado antes desta correção, execute uma única vez `bd/migracao_usuarios_ativo.sql` no phpMyAdmin. O código agora usa a coluna `usuarios.ativo` para controlar contas ativas e a importação CSV.

## Importação de usuários por CSV
1. Entre com uma conta administradora.
2. Abra **Usuários > Importar CSV**.
3. Use o modelo em `app/views/upload/Modelo_Inserir_Usuario.csv`.
4. O arquivo deve ser CSV separado por ponto e vírgula (`;`) e conter as colunas `Nome`, `Email`, `Senha`, `Ativo` e `Tipo_Acesso`. As colunas de responsável e WhatsApp são opcionais.
5. Senhas são armazenadas com `password_hash`; e-mails repetidos ou dados inválidos são informados no resultado.

## Depuração
A depuração visual está desligada por padrão (`APP_DEBUG = false` em `index.php`). Para desenvolvimento local, pode ser ativada temporariamente. Não deixe a tela detalhada de erros habilitada em produção.

## Principais correções desta revisão
- Corrigido o erro de sintaxe e a estrutura HTML da tela de importação CSV.
- Implementado o método `UserController::importCsv()` que estava apontado na rota, mas não existia.
- Incluída a coluna `ativo` no banco e no model de usuários; contas inativas não conseguem entrar.
- Corrigidos caminhos de inclusão para funcionarem independentemente da pasta de trabalho do PHP.
- A sessão agora é iniciada no começo da aplicação e antes das verificações de agendamento.
- Corrigidas rotas ausentes de avisos e da lojinha; incluída listagem pública de eventos.
- Removidas rotas de Grade/relatórios que apontavam para controllers, métodos ou telas inexistentes.
- Corrigidos links de editar/excluir usuário e a exclusão passou a usar POST.
- Protegidas as operações administrativas de avisos.

## Observação
O módulo de cadastro/edição administrativa de eventos e os relatórios antigos de usuário, produto e token não estavam completos no arquivo recebido. Os links que levavam a essas telas inexistentes foram removidos ou substituídos por destinos funcionais; esses módulos podem ser implementados em uma etapa separada.
