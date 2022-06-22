<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use App\Models\emprestimo_livro;
use App\Models\Livros;
use App\Models\Notificacao;
use App\Models\Sugestao;
use App\Models\User;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Auth::check() === true and Auth::User()->usuario == 1) {
            return redirect()->route('user.listLivros');
        }
        return redirect()->route('admin.login');
    }

    public function listLivros()
    {
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        $pesquisa = request('pesquisa');
        if ($pesquisa) {
            $livros = Livros::where('titulo', 'like', "%{$pesquisa}%")
                ->where('quantidade', '>=', '1')
                ->where('id_biblioteca', Auth::User()->bibilioteca_usuario)
                ->paginate(6);

            return view('user.dashboard', [
                'livros' => $livros,
                'pesquisa' => $pesquisa,
                'var' => $var
            ]);
        } else {
            $livros = Livros::where('id_biblioteca', Auth::User()->bibilioteca_usuario)
                ->where('quantidade', '>=', '1')
                ->paginate(6);

            return view('user.dashboard', [
                'livros' => $livros,
                'pesquisa' => $pesquisa,
                'var' => $var
            ]);
        }
    }

    public function CarrinhoCompra()
    {
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        $pedidos = Emprestimo::where([
            'status' => 'RE',
            'id_usuario' => Auth::User()->id
        ])->get();

        //dd($pedidos[0]->emprestimo_livro[0]->Emprestimo);

        return view('user.carrinho', compact('pedidos','var'));
    }

    public function DeleteCarrinho($id)
    {
        emprestimo_livro::where([
            'id_livro' => $id,
        ])->delete();

        return redirect()->route('user.CarrinhoCompra');
    }

    public function AdicionarCarrinhoCompra(Request $request)
    {


        $this->middleware('VerifyCsrfToken');

        $req = $request;
        $idlivro = $req->id;

        $user = User::find(Auth::User()->id);

        $livro = Livros::find($idlivro);

        if (empty($livro->id)) {
            $req->session()->flash('mensagem-falha', 'Livro não encontrado!');
            return redirect()->route('user.CarrinhoCompra');
        }

        $iduser = Auth::User()->id;

        $idpedido = Emprestimo::consultaId([
            'id_usuario' => $iduser,
            'status' => 'RE'
        ]);

        if (empty($idpedido)) {
            $pedido_novo = Emprestimo::create([
                'id_usuario' => $iduser,
                'data_emprestimo' => Carbon::now(),
                'id_biblioteca' => $user->bibilioteca_usuario,
                'data_entrega' => Carbon::now()->addDays(14),
                'multa_emprestimo' => '0',
                'status' => 'RE'
            ]);
            $idpedido = $pedido_novo->id;
        }

        emprestimo_livro::create([
            'data_emprestimo' => Carbon::now(),
            'data_entrega' => Carbon::now()->addDays(14),
            'id_biblioteca' => $user->bibilioteca_usuario,
            'multa_emprestimo' => '0',
            'id_livro' => $idlivro,
            'id_emprestimo' => $idpedido,
        ]);
        $req->session()->flash('mensagem-sucesso', 'Livro Adicionado com sucesso!');
        return redirect()->route('user.CarrinhoCompra');
    }

    public function ConcluirCarrinho(Request $request)
    {

        $emprestimo = Emprestimo::findOrFail($request->id);

        $emprestimo->status = 'RET';

        foreach ($emprestimo->emprestimo_livro as $e){
            $var = $e->Emprestimo->id;

            $livro = Livros::findOrFail($var);

            $livro->quantidade = $livro->quantidade - 1;

            $livro->update();
        }

        $emprestimo->update();

        emprestimo_livro::where('id_emprestimo', $request->id)->update(['status' => 'RET']);

        $request->session()->flash('mensagem-sucesso', 'Locação concluída com sucesso!');
        return redirect()->route('user.listLivros');
    }

    public function ListLocados()
    {
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }


        $pesquisa = request('pesquisa');

        if ($pesquisa) {
            $pedidos = Emprestimo::where([
                'id' => $pesquisa,
                'status' => 'LOC',
                'id_usuario' => Auth::user()->id
            ])->paginate(10);

            return view('user.listlocados', compact('pedidos','pesquisa','var'));
        }else{
            $pedidos = Emprestimo::where([
                'status' => 'LOC',
                'id_usuario' => Auth::user()->id
            ])->paginate(10);

            return view('user.listlocados', compact('pedidos','pesquisa','var'));
        }
    }

    public function LivrosLocados(Request $request)
    {
        if ($request) {
            $pedidos = Emprestimo::where([
                'status' => 'LOC',
                'id_usuario' => Auth::User()->id,
                'id' => $request->id,
            ])->paginate(10);

            return view('user.livrolocados', [
                'pedidos' => $pedidos,
                'request' => $request
            ]);
        }else{
            return redirect()->route('user.listLivros');
        }
    }
    public function ListSugestoes(){
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        $sugestao = Sugestao::where([
            'id_user' => Auth::user()->id
        ])->paginate(9);

        return view('user.listsugestao', compact('sugestao','var'));
    }
    public function FormSugestoes(){
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        return view('user.formsugestoes', compact('var'));
    }
    public function CardSugestao(Request $request){

        $v = Sugestao::findOrFail($request->id);

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        return view('user.cardsugestao', ['v'=> $v,'var'=>$var]);
    }
    public function FormSugestoesDo(Request $request){
        $sugestao = new Sugestao;

        $sugestao->titulo = $request->sugestaotitulo;
        $sugestao->sugestao = $request->sugestaotext;
        $sugestao->id_user = Auth::user()->id;

       $sugestao->save();

       return redirect()->route('user.ListSugestoes');
    }
    public function Notificacao(){
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        $not = Notificacao::where('id_emprestimo',$users)
            ->where('status','N')
            ->paginate(10);
        return view('user.notificacao',compact('var','not'));
    }
    public function NotificacaoLida(Request $request){
        Notificacao::where('id',$request->id)->update(['status'=>'L']);

        return redirect()->route('user.Notificacao');
    }
    public function listlivroReserva()
    {
        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        $pesquisa = request('pesquisa');
        if ($pesquisa) {
            $livros = Livros::where('titulo', 'like', "%{$pesquisa}%")
                ->where('quantidade', '>=', '1')
                ->where('id_biblioteca', Auth::User()->bibilioteca_usuario)
                ->paginate(6);

            return view('user.listlivrosreserva', [
                'livros' => $livros,
                'pesquisa' => $pesquisa,
                'var' => $var
            ]);
        } else {
            $livros = Livros::where('id_biblioteca', Auth::User()->bibilioteca_usuario)
                ->where('quantidade', '>=', '1')
                ->paginate(6);

            return view('user.listlivrosreserva', [
                'livros' => $livros,
                'pesquisa' => $pesquisa,
                'var' => $var
            ]);
        }
    }
    public function FinalizaReserva(Request $request){

        $var = 0;

        $id = Emprestimo::consultaId([
            'id_usuario' => Auth::user()->id,
        ]);

        $users = Emprestimo::where('id_usuario',Auth::user()->id)->pluck('id');

        if(!empty($id)) {
            $var = Notificacao::where('id_emprestimo', $users[0])
                ->where('status', 'N')
                ->count();
        }

        $livros = Livros::where('id',$request->id)->get();

        return view('user.finalizareserva',[
            'livros' => $livros,
            'var' => $var
        ]);
    }
    public function FinalizaReservaDo(Request $request){

        $users = User::find(Auth::user()->id);

        $emp = emprestimo_livro::where('id_biblioteca',$users->bibilioteca_usuario)
            ->where('data_emprestimo',$request->date)
            ->first();


        $re = Reserva::where('id_biblioteca',$users->bibilioteca_usuario)
            ->where('data_reserva',$request->date)
            ->first();

        if($emp != null or $re != null){
            $request->session()->flash('mensagem-erro', 'Já existe uma locação ou reserva nesta data!');
            return redirect()->route('user.listlivroReserva');
        }elseif ($emp == null or $re != null){

            Reserva::create([
            'id_leitor' => Auth::user()->id,
            'id_biblioteca' => $users->bibilioteca_usuario,
            'id_livro' => $request->id,
            'status' => 'RE',
            'data_reserva' => $request->date,
            ]);
            $request->session()->flash('mensagem-sucesso', 'Reserva realizada!');
            return redirect()->route('user.listlivroReserva');
        }
    }
}
