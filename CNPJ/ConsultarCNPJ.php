<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CNPJ</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            padding-top: 60px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Consulta de CNPJ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Página Inicial</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container mt-5">
        <h1 class="mb-4">Consulta de CNPJ</h1>

        <!-- Formulário de Consulta de CNPJ -->
        <form id="consultaForm">
            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="consultarCNPJ()">Consultar <i
                    class="fas fa-search"></i></button>
        </form>

        <!-- Resultados da Consulta -->
        <div id="resultados" class="mt-4"></div>
    </div>

    <!-- Rodapé -->
    <footer class="fixed-bottom bg-dark text-white text-center p-2">
        <p>&copy; <?php echo date('Y'); ?> Sua Empresa. Todos os direitos reservados.</p>
    </footer>

    <!-- Bootstrap e jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Seu Script JavaScript -->
    <script>
        function consultarCNPJ() {
            var cnpj = document.getElementById('cnpj').value;

            // Fazendo a requisição AJAX para a API
            var apiUrl = 'https://publica.cnpj.ws/cnpj/' + cnpj;

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => exibirResultados(data))
                .catch(error => console.error('Erro ao consultar API:', error));
        }

        function exibirResultados(data) {
            // Atualizando a div "resultados" com os dados retornados
            var resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = '<p><strong>Razão Social:</strong> ' + data.razao_social + '</p>' +
                '<p><strong>Capital Social:</strong> R$ ' + data.capital_social + '</p>' +
                '<p><strong>Atividade Principal:</strong> ' + data.estabelecimento.atividade_principal.descricao + '</p>' +
                '<p><strong>Endereço:</strong> ' + data.estabelecimento.logradouro + ', ' + data.estabelecimento.numero +
                ' - ' + data.estabelecimento.bairro + ', ' + data.estabelecimento.cidade.nome + '/' +
                data.estabelecimento.estado.sigla + '</p>' +
                '<p><strong>Email:</strong> ' + data.estabelecimento.email + '</p>';
        }
    </script>
</body>

</html>
