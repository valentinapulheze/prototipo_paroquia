<?php
$agendamentos = $agendamentos ?? [];

// Filtra os agendamentos a partir da data atual
$hoje = date('Y-m-d');

$proximosAgendamentos = array_filter($agendamentos, function ($agendamento) use ($hoje) {
    return $agendamento['data'] >= $hoje;
});
?>

<style>
    .painel-admin {
        padding: 40px;
        background: #f5f6f8;
        min-height: 100vh;
    }

    .painel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
    }

    .painel-header h1 {
        margin: 0;
        color: #003B61;
        font-size: 32px;
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

    .cards-admin {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .card-admin {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 18px rgba(0,0,0,.08);
        text-decoration: none;
        transition: .3s;
        border-top: 5px solid #C8A961;
    }

    .card-admin:hover {
        transform: translateY(-5px);
    }

    .card-admin h2 {
        color: #003B61;
        margin: 0 0 10px;
    }

    .card-admin p {
        color: #666;
        margin: 0 0 20px;
    }

    .btn-card {
        display: inline-block;
        background: #003B61;
        color: white;
        padding: 9px 15px;
        border-radius: 7px;
        text-decoration: none;
    }

    .btn-card:hover {
        color: white;
        background: #002b46;
    }

    /* SEÇÃO DE EVENTOS */

    .eventos-admin {
        background: white;
        margin-top: 35px;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 5px 18px rgba(0,0,0,.08);
    }

    .eventos-admin h2 {
        color: #003B61;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .eventos-descricao {
        color: #666;
        margin-bottom: 25px;
    }

    .evento-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 18px;
        border: 1px solid #e5e5e5;
        border-left: 5px solid #C8A961;
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .evento-info h3 {
        color: #003B61;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .evento-info p {
        color: #666;
        margin: 4px 0;
        font-size: 14px;
    }

    .evento-data {
        background: #eaf7fb;
        color: #003B61;
        padding: 10px 15px;
        border-radius: 8px;
        text-align: center;
        min-width: 110px;
        font-weight: 600;
    }

    .evento-data strong {
        display: block;
        font-size: 19px;
    }

    .sem-eventos {
        text-align: center;
        padding: 30px;
        color: #777;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .sem-eventos i {
        font-size: 35px;
        color: #C8A961;
        display: block;
        margin-bottom: 10px;
    }

    .btn-ver-agendamentos {
        display: inline-block;
        margin-top: 15px;
        background: #003B61;
        color: white;
        text-decoration: none;
        padding: 10px 16px;
        border-radius: 7px;
    }

    .btn-ver-agendamentos:hover {
        background: #002b46;
        color: white;
    }

    @media (max-width: 900px) {
        .cards-admin {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .painel-admin {
            padding: 20px;
        }

        .cards-admin {
            grid-template-columns: 1fr;
        }

        .painel-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }

        .evento-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .evento-data {
            width: 100%;
        }
    }
</style>

<div class="painel-admin">

    <div class="painel-header">

        <div>
            <h1>Painel Administrativo</h1>

            <p>
                Administração da Paróquia Santo Anastácio
            </p>
        </div>

        <a
            href="<?= BASE_URL ?>/?url=logout"
            class="btn-sair"
            onclick="return confirm('Tem certeza de que deseja sair?');"
        >
            Sair
        </a>

    </div>

    <!-- CARDS ADMINISTRATIVOS -->

    <div class="cards-admin">

        <div class="card-admin">
            <h2>Usuários</h2>

            <p>
                Gerencie os usuários e suas permissões.
            </p>

            <a href="<?= BASE_URL ?>/?url=listUser" class="btn-card">
                Gerenciar
            </a>
        </div>

        <div class="card-admin">
            <h2>Avisos</h2>

            <p>
                Cadastre e gerencie os avisos da paróquia.
            </p>

            <a href="<?= BASE_URL ?>/?url=aviso" class="btn-card">
                Gerenciar
            </a>
        </div>

        <div class="card-admin">
            <h2>Agenda</h2>

            <p>
                Gerencie eventos e compromissos.
            </p>

            <a href="<?= BASE_URL ?>/?url=agenda" class="btn-card">
                Gerenciar
            </a>
        </div>

        <div class="card-admin">
            <h2>Lojinha</h2>

            <p>
                Gerencie produtos e anúncios da loja.
            </p>

            <a href="<?= BASE_URL ?>/?url=listProduto" class="btn-card">
                Gerenciar
            </a>
        </div>

    </div>

    <!-- EVENTOS E AGENDAMENTOS DE CONFISSÃO -->

    <div class="eventos-admin">

        <h2>
            <i class="bi bi-calendar-event me-2"></i>
            Próximas Confissões
        </h2>

        <p class="eventos-descricao">
            Agendamentos realizados pelos clientes.
        </p>

        <?php if (!empty($proximosAgendamentos)): ?>

            <?php foreach ($proximosAgendamentos as $agendamento): ?>

                <div class="evento-item">

                    <div class="evento-info">

                        <h3>
                            <i class="bi bi-person-circle me-1"></i>
                            <?= htmlspecialchars($agendamento['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <p>
                            <i class="bi bi-clock me-1"></i>

                            Horário:
                            <?= date('H:i', strtotime($agendamento['hora_inicial'])) ?>
                            às
                            <?= date('H:i', strtotime($agendamento['hora_final'])) ?>
                        </p>

                        <?php if (!empty($agendamento['detalhamento'])): ?>

                            <p>
                                <i class="bi bi-card-text me-1"></i>

                                <?= htmlspecialchars($agendamento['detalhamento'], ENT_QUOTES, 'UTF-8') ?>
                            </p>

                        <?php endif; ?>

                    </div>

                    <div class="evento-data">

                        <strong>
                            <?= date('d', strtotime($agendamento['data'])) ?>
                        </strong>

                        <?= date('m/Y', strtotime($agendamento['data'])) ?>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="sem-eventos">

                <i class="bi bi-calendar2-check"></i>

                <strong>Nenhuma confissão agendada.</strong>

                <p class="mb-0">
                    Quando um cliente realizar um agendamento, ele aparecerá aqui.
                </p>

            </div>

        <?php endif; ?>

        <a
            href="<?= BASE_URL ?>/?url=painelAgendamento"
            class="btn-ver-agendamentos"
        >
            <i class="bi bi-calendar-check me-1"></i>
            Ver todos os agendamentos
        </a>

    </div>

</div>