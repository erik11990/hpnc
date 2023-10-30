<script src="js/producto.js?rev= <?php echo time(); ?>"></script>
<br>
<section class="content">
    @include('productos._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
    @include('productos._tabla')
</section>
<script>
    $(document).ready(function() {
        $('#tabla_producto_simple').DataTable();
    });
</script>
<script>
    list_producto_simple();
    $('#btn_actualizar_colaborador').hide();
</script>
