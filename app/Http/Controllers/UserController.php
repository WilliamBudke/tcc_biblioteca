<?php

namespace App\Http\Controllers;

use App\Models\Livros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        if(Auth::check() === true AND Auth::User()->usuario == 1){
            return redirect()->route('user.listLivros');
        }
        return redirect()->route('admin.login');
    }
    public function listLivros(){
        $pesquisa = request('pesquisa');
        if($pesquisa){
            $livros = Livros::where('titulo','like',"%{$pesquisa}%")
                ->where('quantidade', '>=', '1')
                ->where('id_biblioteca', Auth::User()->bibilioteca_usuario)
                ->paginate(6);

            return view('user.dashboard', [
                'livros' => $livros,
                'pesquisa'=> $pesquisa
            ]);
        }else {
            $livros = Livros::where('id_biblioteca', Auth::User()->bibilioteca_usuario)
                ->where('quantidade', '>=', '1')
                ->paginate(6);

            return view('user.dashboard', [
                'livros' => $livros,
                'pesquisa'=> $pesquisa
            ]);
        }
    }
    public function CarrinhoCompra(){
        return view('user.carrinho');
    }
}
