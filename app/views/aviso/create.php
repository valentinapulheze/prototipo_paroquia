
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Novo Aviso | Paróquia</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --azul: #003B61;
            --azul-hover: #002c49;
            --dourado: #C8A961;
            --fundo: #f3f5f8;
            --texto: #263445;
        }

        body {
            background: var(--fundo);
            font-family: 'Poppins', Arial, sans-serif;
            color: var(--texto);
            min-height: 100vh;
        }

        .pagina {
            max-width: 950px;
            margin: 0 auto;
            padding: 45px 20px;
        }

        .cabecalho {
            margin-bottom: 25px;
        }

        .etiqueta {
            display: inline-block;
            background: #f5ead0;
            color: #806321;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .cabecalho h1 {
            color: var(--azul);
            font-size: clamp(26px, 4vw, 34px);
            font-weight: 700;
            margin-bottom: 8px;
        }

        .cabecalho p {
            color: #718096;
            margin-bottom: 0;
            font-size: 14px;
        }

        .card-form {
            background: #fff;
            border: 1px solid #e8ecf1;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 10px 35px rgba(25, 45, 65, 0.07);
        }

        .secao-titulo {
            font-size: 16px;
            font-weight: 600;
            color: var(--azul);
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #344256;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 1px solid #dce2e9;
            border-radius: 9px;
            padding: 12px 14px;
            font-size: 14px;
            color: var(--texto);
            background-color: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--dourado);
            box-shadow: 0 0 0 3px rgba(200, 169, 97, 0.17);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 110px;
        }

        .ajuda {
            color: #8490a0;
            font-size: 12px;
            margin-top: 6px;
        }

        .linha {
            border: 0;
            border-top: 1px solid #edf0f4;
            margin: 26px 0;
        }

        .opcao-destaque {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #fbf8f0;
            border: 1px solid #eee3c6;
            border-radius: 10px;
        }

        .opcao-destaque .form-check-input {
            width: 18px;
            height: 18px;
            margin: 0;
            cursor: pointer;
        }

        .opcao-destaque .form-check-input:checked {
            background-color: var(--dourado);
            border-color: var(--dourado);
        }

        .opcao-destaque label {
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: #594a2c;
        }

        .botoes {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            border-radius: 9px;
            padding: 11px 20px;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-salvar {
            background: var(--azul);
            color: #fff;
            border: 1px solid var(--azul);
        }

        .btn-salvar:hover {
            background: var(--azul-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-cancelar {
            background: #fff;
            color: #5d6877;
            border: 1px solid #dce2e9;
        }

        .btn-cancelar:hover {
            background: #f3f5f8;
            color: var(--azul);
        }

        .alert {
            border-radius: 10px;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            .pagina {
                padding: 25px 14px;
            }

            .card-form {
                padding: 22px 18px;
                border-radius: 14px;
            }

            .botoes {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .botoes .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="pagina">

    <div class="cabecalho">
        

        <h1>Novo Aviso</h1>

        <p>
            Preencha as informações abaixo para cadastrar um aviso
            para a comunidade paroquial.
        </p>
    </div>

    <?php if (!empty($_SESSION['erro'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['erro'], ENT_QUOTES, 'UTF-8') ?>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Fechar"></button>
        </div>

        <?php unset($_SESSION['erro']); ?>
    <?php endif; ?>

    <div class="card-form">

        <form method="POST"
              action="<?= BASE_URL ?>/?url=saveAviso"
              enctype="multipart/form-data">

            <h2 class="secao-titulo">Informações do aviso</h2>

            <div class="mb-4">
                <label for="titulo" class="form-label">
                    Título <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    class="form-control"
                    maxlength="45"
                    placeholder="Ex.: Missa especial de domingo"
                    required>
            </div>

            <div class="mb-4">
                <label for="detalhamento" class="form-label">
                    Detalhamento <span class="text-danger">*</span>
                </label>

                <textarea
                    id="detalhamento"
                    name="detalhamento"
                    class="form-control"
                    rows="3"
                    maxlength="100"
                    placeholder="Escreva um breve resumo do aviso..."
                    required></textarea>

                <div class="ajuda">
                    Máximo de 100 caracteres.
                </div>
            </div>

            <div class="mb-4">
                <label for="mensagem" class="form-label">
                    Mensagem completa
                </label>

                <textarea
                    id="mensagem"
                    name="mensagem"
                    class="form-control"
                    rows="5"
                    placeholder="Adicione datas, horários, local e outras informações importantes..."></textarea>

                <div class="ajuda">
                    Campo opcional. Use este espaço para fornecer mais detalhes.
                </div>
            </div>

            <div class="mb-4">
                <label for="foto" class="form-label">
                    Foto do aviso
                </label>

                <input
                    type="file"
                    id="foto"
                    name="foto"
                    class="form-control"
                    accept=".jpg,.jpeg,.png,.gif,.webp">

                <div class="ajuda">
                    Opcional. Formatos permitidos: JPG, PNG, GIF e WEBP. Máximo de 5 MB.
                </div>
            </div>

            <hr class="linha">

            <h2 class="secao-titulo">Classificação e validade</h2>

            <div class="row g-4">

                <div class="col-md-6">
                    <label for="categoria" class="form-label">
                        Categoria <span class="text-danger">*</span>
                    </label>

                    <select
                        id="categoria"
                        name="categoria"
                        class="form-select"
                        required>
                        <option value="geral">Geral</option>
                        <option value="missa">Missa</option>
                        <option value="evento">Evento</option>
                        <option value="pastoral">Pastoral</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="data_expiracao" class="form-label">
                        Data de expiração
                    </label>

                    <input
                        type="date"
                        id="data_expiracao"
                        name="data_expiracao"
                        class="form-control">

                    <div class="ajuda">
                        Opcional: data em que o aviso deixa de ser válido.
                    </div>
                </div>

            </div>

            <div class="opcao-destaque mt-4">
                <input
                    type="checkbox"
                    id="destaque"
                    name="destaque"
                    value="1"
                    class="form-check-input">

                <div>
                    <label for="destaque">
                        Destacar este aviso
                    </label>

                    <div class="ajuda">
                        Indica que este aviso deve receber destaque no sistema.
                    </div>
                </div>
            </div>

            <div class="botoes">
                <a href="<?= BASE_URL ?>/?url=aviso"
                   class="btn btn-cancelar">
                    Cancelar
                </a>

                <button type="submit" class="btn btn-salvar">
                    Salvar aviso
                </button>
            </div>

        </form>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
