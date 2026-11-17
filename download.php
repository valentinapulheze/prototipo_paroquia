<?php
$arquivo = $_GET['arq'] ?? null;
$extensoesPermitidas = [
    'pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx', 'xls', 'xlsx',
    'ppt', 'pptx', 'txt', 'zip', 'rar', 'odg', 'ods', 'odt'
];

if ($arquivo) {
    $arquivoSeguro = basename($arquivo);
    $caminho = __DIR__ . '/app/views/upload/' . $arquivoSeguro;
    $extensao = strtolower(pathinfo($arquivoSeguro, PATHINFO_EXTENSION));

    if (in_array($extensao, $extensoesPermitidas) && file_exists($caminho)) {
        $tiposMime = [
            'pdf'  => 'application/pdf',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt'  => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'txt'  => 'text/plain',
            'zip'  => 'application/zip',
            'rar'  => 'application/vnd.rar',
            'odg'  => 'application/vnd.oasis.opendocument.graphics',
            'ods'  => 'application/vnd.oasis.opendocument.spreadsheet',
            'odt'  => 'application/vnd.oasis.opendocument.text'
        ];

        $mime = $tiposMime[$extensao] ?? 'application/octet-stream';
        header('Content-Type: ' . $mime);

        // Para tipos suportados inline, mostrar no navegador
        $tiposInline = ['pdf', 'jpg', 'jpeg', 'png'];
        if (in_array($extensao, $tiposInline)) {
            header('Content-Disposition: inline; filename="' . $arquivoSeguro . '"');
        } else {
            // Forçar download para os demais tipos
            header('Content-Disposition: attachment; filename="' . $arquivoSeguro . '"');
        }

        header('Content-Length: ' . filesize($caminho));
        readfile($caminho);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Erro - Arquivo não encontrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f44336, #e57373);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .card {
            background-color: #fff;
            color: #333;
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            text-align: center;
            padding: 30px;
        }
        .card i {
            font-size: 48px;
            color: #f44336;
        }
        .btn-close-page {
            background-color: #f44336;
            border: none;
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            margin-top: 20px;
        }
        .btn-close-page:hover {
            background-color: #d32f2f;
        }
    </style>
    <script>
        function fecharPagina() {
            window.close();
        }
    </script>
</head>
<body>
    <div class="card">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <h3 class="mt-3">Arquivo não encontrado</h3>
        <p>O arquivo solicitado não existe ou o tipo não é permitido.</p>
        <button class="btn-close-page" onclick="fecharPagina()">Fechar</button>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
