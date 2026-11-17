
<?php
require_once dirname(__DIR__, 2) . '/core/auth.php';
?>

<style>
    .help-button {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: #6c757d;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .user-photo {
        width: 48px;
        height: 48px;
        object-fit: cover;
        cursor: pointer;
    }

    .user-table td {
        vertical-align: middle;
    }

    #modalZoom {
        display: none;
        position: fixed;
        inset: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #imgZoom {
        max-width: 90%;
        max-height: 85%;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 0 30px #000;
    }

    .zoom-close {
        position: absolute;
        top: 20px;
        right: 30px;
        background: none;
        border: none;
        color: white;
        font-size: 32px;
        cursor: pointer;
    }
</style>

<main class="text-dark py-4" style="background-color: #edf6fc; min-height: 100vh;">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h2 class="mb-0">Painel de Usuários</h2>

            <button
                type="button"
                class="help-button"
                data-bs-toggle="modal"
                data-bs-target="#helpModal"
                aria-label="Ajuda sobre usuários"
                title="Ajuda"
            >
                ?
            </button>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <div class="card shadow-lg border-0">
            <div class="card-body">

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="?url=register" class="btn btn-primary">
                        <i class="fa fa-user-plus me-1"></i>
                        Novo usuário
                    </a>
                    <a href="?url=saveMassa" class="btn btn-outline-primary">
                        <i class="fa fa-file-upload me-1"></i>
                        Importar CSV
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="idtabela" class="table table-bordered table-striped user-table">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th class="text-center">Perfil de acesso</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($users)): ?>

                                <?php foreach ($users as $user): ?>
                                    <?php
                                        $id = $user['id_usuario'] ?? '';
                                        $nome = $user['nome'] ?? '';
                                        $email = $user['email'] ?? '';
                                        $telefone = $user['telefone'] ?? '';
                                        $foto = $user['foto'] ?? '';
                                        $tipo = (string) ($user['tipo_acesso'] ?? '');

                                        $perfil = $tipo === '0'
                                            ? 'Administrador'
                                            : ($tipo === '1' ? 'Cliente' : 'Não definido');
                                    ?>

                                    <tr>
                                        <td class="text-center">
                                            <?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if ($foto !== ''): ?>
                                                    <img
                                                        src="./app/views/fotos/<?= rawurlencode(basename($foto)) ?>"
                                                        alt="Foto de <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>"
                                                        class="rounded-circle me-2 user-photo"
                                                        onclick="abrirZoom(this.src)"
                                                    >
                                                <?php else: ?>
                                                    <div
                                                        class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
                                                        style="width: 48px; height: 48px; flex-shrink: 0;"
                                                        aria-label="Usuário sem foto"
                                                    >
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                <?php endif; ?>

                                                <span>
                                                    <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') ?>
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8') ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if ($tipo === '0'): ?>
                                                <span class="badge bg-dark">
                                                    Administrador
                                                </span>
                                            <?php elseif ($tipo === '1'): ?>
                                                <span class="badge bg-secondary">
                                                    Cliente
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">
                                                    Não definido
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">

                                                <a
                                                    href="?url=editUser&id=<?= rawurlencode((string) $id) ?>"
                                                    class="btn btn-sm btn-warning"
                                                    title="Editar usuário"
                                                    aria-label="Editar usuário"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form method="POST" action="?url=deleteUser" class="d-inline" onsubmit="return confirm('Tem certeza de que deseja excluir este usuário?');">
                                                    <input type="hidden" name="idusuario" value="<?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Excluir usuário" aria-label="Excluir usuário">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Nenhum usuário cadastrado.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <a href="?url=dashboard" class="btn btn-secondary mt-3">
                    <i class="fa fa-arrow-left me-1"></i>
                    Voltar
                </a>

            </div>
        </div>
    </div>
</main>

<!-- Modal de ajuda -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">
                    Ajuda — Painel de Usuários
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Fechar"
                ></button>
            </div>

            <div class="modal-body">
                <p>
                    Nesta tela, o administrador pode consultar os usuários cadastrados
                    no sistema da paróquia.
                </p>

                <ul>
                    <li><strong>Novo usuário:</strong> abre a tela de cadastro.</li>
                    <li><strong>Administrador:</strong> usuário com permissões administrativas.</li>
                    <li><strong>Cliente:</strong> usuário com acesso comum ao sistema.</li>
                    <li><strong>Editar:</strong> permite alterar os dados do usuário.</li>
                    <li><strong>Excluir:</strong> solicita confirmação antes de excluir.</li>
                    <li><strong>Foto:</strong> clique na imagem para ampliá-la.</li>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Modal de zoom da foto -->
<div
    id="modalZoom"
    role="dialog"
    aria-modal="true"
    aria-label="Foto ampliada"
    onclick="fecharZoom()"
>
    <button
        type="button"
        class="zoom-close"
        onclick="fecharZoom()"
        aria-label="Fechar imagem ampliada"
    >
        <i class="fa fa-times-circle"></i>
    </button>

    <img id="imgZoom" src="" alt="Foto ampliada">
</div>

<script>
    function abrirZoom(src) {
        const modal = document.getElementById('modalZoom');
        const imagem = document.getElementById('imgZoom');

        imagem.src = src;
        modal.style.display = 'flex';
    }

    function fecharZoom() {
        document.getElementById('modalZoom').style.display = 'none';
        document.getElementById('imgZoom').src = '';
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            fecharZoom();
        }
    });
</script>
