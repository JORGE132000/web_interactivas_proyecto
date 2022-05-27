<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Administrar Artículos</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container pt-5 mb-5">
        <h1>Artículos</h1>

        @if($articulos->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        {{-- <th scope="col">ID</th> --}}
                        <th scope="col">Imagen</th>
                        <th scope="col">Articulo</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($articulos as $articulo)
                    <tr>
                        <td><img src="{{asset('images/' . $articulo->image_path)}}" alt="{{$articulo->articulo}}" width="100"></td>
                        <th scope="row">{{$articulo->articulo}}</th>
                        <td>{{$articulo->categoria}}</td>
                        <td>{{$articulo->precio}}</td>
                        <td>{{$articulo->descripcion}}</td>
                        <td>
                            <a class="btn btn-danger" href="/eliminar/{{$articulo->id}}">Eliminar</a> 
                            <a class="btn btn-secondary" href="/editaproducto/{{$articulo->id}}">Editar</a> 
                            <a class="btn btn-primary" href="/producto/{{$articulo->id}}">Ver</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <a type="button" class="btn btn-secondary" href="/">Ir al inicio</a>
            <a type="button" class="btn btn-primary" href="/creaproducto">Crear Artículo</a>
            <a type="button" class="btn btn-success" href="/exportart">Exportar .CSV</a>
        @else
            <h2>No hay artículos existentes en el catálogo :(</h2>
            <h3>¿Porqué no agregas uno?, haz click <a href="creaproducto">aquí</a></h3>
            <a type="button" class="btn btn-danger" href="/">Cancelar</a>
        @endif
    </div>
</body>
</html>