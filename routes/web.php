<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController; // Asegúrate de importar el controlador de publicaciones

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Mi perfil
Route::get('/perfil', [PerfilController::class, 'mostrarPerfil'])->name('perfil');
Route::get('/perfil/posts', [PerfilController::class, 'mostrarPosts'])->name('perfil.posts');


// Ruta para mostrar el formulario de creación de un nuevo post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Ruta para almacenar un nuevo post en la base de datos
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
