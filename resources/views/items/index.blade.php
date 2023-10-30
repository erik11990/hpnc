<script src="js/item.js?rev= <?php echo time(); ?>"></script>
<br>
<section class="content">
    @include('items._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
    @include('items._tabla')
</section>
<script>
    $(document).ready(function() {
        $('#tabla_item_simple').DataTable();
    });
</script>
<script>
    list_item_simple();
    $('#btn_actualizar_item').hide();
</script>
