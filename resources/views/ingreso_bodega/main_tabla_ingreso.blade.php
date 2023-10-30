<script src="js/ingrego_index.js?rev= <?php echo time(); ?>"></script>
<br>
<div class="row offset-1">
    <a href="#!" class="rounded-pill nav-link btn btn-primary"
        onclick="cargar_contenido('contenido_principal', '{{ url('ingresobodega') }}')">
        <i class="far fa-calendar-plus fa-spin"></i>
    </a>
</div>
<br>
<div id="_pdf_embebido">
    @include('ingreso_bodega.pdf._pdf_embebido')
</div>
<section id="_tabla_index" class="content">
    @include('ingreso_bodega._tabla_index')
</section>
<script>
    $('#_pdf_embebido').hide();
</script>
