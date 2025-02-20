<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h3 class="text-center">Iniciar Sesión</h3>
        <form id="loginForm">
            <div class="mb-3">
                <label class="form-label">Número de Documento</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" id="numero_documento" name="numero_documento" class="form-control" placeholder="Ingrese su documento" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su contraseña" required>
                </div>
            </div>

            <div id="mensaje"></div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function () {

            $("#loginForm").validate({
                rules: {
                    password: { required: true },
                    numero_documento: { required: true, digits: true }
                },
                messages: {
                    password: "La contraseña es un campo obligatorio.",
                    numero_documento: {
                        required: "El número de documento es obligatorio.",
                        digits: "Solo puede ingresar valores numericos."
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function (error, element) {
                    error.addClass("mt-1");
                    error.insertAfter(element);
                },
                highlight: function (element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    $.ajax({
                        url: "/api/login",
                        type: "POST",
                        data: {
                            numero_documento: $("#numero_documento").val(),
                            password: $("#password").val()
                        },
                        success: function (response) {
                            $("#mensaje").html('<div class="alert alert-success">' + response.message + '</div>');

                            localStorage.setItem("auth_token", response.token);

                            setTimeout(() => {
                                window.location.href = "/pacientes";
                            }, 900);
                        },
                        error: function (xhr) {
                            $("#mensaje").html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                        }
                    });
                }
            });

            
        });
    </script>

</body> 
</html>
