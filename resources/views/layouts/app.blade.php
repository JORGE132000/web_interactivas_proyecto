<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        {{-- <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation') --}}

            <!-- Page Heading -->
            {{-- <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header> --}}

            <!-- Page Content -->
            <main>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/">Accesorios A&P</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
                                <li class="nav-item dropdown">
                                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Categorías
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach($categorias as $categoria)
                                            <li><a class="dropdown-item" href="/categoria/{{$categoria->id}}">{{$categoria->categoria}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
        
                                @auth
                                    <li class="nav-item dropdown">
                                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Administrador
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="/administracategorias">Administrar Categorías</a></li>
                                            <li><a class="dropdown-item" href="/verarticulos">Administrar Productos</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="/creaproducto">Agregar Producto</a></li>
                                        </ul>
                                    </li>
                                @endauth
                                
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        @auth
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
        
                                                <x-responsive-nav-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                        class="nav-link active">
                                                    {{ __('Cerrar Sesión') }}
                                                </x-responsive-nav-link>
        
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" class="nav-link active">Iniciar Sesión</a>
                                        @endauth
                                    </li>
                                @endif
                            </ul>
                            <form action="/busqueda" method="POST" class="d-flex" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="busqueda">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </nav>
        

                @yield('content')
            </main>
        {{-- </div> --}}
    </body>
</html>
