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
<main class="text-light" style="background-color: #F4C2C2;">
    <div class="container mt-3">
        <?php require_once dirname(__DIR__, 2) . '/core/auth.php'; ?>
        <h2 class="card-title mb-4">Painel de Token</h2>
        <div class="row justify-content-center mb-4">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <a href="./saveToken" class="btn btn-primary">Novo</a>
                        </div>
                        <div class="help-container">

                            <div class="help-card">
                                <img src="img/help_token.png" alt="Ajuda" width="16">
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
                                        <img src="img/help_token.png" class="img-fluid" alt="Ajuda">
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="table-responsive">
                            <table id="idtabela" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Data do Token</th>
                                        <th>Data que Expira</th>
                                        <th>E-mail</th>
                                        <th>Token</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($tokens as $row):
                                        $DtaToken  = date('d/m/Y H:i:s', strtotime($row['created_at']));
                                        $DtaExpira = date('d/m/Y H:i:s', strtotime($row['created_at'] . ' +1 hour'));
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $row['id'] ?></td>
                                            <td><?= $DtaToken ?></td>
                                            <td><?= $DtaExpira ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['token'] ?></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="./editToken&id=<?= $row['id'] ?>" title="Editar" class="btn btn-sm btn-warning"><i class="fa fa-edit text-"></i></a>
                                                    <a href="./deleteToken&id=<?= $row['id'] ?>" title="Excluir" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>