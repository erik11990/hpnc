<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\ColaboradoresController;
use App\Http\Controllers\IngresosBodegaController;
use App\Http\Controllers\EgresosBodegaController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UserController;

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('afiliadostotal', [DashboardController::class, 'totalAfiliados']);
    Route::get('pacientestotal', [DashboardController::class, 'totalPacientes']);
    Route::get('colaboradorestotal', [DashboardController::class, 'totalColaboradores']);
    Route::get('usuariostotal', [DashboardController::class, 'totalUsuarios']);

    /* rutas para las categorias */
    Route::resource('categorias', CategoriasController::class)
        ->names('categorias')
        ->parameters(['categorias' => 'id']);
    Route::get('listarcategorias', [CategoriasController::class, 'listarCategorias'])->name('categorias.listarcategorias');

    /* rutas para los items */
    Route::resource('/items', ItemsController::class)
        ->names('items')
        ->parameters(['items' => 'id']);
    Route::get('selectcategoria', [ItemsController::class, 'selectCategoria'])->name('items.selectcategoria');
    Route::get('listaritems', [ItemsController::class, 'listarItems'])->name('items.listaritems');

    /* rutas para los clientes */
    Route::resource('/usuarios', UsuariosController::class)
        ->names('usuarios')
        ->parameters(['usuarios' => 'id']);
    Route::get('listarusuarios', [UsuariosController::class, 'listarUsuarios'])->name('usuarios.listarusuarios');
    Route::get('selectdepartamento', [UsuariosController::class, 'selectDepartamento'])->name('usuarios.selectdepartamento');
    Route::get('selectmunicipio', [UsuariosController::class, 'selectMunicipio'])->name('usuarios.selectmunicipio');
    Route::get('selectmunicipioeditar', [UsuariosController::class, 'selectMunicipioEditar'])->name('usuarios.selectmunicipioeditar');
    Route::get('selectestadocivil', [UsuariosController::class, 'selectEstadoCivil'])->name('usuarios.selectestadocivil');

    /* ruta para los pecientes */
    Route::resource('/pacientes', PacientesController::class)
        ->names('pacientes')
        ->parameters(['pacientes' => 'id']);
    Route::get('listarpacientes', [PacientesController::class, 'listarPacientes'])->name('pacientes.listarpacientes');
    Route::get('selecttipopaciente', [PacientesController::class, 'selectTipoPaciente'])->name('pacientes.selecttipopaciente');
    Route::post('buscarpersona', [PacientesController::class, 'buscarPersona'])->name('pacientes.buscarpersona');

    /* ruta para los colaboradores */
    Route::resource('/colaboradores', ColaboradoresController::class)
        ->names('colaboradores')
        ->parameters(['colaboradores' => 'id']);
    Route::get('listarcolaboradores', [ColaboradoresController::class, 'listarColaboradores'])->name('colaboradores.listarcolaboradores');
    Route::get('selecttipocolaborador', [ColaboradoresController::class, 'selectTipoColaborador'])->name('colaboradores.selecttipocolaboradore');

    /* ruta el ingreso a bodega */
    Route::resource('/bodega', IngresosBodegaController::class)
        ->names('bodega')
        ->parameters(['bodega' => 'id']);
    Route::get('ingresobodega', [IngresosBodegaController::class, 'ingresoBodega'])->name('bodega.ingresobodega');
    Route::get('selectforma', [IngresosBodegaController::class, 'selectForma'])->name('bodega.selectforma');
    Route::get('selectserie', [IngresosBodegaController::class, 'selectSerie'])->name('bodega.selectserie');
    Route::get('selectproveedor', [IngresosBodegaController::class, 'selectProveedor'])->name('bodega.selectproveedor');
    Route::get('selectcodigo', [IngresosBodegaController::class, 'selectCodigo'])->name('bodega.selectcodigo');
    Route::get('selectlibro', [IngresosBodegaController::class, 'selectLibro'])->name('bodega.selectlibro');
    Route::get('selectcategoriaproducto', [IngresosBodegaController::class, 'selectCategoriaProducto'])->name('bodega.selectcategoriaproducto');
    Route::get('selectdependencia', [IngresosBodegaController::class, 'selectDependencia'])->name('bodega.selectdependencia');
    Route::get('selectprograma', [IngresosBodegaController::class, 'selectPrograma'])->name('bodega.selectprograma');
    Route::get('listaringresos', [IngresosBodegaController::class, 'listarIngresos'])->name('bodega.listaringresos');
    Route::get('pdf/{id_ingreso_bodega}', [IngresosBodegaController::class, 'Pdf'])->name('bodega.pdf');

    /* rutas para el detalle ingreso bodega */
    Route::get('selectidaccionfarmacologica', [IngresosBodegaController::class, 'selectidaccionfarmacologica'])->name('detalle_bodega.selectidaccionfarmacologica');
    Route::get('selectselectidnombreproducto', [IngresosBodegaController::class, 'selectselectidnombreproducto'])->name('detalle_bodega.selectselectidnombreproducto');
    Route::get('selectidlaboratorio', [IngresosBodegaController::class, 'selectidlaboratorio'])->name('detalle_bodega.selectidlaboratorio');
    Route::get('selectidpresentacionunidaddemedida', [IngresosBodegaController::class, 'selectidpresentacionunidaddemedida'])->name('detalle_bodega.selectidpresentacionunidaddemedida');
    Route::get('selectidmarca', [IngresosBodegaController::class, 'selectidmarca'])->name('detalle_bodega.selectidmarca');
    Route::get('selectidcodigogastorenglon', [IngresosBodegaController::class, 'selectidcodigogastorenglon'])->name('detalle_bodega.selectidcodigogastorenglon');

    /* rutas para egreso o despacho de bodega */
    Route::resource('/egresobodega', EgresosBodegaController::class)
        ->names('egresobodega')
        ->parameters(['egresobodega' => 'id']);
    Route::get('indexegresobodega', [EgresosBodegaController::class, 'indexegresobodega'])->name('egresobodega.indexegresobodega');
    Route::get('listaregresos', [EgresosBodegaController::class, 'listarEgresos'])->name('egresobodega.listarEgresos');
    Route::get('selectlugar', [EgresosBodegaController::class, 'selectlugar'])->name('egresobodega.selectlugar');
    Route::get('selectentrega', [EgresosBodegaController::class, 'selectentrega'])->name('egresobodega.entrega');
    Route::get('selectautoriza', [EgresosBodegaController::class, 'selectautoriza'])->name('egresobodega.autoriza');
    Route::get('selectsolicitantecolaborador', [EgresosBodegaController::class, 'selectSolicitante'])->name('egresobodega.selectsolicitante');
    Route::get('selectsolicitantepaciente', [EgresosBodegaController::class, 'selectSolicitantePaciente'])->name('egresobodega.selectsolicitantepaciente');
    Route::get('pdf_egreso/{id_pedido_despacho}', [EgresosBodegaController::class, 'PdfEgreso']);


    /* productos */
    Route::resource('/productos', ProductosController::class)
        ->names('productos')
        ->parameters(['productos' => 'id']);
    Route::get('listarproductos', [ProductosController::class, 'listarProductos'])->name('productos.listarproductos');
    Route::get('selectaccionfarmacologica', [ProductosController::class, 'selectAccionFarmacologica'])->name('productos.selectaccionfarmacologica');

    /* crud usuarios */
    Route::resource('crearusuario', UserController::class);
    Route::get('listarusers', [UserController::class, 'listarUsers']);
    Route::get('roles', [UserController::class, 'roles']);

});

Auth::routes();