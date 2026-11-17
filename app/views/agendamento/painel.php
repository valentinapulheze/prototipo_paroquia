
<?php
$agendamentos = $agendamentos ?? [];
$disponibilidades = $disponibilidades ?? [];
$datasIndisponiveis = $datasIndisponiveis ?? $disponibilidades;
?>

<div class="container py-5">

    <div class="mb-4">
        <h2 style="color: #003B61;">
            <i class="bi bi-calendar-check"></i>
            Gerenciamento de Confissões
        </h2>

        <p class="text-muted">
            Gerencie as datas sem atendimento e consulte os agendamentos realizados.
        </p>
    </div>

    <?php if (!empty($_SESSION['sucesso_agendamento'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['sucesso_agendamento']) ?>
        </div>
        <?php unset($_SESSION['sucesso_agendamento']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['erro_agendamento'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['erro_agendamento']) ?>
        </div>
        <?php unset($_SESSION['erro_agendamento']); ?>
    <?php endif; ?>

    <!-- CADASTRAR DATA INDISPONÍVEL -->

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-4">

            <h4 class="mb-2" style="color: #003B61;">
                <i class="bi bi-calendar-x"></i>
                Cadastrar data indisponível
            </h4>

            <p class="text-muted">
                Informe os dias em que não haverá atendimento de confissões.
            </p>

            <form action="<?= BASE_URL ?>/?url=cadastrarDisponibilidade"
                  method="POST">

                <div class="row g-3 align-items-end">

                    <div class="col-md-8">
                        <label for="data" class="form-label fw-semibold">
                            Data sem atendimento
                        </label>

                        <input type="date"
                               name="data"
                               id="data"
                               class="form-control"
                               min="<?= date('Y-m-d') ?>"
                               required>
                    </div>

                    <div class="col-md-4">
                        <button type="submit"
                                class="btn text-white w-100"
                                style="background: #003B61;">
                            <i class="bi bi-plus-circle"></i>
                            Bloquear data
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <!-- DATAS INDISPONÍVEIS -->

    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-body p-4">

            <h4 class="mb-3" style="color: #003B61;">
                <i class="bi bi-calendar-minus"></i>
                Datas indisponíveis
            </h4>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Responsável pelo bloqueio</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (empty($datasIndisponiveis)): ?>

                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhuma data indisponível cadastrada.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($datasIndisponiveis as $item): ?>

                            <tr>
                                <td>
                                    <?= date('d/m/Y', strtotime($item['data'])) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($item['nome'] ?? 'Administrador') ?>
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        Indisponível
                                    </span>
                                </td>

                                <td>
                                    <form action="<?= BASE_URL ?>/?url=liberar"
                                          method="POST"
                                          onsubmit="return confirm('Deseja liberar esta data para agendamentos?');">

                                        <input type="hidden"
                                               name="data"
                                               value="<?= htmlspecialchars($item['data'], ENT_QUOTES, 'UTF-8') ?>">

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-unlock"></i>
                                            Liberar data
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    <!-- AGENDAMENTOS REALIZADOS -->

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <h4 class="mb-3" style="color: #003B61;">
                <i class="bi bi-calendar2-check"></i>
                Agendamentos realizados
            </h4>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Observações</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (empty($agendamentos)): ?>

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhum agendamento realizado.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($agendamentos as $item): ?>

                            <tr>
                                <td>
                                    <?= htmlspecialchars($item['nome'] ?? 'Usuário') ?>
                                </td>

                                <td>
                                    <?= date('d/m/Y', strtotime($item['data'])) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(substr($item['hora_inicial'], 0, 5)) ?>
                                    às
                                    <?= htmlspecialchars(substr($item['hora_final'], 0, 5)) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($item['detalhamento'] ?? '-') ?>
                                </td>

                                <td>
                                    <form action="<?= BASE_URL ?>/?url=cancelarAgendamento"
                                          method="POST"
                                          onsubmit="return confirm('Deseja cancelar este agendamento?');">

                                        <input type="hidden"
                                               name="id_agendamento"
                                               value="<?= (int) $item['id_agendamento'] ?>">

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                            Cancelar
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>
