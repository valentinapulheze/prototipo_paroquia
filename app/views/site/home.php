
<main>
    <section class="hero">
        <div class="col-md-12 col-sm-4">
            <h4 class="mb-0 paragrafo">Bem-vindo à</h4>
            <h1 class="mb-0 paragrafo">Paróquia</h1>
            <h1>Santo Anastácio</h1>

            <div class="decoracao">
                <span class="linha"></span>
                <span class="cruz"></span>
            </div>

            <h6 class="mb-0 paragrafo">Lugar de fé, comunhão e amor.</h6>
            <h6 class="mb-0 paragrafo">Juntos, somos Igreja!</h6>

            <a href="?url=sobre" class="btn bi bi-heart">
                Conheça nossa Paróquia
            </a>
        </div>
    </section>

    <div class="container-fluid">
        <div class="row gap-4 mb-3">

            <!-- Card Avisos -->
            <div class="col-md-3 ms-3 card">
                <div class="text-white rounded">

                    <div class="card-header bi bi-megaphone megaphone">
                        <b class="paragrafo">Últimos Avisos</b>

                        <a href="?url=avisos" class="ver-todos float-end">
                            Ver todos
                        </a>
                    </div>

                    <ul class="list-group list-group-flush mx-1">

                        <?php if (!empty($avisos) && is_array($avisos)): ?>

                            <?php foreach (array_slice($avisos, 0, 3) as $aviso): ?>

                                <li class="list-group-item aviso-item">

                                    <img
                                        src="<?= !empty($aviso['foto'])
                                            ? BASE_URL . '/' . ltrim($aviso['foto'], '/')
                                            : BASE_URL . '/img/card_corpus.jpg' ?>"
                                        class="card-img-left"
                                        alt="Aviso da paróquia"
                                    >

                                    <div class="aviso-conteudo">

                                        <b class="aviso-titulo paragrafo">
                                            <?= htmlspecialchars($aviso['titulo'] ?? 'Aviso', ENT_QUOTES, 'UTF-8') ?>
                                        </b>

                                        <p class="aviso-texto paragrafo">
                                            <?= htmlspecialchars(
                                                !empty($aviso['detalhamento'])
                                                    ? $aviso['detalhamento']
                                                    : ($aviso['mensagem'] ?? ''),
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </p>

                                        <?php if (!empty($aviso['data_expiracao'])): ?>
                                            <p class="aviso-subtexto paragrafo">
                                                Até <?= date('d/m/Y', strtotime($aviso['data_expiracao'])) ?>
                                            </p>
                                        <?php endif; ?>

                                    </div>

                                </li>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <li class="list-group-item">
                                Nenhum aviso disponível no momento.
                            </li>

                        <?php endif; ?>

                    </ul>
                </div>
            </div>

            <!-- Card Lojinha -->
            <div class="col-md-6 card">

                <div class="card-header bi bi-bag megaphone">
                    <b class="paragrafo">Lojinha</b>

                    <a href="?url=loja" class="ver-todos float-end">
                        Ver todos
                    </a>
                </div>

                <div class="card-body">
                    <div class="cards-centrais">

                        <?php if (!empty($produtos) && is_array($produtos)): ?>

                            <?php foreach (array_slice($produtos, 0, 4) as $produto): ?>

                                <a
                                    href="<?= BASE_URL ?>/?url=produto&id=<?= (int)($produto['id_produto'] ?? $produto['id'] ?? 0) ?>"
                                    class="card card-mini text-decoration-none text-dark"
                                >

                                    <?php if (!empty($produto['foto'])): ?>

                                        <img
                                            src="<?= BASE_URL ?>/<?= htmlspecialchars(ltrim($produto['foto'], '/'), ENT_QUOTES, 'UTF-8') ?>"
                                            class="card-img-top"
                                            alt="<?= htmlspecialchars($produto['titulo'] ?? 'Produto', ENT_QUOTES, 'UTF-8') ?>"
                                        >

                                    <?php else: ?>

                                        <div class="text-center p-4">
                                            <i class="bi bi-image" style="font-size: 40px;"></i>
                                        </div>

                                    <?php endif; ?>

                                    <div class="card-body text-center">

                                        <h6 class="card-title">
                                            <?= htmlspecialchars($produto['titulo'] ?? 'Produto', ENT_QUOTES, 'UTF-8') ?>
                                        </h6>

                                        <p class="card-title fw-bold">
                                            R$ <?= number_format((float)($produto['preco'] ?? 0), 2, ',', '.') ?>
                                        </p>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="alert alert-info w-100 text-center">
                                Nenhum produto disponível no momento.
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <!-- Card Dízimo -->
            <div class="col-md-3 card-dizimo">

                <h2>Dízimo Online</h2>

                <p>
                    Ajude a manter nossa paróquia e obras de fé.
                </p>

                <div class="pix-box">

                    <img
                        src="https://img.icons8.com/?size=100&id=uqpbD9vhCDEQ&format=png&color=000000"
                        alt="Pix"
                        class="pix-icon"
                    >

                    <div class="pix-titulo">
                        Contribua via Pix
                    </div>

                </div>

                <a class="btn btn-dizimo" href="?url=dizimo">
                    ♡ Enviar comprovante
                </a>

            </div>

        </div>
    </div>
</main>

<style>
    .hero {
        height: 100vh;
        background-image: url('./img/img-home-br.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        padding-left: 30px;
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        background: #0d4d8b;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
    }

    h1 {
        color: #003B61;
    }

    .paragrafo {
        color: #003B61;
    }

    .decoracao {
        display: flex;
        align-items: center;
        gap: 14px;
        color: #c49a3a;
    }

    .linha {
        width: 70px;
        height: 1.5px;
        background: #c49a3a;
    }

    .cruz {
        position: relative;
        width: 14px;
        height: 22px;
    }

    .cruz::before {
        content: "";
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 18px;
        background: #c49a3a;
    }

    .cruz::after {
        content: "";
        position: absolute;
        top: 6px;
        left: 50%;
        transform: translateX(-50%);
        width: 12px;
        height: 2px;
        background: #c49a3a;
    }

    .container-cards {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 30px 50px;
    }

    .card {
        margin: 0;
    }

    .megaphone {
        color: #c49a3a;
    }

    /* Avisos */
    .card-img-left {
        width: 70px;
        min-width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
    }

    .aviso-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 10px 15px;
    }

    .aviso-conteudo {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .aviso-titulo {
        font-size: 16px;
        line-height: 1.2;
        margin-bottom: 2px;
    }

    .aviso-texto {
        font-size: 14px;
        margin-bottom: 1px;
        line-height: 1.3;
    }

    .aviso-subtexto {
        font-size: 14px;
        margin-bottom: 0;
        line-height: 1.3;
    }

    /* Dízimo */
    .card-dizimo {
        background-color: #003366;
        color: #fff;
        width: 280px;
        padding: 20px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        margin: 0;
    }

    .card-dizimo h2 {
        font-family: 'Lora', serif;
        color: #f3a633;
        margin-bottom: 8px;
        font-size: 22px;
    }

    .card-dizimo p {
        margin-bottom: 15px;
        font-size: 13px;
        line-height: 1.4;
    }

    .pix-box {
        background: rgba(255, 255, 255, 0.08);
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .pix-icon {
        width: 35px;
        filter: brightness(0) invert(1);
        margin-bottom: 6px;
    }

    .pix-titulo {
        color: #f3a633;
        font-size: 16px;
        font-weight: bold;
    }

    .btn-dizimo {
        background-color: #c59b4e;
        border: none;
        width: 100%;
        padding: 8px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-dizimo:hover {
        background-color: #b58a3c;
        color: white;
    }

    .ver-todos {
        color: #003B61;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.3s;
    }

    .cards-centrais {
        display: flex;
        gap: 15px;
        margin: 0 20px;
        align-items: stretch;
    }

    .card-mini {
        width: 160px;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-mini img {
        height: 150px;
        object-fit: cover;
    }

    .card-mini .card-body {
        padding: 15px;
    }

    @media (max-width: 991px) {
        .hero {
            height: 80vh;
            min-height: 550px;
            padding-left: 30px;
            padding-right: 30px;
            background-position: center;
        }

        .hero > div {
            max-width: 60%;
        }

        .hero h1 {
            font-size: 2rem;
        }

        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }

        .container-fluid .row {
            gap: 20px !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .container-fluid .col-md-3,
        .container-fluid .col-md-6 {
            width: 100%;
            max-width: 100%;
            margin-left: 0 !important;
        }

        .card-dizimo {
            width: 100%;
        }

        .cards-centrais {
            justify-content: center;
            flex-wrap: wrap;
            margin: 0;
        }

        .card-mini {
            width: 160px;
        }
    }

    @media (max-width: 767px) {
        .hero {
            height: 100vh;
            min-height: 600px;
            padding: 30px 20px;
            align-items: center;
            background-position: center;
        }

        .hero > div {
            max-width: 100%;
            width: 100%;
        }

        .hero h4 {
            font-size: 1rem;
        }

        .hero h1 {
            font-size: 2rem;
            line-height: 1.15;
        }

        .hero h6 {
            font-size: 0.85rem;
        }

        .hero .btn {
            font-size: 14px;
            padding: 10px 18px;
        }

        .decoracao {
            gap: 10px;
        }

        .linha {
            width: 50px;
        }

        .container-fluid {
            padding-left: 12px;
            padding-right: 12px;
        }

        .container-fluid .row {
            display: flex;
            flex-direction: column;
            gap: 20px !important;
            margin: 0 !important;
        }

        .container-fluid .col-md-3,
        .container-fluid .col-md-6 {
            width: 100%;
            max-width: 100%;
            margin: 0 !important;
            padding: 0;
        }

        .card {
            width: 100%;
        }

        .aviso-item {
            gap: 12px;
            padding: 10px;
        }

        .card-img-left {
            width: 65px;
            min-width: 65px;
            height: 65px;
        }

        .aviso-titulo {
            font-size: 15px;
        }

        .aviso-texto,
        .aviso-subtexto {
            font-size: 13px;
        }

        .cards-centrais {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin: 0;
        }

        .card-mini {
            width: 100%;
            min-width: 0;
        }

        .card-mini img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .card-mini .card-body {
            padding: 10px;
        }

        .card-mini .card-title {
            font-size: 13px;
            line-height: 1.3;
        }

        .card-dizimo {
            width: 100%;
            padding: 20px 15px;
        }

        .card-dizimo h2 {
            font-size: 21px;
        }

        .card-dizimo p {
            font-size: 13px;
        }
    }

    @media (max-width: 400px) {
        .hero {
            padding-left: 15px;
            padding-right: 15px;
        }

        .hero h1 {
            font-size: 1.7rem;
        }

        .hero h4 {
            font-size: 0.9rem;
        }

        .hero h6 {
            font-size: 0.8rem;
        }

        .hero .btn {
            font-size: 13px;
            padding: 9px 14px;
        }

        .cards-centrais {
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .card-mini img {
            height: 120px;
        }

        .card-mini .card-body {
            padding: 8px 5px;
        }

        .card-mini .card-title {
            font-size: 12px;
        }

        .aviso-item {
            padding: 8px;
        }

        .card-img-left {
            width: 55px;
            min-width: 55px;
            height: 55px;
        }
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    img {
        max-width: 100%;
    }
</style>
