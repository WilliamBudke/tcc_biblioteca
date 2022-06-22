<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivrosRegister;
use App\Http\Requests\StoreLeitorRegister;
use App\Models\Emprestimo;
use App\Models\emprestimo_livro;
use App\Models\Livros;
use App\Models\Reserva;
use App\Models\Sugestao;
use App\Models\User;
use Carbon\Carbon;
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
        $this->middleware('VerifyCsrfToken');

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
        $this->middleware('VerifyCsrfToken');

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
        $this->middleware('VerifyCsrfToken');

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
        $var = Emprestimo::where('id_biblioteca',Auth::user()->id)
            ->where('status','RET')
            ->paginate(10);

        return view('admin.locarlivro',compact('var'));
    }
    public function ListadeLivros(Request $request){
        $var = emprestimo_livro::where('id_emprestimo',$request->id)
            ->where('status','RET')
            ->paginate(10);
        return view('admin.visualizarlivros',compact('var'));
    }
    public function LocarLivros(Request $request){
        Emprestimo::where('id',$request->id)->update(['status' => 'LOC']);

        emprestimo_livro::where('id_emprestimo', $request->id)->update(['status' => 'LOC']);

        $request->session()->flash('mensagem-sucesso', 'Locação concluída com sucesso!');
        return redirect()->route('admin.locarLivro');
    }
    public function CirculacaoLivro(){
        $var = Emprestimo::where(['status' => 'LOC'])->where('id_biblioteca',Auth::user()->id)->paginate(10);
        return view('admin.locadoscirculacao',compact('var'));
    }
    public function ListadeLivrosCirculacao(Request $request){
        $var = emprestimo_livro::where('id_emprestimo',$request->id)->where('status','LOC')->paginate(10);
        return view('admin.visualizarlivroscirculacao',compact('var'));
    }
    public function ListadeLivrosDevolvidos(Request $request){
        $var = emprestimo_livro::where('id_emprestimo',$request->id)->where('status','DEV')->paginate(10);
        return view('admin.visualizarhistoricolivros',compact('var'));
    }
    public function DevolverLocacao(Request $request){

        $emprestimo = Emprestimo::findOrFail($request->id);

        if(Carbon::now() <= $emprestimo->data_entrega) {
            Emprestimo::where('id', $request->id)->update(['status' => 'DEV', 'data_entrega' => Carbon::now()]);

            emprestimo_livro::where('id_emprestimo', $request->id)->update(['status' => 'DEV', 'data_entrega' => Carbon::now()]);

            foreach ($emprestimo->emprestimo_livro as $e) {
                $var = $e->Emprestimo->id;

                $livro = Livros::findOrFail($var);

                $livro->quantidade = $livro->quantidade + 1;

                $livro->update();
            }
            $request->session()->flash('mensagem-sucesso', 'Locação devolvida com sucesso!');
            return redirect()->route('admin.CirculacaoLivro');
        }else if(Carbon::now() >= $emprestimo->data_entrega ){

            $var = User::find(Auth::user()->id);

            $aux = $emprestimo->data_entrega;

            $a = Carbon::now();

            $multa = ($var->valor_multa * $a->diffInDays($aux));

            Emprestimo::where('id', $request->id)->update(['status' => 'DEV', 'data_entrega' => Carbon::now(),'multa_emprestimo' => $multa]);

            emprestimo_livro::where('id_emprestimo', $request->id)->update(['status' => 'DEV', 'data_entrega' => Carbon::now(),'multa_emprestimo' => $multa]);

            foreach ($emprestimo->emprestimo_livro as $e) {
                $var = $e->Emprestimo->id;

                $livro = Livros::findOrFail($var);

                $livro->quantidade = $livro->quantidade + 1;

                $livro->update();
            }

            return view('admin.registramulta', ['multa'=> $multa]);
        }
    }
    public function HistoricoCirculacao(){
        $var = Emprestimo::where(['status' => 'DEV'])->where('id_biblioteca',Auth::user()->id)->paginate(10);
        return view('admin.historicolocacao',compact('var'));
    }
    public function ListSugestao(){
        $sugestao = Sugestao::all();

        return view('admin.listsugestao', compact('sugestao',));
    }
    public function CardSugestao(Request $request){
        $v = Sugestao::findOrFail($request->id);
        return view('admin.cardsugestao', ['v'=> $v]);
    }
    public function ValorMulta(){
        return view('admin.valormulta');
    }
    public function ValorMultaDo(Request $request){
        User::where('id', Auth::user()->id)->update(['valor_multa' => $request->valor]);

        return redirect()->route('admin.locarLivro');
    }
    public function ListReservas(){
        $reserva = Reserva::where('id_biblioteca',Auth::user()->id)->where('status','re')->paginate(10);

        return view('admin.listreservas',compact('reserva'));
    }
    public function LivrosReserva(Request $request){
        $var = Reserva::where('id_biblioteca',Auth::user()->id)
            ->where('id',$request->id)
            ->where('status','re')->paginate(10);

        return view('admin.ListLivrosReserva',compact('var'));
    }
    public function LocarReserva(Request $request){
        Reserva::where('id_biblioteca',Auth::user()->id)
                ->where('id',$request->id)
                ->where('status','re')
                ->update(['status' => 'LOC']);

        $aux = Reserva::find($request->id);

        $pedido_novo = Emprestimo::create([
            'id_usuario' => $aux->id_leitor,
            'data_emprestimo' => Carbon::now(),
            'id_biblioteca' => $aux->id_biblioteca,
            'data_entrega' => Carbon::now()->addDays(14),
            'multa_emprestimo' => '0',
            'status' => 'LOC'
        ]);

        $idpedido = $pedido_novo->id;

        emprestimo_livro::create([
        'data_emprestimo' => Carbon::now(),
        'data_entrega' => Carbon::now()->addDays(14),
        'id_biblioteca' => $aux->id_biblioteca,
        'multa_emprestimo' => '0',
        'status' => 'LOC',
        'id_livro' => $aux->id_livro,
        'id_emprestimo' => $idpedido,
        ]);

        return redirect()->route('admin.ListReservas');
    }
    public function LocacaoLivro(){
        $var = 0;

        $pesquisa = request('pesquisa');

        $users = User::where('bibilioteca_usuario',Auth::user()->id)->get();

        if ($pesquisa) {
            $livros = Livros::where('titulo', 'like', "%{$pesquisa}%")
                ->where('quantidade', '>=', '1')
                ->where('id_biblioteca', Auth::User()->id)
                ->paginate(6);

            return view('admin.novalocacao', [
                'livros' => $livros,
                'pesquisa' => $pesquisa,
                'users' => $users,
                'var' => $var
            ]);
        } else {
            $livros = Livros::where('id_biblioteca', Auth::User()->id)
                ->where('quantidade', '>=', '1')
                ->paginate(6);

            return view('admin.novalocacao', [
                'livros' => $livros,
                'pesquisa' => $pesquisa,
                'users' => $users,
                'var' => $var
            ]);
        }
        return view('admin.novalocacao');
    }
    public function AdicionaLocacao(Request $request){
        $req = $request;
        $idlivro = $req->id;

        $livro = Livros::find($idlivro);

        if (empty($livro->id)) {
            $req->session()->flash('mensagem-falha', 'Livro não encontrado!');
            return redirect()->route('user.CarrinhoCompra');
        }

        $idpedido = Emprestimo::consultaId([
            'status' => 'RE'
        ]);

        if (empty($idpedido)) {
            $pedido_novo = Emprestimo::create([
                'id_usuario' => null,
                'data_emprestimo' => Carbon::now(),
                'id_biblioteca' => Auth::user()->id,
                'data_entrega' => Carbon::now()->addDays(14),
                'multa_emprestimo' => '0',
                'status' => 'RE'
            ]);
            $idpedido = $pedido_novo->id;
        }

        emprestimo_livro::create([
            'data_emprestimo' => Carbon::now(),
            'data_entrega' => Carbon::now()->addDays(14),
            'id_biblioteca' => Auth::user()->id,
            'multa_emprestimo' => '0',
            'id_livro' => $idlivro,
            'id_emprestimo' => $idpedido,
        ]);
        $req->session()->flash('mensagem-sucesso', 'Livro Adicionado com sucesso!');
        return redirect()->route('admin.CarrinhoCompra');
    }
    public function CarrinhoCompra(){

        $users = User::where('bibilioteca_usuario',Auth::user()->id)->get();

        $pedidos = Emprestimo::where([
            'status' => 'RE',
        ])->get();

        return view('admin.carrinholocacao', compact('pedidos','users'));
    }
    public function DeleteCarrinho($id)
    {
        emprestimo_livro::where([
            'id_livro' => $id,
        ])->delete();

        return redirect()->route('admin.CarrinhoCompra');
    }
    public function ConcluirCarrinho(Request $request)
    {

        $emprestimo = Emprestimo::findOrFail($request->id);

        $emprestimo->id_usuario = $request->leitor;

        $emprestimo->status = 'LOC';

        foreach ($emprestimo->emprestimo_livro as $e){
            $var = $e->Emprestimo->id;

            $livro = Livros::findOrFail($var);

            $livro->quantidade = $livro->quantidade - 1;

            $livro->update();
        }

        $emprestimo->update();

        emprestimo_livro::where('id_emprestimo', $request->id)->update(['status' => 'LOC']);

        $request->session()->flash('mensagem-sucesso', 'Locação concluída com sucesso!');
        return redirect()->route('admin.LocacaoLivro');
    }

}
