<main class="text-light" style="background-color: #F4C2C2;">
    <div class="container mt-3">
        <?php require_once dirname(__DIR__, 2) . '/core/auth.php'; ?>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title mb-4 text-center">Cadastrar Usuários de uma Planilha.CSV</h2>
                        <form method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-10 mb-3">
                                    <label for="arquivo" class="form-label">Arquivo (.csv)</label>
                                    <input type="file" name="arquivo" id="arquivo" class="form-control" accept=".csv" required>
                                </div>

                                <div class="col-sm-2 mb-3">
                                    <label for="arquivo" class="form-label">Planilha Modelo (.csv)</label>
                                    <a href="<?= BASE_URL ?>/app/views/upload/Modelo_Inserir_Usuario.csv" class="btn btn-info" download>Baixar Modelo CSV</a>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    Enviar
                                </button>
                                <a href="index.php" class="btn btn-secondary">
                                    Voltar
                                </a>
                            </div>
                        </form>
                        <?php if(!empty($sucesso)): ?>
                            <div class="alert alert-success"><?= $sucesso ?></div>
                        <?php endif; ?>

                        <?php if(!empty($erro)): ?>
                            <div class="alert alert-danger"><?= $erro ?></div>
                        <?php endif; ?>

                        <?php if (!empty($dados)): ?>
                            <h5 class="mt-4">Resultado da importação:</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mt-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Ativo</th>
                                            <th>Telefone / WhatsApp</th>
                                            <th>Tipo de acesso</th>
                                            <th>Resultado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($dados as $usuario): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($usuario['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= htmlspecialchars($usuario['email'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= ((int) ($usuario['ativo'] ?? 1) === 1) ? 'Ativo' : 'Inativo' ?></td>
                                            <td><?= htmlspecialchars($usuario['whatsapp'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><?= ((string) ($usuario['tipo_acesso'] ?? '') === '0') ? 'Administrador' : 'Aluno' ?></td>
                                            <td><?= htmlspecialchars($usuario['msg'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>