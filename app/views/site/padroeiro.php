
<style>
    .padroeiro-page {
        color: #333;
    }

    .padroeiro-hero {
        background: linear-gradient(135deg, #003B61, #07577d);
        color: white;
        padding: 55px 25px;
        text-align: center;
    }

    .padroeiro-hero h1 {
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .padroeiro-hero p {
        font-size: 17px;
        margin: 0;
        opacity: .9;
    }

    .padroeiro-container {
        max-width: 1100px;
        margin: 55px auto;
        padding: 0 25px;
    }

    .padroeiro-conteudo {
        display: flex;
        align-items: center;
        gap: 45px;
        margin-bottom: 55px;
    }

    .padroeiro-foto {
        width: 42%;
        flex-shrink: 0;
    }

    .padroeiro-foto img {
        width: 100%;
        height: 430px;
        object-fit: cover;
        border-radius: 18px;
        box-shadow: 0 6px 18px rgba(0,0,0,.15);
    }

    .padroeiro-texto {
        flex: 1;
    }

    .padroeiro-texto h2 {
        color: #003B61;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .padroeiro-texto p {
        font-size: 16px;
        line-height: 1.8;
        text-align: justify;
    }

    .padroeiro-destaques {
        background: #f3f7f9;
        border-radius: 18px;
        padding: 35px;
        margin-bottom: 45px;
    }

    .padroeiro-destaques h2 {
        color: #003B61;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
    }

    .destaque-item {
        text-align: center;
        padding: 15px;
    }

    .destaque-item i {
        font-size: 35px;
        color: #b58b45;
        margin-bottom: 12px;
    }

    .destaque-item h5 {
        color: #003B61;
        font-weight: 700;
    }

    .padroeiro-frase {
        text-align: center;
        padding: 35px 20px;
        color: #003B61;
        font-size: 20px;
        font-weight: 600;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .padroeiro-hero h1 {
            font-size: 30px;
        }

        .padroeiro-conteudo {
            flex-direction: column;
            gap: 25px;
        }

        .padroeiro-foto {
            width: 100%;
        }

        .padroeiro-foto img {
            height: 350px;
        }

        .padroeiro-destaques {
            padding: 25px 15px;
        }
    }
</style>

<main class="padroeiro-page">

    <section class="padroeiro-hero">
        <h1>Santo Anastácio</h1>
        <p>Conheça a história do padroeiro da nossa paróquia</p>
    </section>

    <div class="padroeiro-container">

        <section class="padroeiro-conteudo">

           <div class="padroeiro-foto">
    <img src="<?= $base ?>/img/santo-anastacio.jpg"
         alt="Imagem de Santo Anastácio">
</div>

            <div class="padroeiro-texto">
                <h2>Quem foi Santo Anastácio?</h2>

                <p>
                    Santo Anastácio, conhecido como Anastácio, o Persa,
                    foi um antigo soldado zoroastriano do exército persa
                    que se converteu ao cristianismo.
                </p>

                <p>
                    Após sua conversão, recebeu o batismo e decidiu
                    dedicar sua vida à fé cristã, tornando-se monge.
                    Sua trajetória foi marcada pela devoção e pela
                    fidelidade às suas crenças.
                </p>

                <p>
                    No século VII, Santo Anastácio foi martirizado
                    por sua fé, tornando-se um exemplo de coragem,
                    perseverança e devoção cristã.
                </p>
            </div>

        </section>

        <section class="padroeiro-destaques">

            <h2>Devoção a Santo Anastácio</h2>

            <div class="row justify-content-center">

                <div class="col-md-5 destaque-item">
                    <i class="bi bi-gem"></i>
                    <h5>Protetor dos ourives</h5>
                    <p>
                        Santo Anastácio é considerado o protetor
                        dos profissionais que trabalham com ouro
                        e outros metais preciosos.
                    </p>
                </div>

                <div class="col-md-5 destaque-item">
                    <i class="bi bi-shield-check"></i>
                    <h5>Contra as tentações</h5>
                    <p>
                        Também é invocado pelos fiéis contra
                        grandes tentações, sendo lembrado por sua
                        firmeza na fé.
                    </p>
                </div>

            </div>

        </section>

        <section class="padroeiro-frase">
            <p>
                "Sua história representa a coragem de permanecer
                fiel à fé, mesmo diante das dificuldades."
            </p>
        </section>

    </div>

</main>
