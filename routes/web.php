<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


//Principal
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Articulos
Route::resource('articles', ArticleController::class)
                ->except('show')
                ->names('articles');

//Categorias
Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');

//Comentarios
Route::resource('comments', CommentController::class)
                ->only('index', 'destroy')
                ->names('comments');

//Perfiles
Route::resource('profiles', ProfileController::class)
                ->only('edit', 'update')
                ->names('profiles');
                
//Ver articulos
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');

//Ver articulos por categorias
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

//Guardar comentarios
Route::get('/comment', [CommentController::class, 'store'])->name('comments.store');


// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store'); 
// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Auth::routes();
