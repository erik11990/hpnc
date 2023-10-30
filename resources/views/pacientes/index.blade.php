<script src="js/paciente.js?rev= <?php echo time(); ?>"></script>
<br>
<section class="content">
    @include('pacientes._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
    @include('pacientes._tabla')
</section>
<script>
    $(document).ready(function() {
        $('#tabla_paciente_simple').DataTable();
    });
</script>
<script>
    list_paciente_simple();
    $('#btn_actualizar_usuario').hide();
</script>
