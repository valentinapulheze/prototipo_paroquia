<main>
  <style>
    /* Fundo com gradiente suave */
    body {
      width: 100%;
      background-image: url("./img/fundoLogin_paroq.png");
      background-size: cover;
      background-attachment: fixed;
      min-height: 100vh;
      background-position: center;
      background-repeat: no-repeat;
    }

    /* Card principal */
    .about-card {
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
      padding: 2.5rem;
      width: 100%;
      animation: fadeIn 1s ease;
    }

    /* Animação de entrada */
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

    /* Título */
    .about-title {
      font-size: 2rem;
      font-weight: 700;
      color: #003B61;
      text-align: center;
      margin-bottom: 2rem;
    }

    /* Subtítulo para seções secundárias */
    .about-subtitle {
      font-size: 1.6rem;
      font-weight: 700;
      color: #003B61;
      text-align: center;
      margin-top: 3rem;
      margin-bottom: 2rem;
    }

    /* Logo */
    .about-logo {
      max-width: 250px;
      border: 5px solid #003B61;
      border-radius: 50%;
      box-shadow: 0 4px 15px rgba(30, 79, 145, 0.3);
      transition: transform 0.3s ease;
    }

    .about-logo:hover {
      transform: scale(1.05);
    }

    /* Texto */
    .about-text p {
      font-size: 1rem;
      line-height: 1.7;
      color: #283020;
      margin-bottom: 1rem;
    }

    .about-text ul {
      list-style: none;
      padding-left: 0;
    }

    .about-text li {
      background: #f4f8ff;
      border-left: 5px solid #003B61;
      padding: 0.6rem 1rem;
      border-radius: 8px;
      margin-bottom: 0.75rem;
      /* Ajustado para eliminar a necessidade de <br> */
      transition: all 0.2s ease;
    }

    .about-text li:hover {
      background: #003B61;
      color: #ffffff;
      transform: translateX(5px);
    }

    /* Cartão de Colaborador individualizado para Bootstrap */
    .colaborador-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 15px;
      padding: 1.5rem 1rem;
      text-align: center;
      transition: all 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
      height: 100%;
      cursor: pointer;
      /* Indica que a foto/card é clicável */
    }

    .colaborador-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0, 59, 97, 0.1);
      border-color: #003B61;
    }

    .colaborador-foto {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #003B61;
      margin-bottom: 1rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .colaborador-nome {
      font-size: 1.1rem;
      font-weight: 700;
      color: #003B61;
      margin-bottom: 0.25rem;
    }

    .colaborador-cargo {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 0;
    }

    @media (max-width: 768px) {
      .about-logo {
        max-width: 180px;
        margin-bottom: 1.5rem;
      }
    }
  </style>

  <div class="container mt-5 mb-5">
    <div class="about-card">
      <h2 class="about-title">Sobre a Paróquia Santo Anastácio</h2>
      <div class="row align-items-center">
        <div class="col-md-3 text-center mb-3">
          <img src="img/logo_paroq.jpg" class="about-logo img-fluid" alt="Logo PSA">
        </div>
        <div class="col-md-9 about-text">
          <p>A <strong>Paróquia Santo Anastácio</strong>, situada no município de Santo Anastácio (SP), foi criada em 29 de abril de 1925 por Dom Carlos Duarte da Costa, então bispo de Botucatu. A construção da Igreja Matriz começou in 1935, consolidando-se como um marco histórico.</p>
          <ul>
            <li><strong>Fundação:</strong> Criada formalmente em abril de 1925, a paróquia logo em maio recebeu seu primeiro pároco, o padre português Antônio Joaquim José Pereira.</li>
            <li><strong>Construção:</strong> A pedra fundamental e o início da construção da atual Igreja Matriz ocorreram em 15 de setembro de 1935.</li>
            <li><strong>Consolidação:</strong> A primeira missa foi celebrada antes mesmo da conclusão do templo. A obra foi finalizada na década de 50, em uma celebração que reuniu mais de 20 sacerdotes.</li>
            <li><strong>Centenário:</strong> A comunidade celebrou seu Jubileu de 100 anos em uma missa solene, marcando a abertura de seu Ano Jubilar junto à Diocese de Presidente Prudente.</li>
          </ul>
          <p><strong>Sobre o Padroeiro:</strong></p>
          <p>A igreja recebe o nome de Santo Anastácio (o Persa), um antigo soldado zoroastriano do exército persa que se converteu ao cristianismo, foi batizado, tornou-se monge e acabou martirizado no século VII. Ele é considerado o protetor dos ourives e é invocado contra grandes tentações.</p>
        </div>
      </div>

      <!-- Seção de Colaboradores (5 Pessoas) -->
      <hr class="mt-5" style="border-color: rgba(0, 59, 97, 0.1);">
      <h3 class="about-subtitle">Nossos Colaboradores</h3>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">
        <!-- Colaborador 1 -->
        <div class="col">
          <div class="colaborador-card" data-bs-toggle="modal" data-bs-target="#modalRafa">
            <img src="img/colaboradores/rafa.jpg" class="colaborador-foto" alt="Rafaela Tetila">
            <div class="colaborador-nome">Rafaela Tetila</div>
            <div class="colaborador-cargo">Colaborador</div>
          </div>
        </div>
        <!-- Colaborador 2 -->
        <div class="col">
          <div class="colaborador-card" data-bs-toggle="modal" data-bs-target="#modalJulia">
            <img src="img/colaboradores/juliaaa.jpg" class="colaborador-foto" alt="Julia Lopes">
            <div class="colaborador-nome">Julia Lopes</div>
            <div class="colaborador-cargo">Colaborador</div>
          </div>
        </div>
        <!-- Colaborador 3 -->
        <div class="col">
          <div class="colaborador-card" data-bs-toggle="modal" data-bs-target="#modalAna">
            <img src="img/colaboradores/ana.jpg" class="colaborador-foto" alt="Ana Clara Simeoni">
            <div class="colaborador-nome">Ana Clara Simeoni</div>
            <div class="colaborador-cargo">Colaborador</div>
          </div>
        </div>
        <!-- Colaborador 4 -->
        <div class="col">
          <div class="colaborador-card" data-bs-toggle="modal" data-bs-target="#modalHelo">
            <img src="img/colaboradores/heloo.jpg" class="colaborador-foto" alt="Heloisa Zanfolin">
            <div class="colaborador-nome">Heloisa Zanfolin</div>
            <div class="colaborador-cargo">Colaborador</div>
          </div>
        </div>
        <!-- Colaborador 5 -->
        <div class="col">
          <div class="colaborador-card" data-bs-toggle="modal" data-bs-target="#modalValentina">
            <img src="img/colaboradores/valentina.jpg" class="colaborador-foto" alt="Valentina Pulheze">
            <div class="colaborador-nome">Valentina Pulheze</div>
            <div class="colaborador-cargo">Colaborador</div>
          </div>
        </div>
      </div> <!-- Fim da Seção de Colaboradores -->
    </div>
  </div>

  <!-- Modais para a imagem abrir inteira -->
  <div class="modal fade" id="modalRafa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body text-center p-0 position-relative">
          <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
          <img src="img/colaboradores/rafa.jpg" class="img-fluid rounded shadow-lg" alt="Rafaela Tetila">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalJulia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body text-center p-0 position-relative">
          <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
          <img src="img/colaboradores/juliaaa.jpg" class="img-fluid rounded shadow-lg" alt="Julia Lopes">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalAna" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body text-center p-0 position-relative">
          <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
          <img src="img/colaboradores/ana.jpg" class="img-fluid rounded shadow-lg" alt="Ana Clara Simeoni">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHelo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body text-center p-0 position-relative">
          <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
          <img src="img/colaboradores/heloo.jpg" class="img-fluid rounded shadow-lg" alt="Heloisa Zanfolin">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalValentina" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body text-center p-0 position-relative">
          <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
          <img src="img/colaboradores/Valentina.jpg" class="img-fluid rounded shadow-lg" alt="Heloisa Zanfolin">
        </div>
      </div>
    </div>
  </div>