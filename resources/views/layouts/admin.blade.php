<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('admin_title') - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<style>
    @media (min-width: 800px) {
        .sidebar {
            height: 100vh;
            position: fixed;
        }
    }
</style>
<body>
<div class="row">
    <div class="col-md-3 col-12">
        <div class="d-flex flex-column p-3 text-white bg-dark sidebar">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Admin</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{route('admin.index')}}"
                       class="nav-link text-white {{ Route::currentRouteNamed('admin.index') ? 'active' : '' }}"
                       aria-current="page">
                        <i class="bi bi-speedometer2"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}"
                       class="nav-link text-white {{ Route::currentRouteNamed('admin.users.index') ? 'active' : '' }}"
                       aria-current="page">
                        <i class="bi bi-people"></i> Les utilisateurs
                    </a>
                </li>
                <li>
                    <a class="nav-link text-white" href="{{route('dashboard.logout')}}">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </a>
                </li>
                {{--<li class="nav-item">
                    <a href="{{route('admin.livrets.index')}}"
                       class="nav-link text-white {{ Route::currentRouteNamed('admin.livrets.index') ? 'active' : '' }}"
                       aria-current="page">
                        <i class="bi bi-speedometer2"></i> Les livrets
                    </a>
                </li>--}}
            </ul>
            <hr>
        </div>
    </div>
    <div class="col-md-9 col-10">
        <main>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('admin_content')
        </main>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p>&copy; 2024 - Livret d'accueil</p>
                    </div>
                </div>
            </div>
            @yield('admin_script')
        </footer>
    </div>
</div>
</body>
</html>
