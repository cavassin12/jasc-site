<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrativo JASC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">JASC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/painel/noticias')}}">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/painel/jogos')}}">Jogos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/painel/galeria')}}">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/painel/ranking')}}">Classificações</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
       @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>