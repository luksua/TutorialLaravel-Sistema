<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')
    @section('content')
        <div class="container">
            <h1>Listado Empleados</h1>

            <a href="{{ url('/empleados/create') }}" class="btn btn-success">Registrar Nuevo Empleado</a>
            @if(Session::has('mensaje'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('mensaje') }}
                </div>
            @endif

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>N.</th>
                        <th>Foto</th>
                        <th>Nombres</th>
                        <th>P. Apellido</th>
                        <th>S. Apellido</th>
                        <th>Correo</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $datos)
                        <tr>
                            <td>{{ $datos->id }}</td>
                            <td><img src="{{ asset('storage') . '/' . $datos->Foto }}" alt="" width="250"></td>
                            <td>{{ $datos->Nombres }}</td>
                            <td>{{ $datos->PrimerApel }}</td>
                            <td>{{ $datos->SegundoApel }}</td>
                            <td>{{ $datos->Correo }}</td>
                            <td>

                                <!-- enlace para la opción editar del Index que al darle click nos lleve al archivo Update.blade.php llevándose el registro seleccionado -->

                                <a href="{{ url('/empleados/' . $datos->id . '/edit') }}" class="btn btn-warning d-inline">Editar</a> |

                                <form action="{{ url('/empleados/' . $datos->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input type="submit" onclick="return confirm('¿Deseas Eliminarlo?')" value="Eliminar" class="btn btn-danger">
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $empleados->Links() !!}
        </div>
    @endsection
</body>

</html>