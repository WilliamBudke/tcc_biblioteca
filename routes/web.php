<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Notifications\EntregaNotification;
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

Route::get('/notifica.broadcast/{mgs}', function ($mgs){

});

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

    Route::get('/admin/Locacao', [AdminController::class, 'locarLivro'])->name('admin.locarLivro');
    Route::get('/admin/Circulacao', [AdminController::class, 'CirculacaoLivro'])->name('admin.CirculacaoLivro');
    Route::get('/admin/HistoricoCirculacao', [AdminController::class, 'HistoricoCirculacao'])->name('admin.HistoricoCirculacao');
    Route::post('/admin/ListadeLivros/{id}', [AdminController::class, 'ListadeLivros'])->name('admin.ListadeLivros');
    Route::post('/admin/ListadeLivrosCirculacao/{id}', [AdminController::class, 'ListadeLivrosCirculacao'])->name('admin.ListadeLivrosCirculacao');
    Route::post('/admin/ListadeLivrosDevolvidos/{id}', [AdminController::class, 'ListadeLivrosDevolvidos'])->name('admin.ListadeLivrosDevolvidos');
    Route::post('/admin/LocarLivros/{id}', [AdminController::class, 'LocarLivros'])->name('admin.LocarLivros');
    Route::post('/admin/DevolverLocacao/{id}', [AdminController::class, 'DevolverLocacao'])->name('admin.DevolverLocacao');
    Route::get('/admin/ValorMulta', [AdminController::class, 'ValorMulta'])->name('admin.ValorMulta');
    Route::post('/admin/ValorMultaDo', [AdminController::class, 'ValorMultaDo'])->name('admin.ValorMultaDo');
    Route::get('/admin/Sugestoes/',[AdminController::class,'ListSugestao'])->name('admin.ListSugestoes');
    Route::post('/admin/CardSugestao/{id}',[AdminController::class,'CardSugestao'])->name('admin.CardSugestao');
    Route::get('/admin/Reservas/',[AdminController::class,'ListReservas'])->name('admin.ListReservas');
    Route::post('/admin/LivrosReserva/{id}',[AdminController::class,'LivrosReserva'])->name('admin.LivrosReserva');
    Route::post('/admin/LocarReserva/{id}',[AdminController::class,'LocarReserva'])->name('admin.LocarReserva');
    Route::get('/admin/LocacaoLivro/',[AdminController::class,'LocacaoLivro'])->name('admin.LocacaoLivro');
    Route::post('/admin/AdicionaLocacao/{id}',[AdminController::class,'AdicionaLocacao'])->name('admin.AdicionaLocacao');
    Route::get('/admin/FinalizaLocacao/',[AdminController::class,'CarrinhoCompra'])->name('admin.CarrinhoCompra');
    Route::delete('/admin/DeleteCarrinho/{id}',[AdminController::class,'DeleteCarrinho'])->name('admin.DeleteCarrinho');
    Route::post('/admin/ConcluirCarrinho/{id}',[AdminController::class,'ConcluirCarrinho'])->name('admin.ConcluirCompra');
});

Route::middleware(['usuario'])->group(function (){
    Route::get('/user', [UserController::class, 'dashboard'])->name('user');
    Route::get('/user/listLivros',[UserController::class,'listLivros'])->name('user.listLivros');
    Route::get('/user/Carrinho',[UserController::class,'CarrinhoCompra'])->name('user.CarrinhoCompra');
    Route::post('/user/AdicionarCarrinho/{id}',[UserController::class,'AdicionarCarrinhoCompra'])->name('user.AddCarrinhoCompra');
    Route::post('/user/ConcluirCarrinho/{id}',[UserController::class,'ConcluirCarrinho'])->name('user.ConcluirCompra');
    Route::delete('/user/DeleteCarrinho/{id}',[UserController::class,'DeleteCarrinho'])->name('user.DeleteCarrinho');
    Route::get('/user/Locados/',[UserController::class,'ListLocados'])->name('user.ListLocados');
    Route::post('/user/LivroLocados/{id}',[UserController::class,'LivrosLocados'])->name('user.LivrosLocados');
    Route::get('/user/Sugestoes/',[UserController::class,'ListSugestoes'])->name('user.ListSugestoes');
    Route::get('/user/SugestaoForm/',[UserController::class,'FormSugestoes'])->name('user.FormSugestoes');
    Route::post('/user/SugestaoForm/Do',[UserController::class,'FormSugestoesDo'])->name('user.FormSugestoesDo');
    Route::get('/user/Notificacao/',[UserController::class,'Notificacao'])->name('user.Notificacao');
    Route::post('/user/NotificacaoLida/{id}',[UserController::class,'NotificacaoLida'])->name('user.NotificacaoLida');
    Route::post('/user/CardSugestao/{id}',[UserController::class,'CardSugestao'])->name('user.CardSugestao');
    Route::get('/user/Reserva', [UserController::class, 'listlivroReserva'])->name('user.listlivroReserva');
    Route::post('/user/FinalizaReserva/{id}', [UserController::class, 'FinalizaReserva'])->name('user.FinalizaReserva');
    Route::post('/user/FinalizaReservaDo/', [UserController::class, 'FinalizaReservaDo'])->name('user.FinalizaReservaDo');

});






