@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Editar Paciente</h2>
    <form id="formEditPaciente" action="{{ route('pacientes.update', $paciente->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="row">
            <!-- Fila 1 -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo_documento_id" class="form-label">Tipo de Documento*</label>
                    <select name="tipo_documento_id" id="tipo_documento_id" class="form-control" required>
                        @foreach($tipos_documento as $tipo)
                            <option value="{{ $tipo->id }}" {{ $paciente->tipo_documento_id == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="numero_documento" class="form-label">Número de Documento*</label>
                    <input type="number" name="numero_documento" id="numero_documento" class="form-control" value="{{ $paciente->numero_documento }}" required>
                </div>
            </div>
    
            <!-- Fila 2 -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre1" class="form-label">Primer Nombre*</label>
                    <input type="text" name="nombre1" id="nombre1" class="form-control" value="{{ $paciente->nombre1 }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre2" class="form-label">Segundo Nombre</label>
                    <input type="text" name="nombre2" id="nombre2" class="form-control" value="{{ $paciente->nombre2 }}">
                </div>
            </div>
    
            <!-- Fila 3 -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="apellido1" class="form-label">Primer Apellido*</label>
                    <input type="text" name="apellido1" id="apellido1" class="form-control" value="{{ $paciente->apellido1 }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="apellido2" class="form-label">Segundo Apellido</label>
                    <input type="text" name="apellido2" id="apellido2" class="form-control" value="{{ $paciente->apellido2 }}">
                </div>
            </div>
    
            <!-- Fila 4 -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="genero_id" class="form-label">Género*</label>
                    <select name="genero_id" id="genero_id" class="form-control" required>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->id }}" {{ $paciente->genero_id == $genero->id ? 'selected' : '' }}>
                                {{ $genero->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="departamento_id" class="form-label">Departamento*</label>
                    <select name="departamento_id" id="departamento" class="form-control" required>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" {{ $paciente->departamento_id == $departamento->id ? 'selected' : '' }}>
                                {{ $departamento->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <!-- Fila 5 -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="municipio_id" class="form-label">Municipio*</label>
                    <select name="municipio_id" id="municipio" class="form-control" required>
                        <option value="{{ $paciente->municipio_id }}" selected>
                            {{ $paciente->municipio->nombre ?? 'Seleccione' }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto del Paciente</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    @if ($paciente->foto)
                        <div class="mt-2">
                            <img id="previewImagen" src="{{ asset('storage/' . $paciente->foto) }}" alt="Foto del paciente" class="img-thumbnail" width="150">
                        </div>
                    @else
                        <div class="mt-2">
                            <img id="previewImagen" src="{{ asset('images/default-user.png') }}" alt="Sin imagen" class="img-thumbnail" width="130">
                        </div>
                    @endif
                </div>
            </div>
            

        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
    
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#foto').on('change', function(event) {
                let file = event.target.files[0]; 

                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImagen').attr('src', e.target.result); 
                    }
                    reader.readAsDataURL(file);
                }
            });

            $("#formEditPaciente").validate({
                rules: {
                    tipo_documento_id: { required: true },
                    numero_documento: { required: true, digits: true },
                    nombre1: { required: true, minlength: 2 },
                    apellido1: { required: true, minlength: 2 },
                    genero_id: { required: true },
                    departamento: { required: true },
                    municipio: { required: true }
                },
                messages: {
                    tipo_documento_id: "Selecciona un tipo de documento.",
                    numero_documento: {
                        required: "El número de documento es obligatorio.",
                        digits: "Solo se permiten números."
                    },
                    nombre1: {
                        required: "El primer nombre es obligatorio.",
                        minlength: "Debe tener al menos 2 caracteres."
                    },
                    apellido1: {
                        required: "El primer apellido es obligatorio.",
                        minlength: "Debe tener al menos 2 caracteres."
                    },
                    genero_id: "Selecciona un género.",
                    departamento_id: "Selecciona un departamento.",
                    municipio_id: "Selecciona un municipio."
                },
                errorElement: "div",
                errorClass: "text-danger",
                highlight: function (element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    Swal.fire({
                        title: "¿Estás seguro que desea actualizar este registo?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#16c457",
                        cancelButtonColor: "#6c757d",
                        confirmButtonText: "Sí, actualizar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
      
            let departamento_id = $('#departamento').val();
            let municipio_id = {{ $paciente->municipio_id ?? 'null' }}; 

            cargarMunicipios(departamento_id, municipio_id);

            $('#departamento').on('change', function() {
                let departamento_id = $(this).val();
                cargarMunicipios(departamento_id, null);
            });

            function cargarMunicipios(departamento_id, municipio_id) {
                $('#municipio').html('<option value="">Cargando...</option>');

                if (departamento_id) {
                    $.ajax({
                        url: '{{ url("get-municipios") }}/' + departamento_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#municipio').empty();
                            let options = '<option value="">Seleccione</option>';
                            data.forEach(function(municipio) {
                                let selected = (municipio.id == municipio_id) ? 'selected' : '';
                                options += `<option value="${municipio.id}" ${selected}>${municipio.nombre}</option>`;
                            });

                            $('#municipio').html(options);
                        }
                    });
                } else {
                    $('#municipio').empty().append('<option value="">Seleccione</option>');
                }
            }

        
        });
    </script>
  
@endsection
