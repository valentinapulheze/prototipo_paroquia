
<style>
    /* Fundo da página */
    body {
        background-image:
            linear-gradient(
                135deg,
                rgba(250, 247, 239, 0.72),
                rgba(238, 227, 203, 0.78)
            ),
            url("./img/index_paroq.png");
        background-size: cover;
        background-attachment: fixed;
        min-height: 100vh;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* Cartão de login */
    .card {
        border: 1px solid #e5d7b8;
        border-radius: 20px;
        box-shadow: 0 14px 40px rgba(77, 58, 26, 0.16);
        margin-bottom: 40px;
        background: #fff;
        overflow: hidden;
    }

    .card-body {
        padding: 32px;
    }

    /* Título */
    .card-title {
        font-weight: 700;
        color: #76551d;
        font-size: 28px;
        margin-bottom: 28px !important;
    }

    .card-title i {
        color: #b99a55;
    }

    /* Labels */
    .form-label {
        color: #51452f;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* Campos de entrada */
    .input-group-text {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 46px;
        color: #8b6927;
        background: #faf7ef;
        border: 1px solid #ddd5c4;
        border-radius: 10px 0 0 10px;
    }

    .input-group .form-control {
        min-height: 48px;
        color: #332f28;
        background: #fffefa;
        border: 1px solid #ddd5c4;
        border-radius: 0 10px 10px 0;
        box-shadow: none;
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .input-group .form-control:focus {
        border-color: #aa8740;
        box-shadow: 0 0 0 3px rgba(170, 135, 64, 0.15);
        outline: none;
    }

    .form-control::placeholder {
        color: #a49b8a;
    }

    /* Botão principal */
    .btn-primary {
        min-height: 49px;
        color: #fff;
        background: linear-gradient(135deg, #806021, #b99a55);
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        transition: box-shadow .2s, filter .2s, transform .2s;
    }

    .btn-primary:hover {
        color: #fff;
        background: linear-gradient(135deg, #76551d, #a98743);
        filter: brightness(1.02);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(128, 96, 33, 0.22);
    }

    .btn-primary:focus-visible {
        outline: 3px solid #d7bd7d;
        outline-offset: 3px;
    }

    /* Botão de recuperação */
    .btn-secondary {
        min-height: 46px;
        color: #76551d;
        background: #faf7ef;
        border: 1px solid #e5d7b8;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        transition: background .2s, border-color .2s;
    }

    .btn-secondary:hover {
        color: #76551d;
        background: #f0e6d0;
        border-color: #c7ad70;
    }

    /* Checkbox */
    .form-check {
        padding-top: 2px;
    }

    .form-check-input {
        border-color: #c7ad70;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #98732e;
        border-color: #98732e;
    }

    .form-check-input:focus {
        border-color: #aa8740;
        box-shadow: 0 0 0 3px rgba(170, 135, 64, 0.15);
    }

    .form-check-label {
        color: #51452f;
        cursor: pointer;
        font-size: 14px;
    }

    /* Textos auxiliares */
    small {
        color: #817969;
        font-size: 12px;
    }

    .text-pink {
        color: #b99a55;
    }

    /* Ajuda do e-mail */
    .help-container {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .help-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        padding: 0;
        border-radius: 50%;
        border: 1px solid #c7ad70;
        background: #faf7ef;
        color: #76551d;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .help-button:hover {
        background: #eee3cb;
    }

    .help-text {
        display: none;
        position: absolute;
        top: 27px;
        left: 0;
        background: #fffefa;
        color: #51452f;
        padding: 10px 12px;
        border: 1px solid #e5d7b8;
        border-radius: 8px;
        box-shadow: 0 5px 16px rgba(77, 58, 26, 0.12);
        width: 200px;
        font-size: 12px;
        line-height: 1.5;
        z-index: 10;
    }

    .help-container:hover .help-text,
    .help-container:focus-within .help-text {
        display: block;
    }

    /* Link de cadastro */
    .cadastro-container {
        display: block;
        text-align: center;
        margin-top: 1.5rem;
        color: #706958;
        font-size: 14px;
    }

    .cadastro-link {
        display: inline-block;
        color: #8b6927;
        font-weight: 700;
        text-decoration: none;
        margin-left: 4px;
        transition: color .2s;
    }

    .cadastro-link:hover {
        color: #b99a55;
        text-decoration: underline;
    }

    /* Mensagem de erro */
    .card .alert-danger {
        color: #842029;
        background: #fff2f0;
        border: 1px solid #f1c7c3;
        border-radius: 10px;
        font-size: 14px;
    }

    /* Responsividade */
    @media (max-width: 576px) {
        .card {
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .card-body {
            padding: 24px 20px;
        }

        .card-title {
            font-size: 25px;
        }
    }
</style>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-0">
                <div class="card-body">

                    <h2 class="card-title text-center">
                        <i class="bi bi-shield-lock me-2"></i>Login
                    </h2>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <!-- E-mail -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <label for="email" class="form-label mb-0">
                                    E-mail
                                </label>

                                <div class="help-container">
                                    <button
                                        type="button"
                                        class="help-button"
                                        aria-label="Ajuda sobre o e-mail"
                                    >?</button>

                                    <div class="help-text">
                                        O e-mail deve corresponder a uma conta já existente.
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="seu@email.com"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Senha -->
                        <div class="mb-3">
                            <label for="senha" class="form-label">
                                Senha
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="senha"
                                    name="senha"
                                    placeholder="••••••"
                                    minlength="6"
                                    maxlength="20"
                                    required
                                >
                            </div>

                            <small class="ms-1 d-block mt-2">
                                Deve ter entre 6 e 20 caracteres.
                            </small>
                        </div>

                        <!-- Mostrar senha -->
                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="showPassword"
                            >

                            <label
                                class="form-check-label"
                                for="showPassword"
                            >
                                Mostrar senha
                            </label>
                        </div>

                        <!-- Botões -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                Entrar
                            </button>

                            <a href="./recuperaLogin" class="btn btn-secondary">
                                <i class="bi bi-key-fill me-1"></i>
                                Esqueceu a senha?
                            </a>
                        </div>
                    </form>

                    <!-- Cadastro -->
                    <div class="text-center mt-4 mb-2 cadastro-container">
                        <span>Não tem uma conta?</span>

                        <a
                            href="index.php?url=register"
                            class="cadastro-link"
                        >
                            Cadastre-se aqui
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<!-- Mostrar ou ocultar senha -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('senha');

    showPasswordCheckbox.addEventListener('change', function () {
        passwordInput.type = this.checked ? 'text' : 'password';
    });
});
</script>
