
<style>
    .painel-admin {
        padding: 40px;
        background: #f5f6f8;
        min-height: 100vh;
    }

    /* CABEÇALHO */
    .painel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .painel-header h1 {
        margin: 0;
        color: #003B61;
        font-size: 30px;
        font-weight: 700;
    }

    .painel-header p {
        margin-top: 8px;
        color: #666;
    }

    .btn-sair {
        background: #dc3545;
        color: white;
        text-decoration: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-sair:hover {
        color: white;
        opacity: .9;
    }

    /* BOAS-VINDAS */
    .boas-vindas {
        background: white;
        border-radius: 15px;
        padding: 25px 30px;
        margin-bottom: 25px;
        border-left: 5px solid #C8A961;
        box-shadow: 0 4px 15px rgba(0,0,0,.05);
    }

    .boas-vindas h2 {
        color: #003B61;
        font-size: 21px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .boas-vindas p {
        color: #666;
        margin: 0;
    }

    /* CARDS DE INDICADORES */
    .cards-resumo {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .card-resumo {
        background: white;
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,.06);
        border-bottom: 4px solid #C8A961;
    }

    .card-resumo .icone {
        width: 45px;
        height: 45px;
        background: #f0f3f5;
        color: #003B61;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .card-resumo h3 {
        color: #666;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .card-resumo h2 {
        color: #003B61;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
    }

    /* TÍTULOS DAS SEÇÕES */
    .titulo-secao {
        color: #003B61;
        font-size: 21px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    /* CARDS ADMINISTRATIVOS */
    .cards-admin {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .card-admin {
        background: white;
        border-radius: 15px;
        padding: 23px;
        box-shadow: 0 5px 18px rgba(0,0,0,.06);
        border-top: 5px solid #C8A961;
        transition: .3s;
    }

    .card-admin:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 22px rgba(0,0,0,.10);
    }

    .card-admin .icone {
        font-size: 27px;
        color: #C8A961;
        margin-bottom: 15px;
    }

    .card-admin h2 {
        color: #003B61;
        font-size: 19px;
        margin: 0 0 10px;
        font-weight: 700;
    }

    .card-admin p {
        color: #666;
        font-size: 14px;
        min-height: 42px;
        margin-bottom: 18px;
    }

    .btn-card {
        display: inline-block;
        background: #003B61;
        color: white;
        padding: 9px 15px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-card:hover {
        color: white;
        background: #002b46;
    }

    /* ÁREA DE EVENTOS E ATIVIDADES */
    .atividades {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,.06);
        margin-bottom: 35px;
    }

    .atividade-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .atividade-item:last-child {
        border-bottom: none;
    }

    .atividade-icone {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f0f3f5;
        color: #003B61;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 17px;
    }

    .atividade-item h4 {
        font-size: 15px;
        color: #003B61;
        margin: 0 0 4px;
    }

    .atividade-item p {
        font-size: 13px;
        color: #777;
        margin: 0;
    }

    .sem-registros {
        color: #777;
        font-size: 14px;
        padding: 15px 0;
        margin: 0;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 1100px) {
        .cards-resumo,
        .cards-admin {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .painel-admin {
            padding: 20px;
        }

        .cards-resumo,
        .cards-admin {
            grid-template-columns: 1fr;
        }

        .painel-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }
    }
</style>


<?php
// Evita erros caso alguma variável não seja enviada pelo controller
$totalUsuarios = $totalUsuarios ?? 0;
$totalAvisos = $totalAvisos ?? 0;
$totalEventos = $totalEventos ?? 0;
$totalProdutos = $totalProdutos ?? 0;
$proximosEventos = $proximosEventos ?? [];
?>

<div class="painel-admin">

    <!-- BOAS-VINDAS -->
    <div class="boas-vindas">

        <h2>Bem-vindo(a) ao painel administrativo!</h2>

        <p>
            Gerencie as informações, atividades e serviços
            da nossa paróquia em um só lugar.
        </p>

    </div>


    <!-- INDICADORES -->
    <h2 class="titulo-secao">Visão geral</h2>

    <div class="cards-resumo">

        <!-- USUÁRIOS -->
        <div class="card-resumo">

            <div class="icone">
                <i class="bi bi-people"></i>
            </div>

            <h3>Usuários cadastrados</h3>

            <h2><?= (int) $totalUsuarios ?></h2>

        </div>


        <!-- AVISOS -->
        <div class="card-resumo">

            <div class="icone">
                <i class="bi bi-megaphone"></i>
            </div>

            <h3>Avisos cadastrados</h3>

            <h2><?= (int) $totalAvisos ?></h2>

        </div>


        <!-- EVENTOS -->
        <div class="card-resumo">

            <div class="icone">
                <i class="bi bi-calendar-event"></i>
            </div>

            <h3>Eventos cadastrados</h3>

            <h2><?= (int) $totalEventos ?></h2>

        </div>


        <!-- PRODUTOS -->
        <div class="card-resumo">

            <div class="icone">
                <i class="bi bi-shop"></i>
            </div>

            <h3>Produtos cadastrados</h3>

            <h2><?= (int) $totalProdutos ?></h2>

        </div>

    </div>


    <!-- GERENCIAMENTO -->
    <h2 class="titulo-secao">Gerenciamento</h2>

    <div class="cards-admin">

        <!-- USUÁRIOS -->
        <div class="card-admin">

            <div class="icone">
                <i class="bi bi-people"></i>
            </div>

            <h2>Usuários</h2>

            <p>
                Gerencie os usuários e suas permissões de acesso.
            </p>
<a href="<?= BASE_URL ?>/?url=listUser" class="btn-card">
    Gerenciar
</a>
        </div>


        <!-- AVISOS -->
        <div class="card-admin">

            <div class="icone">
                <i class="bi bi-megaphone"></i>
            </div>

            <h2>Avisos</h2>

            <p>
                Cadastre, edite e gerencie os comunicados da paróquia.
            </p>

           <a href="<?= BASE_URL ?>/?url=avisos" class="btn-card">
    Gerenciar
</a>

        </div>


        <!-- AGENDA -->
        <div class="card-admin">

            <div class="icone">
                <i class="bi bi-calendar-event"></i>
            </div>

            <h2>Agenda</h2>

            <p>
                Organize eventos, missas e compromissos paroquiais.
            </p>

            <a href="<?= BASE_URL ?>/?url=agendamento" class="btn-card">
                Gerenciar <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        <!-- LOJINHA -->
        <div class="card-admin">

            <div class="icone">
                <i class="bi bi-shop"></i>
            </div>

            <h2>Lojinha</h2>

            <p>
                Gerencie os produtos e anúncios da loja paroquial.
            </p>

            <a href="<?= BASE_URL ?>/?url=listProduto" class="btn-card">
    Gerenciar
</a>

        </div>

    </div>


    <!-- PRÓXIMOS EVENTOS -->
    <h2 class="titulo-secao">Próximos eventos</h2>

    <div class="atividades">

        <?php if (!empty($proximosEventos)): ?>

            <?php foreach ($proximosEventos as $evento): ?>

                <div class="atividade-item">

                    <div class="atividade-icone">
                        <i class="bi bi-calendar-event"></i>
                    </div>

                    <div>

                        <h4>
                            <?= htmlspecialchars($evento['titulo'] ?? '') ?>
                        </h4>

                        <p>

                            <?= htmlspecialchars($evento['tipo'] ?? 'Evento') ?>

                            -

                            <?php
                            if (!empty($evento['data_inicio'])) {
                                echo date(
                                    'd/m/Y',
                                    strtotime($evento['data_inicio'])
                                );
                            }
                            ?>

                        </p>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p class="sem-registros">
                <i class="bi bi-calendar-x"></i>
                Nenhum evento futuro cadastrado.
            </p>

        <?php endif; ?>

    </div>


    <!-- ATIVIDADES RECENTES -->
    <h2 class="titulo-secao">Acessos administrativos</h2>

    <div class="atividades">

        <div class="atividade-item">

            <div class="atividade-icone">
                <i class="bi bi-megaphone"></i>
            </div>

            <div>
                <h4>Gerenciamento de avisos</h4>

                <p>
                    Acesse a área de comunicados da paróquia.
                </p>
            </div>

        </div>


        <div class="atividade-item">

            <div class="atividade-icone">
                <i class="bi bi-people"></i>
            </div>

            <div>
                <h4>Gerenciamento de usuários</h4>

                <p>
                    Consulte os usuários cadastrados no sistema.
                </p>
            </div>

        </div>


        <div class="atividade-item">

            <div class="atividade-icone">
                <i class="bi bi-shop"></i>
            </div>

            <div>
                <h4>Gerenciamento da lojinha</h4>

                <p>
                    Consulte os produtos disponíveis.
                </p>
            </div>

        </div>

    </div>

</div>
