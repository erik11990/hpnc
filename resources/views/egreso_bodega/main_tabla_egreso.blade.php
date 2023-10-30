<script src="js/egreso_index.js?rev= <?php echo time(); ?>"></script>
<br>
<div class="row offset-1">
    <a href="#!" class="rounded-pill nav-link btn btn-primary"
        onclick="cargar_contenido('contenido_principal', '{{ url('indexegresobodega') }}')">
        <i class="far fa-calendar-plus fa-spin"></i>
    </a>
</div>
<br>
<div id="_pdf_embebido_egreso">
    @include('egreso_bodega.pdf._pdf_embebido_egreso')
</div>
<section id="_tabla_index_egreso" class="content">
    @include('egreso_bodega._tabla_index_egreso')
</section>

<script>
    $('#_pdf_embebido_egreso').hide();
</script>
