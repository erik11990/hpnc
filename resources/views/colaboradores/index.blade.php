<script src="js/colaborador.js?rev= <?php echo time(); ?>"></script>
<br>
<section class="content">
    @include('colaboradores._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
    @include('colaboradores._tabla')
</section>
<script>
    $(document).ready(function() {
        $('#tabla_colaborador_simple').DataTable();
    });
</script>
<script>
    list_colaborador_simple();
    $('#btn_actualizar_colaborador').hide();
</script>
