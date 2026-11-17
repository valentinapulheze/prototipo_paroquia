
<?php
require_once dirname(__DIR__, 2) . '/core/auth.php';
?>

<main class="text-dark" style="background-color: #f5f6f8; min-height: 100vh;">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">

                        <h2 class="card-title text-center mb-4">
                            Editar Usuário
                        </h2>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($sucesso)): ?>
                            <div class="alert alert-success">
                                <?= htmlspecialchars($sucesso, ENT_QUOTES, 'UTF-8') ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" enctype="multipart/form-data">

                            <input
                                type="hidden"
                                name="idusuario"
                                value="<?= htmlspecialchars((string)($users['id_usuario'] ?? $users['idusuario'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                            >

                            <!-- DADOS DO USUÁRIO -->
                            <div class="border rounded p-3 mb-4">
                                <h5 class="mb-3">Dados do usuário</h5>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nome" class="form-label">
                                            Nome completo
                                        </label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            id="nome"
                                            name="nome"
                                            value="<?= htmlspecialchars($users['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                            maxlength="45"
                                            required
                                        >
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="telefone" class="form-label">
                                            Telefone
                                        </label>

                                        <input
                                            type="tel"
                                            class="form-control"
                                            id="telefone"
                                            name="telefone"
                                            value="<?= htmlspecialchars($users['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                            maxlength="18"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- PERFIL DE ACESSO -->
                            <div class="border rounded p-3 mb-4">
                                <h5 class="mb-3">Permissões de acesso</h5>

                                <div class="mb-3">
                                    <label for="tipo_acesso" class="form-label">
                                        Perfil de acesso
                                    </label>

                                    <select
                                        name="tipo_acesso"
                                        class="form-select"
                                        id="tipo_acesso"
                                        required
                                    >
                                        <option
                                            value="0"
                                            <?= (string)($users['tipo_acesso'] ?? '') === '0' ? 'selected' : '' ?>
                                        >
                                            Administrador
                                        </option>

                                        <option
                                            value="1"
                                            <?= (string)($users['tipo_acesso'] ?? '') === '1' ? 'selected' : '' ?>
                                        >
                                            Cliente
                                        </option>
                                    </select>

                                    <small class="text-muted">
                                        O cadastro público deve criar contas como Cliente.
                                        Reserve o perfil Administrador para pessoas autorizadas.
                                    </small>
                                </div>
                            </div>

                            <!-- FOTO -->
                            <div class="border rounded p-3 mb-4">
                                <h5 class="mb-3">Foto do usuário</h5>

                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-3">
                                        <?php if (!empty($users['foto'])): ?>
                                            <img
                                                id="preview"
                                                src="./app/views/fotos/<?= rawurlencode(basename($users['foto'])) ?>"
                                                alt="Foto do usuário"
                                                class="rounded-circle mb-2"
                                                style="width: 120px; height: 120px; object-fit: cover;"
                                            >
                                        <?php else: ?>
                                            <img
                                                id="preview"
                                                src="./img/sem_imagem.png"
                                                alt="Sem foto cadastrada"
                                                class="rounded-circle mb-2"
                                                style="width: 120px; height: 120px; object-fit: cover;"
                                            >
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-8 mb-3">
                                        <label for="foto" class="form-label">
                                            Alterar foto (opcional)
                                        </label>

                                        <input
                                            type="file"
                                            class="form-control"
                                            id="foto"
                                            name="foto"
                                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                        >

                                        <small class="form-text text-muted">
                                            Formatos aceitos: JPG, JPEG, PNG e WEBP.
                                            Deixe vazio para manter a foto atual.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- LOGIN -->
                            <div class="border rounded p-3 mb-4">
                                <h5 class="mb-3">Dados de login</h5>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        E-mail
                                    </label>

                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="<?= htmlspecialchars($users['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        maxlength="50"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="senha" class="form-label">
                                        Nova senha (opcional)
                                    </label>

                                    <div class="input-group">
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="senha"
                                            name="senha"
                                            placeholder="Digite uma nova senha"
                                            minlength="6"
                                            maxlength="20"
                                            autocomplete="new-password"
                                        >

                                        <button
                                            class="btn btn-outline-secondary"
                                            type="button"
                                            id="toggleSenha"
                                            aria-label="Mostrar ou ocultar senha"
                                        >
                                            <i class="fa fa-eye-slash" id="iconSenha"></i>
                                        </button>
                                    </div>

                                    <small class="form-text text-muted">
                                        Deixe em branco para manter a senha atual.
                                        A nova senha deve ter entre 6 e 20 caracteres.
                                    </small>
                                </div>
                            </div>

                            <!-- BOTÕES -->
                            <div class="d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i>
                                    Salvar alterações
                                </button>

                                <a href="?url=listUser" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i>
                                    Voltar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const senhaInput = document.getElementById('senha');
    const toggleSenha = document.getElementById('toggleSenha');
    const iconSenha = document.getElementById('iconSenha');
    const fotoInput = document.getElementById('foto');
    const preview = document.getElementById('preview');

    // Mostrar ou ocultar senha
    toggleSenha.addEventListener('click', function () {
        const mostrar = senhaInput.type === 'password';

        senhaInput.type = mostrar ? 'text' : 'password';

        iconSenha.classList.toggle('fa-eye', mostrar);
        iconSenha.classList.toggle('fa-eye-slash', !mostrar);
    });

    // Pré-visualizar nova foto
    fotoInput.addEventListener('change', function () {
        const arquivo = this.files && this.files[0];

        if (!arquivo) {
            return;
        }

        const formatosPermitidos = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!formatosPermitidos.includes(arquivo.type)) {
            alert('Selecione uma imagem JPG, JPEG, PNG ou WEBP.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (evento) {
            preview.src = evento.target.result;
        };

        reader.readAsDataURL(arquivo);
    });
});
</script>
