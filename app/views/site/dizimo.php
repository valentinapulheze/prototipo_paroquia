
<main>
    <?php
    $numeroWhatsApp = '5518997953239';
    ?>

    <style>
        body {
            width: 100%;
            min-height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .about-title {
            font-size: 2rem;
            font-weight: 700;
            color: #003B61;
            text-align: center;
            margin-bottom: 1rem;
        }

        .btn-contribuir {
            display: inline-block;
            margin-top: 20px;
            background: #C8A961;
            color: #fff;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-contribuir:hover {
            background: #b5964e;
            color: #fff;
        }

        .about-card {
            background: #003B61;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            width: 98%;
            max-width: 1600px;
            margin: 0 auto;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .about-logo {
            width: 100%;
            max-width: 450px;
            display: block;
            margin: 25px auto;
            border-radius: 10px;
        }

        .card-contribuicao {
            width: 98%;
            max-width: 1000px;
            margin: 0 auto 30px;
        }

        .contribui-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
        }

        .contribui-conteudo {
            display: flex;
            flex-direction: column;
        }

        .contribui-titulo {
            font-size: 16px;
            margin-bottom: 2px;
        }

        .contribui-subtitulo {
            font-size: 14px;
            color: #555;
            margin: 0;
        }

        .badge-numero {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f3f5;
            color: #6c757d;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        @media (max-width: 992px) {
            .about-card {
                width: 100%;
                padding: 2rem;
                border-radius: 15px;
            }

            .card-contribuicao {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .about-card {
                padding: 1.5rem;
            }

            .about-logo {
                max-width: 250px;
            }

            .contribui-item {
                align-items: flex-start;
            }

            .btn-contribuir {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .about-title {
                font-size: 1.6rem;
            }
        }
    </style>

    <h1 class="about-title mt-3">Dízimo Online</h1>

    <h6 style="text-align: center; color: gray;">
        Sua doação ajuda a manter nossa Paróquia e as obras de fé
    </h6>

    <div class="container-fluid px-1 mt-5 mb-5">
        <div class="about-card text-center text-white">

            <h1 class="text-white">
                <i class="bi bi-heart" style="font-size: 50px;"></i>
            </h1>

            <h4 class="text-white">
                <strong>Contribua com a Paróquia</strong>
            </h4>

            <p>
                Sua generosidade nos ajuda a continuar servindo a comunidade.
            </p>

            <img src="img/pix_card.jpg"
                class="about-logo img-fluid"
                alt="Logo Pix">

            <button
                type="button"
                class="btn-contribuir"
                onclick="enviarComprovante()"
            >
                <i class="bi bi-whatsapp"></i>
                Enviar comprovante
            </button>

        </div>
    </div>

    <div class="card card-contribuicao">

        <div class="card-header">
            <b>Outras formas de contribuir</b>
        </div>

        <ul class="list-group list-group-flush">

            <li class="list-group-item contribui-item">

                <span class="badge-numero">1</span>

                <div class="contribui-conteudo">
                    <b class="contribui-titulo">
                        Durante as missas
                    </b>

                    <p class="contribui-subtitulo">
                        Deposite sua contribuição no cesto durante as celebrações.
                    </p>
                </div>

            </li>

            <li class="list-group-item contribui-item">

                <span class="badge-numero">2</span>

                <div class="contribui-conteudo">
                    <b class="contribui-titulo">
                        Secretaria paroquial
                    </b>

                    <p class="contribui-subtitulo">
                        Visite nossa secretaria em horário comercial.
                    </p>
                </div>

            </li>

            <li class="list-group-item contribui-item">

                <span class="badge-numero">3</span>

                <div class="contribui-conteudo">
                    <b class="contribui-titulo">
                        Doações à caridade
                    </b>

                    <p class="contribui-subtitulo">
                        A partir de dinheiro, alimento, brinquedos ou roupas, sua ação muda vidas.
                    </p>
                </div>

            </li>

        </ul>

    </div>

    <script>
        function enviarComprovante() {

            var mensagem =
                'Olá! Acabei de realizar uma contribuição para a Paróquia e gostaria de enviar o comprovante do meu dízimo.';

            var url =
                'https://wa.me/<?= $numeroWhatsApp ?>?text=' +
                encodeURIComponent(mensagem);

            window.open(url, '_blank');
        }
    </script>

</main>
