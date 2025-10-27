
<?php $__env->startSection('title','Ruta C - Ingreso de empresarios'); ?>
<?php $__env->startSection('description',''); ?>

<?php $__env->startSection('content'); ?>
<div id="login">
    <form method="post" action="<?php echo e(route('login.process')); ?>">
        <?php echo csrf_field(); ?>
        <h2 class="mayus mb-20">Iniciar sesión</h2>
        <div class="row">
            <label class="textl">Email</label>
            <input type="text" name="email" tabindex="4" placeholder="Email" autocomplete="username" />
        </div>
        <div class="row">
            <label class="textl">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Contraseña" tabindex="5" required autocomplete="current-password" />
            <span id="divMostrarPassword" style="position: absolute; margin-left: -30px; cursor: pointer; padding: 15px 0px; width: 30px;" >
                <i class="fa fa-solid fa-eye bi bi-eye-slash" id="togglePassword"></i>
            </span>
        </div>
        <div class="row" tabindex="6">
            <input class="button button-primary" type="submit" name="send" value="Iniciar sesión">
        </div>
        
        <!-- Separador -->
        <div class="row text-center" style="margin: 20px 0;">
            <div style="position: relative;">
                <hr style="border: 1px solid #e0e0e0; margin: 0;">
                <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: white; padding: 0 15px; color: #666; font-size: 14px;">O</span>
            </div>
        </div>
        
        <!-- Botón de Google -->
        <div class="row" tabindex="7">
            <a href="<?php echo e(route('google.login')); ?>" class="button button-google" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Continuar con Google
            </a>
        </div>
        
        <div class="row" tabindex="8">
            <a class="button button-third mt-10 forgot-password block" href="#" id="openForgotPasswordModal" tabindex="9">¿Olvidó su contraseña?</a>
        </div>
    </form>
</div>

<!-- Modal de Recuperación de Contraseña -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mayus" id="forgotPasswordModalLabel">Recuperar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
                
                <form id="forgotPasswordForm">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <label class="textl">Correo electrónico</label>
                        <input type="email" id="reset_email" name="email" placeholder="Correo electrónico" required autofocus>
                        <div class="text-danger" id="email-error" style="text-align: left; margin-top: 5px;"></div>
                    </div>
                    
                    <div class="row mt-20">
                        <button type="submit" class="button button-primary" id="submit-forgot-btn">
                            Enviar enlace de recuperación
                        </button>
                    </div>
                </form>

                <div id="forgot-success-message" style="display: none; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; margin-top: 15px; color: #155724;"></div>
                <div id="forgot-error-message" style="display: none; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; margin-top: 15px; color: #721c24;"></div>
            </div>
        </div>
    </div>
</div>

<style>
    #forgotPasswordModal .modal-content {
        border-radius: 10px;
    }
    
    #forgotPasswordModal .modal-header {
        border-bottom: 1px solid #e9ecef;
    }
    
    #forgotPasswordModal .modal-title {
        font-weight: 600;
        font-size: 18px;
    }
    
    #forgotPasswordModal .modal-body {
        padding: 30px;
    }
    
    #forgotPasswordModal .row {
        margin-bottom: 15px;
    }
    
    #forgotPasswordModal input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    #forgotPasswordModal input:focus {
        border-color: #007bff;
        outline: none;
    }
    
    #forgotPasswordModal label {
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }
    
    /* Estilos para el botón de Google */
    .button-google {
        background: white;
        color: #333;
        border: 1px solid #dadce0;
        border-radius: 4px;
        padding: 12px 16px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px 0 rgba(60,64,67,.3), 0 1px 3px 1px rgba(60,64,67,.15);
    }
    
    .button-google:hover {
        background: #f8f9fa;
        border-color: #dadce0;
        box-shadow: 0 1px 3px 0 rgba(60,64,67,.3), 0 4px 8px 3px rgba(60,64,67,.15);
        color: #333;
        text-decoration: none;
    }
    
    .button-google:active {
        background: #f1f3f4;
        box-shadow: 0 1px 2px 0 rgba(60,64,67,.3), 0 2px 6px 2px rgba(60,64,67,.15);
    }
</style>

<script>
  $(document).ready(function () {
      // Toggle password visibility
      $("#divMostrarPassword").click(function () {
          console.log($("#password").attr('type'));
          var tipo  = ($("#password").attr('type') === "password" ? "text" : "password");
          console.log(tipo);
          password.setAttribute("type", tipo);
      });
      
      // Abrir modal de recuperación
      $('#openForgotPasswordModal').click(function(e) {
          e.preventDefault();
          const modal = new bootstrap.Modal(document.getElementById('forgotPasswordModal'));
          modal.show();
      });
      
      // Enviar formulario de recuperación
      $('#forgotPasswordForm').on('submit', function(e) {
          e.preventDefault();
          
          const email = $('#reset_email').val();
          const submitBtn = $('#submit-forgot-btn');
          const emailError = $('#email-error');
          const successMessage = $('#forgot-success-message');
          const errorMessage = $('#forgot-error-message');
          
          // Limpiar mensajes anteriores
          emailError.text('');
          successMessage.hide();
          errorMessage.hide();
          
          // Validación básica
          if (!email) {
              emailError.text('El correo electrónico es requerido.');
              return;
          }
          
          // Deshabilitar botón y mostrar loading
          submitBtn.prop('disabled', true);
          submitBtn.text('Enviando...');
          
          $.ajax({
              url: '<?php echo e(route("password.send")); ?>',
              method: 'POST',
              data: {
                  email: email,
                  _token: '<?php echo e(csrf_token()); ?>'
              },
              success: function(response) {
                  if (response.success) {
                      successMessage.show();
                      successMessage.html('<i class="fa fa-check-circle" aria-hidden="true"></i> ' + response.message);
                      $('#forgotPasswordForm')[0].reset();
                      
                      // Cerrar modal después de 2 segundos
                      setTimeout(function() {
                          const modal = bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal'));
                          modal.hide();
                          successMessage.hide();
                      }, 2000);
                  } else {
                      errorMessage.show();
                      errorMessage.html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' + response.message);
                  }
              },
              error: function(xhr) {
                  const response = xhr.responseJSON;
                  errorMessage.show();
                  errorMessage.html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> ' + 
                      (response && response.message ? response.message : 'Error al enviar el correo. Por favor intenta nuevamente.'));
              },
              complete: function() {
                  submitBtn.prop('disabled', false);
                  submitBtn.text('Enviar enlace de recuperación');
              }
          });
      });
  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Dir-CIDS\Documents\RutaC_Brayan\rutadecrecimiento-1\resources\views/website/company/login.blade.php ENDPATH**/ ?>