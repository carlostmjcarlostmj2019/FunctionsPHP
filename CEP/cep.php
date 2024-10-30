<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de CEP</title>
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
        <a class="navbar-brand" href="#">Consulta de CEP</a>
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
        <h1 class="mb-4">Consulta de CEP</h1>

        <!-- Formulário de Consulta de CEP -->
        <form id="consultaCepForm">
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="consultarCEP()">Consultar <i
                    class="fas fa-search"></i></button>
        </form>

        <!-- Resultados da Consulta -->
        <div id="resultados" class="mt-4"></div>
    </div>

    <!-- Rodapé -->
    <footer class="fixed-bottom bg-dark text-white text-center p-2">
        <p>&copy; <script>document.write(new Date().getFullYear());</script> Sua Empresa. Todos os direitos reservados.</p>
    </footer>

    <!-- Bootstrap e jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Seu Script JavaScript -->
    <script>
        function consultarCEP() {
            var cep = document.getElementById('cep').value.replace(/\D/g, '');

            // Verifica se o CEP possui o tamanho correto
            if (cep.length !== 8) {
                alert("Por favor, insira um CEP válido com 8 dígitos.");
                return;
            }

            // Fazendo a requisição AJAX para a API ViaCEP
            var apiUrl = 'https://viacep.com.br/ws/' + cep + '/json/';

            fetch(apiUrl)
                .then(response => response.json())
                .then(data => exibirResultados(data))
                .catch(error => console.error('Erro ao consultar API:', error));
        }

        function exibirResultados(data) {
            var resultadosDiv = document.getElementById('resultados');

            if (data.erro) {
                resultadosDiv.innerHTML = '<p class="text-danger">CEP não encontrado. Verifique e tente novamente.</p>';
                return;
            }

            resultadosDiv.innerHTML = '<p><strong>Rua:</strong> ' + (data.logradouro || 'N/A') + '</p>' +
                '<p><strong>Bairro:</strong> ' + (data.bairro || 'N/A') + '</p>' +
                '<p><strong>Cidade:</strong> ' + data.localidade + '</p>' +
                '<p><strong>Estado:</strong> ' + data.uf + '</p>' +
                '<p><strong>DDD:</strong> ' + data.ddd + '</p>';
        }
    </script>
</body>

</html>
