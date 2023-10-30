<script src="js/user.js?rev= <?php echo time(); ?>"></script>
<br>
<form id="form_user">
    <input type="hidden" id="id" name="id">
    <div class="card-body register-card-body offset-md-4 col-md-4">
        <p class="login-box-msg">Nuevo usuario</p>
        <div class="fixed-top d-flex justify-content-end p-3" style="z-index: 1050; margin-top: 1.5cm;">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
                <div class="toast-header bg-danger text-white">
                    <strong class="mr-auto">¡Alerta!</strong>
                    <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="errores" class="toast-body">
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="text" name="name" id="name" class="input form-control"
                placeholder="Nombres y apellidos">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" name="email" id="email" class="input form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="form-group mb-3">
            <select class="form-control" id="rol" name="rol">
            </select>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" id="password" class="input form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" id="passwordConfirm" class="input form-control"
                placeholder="Retype password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <button id="btn_user" type="button" class="btn btn-primary btn-block" onclick="Registrar_user()">Registrar</button>
            <button id="btn_user_update" type="button" class="btn btn-info btn-block" onclick="Actualizar_user()">Actualizar</button>
        </div>
    </div>
</form>
<br>
@include('_modal_mensajes._moda_guardar')
@include('_modal_mensajes._moda_actualizar')
@include('_modal_mensajes._moda_estado')
@include('auth._tabla')
<script>
    $(document).ready(function() {
        $('#tabla_user_simple').DataTable();
    });
</script>
<script>
    list_user_simple();
    roles();
    $('#btn_user_update').hide();
</script>
