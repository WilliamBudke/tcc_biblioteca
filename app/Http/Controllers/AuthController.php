<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRegister;
use App\Models\Emprestimo;
use App\Models\Notificacao;
use App\Notifications\EntregaNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function dashboard(){

        $users = Emprestimo::where('data_entrega',Carbon::today())->where('status','LOC')->pluck('id');

            foreach ($users as $user) {
                $idemp = Notificacao::consultaId([
                    'id_emprestimo' => $user,
                ]);
                if(empty($idemp)){
                $u = Emprestimo::findOrFail($user);

                $not = new Notificacao;

                $not-> mensagens_notificacoes = 'Hoje é a data de entrega do emprestimo de ID:';
                $not-> id_emprestimo = $u->id;
                $not-> data = Carbon::today();
                $not-> status  = 'N';

                $not->save();
            }
        }

        if(Auth::check() === true AND Auth::User()->admin == 1){
            return redirect()->route('admin.ListLivroDo');
        }
        if(Auth::check() === true AND Auth::User()->usuario == 1){
            return redirect()->route('user');
        }
        return redirect()->route('admin.login');
    }
    public function showLoginForm(){
        return view('admin.formLogin');
    }
    public function login(Request $request){
        $credentials = [
            'email'=> $request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($credentials)){
            return redirect()->route('admin');
        }
        return redirect()->back()->withInput()->withErrors('Os dados não conferem!');
    }
    public function showLogout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function showRegistrar(){
            Auth::logout();
            return view('admin.registra');
    }
    public function store(StoreUserRegister $request){
        if(Auth::check() === false) {
            $user = new User;


            $user->name = $request->razao;
            $user->email = $request->email;
            $user->password = $request->senha;
            $user->admin = 1;
            $user->cnpj = $request->CNPJ;
            $user->endereco = $request->endereco;
            $user->cidade = $request->cidade;
            $user->estado = $request->estado;
            $user->bairro = $request->bairro;
            $user->complemento = $request->complemento;
            $user->numero = $request->numero;
            $user->zip = $request->cep;
            $user->password = bcrypt($request->senha);

            $user->save();

            return redirect()->route('admin');
        }else{
            Auth::logout();
            return redirect()->route('admin');
        }
    }
}
