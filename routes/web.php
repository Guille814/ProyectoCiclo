<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Mi perfil
Route::get('/perfil', [PerfilController::class, 'mostrarPerfil'])->name('perfil');

// Ruta para mostrar el formulario de creación de un nuevo post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Ruta para almacenar un nuevo post en la base de datos
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Editar post
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Eliminar post
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}/confirmDelete', [PostController::class, 'confirmDelete'])->name('posts.confirmDelete');

// Buscador de usuarios
Route::get('/buscar', [UserController::class, 'buscar'])->name('usuarios.buscar');
// Ver otros usuarios
Route::get('/perfil/{username}', [PerfilController::class, 'mostrarPerfilAjeno'])->name('perfil.mostrar');

// Ruta likes 
Route::post('/post/{postId}/like', [LikeController::class, 'likePost'])->name('post.like');
Route::delete('/post/{postId}/unlike', [LikeController::class, 'unlikePost'])->name('post.unlike');


// Ruta comentarios
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('/comment/{commentId}', [CommentController::class, 'destroy'])->name('comment.destroy');

// Followers
use App\Http\Controllers\FollowController;

Route::middleware(['auth'])->group(function () {
    // Ruta para seguir a un usuario
    Route::post('/usuario/{usuario}/follow', [FollowController::class, 'follow'])->name('usuario.follow');

    // Ruta para dejar de seguir a un usuario
    Route::post('/usuario/{usuario}/unfollow', [FollowController::class, 'unfollow'])->name('usuario.unfollow');
});

// Admin routes
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('register', [AdminAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AdminAuthController::class, 'register']);
});

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::delete('/admin/users/{usuario}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('/users/{usuario}', [UserController::class, 'update'])->name('admin.users.update');
});

// Chat admin routes
use App\Http\Controllers\ChatAdminController;

Route::post('/admin/chat', [ChatAdminController::class, 'store'])->name('admin.chat.store');
Route::get('/admin/chat/create', [ChatAdminController::class, 'create'])->name('admin.chat.create');
Route::get('/admin/chat', [ChatAdminController::class, 'index'])->name('admin.chat.index');
Route::get('/admin/chat', [ChatAdminController::class, 'index'])->name('admin.chat');

//AJUSTES DEL PERFIL
Route::get('/ajustes', [UserController::class, 'ajustes'])->name('perfil.ajustes');
Route::put('/ajustes/actualizar', [UserController::class, 'actualizar'])->name('perfil.actualizar');

//GRUPOS
use App\Http\Controllers\GroupController;

Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
Route::post('/groups/{group}/members', [GroupController::class, 'addMember'])->name('groups.addMember');
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');


//EVENTOS
use App\Http\Controllers\EventController;

Route::middleware(['auth'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
});

//NOTIFICACIONES
use App\Http\Controllers\NotificationController;

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
Route::patch('/notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/buscar-usuarios', [UserController::class, 'buscar'])->name('usuarios.buscar');
    Route::resource('groups', GroupController::class);
});

use App\Http\Controllers\GroupFollowController;

Route::post('/groups/{group}/follow', [GroupFollowController::class, 'follow'])->name('groups.follow');
Route::post('/groups/{group}/unfollow', [GroupFollowController::class, 'unfollow'])->name('groups.unfollow');

use App\Http\Controllers\ChangePasswordController;

Route::get('/password/change', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');

use App\Http\Controllers\ReportController;

Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');

// Ruta para la página de reportes
Route::get('/admin/reportes', [ReportController::class, 'index'])->name('admin.reportes');

Route::delete('/admin/reports/{report}', [ReportController::class, 'destroy'])->name('admin.reports.destroy');

Route::get('/admin/reports/{report}', [ReportController::class, 'show'])->name('admin.reports.show');

// web.php
Route::get('/enlaces', [UserController::class, 'enlaces'])->name('perfil.enlaces');
Route::post('/enlaces', [UserController::class, 'actualizarEnlaces'])->name('usuarios.enlaces.actualizar');

Route::get('/groups/{group}/ajustes/edit', [GroupController::class, 'edit'])->name('groups.ajustes.edit');


Route::get('/groups/{group}/ajustes/enlaces', [GroupController::class, 'editLinks'])->name('groups.ajustes.enlaces');
Route::put('/groups/{group}/ajustes/enlaces', [GroupController::class, 'updateLinks'])->name('groups.links.update');

Route::put('/ajustes/actualizar', [UserController::class, 'actualizar'])->name('perfil.actualizar');

//SeGUIR EVENTO 
Route::post('/events/{event}/attend', [EventController::class, 'attendEvent'])->name('events.attend');
Route::post('/events/{event}/leave', [EventController::class, 'leaveEvent'])->name('events.leave');

//editar evento

Route::middleware('auth')->group(function () {
    Route::get('events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::get('/groups/{group}/members', [GroupController::class, 'getMembers']);

Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');


// Rutas de administración de grupos
Route::prefix('admin')->group(function () {
    Route::get('/groups', [GroupController::class, 'adminIndex'])->name('admin.groups.index');
    Route::get('/groups/create', [GroupController::class, 'adminCreate'])->name('admin.groups.create');
    Route::post('/groups', [GroupController::class, 'adminStore'])->name('admin.groups.store');
    Route::get('/groups/{id}/edit', [GroupController::class, 'adminEdit'])->name('admin.groups.edit');
    Route::put('/groups/{id}', [GroupController::class, 'adminUpdate'])->name('admin.groups.update');
    Route::delete('/groups/{id}', [GroupController::class, 'adminDestroy'])->name('admin.groups.destroy');
});


Route::get('/admin/events', [EventController::class, 'adminIndex'])->name('admin.events.index');
Route::get('/admin/events/{id}/edit', [EventController::class, 'adminEdit'])->name('admin.events.edit');
Route::put('/admin/events/{id}', [EventController::class, 'adminUpdate'])->name('admin.events.update');
Route::delete('/admin/events/{id}', [EventController::class, 'adminDestroy'])->name('admin.events.destroy');

Route::get('/info', [AdminController::class, 'info'])->name('admin.info');

Route::get('/app-info', function () {
    return view('app-info'); 
})->name('app.info');
