<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISDOC | Iniciar Sesión</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- AdminLTE 3 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

  <style>
    /* --- Estilos Personalizados Tema Morado --- */
    body.login-page {
      background: linear-gradient(135deg, #1a102f 0%, #2d1b4d 100%);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-box {
      width: 420px;
    }

    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.4) !important;
      overflow: hidden;
    }

    .card-primary.card-outline {
      border-top: 3px solid #6f42c1;
    }

    .card-header {
      background-color: #ffffff;
      border-bottom: 1px solid #f1f5f9;
      padding: 2rem 1.5rem 1rem 1.5rem;
    }

    .brand-logo {
      font-size: 1.8rem;
      font-weight: 700;
      color: #0f172a;
      letter-spacing: -0.5px;
    }

    .brand-logo span, .text-purple {
      color: #6f42c1 !important;
    }

    .form-control {
      border-radius: 8px;
      height: 48px;
      border: 1px solid #cbd5e1;
      padding-left: 1rem;
      transition: all 0.2s;
    }

    .form-control:focus {
      border-color: #6f42c1;
      box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.15);
    }

    .input-group-text {
      border-radius: 0 8px 8px 0;
      background-color: transparent;
      border-color: #cbd5e1;
      color: #64748b;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
      border-color: #6f42c1;
      background-color: #6f42c1;
    }

    .custom-control-input:focus ~ .custom-control-label::before {
      box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(111, 66, 193, 0.25);
    }

    .custom-control-label {
      color: #64748b;
      font-weight: 400;
      cursor: pointer;
    }

    .btn-purple {
      background-color: #6f42c1;
      color: white;
      border-color: #6f42c1;
      border-radius: 8px;
      height: 48px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.2s ease;
    }

    .btn-purple:hover {
      background-color: #5a32a3;
      border-color: #5a32a3;
      color: white;
      transform: translateY(-1px);
    }

    .btn-purple:focus, .btn-purple.focus {
      box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.5);
    }

    .link-purple {
      color: #6f42c1;
      transition: color 0.2s;
    }
    
    .link-purple:hover {
      color: #5a32a3;
      text-decoration: underline;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <div class="brand-logo mb-1">
        <i class="fas fa-folder-open text-purple mr-2"></i><b>SISDOC</b> <span>| S.S.C.</span>
      </div>
      <p class="text-muted small mb-0">Ingresa tus credenciales para acceder</p>
    </div>
    
    <div class="card-body login-card-body p-4">
      <form action="{{ route('login') }}" method="POST">
        <!-- Token CSRF requerido para evitar el error 419 -->
        @csrf
        
        <!-- Campo Email -->
        <div class="form-group mb-3">
          <label class="text-secondary small font-weight-bold">Correo Electrónico</label>
          <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="nombre@ejemplo.com" value="{{ old('email') }}" required autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Campo Contraseña -->
        <div class="form-group mb-3">
          <label class="text-secondary small font-weight-bold">Contraseña</label>
          <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Opciones adicionales -->
        <div class="row align-items-center my-3">
          <div class="col-6">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="remember" name="remember">
              <label class="custom-control-label small" for="remember">Recordarme</label>
            </div>
          </div>
          <div class="col-6 text-right">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="small link-purple font-weight-bold">¿Olvidaste tu clave?</a>
            @endif
          </div>
        </div>

        <!-- Botón de Envío -->
        <div class="mt-4">
          <button type="submit" class="btn btn-purple btn-block">
            <i class="fas fa-sign-in-alt mr-2"></i> Acceder al Sistema
          </button>
        </div>
      </form>
    </div>
    
    <div class="card-footer text-center bg-white border-0 pb-4">
      <small class="text-muted">© 2026 SISDOC. Todos los derechos reservados.</small>
    </div>
  </div>

</div>

</body>
</html>