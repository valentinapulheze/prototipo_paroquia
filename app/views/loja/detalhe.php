<?php
$produto = $produto ?? null;

$numeroWhatsApp = '5518997953239';
?>

<style>
    .detalhe-container {
        background: #f5f6f8;
        padding: 45px 20px;
        min-height: 75vh;
    }

    .detalhe-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,.08);
    }

    .detalhe-imagem {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
    }

    .detalhe-titulo {
        color: #003B61;
        font-weight: 700;
    }

    .detalhe-preco {
        color: #C8A961;
        font-size: 28px;
        font-weight: 700;
    }

    .btn-comprar {
        background: #003B61;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }

    .btn-comprar:hover {
        background: #005080;
        color: white;
    }
</style>

<div class="detalhe-container">
    <div class="container">

        <a href="<?= BASE_URL ?>/?url=loja"
           class="text-decoration-none mb-4 d-inline-block">
            ← Voltar para a loja
        </a>

        <div class="detalhe-card">
            <div class="row align-items-center g-4">

                <div class="col-md-6">

                    <?php if (!empty($produto['foto'])): ?>

                        <img
                            src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($produto['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>"
                            class="detalhe-imagem"
                            alt="<?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>"
                        >

                    <?php endif; ?>

                </div>

                <div class="col-md-6">

                    <h2 class="detalhe-titulo">
                        <?= htmlspecialchars($produto['titulo'], ENT_QUOTES, 'UTF-8') ?>
                    </h2>

                    <p class="detalhe-preco">
                        R$ <?= number_format((float)$produto['preco'], 2, ',', '.') ?>
                    </p>

                    <p>
                        Produto disponível em nossa lojinha paroquial.
                    </p>

                    <button
                        type="button"
                        class="btn-comprar"
                        onclick="comprarWhatsApp()"
                    >
                        <i class="bi bi-whatsapp"></i>
                        Comprar
                    </button>

                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function comprarWhatsApp() {

        var produto = <?= json_encode($produto['titulo'] ?? '') ?>;

        var preco = <?= json_encode(
            number_format((float)($produto['preco'] ?? 0), 2, ',', '.')
        ) ?>;

        var mensagem =
            'Olá! Gostaria de comprar o produto "' +
            produto +
            '", no valor de R$ ' +
            preco +
            '.';

        var url =
            'https://wa.me/<?= $numeroWhatsApp ?>?text=' +
            encodeURIComponent(mensagem);

        window.open(url, '_blank');
    }
</script>