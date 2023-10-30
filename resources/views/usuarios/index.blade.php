<script src="js/usuario.js?rev= <?php echo time(); ?>"></script>
<br>
<section class="content">
    @include('usuarios._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
    @include('usuarios._tabla')
</section>
<script>
    $(document).ready(function() {
        $('#tabla_usuario_simple').DataTable();
    });
</script>
<script>
    list_usuario_simple();
    $('#btn_actualizar_usuario').hide();
</script>
