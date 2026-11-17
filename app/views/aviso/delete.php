<div class="avisos">
    <h1>📢 Avisos da Paróquia</h1>

    <?php if (empty($avisos)): ?>
        <p class="avisos-vazio">Nenhum aviso no momento.</p>
    <?php endif; ?>

    <?php foreach ($avisos as $a): ?>
        <div class="aviso cat-<?= htmlspecialchars($a['categoria']) ?> <?= $a['destaque'] ? 'destaque' : '' ?>">
            <span class="aviso-tag"><?= htmlspecialchars(ucfirst($a['categoria'])) ?><?= $a['destaque'] ? ' · ⭐ Destaque' : '' ?></span>
            <h3><?= htmlspecialchars($a['titulo']) ?></h3>
            <p><?= nl2br(htmlspecialchars($a['mensagem'])) ?></p>
            <div class="aviso-meta">
                <span>Publicado em <?= date('d/m/Y', strtotime($a['criado_em'])) ?></span>
                <?php if ($a['data_expiracao']): ?>
                    <span>Válido até <?= date('d/m/Y', strtotime($a['data_expiracao'])) ?></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>