<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivrosRegister;
use App\Http\Requests\StoreLeitorRegister;
use App\Models\Livros;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function InsertLivro(){
        if(Auth::check() === true){
            return view('admin.novolivro');
        }
    }
    public function InsertLivroDo(StoreLivrosRegister $request){
        $livros = new Livros;

        $livros->titulo = $request->TituloLivro;
        $livros->edicao = $request->Edicao;
        $livros->volume = $request->Volume;
        $livros->isbn = $request->ISBN;
        $livros->autor = $request->Autor;
        $livros->genero = $request->Genero;
        $livros->editora = $request->Editora;
        $livros->quantidade = $request->quantidade;
        $livros->id_biblioteca = Auth::User()->id;

        if($request->hasFile('image') && $request->file('image')->isValid()){

            $image = $request->image->store('livros');

            $livros['image'] = $image;

        }

        $livros->save();
        return redirect()->route('admin');
    }
    public function DeleteLivro($id){
        Livros::findOrFail($id)->delete();

        return redirect()->route('admin.ListLivroDo');
    }
    public function AlterLivro($id){
        $livro = Livros::findOrFail($id);
        return view('admin.editlivro',['livro'=> $livro]);
    }
    public function AlterLivroUpdate(StoreLivrosRegister $request){
        //var_dump($request->all());

        Livros::findOrFail($request->id)->update($request->all());

        return redirect()->route('admin.ListLivroDo');
    }
    public function ListLivroDo(){
        $pesquisa = request('pesquisa');
        if($pesquisa){
            $livros = Livros::where('titulo','like',"%{$pesquisa}%")
                ->where('id_biblioteca',Auth::User()->id)->paginate(10);

            return view('admin.dashboard',[
                'livros'=>$livros,
                'pesquisa'=> $pesquisa
            ]);
        }else{
        $livros = Livros::where('id_biblioteca',Auth::User()->id)->paginate(10);

        return view('admin.dashboard',[
            'livros'=>$livros,
            'pesquisa'=> $pesquisa
        ]);
        }
    }
    public function listLeitorDo(){
        $pesquisa = request('pesquisa');

        if($pesquisa){
            $users = User::where('name','like',"%{$pesquisa}%")
                ->where('bibilioteca_usuario',Auth::User()->id)->paginate(10);
            return view('admin.listleitor', [
                'users' => $users,
                'pesquisa'=> $pesquisa
            ]);
        }else {
            $users = User::where('bibilioteca_usuario', Auth::User()->id)->paginate(10);

            return view('admin.listleitor', [
                'users' => $users,
                'pesquisa'=> $pesquisa
            ]);
        }
    }
    public function InsertLeitor(){
        return view('admin.novoleitor');
    }
    public function InsertLeitorDo(StoreLeitorRegister $request){
        $user = new User;

        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = $request->senha;
        $user->usuario = 1;
        $user->cpf = $request->CPF;
        $user->endereco = $request->endereco;
        $user->cidade = $request->cidade;
        $user->estado = $request->estado;
        $user->bairro = $request->bairro;
        $user->complemento = $request->complemento;
        $user->numero = $request->numero;
        $user->zip = $request->cep;
        $user->password = bcrypt($request->senha);
        $user->bibilioteca_usuario = Auth::User()->id;

        $user->save();
        return redirect()->route('admin.ListLeitor');
    }
    public function Alterleitor($id){
        $user = User::findOrFail($id);
        return view('admin.editleitor',['user'=> $user]);
    }
    public function AlterleitorUpdate(Request $request){
        $user = User::findOrFail($request->id);

        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = $request->senha;
        $user->usuario = 1;
        $user->cpf = $request->CPF;
        $user->endereco = $request->endereco;
        $user->cidade = $request->cidade;
        $user->estado = $request->estado;
        $user->bairro = $request->bairro;
        $user->complemento = $request->complemento;
        $user->numero = $request->numero;
        $user->zip = $request->cep;
        $user->password = bcrypt($request->senha);
        $user->bibilioteca_usuario = Auth::User()->id;
        $user->update();
        return redirect()->route('admin.ListLeitor');
    }
    public function Deleteleitor($id){
        User::findOrFail($id)->delete();

        return redirect()->route('admin.ListLeitor');
    }
    public function locarLivro()
    {
        $pesquisa = request('pesquisa');

        if ($pesquisa) {
            $livros = Livros::where('titulo', 'like', "%{$pesquisa}%")
                ->where('id_biblioteca', Auth::User()->id)->paginate(10);

            return view('admin.dashboard', [
                'livros' => $livros,
                'pesquisa' => $pesquisa
            ]);
        } else {
            $livros = Livros::where('id_biblioteca', Auth::User()->id)->paginate(10);

            return view('admin.locarlivro');
        }
    }
}
