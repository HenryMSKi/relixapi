<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->put('/actualizarClavedefault', 'CambioClaveController::actualizarClaveDefault');
$routes->put('/generarclave', 'CambioClaveController::recuperarClave');
$routes->get('/ramdon', 'CambioClaveController::generateRandomString');
$routes->post('/enviarCodigo', 'CambioClaveController::enviarcodigoClave');
$routes->post('/enviarCodigo', 'CambioClaveController::enviarcodigoClave');
$routes->post('/actualizarClave', 'CambioClaveController::actualizarClave');
$routes->post('/auth/login', 'Auth::credentialsValidate');
$routes->get('/auth/login', 'Auth::validarUsuarioToken');
$routes->get('/auth/cook', 'Auth::cook');
$routes->get('/roles', 'RolController::listarRoles');

/* $routes->get('/producto', 'ProductoController::listarProducto');
$routes->post('/producto', 'ProductoController::busquedamasivaProductos'); */
$routes->get('/vendedor', 'VendedorController::listarVendedores');
$routes->get('/departamento', 'DepartamentoController::listarDepartamentos');
$routes->get('/provincia/(:num)', 'ProvinciaController::listarProvincias/$1');
$routes->get('/distrito/(:num)', 'DistritoController::listarDistritos/$1');
$routes->get('/tiposproyecto', 'TipoproyectoController::listarTipoproyecto');
$routes->get('/modalidadesejecucion', 'ModalidadejecucionController::listarModalidadejecucion');
$routes->get('/formaspago', 'FormapagoController::listarFormaspago');
$routes->get('/estadosfichaproyecto', 'EstadofichaproyectoController::listarEstadosfichaproyecto');
$routes->get('/division', 'DivisionController::listarDivision');
$routes->get('/facturaciones', 'FacturacionController::listarFacturacion');
$routes->get('/modalidadescontrato', 'ModalidadcontratoController::listarModalidadcontrato');
$routes->get('/financiamientos', 'FinanciamientoController::listarFinanciamiento');
$routes->get('/anticipos', 'AnticipoController::listarAnticipo');
$routes->get('/detracciones', 'DetraccionesController::listarDetracciones');
$routes->get('/retenciones', 'RetencionController::listarRetencion');
$routes->get('/facturasnegociables', 'FacturanegociableController::listarFacturacionnegociable');
$routes->post('/detallefichatecnica', 'DetallefichatecnicaController::agregarDetalleficha');
$routes->put('/detallefichatecnica', 'DetallefichatecnicaController::actualizarDetallefichatecnica');
$routes->get('/detallefichatecnica/(:num)', 'DetallefichatecnicaController::listarDetallefichatecnica/$1');
$routes->put('/guardardataficha', 'DetallefichatecnicaController::guardarDatadetallefichatecnica');
$routes->get('/precioproducto', 'PrecioproductoController::listarPrecioproducto');
$routes->get('/listarDetalleGerenteGeneral/(:num)', 'DetallefichatecnicaController::listarDetalleFichaGerenteGeneral/$1');
$routes->get('/enviarEmailPrueba', 'sendEmailPrueba::sendEmail');
$routes->get('/ExcelReporteDos/(:any)', 'DetallefichatecnicaController::exportarExcelReporteDos/$1');
$routes->delete('/detallefichatecnica/(:num)', 'DetallefichatecnicaController::eliminarDetalleFichaTecnica/$1');
$routes->put('/estadoProductos', 'DetallefichatecnicaController::cambiarEstadoProductoDetalleFichaTecnica');
$routes->post('/anularProductoDetalle', 'DetallefichatecnicaController::anularProducto');
$routes->post('/productoDetalleFichaTecnica', 'DetallefichatecnicaController::agregarProductoDetalleFichaTecnica');
$routes->post('/productos', 'ProductoController::mantenimientoProductos');
$routes->get('/productos/(:num)', 'ProductoController::buscarProducto/$1');
$routes->post('/productosUnidad', 'ProductoController::registrarProducto');
$routes->get('/partidas', 'PartidaController::listarPartidas');
$routes->get('/subpartidas/(:num)', 'SubpartidaController::listarSubPartida/$1');
$routes->get('/estadoProductos', 'EstadoproductoDetallefichatecnicaController::listarEstadosProdutos');


$routes->group('api', ['namespace' =>'App\Controllers\API', 'filter' => 'authfilter'], function($routes){
    $routes->get('usuarios', 'UsuarioController::listarUsuario');
    $routes->post('usuarios', 'UsuarioController::agregarUsuario');
    $routes->put('usuarios/update/(:num)', 'UsuarioController::updateUser/$1');
    $routes->put('usuarios/estado/(:num)', 'UsuarioController::cambioEstado/$1');
    $routes->put('usuarios/generarclave/(:num)', 'UsuarioController::generarClave/$1');
    $routes->delete('usuarios/delete/(:num)', 'UsuarioController::deleteUser/$1');
    $routes->get('usuarios/roles/(:num)', 'UsuarioController::obtenerUsuariosporRol/$1');
    $routes->get('codigoficha', 'FichatecnicaController::contadorFichas');
    $routes->get('fichatecnica', 'FichatecnicaController::listarFichatecnica');
    $routes->post('fichatecnica', 'FichatecnicaController::agregarFichatecnica');
    $routes->put('fichatecnica/(:num)', 'FichatecnicaController::actualizarFichatecnica/$1');
    $routes->get('FichaTecnicaCotizadas', 'FichatecnicaController::listarFichatecnicaEnviada');
    $routes->put('AprobacionGerenteGeneral/(:num)', 'FichatecnicaController::actualizarAprobacionGerenteGeneral/$1');
    $routes->put('AprobacionGerenteAdministracion/(:num)', 'FichatecnicaController::actualizarAprobacionGerenteAdministracion/$1');
    $routes->get('FichaTecnicaBackOffice', 'FichatecnicaController::listarFichatecnicaBackOffice');
    $routes->get('exportarFichasTecnicas', 'FichatecnicaController::exportarExcelFichasTecnicas');
    
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
