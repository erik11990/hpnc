<script src="js/categoria.js?rev= <?php echo time(); ?>"></script>
<br>
<section class="content">
    @include('categorias._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
    @include('categorias._tabla')
</section>
<script>
    $(document).ready(function() {
        $('#tabla_categoria_simple').DataTable();
    });
</script>
<script>
    list_categoria_simple();
    $('#btn_actualizar_categoria').hide();
</script>
