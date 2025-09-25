<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Empleados')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8fafc; }
        .navbar-brand { font-weight: bold; }
        .card { box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .table th, .table td { vertical-align: middle; }
    .bg-femenino { background-color: #ff69b4 !important; color: #fff !important; }
    .bg-area-admin { background-color: #6c757d !important; color: #fff !important; }
    .bg-area-rh { background-color: #20c997 !important; color: #fff !important; }
    .bg-area-dev { background-color: #198754 !important; color: #fff !important; }
    .bg-area-ventas { background-color: #ffc107 !important; color: #212529 !important; }
    .bg-area-sistemas { background-color: #0d6efd !important; color: #fff !important; }
    .bg-area-conta { background-color: #fd7e14 !important; color: #fff !important; }
    .bg-area-marketing { background-color: #6610f2 !important; color: #fff !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('empleados.index') }}">Gestión de Empleados</a>
        </div>
    </nav>
        <main class="container flex-grow-1">
                @yield('content')
                <!-- Modales de alerta para acciones -->
                @if(session('success'))
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="successModalLabel">¡Éxito!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(session('error'))
                <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </main>
    <footer class="bg-primary text-white py-4 mt-5 shadow-lg">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span class="fw-bold">Gestión de Empleados</span> &mdash; Laravel 12.x &bull; PHP 8.2
            </div>
            <div>
                <span>Desarrollado por <a href="mailto:victor.gomez@correo.com" class="text-white text-decoration-underline">Victor Gomez</a> &copy; {{ date('Y') }}</span>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if(document.getElementById('successModal')) {
                var modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();
            }
            if(document.getElementById('errorModal')) {
                var modal = new bootstrap.Modal(document.getElementById('errorModal'));
                modal.show();
            }
        });
    </script>
</body>
</html>
