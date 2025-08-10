<h1>{{ $modo }} Empleados</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <input class="form-control" type="text" value="{{ isset($empleado->Nombres) ? $empleado->Nombres : old('Nombres') }}" name="Nombres"
        id="Nombres" placeholder="Escriba sus nombres"><br>
    <input class="form-control" type="text" value="{{ isset($empleado->PrimerApel) ? $empleado->PrimerApel : old('PrimerApel') }}" name="PrimerApel"
        id="PrimerApel" placeholder="Escriba su primer apellido"><br>
    <input class="form-control" type="text" value="{{ isset($empleado->SegundoApel) ? $empleado->SegundoApel : old('SegundoApel') }}" name="SegundoApel"
        id="SegundoApel" placeholder="Escriba su segundo apellido"><br>
    <input class="form-control" type="text" value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo') }}" name="Correo" id="Correo"
        placeholder="Escriba su correo"><br>
    <input class="form-control" type="file" name="Foto" id="Foto"><br>
    @if(isset($empleado->Foto))
        <img src="{{ asset('storage') . '/' . $empleado->Foto }}" alt="" width="220">
    @endif
    <input class="btn btn-warning" type="submit" value="{{ $modo }} Registro">
</div>