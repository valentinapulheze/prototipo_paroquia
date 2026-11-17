
<style>
    .sofistic-blue {
        background-color: #003B61;
        margin-top: 60px;
    }
</style>

<footer class="sofistic-blue text-white text-center py-3">

    <span class="fs-6">
        "No coração da Igreja, minha Mãe, eu serei o amor" - Santa Teresinha do Menino Jesus
    </span>

    <br>

    <span class="fs-6">
        Copyright © 2026 - Paróquia Santo Anastácio
    </span>

</footer>

<!-- ======================= SCRIPTS DO SISTEMA ======================= -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap Bundle (inclui Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Plugins -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Inicializa tabela DataTable -->
<script>
    $(document).ready(function () {
        if ($('#idtabela').length) {
            $('#idtabela').DataTable({
                language: { url: "js/pt_br.json" }
            });
        }
    });
</script>

<!-- Oculta mensagens de alerta após 3 segundos -->
<script>
    setTimeout(function () {
        const messageDiv = document.getElementById('message');

        if (messageDiv) {
            messageDiv.style.display = 'none';
        }
    }, 3000);
</script>

<!-- Mostra lista completa de alunos -->
<script>
    function mostrarMais(link) {
        const lista = link.previousElementSibling;
        const extras = lista.querySelectorAll('.extra');
        const mostrando = extras[0] && !extras[0].classList.contains('d-none');

        extras.forEach(li => li.classList.toggle('d-none'));

        link.textContent = mostrando ? 'Ver mais' : 'Ver menos';
    }
</script>

</body>
</html>
