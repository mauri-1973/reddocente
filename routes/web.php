<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Tracker;

use App\Http\Controllers\Admin;
use App\Http\Controllers\Docs;
use App\Http\Controllers\Blog;
use App\Http\Controllers\Comments;
use App\Http\Controllers\Statistics;
use App\Http\Controllers\Forums;
use App\Http\Controllers\Users;
use App\Http\Controllers\Chats;
use App\Http\Controllers\Brainstorm;
use App\Http\Controllers\Competitions;
use App\Http\Controllers\Docentes;

Route::get('/', [Docs\DocumentsExtController::class, 'exit'])->name('welcome');

Route::group(['middleware' => ['role:admin','translate']], function () {
    
	Route::resource('permissions', 'Admin\PermissionsController');
    Route::resource('roles', 'Admin\RolesController');
    Route::resource('users', 'Admin\UsersController');
    Route::get('login-activities',[
        'as' => 'login-activities',
        'uses' => 'Admin\UsersController@indexLoginLogs'
    ]);
    Route::get('agregar-usuarios-academicos', [Admin\UsersController::class, 'indexaca'])->name('agregar-usuarios-academicos');  
    Route::get('agregar-usuarios-estudiantes', [Admin\UsersController::class, 'indexest'])->name('agregar-usuarios-estudiantes');  
    Route::get('agregar-usuarios-noticias', [Admin\UsersController::class, 'indexnot'])->name('agregar-usuarios-noticias');  
    Route::get('agregar-usuarios-revisores', [Admin\UsersController::class, 'indexrev'])->name('agregar-usuarios-revisores');  
    Route::get('agregar-usuarios-administradores', [Admin\UsersController::class, 'index'])->name('agregar-usuarios-administradores'); 
    Route::get('mostrar-formulario-tipo-usuario/{tipo}', [Admin\UsersController::class, 'adduser'])->name('mostrar-formulario-tipo-usuario');
    Route::get('solicitudes-ingreso-docentes-formulario', [Admin\UsersController::class, 'solingdocfor'])->name('solicitudes-ingreso-docentes-formulario');
    Route::post('ingresar-categoria-solicitud-docente', [Admin\UsersController::class, 'ingcatsoldoc'])->name('ingresar-categoria-solicitud-docente');
    

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Categorías  ///////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('agregar-categorias-administrador', [Admin\CategoriesController::class, 'indexini'])->name('agregar-categorias-administrador');
    Route::post('ingreso-categoria-admin', [Admin\CategoriesController::class, 'ingcatadm'])->name('ingreso-categoria-admin');
    Route::post('validar-nombre-categoria', [Admin\CategoriesController::class, 'valnomcat'])->name('validar-nombre-categoria');
    Route::post('editar-categoria-admin', [Admin\CategoriesController::class, 'editcatadm'])->name('editar-categoria-admin');
    Route::post('eliminar-categoria-admin', [Admin\CategoriesController::class, 'elitcatadm'])->name('eliminar-categoria-admin');
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Categorías  ///////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Sub-Categorías  ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::post('ingreso-sub-categoria-admin', [Admin\SubcategoriesController::class, 'ingsubcatadm'])->name('ingreso-sub-categoria-admin');
    Route::post('editar-sub-categoria-admin', [Admin\SubcategoriesController::class, 'editsubcatadm'])->name('editar-sub-categoria-admin');
    Route::post('eliminar-sub-categoria-admin', [Admin\SubcategoriesController::class, 'elisubcatadm'])->name('eliminar-sub-categoria-admin');
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Sub-Categorías  ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Biblioteca Administrador //////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('actualizar-documentos-digitales-administrador', [Docs\DocumentsController::class, 'actdocdigadm'])->name('actualizar-documentos-digitales-administrador');
    Route::post('ingreso-categoria-admin-documentos', [Docs\DocumentsController::class, 'ingcatadmdoc'])->name('ingreso-categoria-admin-documentos');
    Route::post('validar-nombre-categoria-documentos', [Docs\DocumentsController::class, 'valnomcatdoc'])->name('validar-nombre-categoria-documentos');
    Route::post('ingreso-book-admin-documentos', [Docs\DocumentsController::class, 'ingdocbibdocadm'])->name('ingreso-book-admin-documentos');
    Route::post('editar-book-admin-documentos', [Docs\DocumentsController::class, 'edidocbibdocadm'])->name('editar-book-admin-documentos');
    Route::post('eliminar-book-admin-documentos', [Docs\DocumentsController::class, 'elidocbibdocadm'])->name('eliminar-book-admin-documentos');
    Route::get('categorias-documentos-digitales-administrador', [Docs\DocumentsController::class, 'catdocbibdocadm'])->name('categorias-documentos-digitales-administrador');
    Route::post('editar-categoria-admin-documentos', [Docs\DocumentsController::class, 'edicatadmdoc'])->name('editar-categoria-admin-documentos');
    Route::post('eliminar-categoria-book-admin-documentos', [Docs\DocumentsController::class, 'elicatadmdoc'])->name('eliminar-categoria-book-admin-documentos');
    

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Biblioteca Administrador //////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Link-Redirección //////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('configurar-link-admin', [Admin\LinkController::class, 'indexconlinadm'])->name('configurar-link-admin');
    Route::post('agregar-link-redireccion-admin', [Admin\LinkController::class, 'agrelinredadm'])->name('agregar-link-redireccion-admin');
    Route::post('editar-link-redireccion-admin', [Admin\LinkController::class, 'edilinredadm'])->name('editar-link-redireccion-admin');
    Route::post('eliminar-link-redireccion-admin', [Admin\LinkController::class, 'elilinredadm'])->name('eliminar-link-redireccion-admin');

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Link-Redirección //////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Administrador-Concursos
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('buscar-concursos-registrados-administradores', [Competitions\CompetitionsController::class, 'verconregadm'])->name('buscar-concursos-registrados-administradores');
    Route::get('ver-postulantes-registrados-administradores', [Competitions\CompetitionsController::class, 'verposregadm'])->name('ver-postulantes-registrados-administradores');
    Route::get('agregar-nuevo-concurso-administrador', [Competitions\CompetitionsController::class, 'creteconcurso'])->name('agregar-nuevo-concurso-administrador');
    Route::get('agregar-nuevos-tags-administrador', [Competitions\CompetitionsController::class, 'vertagsadmin'])->name('agregar-nuevos-tags-administrador');
    Route::post('ingreso-tag-administrador', [Competitions\CompetitionsController::class, 'ingtagadm'])->name('ingreso-tag-administrador');
    Route::post('validar-nombre-tag-administrador', [Competitions\CompetitionsController::class, 'valnomtag'])->name('validar-nombre-tag-administrador');
    Route::post('editar-tag-administrador', [Competitions\CompetitionsController::class, 'edittagadm'])->name('editar-tag-administrador');
    Route::post('eliminar-tag-administrador', [Competitions\CompetitionsController::class, 'elimtagadm'])->name('eliminar-tag-administrador');
    Route::get('agregar-nuevas-categorias-concursos', [Competitions\CompetitionsController::class, 'vercatcon'])->name('agregar-nuevas-categorias-concursos'); 
    Route::post('ingreso-categoria-concurso-administrador', [Competitions\CompetitionsController::class, 'ingcatconadm'])->name('ingreso-categoria-concurso-administrador');
    Route::post('validar-nombre-categoria-concurso-administrador', [Competitions\CompetitionsController::class, 'valnomcatconadm'])->name('validar-nombre-categoria-concurso-administrador');
    Route::post('editar-categoria-concurso-administrador', [Competitions\CompetitionsController::class, 'edinomcatconadm'])->name('editar-categoria-concurso-administrador');
    Route::post('eliminar-categoria-concurso-administrador', [Competitions\CompetitionsController::class, 'elinomcatconadm'])->name('eliminar-categoria-concurso-administrador');
    Route::post('actualizar-datos-concursos-administrador', [Competitions\CompetitionsController::class, 'actdatconadm'])->name('actualizar-datos-concursos-administrador');
    Route::post('eliminar-archivos-adjuntos-concursos-administrador', [Competitions\CompetitionsController::class, 'eliarcadjconadm'])->name('eliminar-archivos-adjuntos-concursos-administrador');
    Route::post('finalizar-ingreso-concurso-administrador', [Competitions\CompetitionsController::class, 'finingconadm'])->name('finalizar-ingreso-concurso-administrador');
    Route::get('ver-postulantes-registrados-administradores', [Competitions\CompetitionsController::class, 'verposregadm'])->name('ver-postulantes-registrados-administradores');
    Route::get('ver-vista-concurso-usuarios-registrados/{id}', [Competitions\CompetitionsController::class, 'vervisconusureg'])->name('ver-vista-concurso-usuarios-registrados');
    Route::get('editar-vista-concurso-administradores/{id}', [Competitions\CompetitionsController::class, 'edivisconadm'])->name('editar-vista-concurso-administradores');
    Route::post('eliminar-vista-concurso-administradores', [Competitions\CompetitionsController::class, 'elivisconadm'])->name('eliminar-vista-concurso-administradores');
    Route::get('ver-postulaciones-concursos-registrados-administrador/{id}', [Competitions\CompetitionsController::class, 'verposconreg'])->name('ver-postulaciones-concursos-registrados-administrador');
    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Administrador-Concursos
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Funcioinalidades Excel Administrador
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('exportar-usuarios-excel-administrador', [Admin\UsersController::class, 'exportarexcelusuarios'])->name('exportar-usuarios-excel-administrador');
    Route::post('agregar-usuarios-excel-administrador', [Admin\UsersController::class, 'agregarexcelusuarios'])->name('agregar-usuarios-excel-administrador');
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Funcioinalidades Excel Administrador
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
});

Route::group(['middleware' => ['role:docente', 'translate']], function () {
    Route::get('buscar-concursos-registrados-docentes', [Docentes\PostulatiosdocController::class, 'busconregdoc'])->name('buscar-concursos-registrados-docentes');
    Route::get('ver-vista-concurso-usuario-registrado-docente/{id}', [Docentes\PostulatiosdocController::class, 'vervisconusuregdoc'])->name('ver-vista-concurso-usuario-registrado-docente');
    Route::post('solicitar-postulacion-concurso-docente', [Docentes\PostulatiosdocController::class, 'solposcondoc'])->name('solicitar-postulacion-concurso-docente');
    
    

    Route::get('ver-formulario-docente-primera-etapa/{id}', [Docentes\PostulatiosdocController::class, 'verfordocprieta'])->name('ver-formulario-docente-primera-etapa');
    Route::get('ver-formulario-docente-segunda-etapa/{id}', [Docentes\PostulatiosdocController::class, 'verfordocsegeta'])->name('ver-formulario-docente-segunda-etapa');
    Route::get('ver-formulario-docente-tercera-etapa/{id}', [Docentes\PostulatiosdocController::class, 'verfordoctereta'])->name('ver-formulario-docente-tercera-etapa');
    Route::get('ver-formulario-docente-cuarta-etapa/{id}', [Docentes\PostulatiosdocController::class, 'verfordoccuaeta'])->name('ver-formulario-docente-cuarta-etapa');
    Route::post('actualizar-formulario-postulacion-docente-etapa-cuatro', [Docentes\PostulatiosdocController::class, 'actforposdocetacua'])->name('actualizar-formulario-postulacion-docente-etapa-cuatro');
    Route::post('actualizar-formulario-postulacion-docente-etapa-uno', [Docentes\PostulatiosdocController::class, 'actforposdocetauno'])->name('actualizar-formulario-postulacion-docente-etapa-uno');
    Route::post('actualizar-formulario-postulacion-docente-etapa-dos', [Docentes\PostulatiosdocController::class, 'actforposdocetados'])->name('actualizar-formulario-postulacion-docente-etapa-dos');
    Route::post('actualizar-formulario-postulacion-docente-etapa-tres', [Docentes\PostulatiosdocController::class, 'actforposdocetatres'])->name('actualizar-formulario-postulacion-docente-etapa-tres');

    Route::get('ver-formulario-docente-historico/{id}/{version}/{tipo}', [Docentes\PostulatiosdocController::class, 'verfordochist'])->name('ver-formulario-docente-historico');

    
    Route::get('redireccion-formulario-completo-docente/{id}', [Docentes\PostulatiosdocController::class, 'redforcomdoc'])->name('redireccion-formulario-completo-docente');
    Route::get('ver-postulaciones-activas-docentes', [Docentes\PostulatiosdocController::class, 'verposactdoc'])->name('ver-postulaciones-activas-docentes');
    Route::get('imprimr-formulario-docente/{id}', [Docentes\PostulatiosdocController::class, 'impfordoc'])->name('imprimr-formulario-docente');
    Route::get('imprimr-formulario-docente-observaciones/{id}', [Docentes\PostulatiosdocController::class, 'impfordocobs'])->name('imprimr-formulario-docente-observaciones');

    Route::get('ver-observaciones-docente-nueva-ventana/{id}', [Docentes\PostulatiosdocController::class, 'verobsdocnueven'])->name('ver-observaciones-docente-nueva-ventana');
});
Route::group(['middleware' => ['role:revisor|admin', 'translate']], function () {
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Revisor
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('buscar-concursos-registrados-revisor', [Competitions\CompetitionsController::class, 'busconregrev'])->name('buscar-concursos-registrados-revisor'); 
    Route::get('ver-postulantes-registrados-revisor', [Competitions\CompetitionsController::class, 'verposregrev'])->name('ver-postulantes-registrados-revisor');

    Route::get('ver-vista-concurso-usuarios-registrados/{id}', [Competitions\CompetitionsController::class, 'vervisconusureg'])->name('ver-vista-concurso-usuarios-registrados');
    Route::get('ver-postulaciones-concursos-registrados/{id}', [Competitions\PostulationsrevController::class, 'verposconreg'])->name('ver-postulaciones-concursos-registrados');
    Route::get('ver-informacion-ingresada-docente/{tipo}/{idpost}/{idansw}', [Competitions\PostulationsrevController::class, 'verinfingdoc'])->name('ver-informacion-ingresada-docente');
    Route::get('imprimr-formulario-revisor/{id}', [Competitions\PostulationsrevController::class, 'impfordoc'])->name('imprimr-formulario-revisor');
    Route::get('imprimr-formulario-revisor-observaciones/{id}', [Competitions\PostulationsrevController::class, 'impfordocobs'])->name('imprimr-formulario-revisor-observaciones');
    

    Route::get('iniciar-correciones-formulario-revisor/{id}', [Competitions\PostulationsrevController::class, 'ventanapopup'])->name('iniciar-correciones-formulario-revisor');
    Route::post('actualizar-formulario-postulacion-correcciones', [Competitions\PostulationsrevController::class, 'actforposcor'])->name('actualizar-formulario-postulacion-correcciones');

    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Revisor
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
});
Route::group(['middleware' => ['role:blog', 'translate']], function () {
    
    Route::post('agregar-categorias-blog', [Blog\CategoryBlogController::class, 'agrcatblog'])->name('agregar-categorias-blog');
    Route::get('ver-categorias-blog', [Blog\CategoryBlogController::class, 'vercatblog'])->name('ver-categorias-blog'); 
    Route::post('validar-nombre-categoria-blog', [Blog\CategoryBlogController::class, 'valnomcat'])->name('validar-nombre-categoria-blog');
    Route::post('ingreso-categoria-blog', [Blog\CategoryBlogController::class, 'ingcatadm'])->name('ingreso-categoria-blog');
    Route::post('editar-categoria-blog', [Blog\CategoryBlogController::class, 'editcatadm'])->name('editar-categoria-blog');
    Route::post('eliminar-categoria-blog', [Blog\CategoryBlogController::class, 'elitcatadm'])->name('eliminar-categoria-blog');
    
    Route::post('upload-post-blog', [Blog\PostController::class, 'uplposblog'])->name('upload-post-blog');
    Route::get('ver-publicaciones-blog', [Blog\PostController::class, 'indexnew'])->name('ver-publicaciones-blog');
    Route::get('blog-posts-editar/{id}', [Blog\PostController::class, 'ediatrpost'])->name('blog-posts-editar');
    Route::post('blog-posts-eliminar', [Blog\PostController::class, 'eliminarpost'])->name('blog-posts-eliminar');
    Route::get('blog-posts-crear-publicacion', [Blog\PostController::class, 'creteposts'])->name('blog-posts-crear-publicacion');
    Route::post('agregar-publicaciones-blog', [Blog\PostController::class, 'storepost'])->name('agregar-publicaciones-blog');
    Route::get('ver-publicacion-completa/{id}', [Blog\PostController::class, 'verpubcom'])->name('ver-publicacion-completa');
    Route::post('finalizar-edicion-publicacion-blog', [Blog\PostController::class, 'finedipubblo'])->name('finalizar-edicion-publicacion-blog');
    
    Route::get('ver-tags-blog', [Blog\TagsBlogController::class, 'vertagsblog'])->name('ver-tags-blog'); 
    Route::post('ingreso-tag-blog', [Blog\TagsBlogController::class, 'ingtagadm'])->name('ingreso-tag-blog');
    Route::post('validar-nombre-tag-blog', [Blog\TagsBlogController::class, 'valnomtag'])->name('validar-nombre-tag-blog');
    Route::post('editar-tag-blog', [Blog\TagsBlogController::class, 'edittagadm'])->name('editar-tag-blog');
    Route::post('eliminar-tag-blog', [Blog\TagsBlogController::class, 'elimtagadm'])->name('eliminar-tag-blog');
    
    
});

Route::group(['middleware' => ['auth', 'translate']], function () {

    Route::get('/home', 'HomeController@index')->name('home'); 

    Route::resource('profile','Users\ProfileController');
    Route::get('change-password',[
        'as' => 'change-password',
        'uses' => 'Users\ProfileController@password'
    ]);
    Route::put('profile-update-pass',[
        'as' => 'profile-update-pass',
        'uses' => 'Users\ProfileController@updatepass'
    ]);
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Documentos-Digitales  /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('buscar-documentos-digitales-publicos', [Docs\DocumentsController::class, 'busdocdigpub'])->name('buscar-documentos-digitales-publicos');
    Route::post('buscar-docentes-sub-categoria-id', [Docs\DocumentsController::class, 'busdocsubcatid'])->name('buscar-docentes-sub-categoria-id');
    Route::get('visor-pdf-documentos-digitales/{id}', [Docs\DocumentsController::class, 'visordocs'])->name('visor-pdf-documentos-digitales-id');
    Route::post('visor-pdf-documentos-digitales', [Docs\DocumentsController::class, 'visordocs'])->name('visor-pdf-documentos-digitales');
    Route::get('actualizar-documentos-digitales-docentes', [Docs\DocumentsController::class, 'actdocdigdoc'])->name('actualizar-documentos-digitales-docentes'); 
    Route::post('ingresar-documento-biblioteca-docente', [Docs\DocumentsController::class, 'ingdocbibdoc'])->name('ingresar-documento-biblioteca-docente');
    Route::post('editar-documento-biblioteca-docente', [Docs\DocumentsController::class, 'editdocbibdoc'])->name('editar-documento-biblioteca-docente');
    Route::post('eliminar-documento-biblioteca-docente', [Docs\DocumentsController::class, 'elidocbibdoc'])->name('eliminar-documento-biblioteca-docente');



    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Documentos-Administrador  /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('buscar-documentos-digitales-administrador', [Docs\DocumentsController::class, 'busdocdigadm'])->name('buscar-documentos-digitales-administrador');
    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////       Comentarios    /////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::post('ingresar-comentarios-usuarios-registrados', [Comments\CommentsController::class, 'ingcomusureg'])->name('ingresar-comentarios-usuarios-registrados'); 
    Route::post('eliminar-comentarios-usuarios-registrados', [Comments\CommentsController::class, 'elicomusureg'])->name('eliminar-comentarios-usuarios-registrados'); 
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Estadísticas  ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::post('estadisticas-generales-segun-tipo-de-usuario', [Statistics\StatisticsController::class, 'estgensegusu'])->name('estadisticas-generales-segun-tipo-de-usuario');
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Foros  ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('buscar-foros-usuario-registrado', [Forums\ForumsController::class, 'indexforunms'])->name('buscar-foros-usuario-registrado');
    Route::get('categorias-forums-docentes-registrados', [Forums\ForumsController::class, 'addforunmsdoc'])->name('categorias-forums-docentes-registrados');
    Route::post('validar-nombre-categoria-forums', [Forums\ForumsController::class, 'valnomcatfor'])->name('validar-nombre-categoria-forums');
    Route::post('ingreso-categoria-docente-forums', [Forums\ForumsController::class, 'ingcatdocfor'])->name('ingreso-categoria-docente-forums');
    Route::post('busquedas-info-forums-docentes', [Forums\ForumsController::class, 'businffordoc'])->name('busquedas-info-forums-docentes');
    Route::post('editar-categoria-docente-forums', [Forums\ForumsController::class, 'editcatdocfor'])->name('editar-categoria-docente-forums');
    Route::post('eliminar-categoria-docente-forums', [Forums\ForumsController::class, 'elicatdocfor'])->name('eliminar-categoria-docente-forums');
    Route::get('acceder-forum-usuarios-activos/{idcat}', [Forums\ForumsController::class, 'accforusuact'])->name('acceder-forum-usuarios-activos');
    Route::post('agregar-nuevo-tema-forum', [Forums\ForumsController::class, 'addnuetemfor'])->name('agregar-nuevo-tema-forum');
    Route::post('eliminar-nuevo-tema-forum', [Forums\ForumsController::class, 'deletenuetemfor'])->name('eliminar-nuevo-tema-forum');
    Route::post('editar-nuevo-tema-forum', [Forums\ForumsController::class, 'editnuetemfor'])->name('editar-nuevo-tema-forum');
    Route::post('buscar-informacion-usuario-contacto', [Forums\ForumsController::class, 'businfusucon'])->name('buscar-informacion-usuario-contacto');
    Route::get('ver-contenido-tema-forum/{idcom}/{idcat}', [Forums\ForumsController::class, 'vercontemfor'])->name('ver-contenido-tema-forums');
    Route::post('enviar-respuesta-usuario-tema', [Forums\ForumsController::class, 'envresasutem'])->name('enviar-respuesta-usuario-tema');
    Route::post('guardar-votacion-respuesta-usuario', [Forums\ForumsController::class, 'guavotresusu'])->name('guardar-votacion-respuesta-usuario');
    Route::post('eliminar-respuesta-usuario', [Forums\ForumsController::class, 'eliresusu'])->name('eliminar-respuesta-usuario');
    Route::get('listado-usuarios-estado-ingreso-docentes/{idcat}/{tipo}', [Forums\ForumsController::class, 'lisusuestingdoc'])->name('listado-usuarios-estado-ingreso-docentes');
    Route::get('solicitar-acceso-foro-docentes/{idcat}', [Forums\ForumsController::class, 'solaccfordoc'])->name('solicitar-acceso-foro-docentes');
    Route::get('acceder-foro-docentes/{idfor}', [Forums\ForumsController::class, 'accfordoc'])->name('acceder-foro-docentes');
    Route::get('acciones-usuarios-docentes-forums/{tipo}/{idforpar}', [Forums\ForumsController::class, 'accusudocfor'])->name('acciones-usuarios-docentes-forums');
    

    
    
    

    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Publicaciones   ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('ver-publicacion-completa-usuario/{id}', [Users\MixController::class, 'verpubcom'])->name('ver-publicacion-completa-usuario');
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Chats           ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('buscar-chats-usuario-registrado', [Chats\ChatsController::class, 'buschatusureg'])->name('buscar-chats-usuario-registrado');
    Route::post('registro-usuario-en-linea', [Chats\ChatsController::class, 'regusulin'])->name('registro-usuario-en-linea');
    Route::post('agregar-categoria-chat-docente', [Chats\ChatsController::class, 'agecatchadoc'])->name('agregar-categoria-chat-docente');
    Route::post('validar-nombre-categoria-chats', [Chats\ChatsController::class, 'valnomcatchats'])->name('validar-nombre-categoria-chats');
    Route::post('busquedas-info-chats-docentes', [Chats\ChatsController::class, 'businfchatdoc'])->name('busquedas-info-chats-docentes');
    
    Route::get('buscar-chats-usuario-registrado-est', [Chats\ChatsController::class, 'buschatusuregest'])->name('buscar-chats-usuario-registrado-est');
    Route::get('ingresar-chat-usuario-registrado/{idchat}', [Chats\ChatsController::class, 'ingchatusureg'])->name('ingresar-chat-usuario-registrado');
    Route::get('listado-usuarios-estado-ingreso-chat-docentes/{idcat}/{tipo}', [Chats\ChatsController::class, 'lisusuestingdoc'])->name('listado-usuarios-estado-ingreso-chat-docentes');
    Route::get('acciones-usuarios-docentes-chats/{tipo}/{idforpar}', [Chats\ChatsController::class, 'accusudocfor'])->name('acciones-usuarios-docentes-chats');
    Route::get('acceder-chats-usuarios-activos/{idcat}', [Forums\ForumsController::class, 'accforusuact'])->name('acceder-chats-usuarios-activos');

    Route::get('checkConvo/{recieverId}', [Chats\ChatsController::class, 'check'])->name('checkConvo');
    Route::get('loadMessage/{reciever}/{sender}', [Chats\ChatsController::class, 'load'])->name('loadMessage');
    Route::get('retrieveMessages/{reciever}/{sender}/{lastMsgId}', [Chats\ChatsController::class, 'retrieveNew'])->name('retrieveMessages');
    Route::post('sendMessage', [Chats\ChatsController::class, 'store'])->name('sendMessage');

    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Ver Publicaciones///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('ver-publicaciones-en-linea', [Users\MixController::class, 'verpublin'])->name('ver-publicaciones-en-linea');

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Ideas-Usuario   ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('lluvia-de-ideas-usuarios-registrados', [Brainstorm\BrainstormController::class, 'indexbrainstorm'])->name('lluvia-de-ideas-usuarios-registrados');
    Route::post('agregar-nueva-idea-usuario-registrado', [Brainstorm\BrainstormController::class, 'addnueidereg'])->name('agregar-nueva-idea-usuario-registrado');
    Route::get('anexar-nueva-idea-usuario-registrado/{idcom}', [Brainstorm\BrainstormController::class, 'anenueideusureg'])->name('anexar-nueva-idea-usuario-registrado');
    Route::post('enviar-idea-anexa-usuario-registrado', [Brainstorm\BrainstormController::class, 'envideaneusureg'])->name('enviar-idea-anexa-usuario-registrado');
    Route::post('eliminar-idea-anexa-usuario-registrado', [Brainstorm\BrainstormController::class, 'eliideaneusureg'])->name('eliminar-idea-anexa-usuario-registrado');
    Route::post('editar-idea-usuario-registrado', [Brainstorm\BrainstormController::class, 'ediideaneusureg'])->name('editar-idea-usuario-registrado');
    Route::post('editar-idea-anexa-usuario-registrado', [Brainstorm\BrainstormController::class, 'ediideaneusureganex'])->name('editar-idea-anexa-usuario-registrado');
    Route::post('eliminar-idea-principal-usuario-registrado', [Brainstorm\BrainstormController::class, 'eliidepriusureg'])->name('eliminar-idea-principal-usuario-registrado');


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Conectar        ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('conectar-usuarios-registrado', [Users\ConectController::class, 'conusureg'])->name('conectar-usuarios-registrado'); 
    Route::post('enviar-email-conectar-usuarios-registrados', [Users\ConectController::class, 'envemaconusureg'])->name('enviar-email-conectar-usuarios-registrados');

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Tags usuarios   ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::post('validar-nombre-tags-usuario', [Users\TagsUsersController::class, 'valnomtagusu'])->name('validar-nombre-tags-usuario');
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////// Url Externas    ///////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    Route::get('ir-link-administrador-externo-formacion', [Users\MixController::class, 'irlinadmextuno'])->name('ir-link-administrador-externo-formacion');
    Route::get('ir-link-administrador-externo-extension', [Users\MixController::class, 'irlinadmextdos'])->name('ir-link-administrador-externo-extension');
    Route::get('ir-link-administrador-externo-proyectos', [Users\MixController::class, 'irlinadmexttres'])->name('ir-link-administrador-externo-proyectos');
    Route::get('ir-link-administrador-externo-recursos', [Users\MixController::class, 'irlinadmextcuatro'])->name('ir-link-administrador-externo-recursos');
    Route::get('ver-link-embed-administrador/{tipo}/{desde}', [Users\MixController::class, 'verlinenbadm'])->name('ver-link-embed-administrador');
    Route::get('ver-link-embed-administrador-web/{id}', [Users\MixController::class, 'verlinenbadmweb'])->name('ver-link-embed-administrador-web');
    Route::post('editar-sub-categoria-link-externo', [Users\MixController::class, 'edisubcatlinext'])->name('editar-sub-categoria-link-externo');
    
    
    
    
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// IDIOMAS ///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/lang/{language}', [Docs\DocumentsExtController::class, 'lang'])->name('language');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// IDIOMAS ///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// Visor Pdf Ext /////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('visor-pdf-documentos-digitales-externo/{id}', [Docs\DocumentsExtController::class, 'visordocs'])->name('visor-pdf-documentos-digitales-externo');
Route::get('visor-pdf-documentos-digitales-externo-docentes/{id}', [Docs\DocumentsExtController::class, 'visordocsdoc'])->name('visor-pdf-documentos-digitales-externo-docentes');

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////// Visor Pdf Ext /////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////link Imagenes //////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*Route::get('/storage_link', function (){ 
    Artisan::call('storage:link'); 
});*/
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////link Imagenes //////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////Salir Plataforma ///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
   * Logout Route
   */
  Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////Salir Plataforma ///////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*Route::get('/clear-cache', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:cache');
    return "Cache cleared successfully ok";
 });*/
 Route::get('/login', 'Auth\LoginController@showLoginFormnew')->name('login');
 Route::post('ingresar-solicitud-docente-cuenta', 'Auth\LoginController@sendmail')->name('ingresar-solicitud-docente-cuenta');
