<style>
  .help-button {
    position: relative;
    display: inline-block;
  }

  .help-button {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: none;
    background: #6c757d;
    color: white;
    font-size: 12px;
    cursor: pointer;
  }

  .help-card {
    display: none;
    position: absolute;
    top: 30px;
    left: 0;
    width: 220px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: 10px;
    z-index: 100;
  }

  .help-card img {
    width: 100%;
    border-radius: 5px;
    margin-bottom: 5px;
  }


  .help-container:hover .help-text {
    display: block;
  }
</style>
<main style="background-color: #F4C2C2;">
  <div class="container mt-3">
    <?php require_once dirname(__DIR__, 2) . '/core/auth.php'; ?>
    <div class="row justify-content-center mb-4">
      <div class="col-md-12">
        <div class="card shadow-lg">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Editar Token</h2>
            <div class="help-container">

              <div class="help-card">
                <img src="img/help_editar_token.png" alt="Ajuda" width="16">
              </div>

            </div>
            <div class="help-container">

              <button type="button" class="help-button d-flex aling-items-center justify-content-center position-absolute top-0 end-0 m-3" data-bs-toggle="modal" data-bs-target="#helpModal">?</button>

            </div>
            <div class="modal fade" id="helpModal" tabindex="-1">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title">
                      Ajuda do campo
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body text-center">
                    <img src="img/help_editar_token.png" class="img-fluid" alt="Ajuda">
                  </div>
                </div>

              </div>

            </div>
            <form method="POST">
              <div class="row">
                <div class="col-sm-12 mb-3">
                  <input type="hidden" class="form-control" id="id" name="id" value="<?= $tokens['id'] ?? '' ?>" readonly>
                </div>

                <div class="col-sm-2 mb-3">
                  <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                  <label for="created_at" class="form-label">Data do Token</label>
                  <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="<?= $tokens['created_at'] ?? '' ?>" required readonly>
                </div>

                <div class="col-sm-2 mb-3">
                  <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                  <label for="created_expira" class="form-label">Data que Expira</label>
                  <input type="datetime-local" class="form-control" id="created_expira" name="created_expira" value="<?= date('Y-m-d\TH:i', strtotime($tokens['created_at'] . ' +1 hour')) ?>" required readonly>
                </div>

                <div class="col-sm-8 mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <select class="form-select" id="email" name="email" required>
                    <option value="">Selecione</option>
                    <?php foreach ($users as $user): ?>
                      <optgroup label="<?= htmlspecialchars($user['nome']) ?>">
                        <option value="<?= htmlspecialchars($user['email']) ?>"><?= htmlspecialchars($user['email']) ?></option>
                      </optgroup>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>


              <button type="submit" class="btn btn-primary">Editar</button>
              <a href="./listToken" class="btn btn-secondary">Voltar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>