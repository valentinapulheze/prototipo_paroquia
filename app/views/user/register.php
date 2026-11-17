<?php
$erroCadastro = $error ?? null;
?>

<style>
    /* Estrutura geral */
    main.cadastro-page {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1 0 auto;
        width: 100%;
        min-height: 650px;
        padding: 48px 20px;
        background:
            radial-gradient(ellipse at top, #fffdf8 0%, transparent 65%),
            linear-gradient(135deg, #faf7ef 0%, #eee3cb 100%);
        box-sizing: border-box;
    }

    main.cadastro-page * {
        box-sizing: border-box;
    }

    /* Cartão */
    .cadastro-card {
        width: 100%;
        max-width: 650px;
        margin: 0 auto;
        overflow: hidden;
        background: #fff;
        border: 1px solid #e5d7b8;
        border-radius: 20px;
        box-shadow: 0 14px 40px rgba(77, 58, 26, .13);
    }

    /* Cabeçalho dourado */
    .cadastro-header {
        padding: 28px 24px;
        text-align: center;
        color: #fff;
        background: linear-gradient(135deg, #76551d, #b99a55);
    }

    /* Ícone SVG de Nossa Senhora Aparecida */
    .cadastro-simbolo {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        margin: 0 auto 5px;
        color: #fff8e8;
        flex-shrink: 0;
    }

    .cadastro-simbolo svg {
        display: block;
        width: 100%;
        height: 100%;
    }

    .cadastro-header h2 {
        margin: 0 0 8px;
        font-size: 28px;
        font-weight: 700;
    }

    .cadastro-header p {
        margin: 0;
        color: #fff8e8;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Formulário */
    .cadastro-body {
        padding: 32px;
        color: #39352d;
    }

    .cadastro-body .form-label {
        display: block;
        margin-bottom: 8px;
        color: #51452f;
        font-size: 14px;
        font-weight: 600;
    }

    .cadastro-body .form-control {
        display: block;
        width: 100%;
        min-height: 48px;
        padding: 12px 14px;
        color: #332f28;
        background: #fffefa;
        border: 1px solid #ddd5c4;
        border-radius: 10px;
        box-shadow: none;
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .cadastro-body .form-control:focus {
        border-color: #aa8740;
        box-shadow: 0 0 0 3px rgba(170, 135, 64, .15);
        outline: none;
    }

    .cadastro-body .form-control::placeholder {
        color: #a49b8a;
    }

    /* Foto de perfil */
    .cadastro-foto {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 24px;
        padding: 18px;
        background: #fcfaf5;
        border: 1px dashed #c7ad70;
        border-radius: 13px;
    }

    .cadastro-preview {
        display: block;
        flex: 0 0 78px;
        width: 78px;
        height: 78px;
        object-fit: cover;
        background: #f0e8d5;
        border: 2px solid #d2bc83;
        border-radius: 50%;
    }

    .cadastro-foto-info {
        flex: 1;
        min-width: 0;
    }

    .cadastro-foto-info p {
        margin: 0 0 8px;
        color: #51452f;
        font-weight: 600;
    }

    .cadastro-foto-info .form-control {
        min-height: auto;
        padding: 9px;
        background: #fff;
        font-size: 12px;
    }

    .cadastro-foto-info small {
        display: block;
        margin-top: 7px;
        color: #817969;
        font-size: 12px;
        line-height: 1.5;
    }

    /* Botão de cadastro */
    .cadastro-btn {
        display: block;
        width: 100%;
        min-height: 50px;
        padding: 12px 18px;
        color: #fff;
        background: linear-gradient(135deg, #806021, #b99a55);
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: box-shadow .2s, filter .2s, transform .2s;
    }

    .cadastro-btn:hover {
        color: #fff;
        filter: brightness(.96);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(128, 96, 33, .2);
    }

    .cadastro-btn:focus-visible {
        outline: 3px solid #d7bd7d;
        outline-offset: 3px;
    }

    /* Link para login */
    .cadastro-login {
        margin: 22px 0 0;
        color: #706958;
        text-align: center;
        font-size: 14px;
        line-height: 1.7;
    }

    .cadastro-login a {
        color: #8b6927;
        font-weight: 700;
        text-decoration: none;
    }

    .cadastro-login a:hover {
        text-decoration: underline;
    }

    .cadastro-nota {
        margin: 16px 0 0;
        color: #817969;
        text-align: center;
        font-size: 12px;
        line-height: 1.6;
    }

    /* Mensagens */
    .cadastro-alerta {
        margin-bottom: 22px;
        padding: 13px 15px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.5;
    }

    /* Rodapé */
    footer {
        flex-shrink: 0;
    }

    /* Responsividade */
    @media (max-width: 576px) {
        main.cadastro-page {
            min-height: auto;
            padding: 24px 12px;
        }

        .cadastro-card {
            border-radius: 15px;
        }

        .cadastro-header {
            padding: 24px 18px;
        }

        .cadastro-header h2 {
            font-size: 24px;
        }

        .cadastro-body {
            padding: 22px 18px;
        }

        .cadastro-foto {
            align-items: flex-start;
            flex-direction: column;
            gap: 13px;
            padding: 15px;
        }
    }

    @media (max-width: 360px) {
        .cadastro-body {
            padding: 18px 14px;
        }

        .cadastro-header h2 {
            font-size: 22px;
        }
    }
</style>

<main class="cadastro-page">
    <section class="cadastro-card">

        <header class="cadastro-header">

            <!-- Ícone vetorial de Nossa Senhora Aparecida -->
            <div
                class="cadastro-simbolo"
                role="img"
                aria-label="Nossa Senhora Aparecida"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 64 64"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <!-- Coroa -->
                    <path d="M23 13 18 5l9 5 5-7 5 7 9-5-5 8"/>
                    <path d="M23 13h18l-3 5H26z"/>
                    <circle cx="32" cy="5" r="1"/>

                    <!-- Manto -->
                    <path d="M25 19
                             C17 23 11 34 7 53
                             C16 49 24 55 32 60
                             C40 55 48 49 57 53
                             C53 34 47 23 39 19"/>

                    <!-- Rosto -->
                    <path d="M25 20
                             C25 16 28 14 32 14
                             C36 14 39 16 39 20
                             L37 28
                             C36 32 28 32 27 28z"/>

                    <!-- Pescoço -->
                    <path d="M28 32v4l4 4 4-4v-4"/>

                    <!-- Mãos em oração -->
                    <path d="M27 35 32 31 37 35"/>
                    <path d="M27 35 32 44 37 35"/>
                    <path d="M32 44v8"/>

                    <!-- Detalhes do manto -->
                    <path d="M17 32 22 37"/>
                    <path d="M47 32 42 37"/>
                    <path d="M14 43 21 45"/>
                    <path d="M50 43 43 45"/>

                    <!-- Base -->
                    <path d="M23 57h18"/>
                </svg>
            </div>

            <h2>Crie sua conta</h2>

            <p>
                Seja bem-vindo(a)! Preencha os dados abaixo
                para criar sua conta.
            </p>
        </header>

        <div class="cadastro-body">

            <?php if (!empty($erroCadastro)): ?>
                <div class="alert alert-danger cadastro-alerta" role="alert">
                    <?= htmlspecialchars(
                        $erroCadastro,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </div>
            <?php endif; ?>

            <form
                method="POST"
                enctype="multipart/form-data"
                id="formCadastro"
            >

                <!-- Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label">
                        Nome completo
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="nome"
                        name="nome"
                        placeholder="Digite seu nome completo"
                        autocomplete="name"
                        maxlength="150"
                        required
                        value="<?= htmlspecialchars(
                            $_POST['nome'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >
                </div>

                <!-- E-mail -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        E-mail
                    </label>

                    <input
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="voce@exemplo.com"
                        autocomplete="email"
                        maxlength="190"
                        required
                        value="<?= htmlspecialchars(
                            $_POST['email'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >
                </div>

                <!-- Telefone -->
                <div class="mb-3">
                    <label for="telefone" class="form-label">
                        Telefone ou WhatsApp
                    </label>

                    <input
                        type="tel"
                        class="form-control"
                        id="telefone"
                        name="telefone"
                        placeholder="(18) 99999-9999"
                        autocomplete="tel"
                        maxlength="20"
                        required
                        value="<?= htmlspecialchars(
                            $_POST['telefone'] ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >
                </div>

                <!-- Foto de perfil -->
                <div class="cadastro-foto">
                    <img
                        id="previewFoto"
                        class="cadastro-preview"
                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 78 78'%3E%3Crect width='78' height='78' rx='39' fill='%23f0e8d5'/%3E%3Ccircle cx='39' cy='28' r='13' fill='%23b99a55'/%3E%3Cpath d='M13 73c2-17 12-25 26-25s24 8 26 25' fill='%23b99a55'/%3E%3C/svg%3E"
                        alt="Pré-visualização da foto de perfil"
                    >

                    <div class="cadastro-foto-info">
                        <p>
                            Foto de perfil
                            <span class="fw-normal">(opcional)</span>
                        </p>

                        <input
                            type="file"
                            class="form-control"
                            id="foto"
                            name="foto"
                            accept="image/jpeg,image/png"
                        >

                        <small>
                            Formatos JPG ou PNG. Tamanho máximo: 3 MB.
                        </small>
                    </div>
                </div>

                <!-- Senha -->
                <div class="mb-3">
                    <label for="senha" class="form-label">
                        Crie uma senha
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        id="senha"
                        name="senha"
                        placeholder="Mínimo de 6 caracteres"
                        autocomplete="new-password"
                        minlength="6"
                        required
                    >
                </div>

                <!-- Confirmação de senha -->
                <div class="mb-4">
                    <label for="confirmar_senha" class="form-label">
                        Confirme sua senha
                    </label>

                    <input
                        type="password"
                        class="form-control"
                        id="confirmar_senha"
                        name="confirmar_senha"
                        placeholder="Digite a senha novamente"
                        autocomplete="new-password"
                        minlength="6"
                        required
                    >

                    <small
                        id="mensagemSenha"
                        class="text-danger d-none"
                    >
                        As senhas não coincidem.
                    </small>
                </div>

                <!-- Botão -->
                <button type="submit" class="cadastro-btn">
                    Criar minha conta
                </button>

                <p class="cadastro-login">
                    Já tem uma conta?
                    <a href="/paroquia_prototipo_com_link_cadastro/paroquia_prototipo/index.php?url=login">
                        Entrar
                    </a>
                </p>

                <p class="cadastro-nota">
                    Seus dados serão utilizados para criar sua conta.
                </p>

            </form>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formCadastro');
    const inputFoto = document.getElementById('foto');
    const previewFoto = document.getElementById('previewFoto');
    const senha = document.getElementById('senha');
    const confirmarSenha = document.getElementById('confirmar_senha');
    const mensagemSenha = document.getElementById('mensagemSenha');

    // Pré-visualização e validação da foto
    inputFoto.addEventListener('change', function () {
        const arquivo = this.files[0];

        if (!arquivo) {
            return;
        }

        const tiposPermitidos = ['image/jpeg', 'image/png'];

        if (!tiposPermitidos.includes(arquivo.type)) {
            alert('Selecione uma imagem JPG ou PNG válida.');
            this.value = '';
            return;
        }

        if (arquivo.size > 3 * 1024 * 1024) {
            alert('A foto deve ter no máximo 3 MB.');
            this.value = '';
            return;
        }

        const leitor = new FileReader();

        leitor.onload = function (evento) {
            previewFoto.src = evento.target.result;
        };

        leitor.readAsDataURL(arquivo);
    });

    // Confirmação de senha
    function verificarSenhas() {
        const diferentes =
            confirmarSenha.value !== '' &&
            senha.value !== confirmarSenha.value;

        mensagemSenha.classList.toggle('d-none', !diferentes);

        confirmarSenha.setCustomValidity(
            diferentes ? 'As senhas não coincidem.' : ''
        );
    }

    senha.addEventListener('input', verificarSenhas);
    confirmarSenha.addEventListener('input', verificarSenhas);

    form.addEventListener('submit', function (evento) {
        verificarSenhas();

        if (!form.checkValidity()) {
            evento.preventDefault();
            form.reportValidity();
        }
    });
});
</script>