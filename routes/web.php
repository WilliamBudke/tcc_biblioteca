<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

//Route::get('/', function () {return view('welcome');});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::get('/', [AuthController::class, 'dashboard'])->name('admin');
Route::post('/login/do', [AuthController::class, 'login'])->name('admin.login.do');
Route::get('/store', [AuthController::class, 'showRegistrar'])->name('admin.registrar');
Route::post('/store/do', [AuthController::class, 'store'])->name('admin.registrar.do');

//ROTAS DE GET
Route::middleware(['admin'])->group(function (){
    Route::get('/admin/logout', [AuthController::class, 'showLogout'])->name('admin.logout');

    Route::get('/admin/novolivro', [AdminController::class, 'InsertLivro'])->name('admin.insertlivro');
    Route::get('/admin/ListLivroDo', [AdminController::class, 'ListLivroDo'])->name('admin.ListLivroDo');
    Route::post('/admin/insetlivro/do', [AdminController::class, 'InsertLivroDo'])->name('admin.insertlivro.do');
    Route::get('/admin/AlterarLivro/{id}',[AdminController::class,'AlterLivro'])->name('admin.alterLivro');
    Route::put('/admin/UpdateLivro/{id}',[AdminController::class,'AlterLivroUpdate'])->name('admin.alterLivroUpdate');
    Route::delete('/admin/DeleteLivro/{id}',[AdminController::class,'DeleteLivro'])->name('admin.alterLivroDelete');

    Route::get('/admin/ListLeitor', [AdminController::class, 'listLeitorDo'])->name('admin.ListLeitor');
    Route::get('/admin/novoleitor', [AdminController::class, 'InsertLeitor'])->name('admin.inserteLeitor');
    Route::post('/admin/novoleitor/do', [AdminController::class, 'InsertLeitorDo'])->name('admin.inserteLeitorDo');
    Route::get('/admin/Alterarleitor/{id}',[AdminController::class,'Alterleitor'])->name('admin.alterleitor');
    Route::put('/admin/Updateleitor/{id}',[AdminController::class,'AlterleitorUpdate'])->name('admin.alterleitorUpdate');
    Route::delete('/admin/Deleteleitor/{id}',[AdminController::class,'Deleteleitor'])->name('admin.leitorDelete');

    Route::get('/admin/Locação', [AdminController::class, 'locarLivro'])->name('admin.locarLivro');
});

Route::middleware(['usuario'])->group(function (){
    Route::get('/user', [UserController::class, 'dashboard'])->name('user');
    Route::get('/user/listLivros',[UserController::class,'listLivros'])->name('user.listLivros');
    Route::get('/user/CarrinhoCompra',[UserController::class,'CarrinhoCompra'])->name('user.CarrinhoCompra');
});






