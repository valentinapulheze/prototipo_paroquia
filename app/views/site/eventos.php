<main class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Eventos da Paróquia</h1>
        <p class="text-muted">Confira os próximos eventos e atividades.</p>
    </div>
    <?php if (empty($eventos)): ?>
        <div class="alert alert-info text-center">Nenhum evento futuro cadastrado no momento.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($eventos as $evento): ?>
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 shadow-sm">
                        <?php if (!empty($evento['foto'])): ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($evento['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>" class="card-img-top" alt="<?= htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8') ?>" style="height:190px;object-fit:cover">
                        <?php endif; ?>
                        <div class="card-body">
                            <span class="badge text-bg-primary mb-2"><?= htmlspecialchars($evento['tipo'], ENT_QUOTES, 'UTF-8') ?></span>
                            <h2 class="h5 card-title"><?= htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8') ?></h2>
                            <p class="card-text text-muted mb-0">
                                <?= date('d/m/Y', strtotime($evento['data_inicio'])) ?>
                                <?php if ($evento['data_fim'] !== $evento['data_inicio']): ?>
                                    até <?= date('d/m/Y', strtotime($evento['data_fim'])) ?>
                                <?php endif; ?>
                            </p>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
