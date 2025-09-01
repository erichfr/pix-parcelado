<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | PIX Parcelado</title>

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Estilos Globais --}}
    <style>
        body {
            background-color: #0d0d1a;
            color: #ffffff;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Cards comuns e dashboard */
        .card-hover {
            border-radius: 15px;
            background: linear-gradient(135deg, #1a1a2e, #162447);
            box-shadow: 0 0 15px rgba(0,255,255,0.2);
            transition: transform 0.3s, box-shadow 0.3s, filter 0.3s;
            cursor: pointer;
            border: none;
            color: #fff;
        }

        .card-hover:hover {
            transform: translateY(-15px) rotateX(2deg) rotateY(2deg);
            box-shadow: 0 15px 40px rgba(0,255,255,0.6);
            filter: brightness(1.15);
        }

        /* Botões com efeito neon */
        .btn-hover {
            transition: all 0.3s;
            box-shadow: 0 0 5px rgba(0,255,255,0.4);
        }

        .btn-hover:hover {
            filter: brightness(1.25);
            transform: translateY(-3px);
            box-shadow: 0 0 15px rgba(0,255,255,0.9);
        }

        /* Quick Access links */
        .quick-link {
            background: linear-gradient(135deg, #1a1a2e, #0f0f2a);
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s, filter 0.3s;
            text-decoration: none;
        }

        .quick-link:hover {
            transform: translateY(-10px) rotateX(3deg) rotateY(3deg);
            box-shadow: 0 15px 50px rgba(0,255,255,0.7);
            filter: brightness(1.2);
        }

        .quick-link h4, .quick-link p {
            color: #0ff;
        }

        .card-title i, .card-text i {
            color: #0ff;
        }

        .alert {
            background-color: #22223b;
            color: #f0f0f0;
            border: none;
        }

        a { text-decoration: none; }

        .progress {
            background-color: #111 !important;
        }

        .progress-bar {
            box-shadow: 0 0 8px rgba(0,255,255,0.7);
            transition: width 1s ease-in-out;
        }
        .progress-bar.bg-warning { background-color: #ffc107 !important; box-shadow: 0 0 10px #ffc107; }
        .progress-bar.bg-success { background-color: #198754 !important; box-shadow: 0 0 10px #198754; }
        .progress-bar.bg-danger  { background-color: #dc3545 !important; box-shadow: 0 0 10px #dc3545; }

    </style>


    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1a1a2e;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">PIX Parcelado</a>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
