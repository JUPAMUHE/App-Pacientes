@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Registrar Paciente</h2>
    
    <form id="formPaciente" action="{{ route('pacientes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo_documento_id" class="form-label">Tipo de Documento*</label>
                    <select name="tipo_documento_id" id="tipo_documento_id" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach ($tipos_documento as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="numero_documento" class="form-label">Número de Documento*</label>
                    <input type="number" name="numero_documento" id="numero_documento" class="form-control" required>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre1" class="form-label">Primer Nombre*</label>
                    <input type="text" name="nombre1" id="nombre1" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre2" class="form-label">Segundo Nombre</label>
                    <input type="text" name="nombre2" id="nombre2" class="form-control">
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="apellido1" class="form-label">Primer Apellido*</label>
                    <input type="text" name="apellido1" id="apellido1" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="apellido2" class="form-label">Segundo Apellido</label>
                    <input type="text" name="apellido2" id="apellido2" class="form-control">
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="genero_id" class="form-label">Género*</label>
                    <select name="genero_id" id="genero_id" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="departamento_id" class="form-label">Departamento*</label>
                    <select name="departamento_id" id="departamento_id" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="municipio_id" class="form-label">Municipio*</label>
                    <select name="municipio_id" id="municipio_id" class="form-control" required>
                        <option value="">Seleccione un departamento primero</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto de Perfil</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">

                    <div class="mt-2">
                        <img id="previewImagen" src="{{ asset('images/default-user.png') }}" alt="Sin imagen" class="img-thumbnail" width="140">
                    </div>
                </div>
            </div>
        </div>
    
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Guardar</button>
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

        $("#formPaciente").validate({
            rules: {
                tipo_documento_id: { required: true },
                numero_documento: { required: true, digits: true },
                nombre1: { required: true, minlength: 2 },
                apellido1: { required: true, minlength: 2 },
                genero_id: { required: true },
                departamento_id: { required: true },
                municipio_id: { required: true }
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
                    title: "¿Estás seguro que desea guardar este registo?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#16c457",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Sí, guardar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });

        $('#departamento_id').change(function() {
            var departamento_id = $(this).val();
            $('#municipio_id').html('<option value="">Cargando...</option>');
 
            if (departamento_id) {
                $.ajax({
                    url: '{{ url("get-municipios") }}/' + departamento_id,
                    type: 'GET',
                    success: function(data) {
                        var options = '<option value="">Seleccione...</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.nombre + '</option>';
                        });
                        $('#municipio_id').html(options);
                    }
                });
            } else {
                $('#municipio_id').html('<option value="">Seleccione un departamento primero</option>');
            }
        });
    });
</script>
@endsection
