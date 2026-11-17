
<style>
  .about-title {
    color: #003B61;
    font-weight: 700;
    margin-left: 4rem;
  }

  .aviso-card {
    width: 100%;
    max-width: 320px;
    height: 370px;
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 16px rgba(0,0,0,.12);
    transition: .3s;
  }

  .aviso-card:hover {
    transform: translateY(-5px);
  }

  .aviso-card .card-img-top {
    width: 100%;
    height: 170px;
    object-fit: cover;
  }

  .aviso-card .card-body {
    display: flex;
    flex-direction: column;
    padding: 15px;
  }

  .aviso-card .card-title {
    color: #003B61;
    font-size: 18px;
    font-weight: 700;
    margin: 8px 0;
  }

  .aviso-card .card-text {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
  }

  @media (max-width:768px) {
    .about-title {
      margin-left: 1rem;
    }

    .subtitulo {
      margin-left: 1rem !important;
    }

    .aviso-card {
      max-width: 100%;
    }
  }
</style>

<main>

  <h1 class="about-title mt-3 mb-3">Últimos Avisos</h1>

  <h6 class="subtitulo" style="margin-left:4rem;color:gray;">
    Acompanhe as novidades da nossa comunidade
  </h6>

  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mx-4 mt-2">

    <?php if (!empty($avisos) && is_array($avisos)): ?>

      <?php foreach ($avisos as $aviso): ?>

        <div class="col d-flex justify-content-center">

          <div class="card aviso-card">

            <img
              src="<?= !empty($aviso['foto'])
                ? BASE_URL . '/' . htmlspecialchars(ltrim($aviso['foto'], '/'), ENT_QUOTES, 'UTF-8')
                : BASE_URL . '/img/card_corpus.jpg' ?>"
              class="card-img-top"
              alt="Aviso da paróquia"
            >

            <div class="card-body">

              <small class="text-muted">
                <i class="bi bi-calendar4-event"></i>

                <?php if (!empty($aviso['criado_em'])): ?>
                  <?= date('d/m/Y', strtotime($aviso['criado_em'])) ?>
                <?php else: ?>
                  Aviso da paróquia
                <?php endif; ?>
              </small>

              <h5 class="card-title">
                <?= htmlspecialchars($aviso['titulo'] ?? 'Aviso', ENT_QUOTES, 'UTF-8') ?>
              </h5>

              <p class="card-text">
                <?= htmlspecialchars(
                  $aviso['detalhamento'] ?? $aviso['mensagem'] ?? '',
                  ENT_QUOTES,
                  'UTF-8'
                ) ?>
              </p>

              <?php if (!empty($aviso['data_expiracao'])): ?>
                <small class="text-muted mt-auto">
                  Até <?= date('d/m/Y', strtotime($aviso['data_expiracao'])) ?>
                </small>
              <?php endif; ?>

            </div>

          </div>

        </div>

      <?php endforeach; ?>

    <?php else: ?>

      <div class="col-12">
        <p class="text-muted">
          Nenhum aviso disponível no momento.
        </p>
      </div>

    <?php endif; ?>

  </div>

</main>
