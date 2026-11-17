<style>
    .contato-section {
        padding: 30px 20px;
    }

    .contato-titulo {
        text-align: center;
        color: #004b73;
        font-weight: bold;
        margin-bottom: 45px;
    }

    .contato-conteudo {
        display: flex;
        align-items: center;
        gap: 7%;
    }

    /* Imagem da igreja */
    .contato-igreja {
        flex: 0 0 30%;
        text-align: center;
    }

    .contato-igreja img {
        width: 100%;
        max-width: 310px;
        height: 365px;
        object-fit: cover;
        border-radius: 25px;
        border: 5px solid #004b73;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.25);
    }

    /* Lado direito */
    .contato-direita {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Card do contato */
    .contato-card {
        width: 100%;
        min-height: 220px;
        background: #fff;
        border-radius: 20px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.10);
    }

    .contato-padre img {
        width: 140px;
        height: 180px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #004b73;
    }

    .contato-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .contato-info h3 {
        margin: 0 0 5px 0;
        color: #111;
        font-size: 22px;
    }

    .contato-info p {
        margin: 0;
        color: #004b73;
        font-size: 17px;
    }

    /* Localização */
    .contato-localizacao {
        margin-top: 40px;
        width: 100%;
        padding: 18px 25px;
        border: 2px solid #6ea9d7;
        border-radius: 18px;
        background: #fff;
        color: #004b73;
        font-size: 17px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-sizing: border-box;
    }

    .contato-localizacao i {
        font-size: 25px;
        margin-right: 10px;
    }


    /* =========================
       RESPONSIVIDADE
       ========================= */

    @media (max-width: 992px) {

        .contato-conteudo {
            gap: 30px;
        }

        .contato-igreja {
            flex: 0 0 35%;
        }

        .contato-igreja img {
            height: 330px;
        }

        .contato-card {
            padding: 15px;
        }

        .contato-padre img {
            width: 120px;
            height: 160px;
        }

        .contato-info h3 {
            font-size: 19px;
        }

        .contato-info p {
            font-size: 15px;
        }

        .contato-localizacao {
            font-size: 15px;
        }
    }


    @media (max-width: 768px) {

        .contato-section {
            padding: 25px 15px;
        }

        .contato-titulo {
            margin-bottom: 30px;
        }

        .contato-conteudo {
            flex-direction: column;
            gap: 25px;
        }

        .contato-igreja {
            width: 100%;
        }

        .contato-igreja img {
            width: 280px;
            height: 330px;
        }

        .contato-direita {
            width: 100%;
        }

        .contato-card {
            min-height: auto;
            flex-direction: column;
            text-align: center;
            padding: 25px 15px;
        }

        .contato-padre img {
            width: 130px;
            height: 165px;
        }

        .contato-info {
            align-items: center;
        }

        .contato-localizacao {
            margin-top: 25px;
            padding: 15px;
            flex-direction: column;
            gap: 8px;
            line-height: 1.5;
        }

        .contato-localizacao i {
            margin-right: 0;
        }
    }


    @media (max-width: 480px) {

        .contato-titulo {
            font-size: 26px;
        }

        .contato-igreja img {
            width: 240px;
            height: 290px;
        }

        .contato-card {
            padding: 20px 10px;
        }

        .contato-padre img {
            width: 115px;
            height: 150px;
        }

        .contato-info h3 {
            font-size: 18px;
        }

        .contato-info p {
            font-size: 14px;
            word-break: break-word;
        }

        .contato-localizacao {
            font-size: 14px;
        }
    }
</style>


<section class="contato-section">

    <h1 class="contato-titulo">
        Contato
    </h1>

    <div class="contato-conteudo">

        <!-- Imagem da igreja -->
        <div class="contato-igreja">

            <img
                src="./img/img_contato_igreja1.jpg"
                alt="Igreja Santo Anastácio"
            >

        </div>


        <!-- Conteúdo da direita -->
        <div class="contato-direita">

            <!-- Card do padre -->
            <div class="contato-card">

                <div class="contato-padre">

                    <img
                        src="./img/padreSanderson.jpg"
                        alt="Pe. Sanderson Vergara"
                    >

                </div>


                <div class="contato-info">

                    <h3>
                        Pe. Sanderson Vergara
                    </h3>

                    <p>
                        (18) 99795-3239
                    </p>

                    <p>
                        paroquiasantoanastacio@hotmail.com
                    </p>
                </div>
            </div>

            <div class="contato-localizacao">

                <i class="bi bi-geo-alt"></i>

                <span>
                    Localização Praça da Matriz, nº 72,
                    Centro | CEP: 19360-019 |
                    Santo Anastácio (SP)
                </span>

            </div>

        </div>

    </div>

</section>