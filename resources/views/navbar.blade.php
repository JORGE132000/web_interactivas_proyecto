@extends('welcome')

@section('navbar')
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

@endsection