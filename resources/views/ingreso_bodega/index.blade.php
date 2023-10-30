<script src="js/bodega.js?rev= <?php echo time(); ?>"></script>
<br>

{{-- <section class="content">
    @include('ingreso_bodega._tabla_index')
</section> --}}

<section class="content">
    @include('ingreso_bodega._form')
    @include('_modal_mensajes._moda_guardar')
    @include('_modal_mensajes._moda_actualizar')
    @include('_modal_mensajes._moda_estado')
</section>
