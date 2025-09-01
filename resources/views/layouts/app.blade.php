<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Pix Parcelado</title>

    {{-- Bootstrap 5 via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom styles --}}
    <style>
        body {
            background: #0f0f1f;
            color: #fff;
        }

        .btn-hover:hover {
            filter: brightness(1.2);
        }

        .navbar-custom {
            background: linear-gradient(135deg,#1a1a2e,#162447);
        }

        .navbar-brand {
            font-weight: bold;
            color: #0ff !important;
        }

        .nav-link {
            color: #fff !important;
        }

        .nav-link:hover {
            color: #0ff !important;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            transition: all 0.3s;
            box-shadow: 0 0 15px #0ff;
        }
    </style>

    @stack('styles')
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Sistema Pix</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.index') }}"><i class="bi bi-people me-1"></i> Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.create') }}"><i class="bi bi-person-plus me-1"></i> Cadastrar Cliente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('installments.index','pendente') }}"><i class="bi bi-card-checklist me-1"></i> Parcelas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Conteúdo --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- Bootstrap JS via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
