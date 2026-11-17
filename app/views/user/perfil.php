
<?php
$foto = $users['foto'] ?? '';

$caminhoFoto = !empty($foto)
    ? './app/views/fotos/' . rawurlencode(basename($foto))
    : './img/sem_imagem.png';

$tipoAcesso = (int) ($users['tipo_acesso'] ?? -1);
$administrador = $tipoAcesso === 0;
$ativo = (int) ($users['ativo'] ?? 1);

$nome = $users['nome'] ?? 'Usuário';
$email = $users['email'] ?? '';

$idUsuario = $users['id_usuario']
    ?? $users['idusuario']
    ?? '';

$nomeExibicao = mb_strtoupper($nome, 'UTF-8');

$perfilTexto = $tipoAcesso === 0
    ? 'Administrador'
    : ($tipoAcesso === 1 ? 'Cliente' : 'Outro perfil');
?>

<style>
.perfil-page {
    --dourado: #c5a04f;
    --dourado-claro: #ead8a5;
    --azul: #102744;
    --azul-escuro: #091a30;
    --azul-suave: #edf2f8;
    --texto: #243247;
    --cinza: #718096;

    min-height: 85vh;
    padding: 45px 16px;
    background: linear-gradient(140deg, #edf1f6, #ffffff 55%, #e7edf5);
    color: var(--texto);
}

.perfil-container {
    max-width: 1050px;
    margin: 0 auto;
}

.perfil-heading {
    margin-bottom: 28px;
}

.perfil-heading .eyebrow {
    color: var(--dourado);
    font-size: .75rem;
    font-weight: 800;
    letter-spacing: 3px;
    text-transform: uppercase;
}

.perfil-heading h1 {
    margin: 8px 0;
    color: var(--azul);
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    font-weight: 800;
    letter-spacing: -1px;
}

.perfil-heading p {
    color: var(--cinza);
    margin-bottom: 0;
}

.perfil-card {
    overflow: hidden;
    border: 1px solid #e0e5ec;
    border-radius: 22px;
    background: #fff;
    box-shadow: 0 18px 50px rgba(9, 26, 48, .12);
}

.perfil-cover {
    height: 155px;
    position: relative;
    background: linear-gradient(
        115deg,
        #091a30 0%,
        #15385e 65%,
        #245078 100%
    );
    border-bottom: 4px solid var(--dourado);
}

.perfil-cover::after {
    content: "";
    position: absolute;
    inset: 0;
    opacity: .17;
    background-image: radial-gradient(#ead8a5 1px, transparent 1px);
    background-size: 20px 20px;
}

.perfil-content {
    padding: 0 36px 36px;
}

/* Cabeçalho do usuário */
.perfil-user-top {
    display: flex;
    align-items: flex-start;
    gap: 22px;
    flex-wrap: wrap;
    margin: -63px 0 32px;
    position: relative;
    z-index: 2;
}

.perfil-avatar-wrap {
    padding: 5px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid var(--dourado);
    box-shadow: 0 6px 22px rgba(9, 26, 48, .18);
    position: relative;
    z-index: 2;
    flex-shrink: 0;
}

.perfil-avatar {
    width: 118px;
    height: 118px;
    display: block;
    object-fit: cover;
    border-radius: 50%;
    cursor: zoom-in;
    border: 3px solid #fff;
}

.perfil-user-info {
    flex: 1;
    min-width: 180px;
    padding-bottom: 5px;
    margin-top: 68px;
    position: relative;
    z-index: 3;
}

.perfil-user-info h2 {
    color: var(--azul);
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 5px;
    overflow-wrap: anywhere;
    line-height: 1.3;
}

.perfil-user-info p {
    color: var(--cinza);
    margin-bottom: 10px;
    overflow-wrap: anywhere;
}

.perfil-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f8f2e4;
    color: #85651f;
    border: 1px solid #ead8a5;
    padding: 7px 13px;
    border-radius: 30px;
    font-size: .78rem;
    font-weight: 700;
}

/* Seções */
.perfil-section {
    padding: 24px;
    border: 1px solid #e1e7ef;
    border-radius: 17px;
    margin-bottom: 22px;
    background: #fff;
}

.perfil-section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 22px;
}

.perfil-section-icon {
    width: 43px;
    height: 43px;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    border-radius: 12px;
    color: var(--dourado);
    background: var(--azul);
    font-size: 1.1rem;
}

.perfil-section-title h3 {
    margin: 0 0 4px;
    color: var(--azul);
    font-size: 1.05rem;
    font-weight: 800;
}

.perfil-section-title p {
    margin: 0;
    color: var(--cinza);
    font-size: .84rem;
}

.perfil-label {
    display: block;
    margin-bottom: 8px;
    color: var(--azul);
    font-size: .84rem;
    font-weight: 700;
}

/* Campos */
.perfil-page .form-control {
    min-height: 47px;
    padding: 11px 14px;
    border: 1px solid #dce3ec;
    border-radius: 10px;
    background: #fff;
    color: var(--texto);
    box-shadow: none;
}

.perfil-page .form-control:focus {
    border-color: var(--dourado);
    box-shadow: 0 0 0 3px rgba(197, 160, 79, .16);
}

.perfil-page .form-control[readonly] {
    background: #f4f6f9;
    color: #526174;
}

.perfil-page .input-group .form-control {
    border-radius: 10px 0 0 10px;
}

.perfil-page .input-group .btn {
    border-color: #dce3ec;
    border-radius: 0 10px 10px 0;
    color: var(--azul);
    background: #f4f6f9;
}

.perfil-page .input-group .btn:hover {
    color: #fff;
    background: var(--azul);
}

.perfil-help {
    display: block;
    margin-top: 8px;
    color: var(--cinza);
    font-size: .78rem;
    line-height: 1.5;
}

/* Status */
.perfil-status {
    display: flex;
    align-items: center;
    gap: 9px;
    min-height: 47px;
    padding: 12px 14px;
    border-radius: 10px;
    background: #f1f7f3;
    color: #24764e;
    font-size: .9rem;
    font-weight: 700;
}

.perfil-status-dot {
    width: 9px;
    height: 9px;
    border-radius: 50%;
    background: #26966a;
}

.perfil-status.inativo {
    background: #fcf0f0;
    color: #a13c3c;
}

.perfil-status.inativo .perfil-status-dot {
    background: #c44b5b;
}

.perfil-alert {
    border: 0;
    border-radius: 12px;
    padding: 15px 18px;
}

/* Botões */
.perfil-actions {
    display: flex;
    justify-content: flex-end;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: 5px;
}

.btn-perfil {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    gap: 9px;
    min-height: 47px;
    padding: 12px 22px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    transition: all .2s ease;
}

.btn-perfil:hover {
    transform: translateY(-2px);
}

.btn-perfil-primary {
    color: #fff;
    background: var(--azul);
    border: 1px solid var(--azul);
    box-shadow: 0 5px 14px rgba(9, 26, 48, .17);
}

.btn-perfil-primary:hover {
    color: #fff;
    background: #1b4169;
    border-color: var(--dourado);
}

.btn-perfil-primary i {
    color: var(--dourado-claro);
}

.btn-perfil-secondary {
    color: var(--azul);
    background: #fff;
    border: 1px solid #d8c28c;
}

.btn-perfil-secondary:hover {
    color: var(--azul-escuro);
    background: #faf6eb;
    border-color: var(--dourado);
}

/* Zoom da foto */
.perfil-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99999;
    padding: 24px;
    align-items: center;
    justify-content: center;
    background: rgba(5, 15, 29, .91);
    backdrop-filter: blur(6px);
}

.perfil-modal img {
    max-width: 90vw;
    max-height: 85vh;
    object-fit: contain;
    border: 2px solid var(--dourado);
    border-radius: 15px;
    box-shadow: 0 15px 60px #0005;
}

.perfil-modal-close {
    position: absolute;
    top: 20px;
    right: 25px;
    border: 0;
    color: var(--dourado-claro);
    background: transparent;
    font-size: 2rem;
}

/* Responsividade */
@media (max-width: 576px) {
    .perfil-page {
        padding: 25px 12px;
    }

    .perfil-content {
        padding: 0 17px 22px;
    }

    .perfil-cover {
        height: 120px;
    }

    .perfil-user-top {
        gap: 14px;
        margin-top: -48px;
        align-items: flex-start;
    }

    .perfil-avatar {
        width: 92px;
        height: 92px;
    }

    .perfil-user-info {
        margin-top: 12px;
        min-width: 100%;
    }

    .perfil-user-info h2 {
        font-size: 1.2rem;
    }

    .perfil-section {
        padding: 17px;
    }

    .perfil-actions {
        flex-direction: column-reverse;
    }

    .btn-perfil {
        width: 100%;
    }
}
</style>

<main class="perfil-page">
    <div class="perfil-container">

        <div class="perfil-heading">
            <div class="eyebrow">Minha conta</div>
            <h1>Meu perfil</h1>
            <p>Consulte seus dados e mantenha sua conta segura.</p>
        </div>

        <?php if (!empty($sucesso)): ?>
            <div class="alert alert-success perfil-alert">
                <i class="fa fa-check-circle me-2"></i>
                <?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger perfil-alert">
                <i class="fa fa-exclamation-circle me-2"></i>
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <div class="perfil-card">
            <div class="perfil-cover"></div>

            <div class="perfil-content">
                <div class="perfil-user-top">

                    <div class="perfil-avatar-wrap">
                        <img
                            id="preview"
                            class="perfil-avatar"
                            src="<?= htmlspecialchars($caminhoFoto, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Foto do usuário"
                            onclick="abrirZoom(this.src)"
                        >
                    </div>

                    <div class="perfil-user-info">
                        <h2><?= htmlspecialchars($nomeExibicao, ENT_QUOTES, 'UTF-8') ?></h2>

                        <p><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>

                        <span class="perfil-badge">
                            <i class="fa fa-user-circle"></i>
                            <?= htmlspecialchars($perfilTexto, ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>

                </div>

                <form method="POST" action="?url=perfil" autocomplete="off">

                    <input
                        type="hidden"
                        name="idusuario"
                        value="<?= htmlspecialchars((string) $idUsuario, ENT_QUOTES, 'UTF-8') ?>"
                    >

                    <section class="perfil-section">

                        <div class="perfil-section-title">
                            <div class="perfil-section-icon">
                                <i class="fa fa-id-card"></i>
                            </div>

                            <div>
                                <h3>Informações pessoais</h3>
                                <p>Dados vinculados à sua conta.</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="perfil-label">
                                Nome completo
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nome"
                                value="<?= htmlspecialchars($nomeExibicao, ENT_QUOTES, 'UTF-8') ?>"
                                readonly
                            >
                        </div>

                        <div class="row g-3">

                            <div class="col-md-4">
                                <label for="tipo_acesso" class="perfil-label">
                                    Perfil de acesso
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="tipo_acesso"
                                    value="<?= htmlspecialchars($perfilTexto, ENT_QUOTES, 'UTF-8') ?>"
                                    readonly
                                >
                            </div>

                            <div class="col-md-4">
                                <label for="adm" class="perfil-label">
                                    Administrador
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="adm"
                                    value="<?= $administrador ? 'Sim' : 'Não' ?>"
                                    readonly
                                >
                            </div>

                            <div class="col-md-4">
                                <label class="perfil-label">
                                    Status da conta
                                </label>

                                <div class="perfil-status <?= $ativo === 1 ? '' : 'inativo' ?>">
                                    <span class="perfil-status-dot"></span>
                                    <?= $ativo === 1 ? 'Conta ativa' : 'Conta inativa' ?>
                                </div>
                            </div>

                        </div>
                    </section>

                    <section class="perfil-section">

                        <div class="perfil-section-title">
                            <div class="perfil-section-icon">
                                <i class="fa fa-shield-alt"></i>
                            </div>

                            <div>
                                <h3>Segurança da conta</h3>
                                <p>Seu e-mail e sua senha de acesso.</p>
                            </div>
                        </div>

                        <div class="row g-3">

                            <div class="col-md-7">
                                <label for="email" class="perfil-label">
                                    E-mail cadastrado
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
                                    readonly
                                >

                                <small class="perfil-help">
                                    Para alterar seu e-mail, entre em contato com a administração.
                                </small>
                            </div>

                            <div class="col-md-5">
                                <label for="senha" class="perfil-label">
                                    Alterar senha
                                </label>

                                <div class="input-group">
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="senha"
                                        name="senha"
                                        placeholder="Digite a nova senha"
                                        minlength="6"
                                        maxlength="20"
                                        autocomplete="new-password"
                                    >

                                    <button
                                        class="btn btn-outline-secondary"
                                        type="button"
                                        id="toggleSenha"
                                        aria-label="Mostrar senha"
                                    >
                                        <i class="fa fa-eye-slash" id="iconSenha"></i>
                                    </button>
                                </div>

                                <small class="perfil-help">
                                    Deixe em branco para manter sua senha atual. De 6 a 20 caracteres.
                                </small>
                            </div>

                        </div>
                    </section>

                    <div class="perfil-actions">

                        <a href="?url=home" class="btn-perfil btn-perfil-secondary">
                            <i class="fa fa-arrow-left"></i>
                            Voltar
                        </a>

                        <button type="submit" class="btn-perfil btn-perfil-primary">
                            <i class="fa fa-save"></i>
                            Salvar alterações
                        </button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<div
    id="modalZoom"
    class="perfil-modal"
    onclick="fecharZoom()"
    role="dialog"
    aria-modal="true"
    aria-label="Foto ampliada"
>
    <button
        type="button"
        class="perfil-modal-close"
        onclick="fecharZoom()"
        aria-label="Fechar imagem"
    >
        <i class="fa fa-times-circle"></i>
    </button>

    <img
        id="imgZoom"
        src=""
        alt="Foto ampliada"
        onclick="event.stopPropagation()"
    >
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const toggleSenha = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');
    const iconSenha = document.getElementById('iconSenha');

    if (toggleSenha && senhaInput && iconSenha) {

        toggleSenha.addEventListener('click', function () {

            const mostrar = senhaInput.type === 'password';

            senhaInput.type = mostrar ? 'text' : 'password';

            iconSenha.classList.toggle('fa-eye', mostrar);
            iconSenha.classList.toggle('fa-eye-slash', !mostrar);

            toggleSenha.setAttribute(
                'aria-label',
                mostrar ? 'Ocultar senha' : 'Mostrar senha'
            );

        });
    }

});

function abrirZoom(src) {
    const modal = document.getElementById('modalZoom');
    document.getElementById('imgZoom').src = src;
    modal.style.display = 'flex';
}

function fecharZoom() {
    const modal = document.getElementById('modalZoom');
    modal.style.display = 'none';
    document.getElementById('imgZoom').src = '';
}

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        fecharZoom();
    }
});
</script>
