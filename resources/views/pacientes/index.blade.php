@extends('layouts.app')
@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    <div class="d-flex justify-content-between mb-4">
        <h2>Lista de Pacientes</h2>
        <a href="{{ route('pacientes.create') }}" class="btn btn-primary mb-3">Nuevo Paciente</a>
    </div>
    <table id="pacientesTable" class="table table-bordered table-striped ">
        <thead>
            <tr>
                <th>#</th>
                <th>Documento</th>
                <th>Nombre Completo</th>
                <th>Género</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paciente->numero_documento }}</td>
                <td>{{ $paciente->nombre1 }} {{ $paciente->nombre2 }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</td>
                <td>{{ $paciente->genero->nombre }}</td>
                <td>{{ $paciente->departamento->nombre }}</td>
                <td>{{ $paciente->municipio->nombre }}</td>
                <td class="text-center">
                    <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-warning">Editar</a>
                    <form id="formEliminar{{ $paciente->id }}" action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmarEliminacion({{ $paciente->id }})">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#pacientesTable').DataTable({
        responsive: true,
        destroy: true,
        language: {
            url: '/js/es-ES.json'
        }
    });
});

function confirmarEliminacion(id) {
    Swal.fire({
        title: "¿Estás seguro que desea eliminar este registo?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formEliminar" + id).submit();
        }
    });
}
</script>
@endsection
