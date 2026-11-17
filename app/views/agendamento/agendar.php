
<?php
$diasBloqueados = $diasBloqueados ?? [];
$agendamentos = $agendamentos ?? [];

// Formata as datas bloqueadas
$diasBloqueados = array_map(function ($data) {
    return date('Y-m-d', strtotime($data));
}, $diasBloqueados);

// Organiza os horários já ocupados
$horariosOcupados = [];

foreach ($agendamentos as $agendamento) {
    $data = date('Y-m-d', strtotime($agendamento['data']));
    $hora = substr($agendamento['hora_inicial'], 0, 5);

    $horariosOcupados[$data][] = $hora;
}

// Organiza as datas para exibição
$diasBloqueadosExibicao = array_unique($diasBloqueados);
sort($diasBloqueadosExibicao);
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <i class="bi bi-calendar-check"
                           style="font-size: 45px; color: #C8A961;"></i>

                        <h2 class="mt-3" style="color: #003B61;">
                            Agendamento de Confissão
                        </h2>

                        <p class="text-muted">
                            Escolha uma data e o horário desejado.
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

                    <form action="<?= BASE_URL ?>/?url=salvarAgendamento"
                          method="POST">

                        <!-- DATA -->
                        <div class="mb-3">
                            <label for="data" class="form-label fw-semibold">
                                Data do agendamento
                            </label>

                            <input type="date"
                                   name="data"
                                   id="data"
                                   class="form-control"
                                   min="<?= date('Y-m-d') ?>"
                                   required>

                            <small class="text-muted">
                                Escolha uma data futura que não esteja bloqueada.
                            </small>

                            <!-- LISTA DE DATAS INDISPONÍVEIS -->
                            <?php if (!empty($diasBloqueadosExibicao)): ?>
                                <div class="mt-3 p-3 rounded-3"
                                     style="background-color: #fff3f3; border: 1px solid #f1cccc;">

                                    <strong class="text-danger">
                                        <i class="bi bi-calendar-x"></i>
                                        Datas indisponíveis:
                                    </strong>

                                    <ul class="mb-0 mt-2">
                                        <?php foreach ($diasBloqueadosExibicao as $dataBloqueada): ?>
                                            <li>
                                                <?= date('d/m/Y', strtotime($dataBloqueada)) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="mt-3 p-3 rounded-3"
                                     style="background-color: #f0f8f2; border: 1px solid #cce5d1;">

                                    <small class="text-success">
                                        <i class="bi bi-check-circle"></i>
                                        Não existem datas indisponíveis cadastradas.
                                    </small>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- HORÁRIO -->
                        <div class="mb-3">
                            <label for="hora" class="form-label fw-semibold">
                                Horário desejado
                            </label>

                            <select name="hora"
                                    id="hora"
                                    class="form-select"
                                    required
                                    disabled>

                                <option value="">
                                    Primeiro selecione uma data
                                </option>

                            </select>

                            <small class="text-muted">
                                Os atendimentos acontecem das 06h às 18h,
                                em horários de uma hora.
                            </small>
                        </div>

                        <!-- OBSERVAÇÕES -->
                        <div class="mb-4">
                            <label for="detalhamento"
                                   class="form-label fw-semibold">
                                Observações (opcional)
                            </label>

                            <textarea name="detalhamento"
                                      id="detalhamento"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Informações adicionais, se necessário."></textarea>
                        </div>

                        <!-- BOTÃO -->
                        <button type="submit"
                                id="btnAgendar"
                                class="btn w-100 text-white py-2"
                                style="background-color: #003B61;"
                                disabled>

                            Confirmar agendamento
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Datas bloqueadas pelo administrador
const diasBloqueados = <?= json_encode(array_values($diasBloqueadosExibicao)) ?>;

// Horários que já possuem agendamento
const horariosOcupados = <?= json_encode($horariosOcupados) ?>;

const dataInput = document.getElementById('data');
const horaSelect = document.getElementById('hora');
const btnAgendar = document.getElementById('btnAgendar');

dataInput.addEventListener('change', function () {

    const dataSelecionada = this.value;

    horaSelect.innerHTML = '';
    horaSelect.disabled = true;
    btnAgendar.disabled = true;

    if (!dataSelecionada) {
        horaSelect.innerHTML =
            '<option value="">Primeiro selecione uma data</option>';
        return;
    }

    // Verifica se a data foi bloqueada pelo administrador
    if (diasBloqueados.includes(dataSelecionada)) {

        horaSelect.innerHTML =
            '<option value="">Data indisponível</option>';

        alert('Essa data não possui atendimento. Escolha outra data.');

        this.value = '';

        return;
    }

    const ocupados = horariosOcupados[dataSelecionada] || [];

    const opcaoInicial = document.createElement('option');
    opcaoInicial.value = '';
    opcaoInicial.textContent = 'Selecione um horário';

    horaSelect.appendChild(opcaoInicial);

    let quantidadeDisponivel = 0;

    // Horários de início: 06h até 17h
    // Cada atendimento dura uma hora.
    for (let hora = 6; hora < 18; hora++) {

        const horario = String(hora).padStart(2, '0') + ':00';

        const opcao = document.createElement('option');

        opcao.value = horario;
        opcao.textContent = horario;

        if (ocupados.includes(horario)) {

            opcao.textContent += ' - Ocupado';
            opcao.disabled = true;

        } else {

            quantidadeDisponivel++;
        }

        horaSelect.appendChild(opcao);
    }

    if (quantidadeDisponivel === 0) {

        horaSelect.innerHTML =
            '<option value="">Todos os horários estão ocupados</option>';

        horaSelect.disabled = true;

        return;
    }

    horaSelect.disabled = false;
});

// Habilita o botão somente depois da escolha do horário
horaSelect.addEventListener('change', function () {
    btnAgendar.disabled = !this.value;
});
</script>
