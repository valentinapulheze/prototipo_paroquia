
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$estaLogado = isset($_SESSION['logged']) && $_SESSION['logged'] === true;
$tipoAcesso = $_SESSION['user_tipo_acesso'] ?? null;
$nomeUsuario = $_SESSION['user_nome'] ?? 'Usuário';

$base = defined('BASE_URL') ? BASE_URL : '/paroquia_prototipo';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?= $base ?>/img/icons8-igreja-50.png" type="image/x-icon">

    <title>Paróquia Santo Anastácio</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bibliotecas -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= $base ?>/css/avisos.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            padding-bottom: 20px;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        .sofistic {
            color: #003B61;
        }

        /* CABEÇALHO PRINCIPAL */

        .navbar-principal {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e5e5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            padding: 12px 25px;
            margin-bottom: 0;
        }

        .navbar-principal .container-fluid {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-principal .navbar-brand {
            display: flex;
            align-items: center;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .navbar-principal .navbar-brand img {
            width: 48px;
            height: 48px;
            object-fit: cover;
        }

        .navbar-principal .navbar-brand span {
            color: #003B61;
            font-size: 23px;
            line-height: 1.15;
        }

        .navbar-principal .navbar-collapse {
            justify-content: flex-end;
        }

        .navbar-principal .navbar-nav {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 5px;
        }

        .navbar-principal .nav-link {
            color: #003B61 !important;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 12px !important;
            border-radius: 8px;
            transition: 0.2s;
        }

        .navbar-principal .nav-link:hover {
            background-color: #eaf7fb;
            color: #0083a9 !important;
        }

        .navbar-principal .btn {
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            padding: 9px 13px;
        }

        .navbar-principal .dropdown-menu {
            border: none;
            border-radius: 10px;
            padding: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .navbar-principal .dropdown-item {
            border-radius: 6px;
            padding: 9px 12px;
        }

        /* FAIXA DE IDENTIFICAÇÃO DO USUÁRIO */

        .usuario-header {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            width: 100%;
            min-height: 55px;
            padding: 7px 25px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e5e5e5;
        }

        .usuario-avatar {
            width: 36px;
            height: 36px;
            background-color: #003B61;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 15px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .usuario-informacoes {
            display: flex;
            flex-direction: column;
            text-align: right;
        }

        .usuario-informacoes small {
            color: #444;
            font-size: 11px;
        }

        .usuario-tipo {
            color: #003B61 !important;
            font-weight: bold;
        }

        .usuario-foto {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* BOTÃO DO MENU */

        .navbar-principal .navbar-toggler {
            border-color: #003B61;
        }

        .navbar-principal .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 59, 97, 0.2);
        }

        /* BOTÃO SAIR */

        .navbar-principal .btn-sair {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            color: #dc3545 !important;
            border: 1px solid #dc3545;
            background-color: transparent;
            text-decoration: none;
            padding: 9px 13px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .navbar-principal .btn-sair:hover {
            color: #ffffff !important;
            background-color: #dc3545;
        }

        /* RESPONSIVIDADE */

        @media (max-width: 1199px) {
            .navbar-principal .container-fluid {
                flex-wrap: wrap;
            }

            .navbar-principal .navbar-collapse {
                width: 100%;
                flex-basis: 100%;
            }

            .navbar-principal .navbar-nav {
                align-items: stretch;
                padding-top: 12px;
                gap: 3px;
            }

            .navbar-principal .nav-link {
                display: block;
                width: 100%;
            }

            .navbar-principal .navbar-nav .btn {
                display: block;
                width: 100%;
                text-align: left;
                margin-top: 4px;
            }

            .navbar-principal .navbar-nav .btn-sair {
                display: flex !important;
                width: 100%;
                justify-content: flex-start;
                margin-top: 4px;
            }
        }

        @media (max-width: 480px) {
            .navbar-principal {
                padding: 10px 12px;
            }

            .navbar-principal .navbar-brand span {
                font-size: 19px;
            }

            .navbar-principal .navbar-brand img {
                width: 42px;
                height: 42px;
            }

            .usuario-header {
                padding-right: 12px;
            }
        }
    </style>
</head>

<body>

<!-- ================================== -->
<!-- CABEÇALHO PRINCIPAL -->
<!-- ================================== -->

<nav class="navbar navbar-expand-xl navbar-principal">

    <div class="container-fluid">

        <!-- LOGO -->

        <a class="navbar-brand" href="<?= $base ?>/?url=home">

            <img
                src="<?= $base ?>/img/logo_paroq.jpg"
                alt="Logo da Paróquia"
                class="rounded-circle me-2"
            >

            <span class="fw-bold">
                Paróquia<br>Santo Anastácio
            </span>

        </a>

        <!-- BOTÃO MOBILE -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Abrir menu"
        >

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- LINKS DO MENU -->

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <?php if (!$estaLogado): ?>

                    <!-- MENU VISITANTE -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=home">
                            <i class="bi bi-house-door me-1"></i>
                            Início
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=avisos">
                            <i class="bi bi-megaphone me-1"></i>
                            Avisos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=loja">
                            <i class="bi bi-shop me-1"></i>
                            Lojinha
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=dizimo">
                            <i class="bi bi-heart me-1"></i>
                            Dízimo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=sobre">
                            Sobre
                        </a>
                    </li>

                    <!-- NOSSO PADROEIRO -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=padroeiro">
                            <i class="bi bi-cross me-1"></i>
                            Nosso Padroeiro
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=contato">
                            <i class="bi bi-telephone me-1"></i>
                            Contato
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-primary" href="<?= $base ?>/?url=login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login
                        </a>
                    </li>

                <?php elseif ((string) $tipoAcesso === '0'): ?>

                    <!-- MENU ADMINISTRADOR -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=home">
                            <i class="bi bi-house-door me-1"></i>
                            Início
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=dashboard">
                            <i class="bi bi-speedometer2 me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="cadastrosDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Cadastros
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">

                            <li>
                                <a class="dropdown-item" href="<?= $base ?>/?url=listUser">
                                    <i class="bi bi-people me-2"></i>
                                    Usuários
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="<?= $base ?>/?url=aviso">
                                    <i class="bi bi-megaphone me-2"></i>
                                    Avisos
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="<?= $base ?>/?url=listProduto">
                                    <i class="bi bi-shop me-2"></i>
                                    Lojinha
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="movimentacoesDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Movimentações
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">

                            <li>
                                <a class="dropdown-item" href="<?= $base ?>/?url=painelAgendamento">
                                    <i class="bi bi-calendar-check me-2"></i>
                                    Agendamento de Confissões
                                </a>
                            </li>

                        </ul>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=perfil">
                            <i class="bi bi-person-circle me-1"></i>
                            Perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="btn-sair"
                            href="<?= $base ?>/?url=logout"
                            onclick="return confirm('Tem certeza de que deseja sair do site?');"
                        >
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Sair
                        </a>
                    </li>

                <?php elseif ((string) $tipoAcesso === '1'): ?>

                    <!-- MENU CLIENTE -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=home">
                            <i class="bi bi-house-door me-1"></i>
                            Início
                        </a>
                    </li>

                    <!-- NOSSO PADROEIRO -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=padroeiro">
                            <i class="bi bi-cross me-1"></i>
                            Nosso Padroeiro
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=loja">
                            <i class="bi bi-shop me-1"></i>
                            Lojinha
                        </a>
                    </li>

                    <!-- AGENDAMENTO -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=agendamento">
                            <i class="bi bi-calendar-check me-1"></i>
                            Agendamento de Confissão
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=avisosPublicos">
                            <i class="bi bi-megaphone me-1"></i>
                            Avisos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=eventosPublicos">
                            <i class="bi bi-calendar-event me-1"></i>
                            Eventos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=perfil">
                            <i class="bi bi-person-circle me-1"></i>
                            Perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="btn-sair"
                            href="<?= $base ?>/?url=logout"
                            onclick="return confirm('Tem certeza de que deseja sair do site?');"
                        >
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Sair
                        </a>
                    </li>

                <?php else: ?>

                    <!-- OUTROS USUÁRIOS LOGADOS -->

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=home">
                            Início
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/?url=perfil">
                            Meu perfil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="btn-sair"
                            href="<?= $base ?>/?url=logout"
                            onclick="return confirm('Tem certeza de que deseja sair do site?');"
                        >
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Sair
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>

</nav>

<!-- ================================== -->
<!-- IDENTIFICAÇÃO DO USUÁRIO -->
<!-- ================================== -->

<?php if ($estaLogado): ?>

    <div class="usuario-header">

        <div class="usuario-avatar">

            <?= htmlspecialchars(
                mb_strtoupper(mb_substr($nomeUsuario, 0, 1)),
                ENT_QUOTES,
                'UTF-8'
            ); ?>

        </div>

        <div class="usuario-informacoes">

            <small>
                Bem-vindo,
                <strong>
                    <?= htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8'); ?>
                </strong>!
            </small>

            <small class="usuario-tipo">

                <?php
                if ((string) $tipoAcesso === '0') {
                    echo 'Administrador';
                } elseif ((string) $tipoAcesso === '1') {
                    echo 'Cliente';
                } else {
                    echo 'Usuário';
                }
                ?>

            </small>

        </div>

        <?php if (!empty($_SESSION['user_foto'])): ?>

            <img
                src="<?= $base ?>/app/views/fotos/<?= htmlspecialchars(
                    basename($_SESSION['user_foto']),
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                alt="Foto do usuário"
                class="usuario-foto"
            >

        <?php endif; ?>

    </div>

<?php endif; ?>

<!-- O CONTEÚDO DAS PÁGINAS COMEÇA DEPOIS DESTE ARQUIVO -->
</body>
</html>
