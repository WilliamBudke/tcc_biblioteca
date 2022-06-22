<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Dashboard</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">Alencar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{route('admin.ListLivroDo')}}">Livros</a>
                <a class="nav-link" href="{{route('admin.ListLeitor')}}">Leitores</a>
                <a class="nav-link" href="{{route('admin.locarLivro')}}">Locar livro</a>
                <a class="nav-link" href="{{route('admin.ListReservas')}}">Reservas</a>
                <a class="nav-link" href="{{route('admin.ListSugestoes')}}">Solicitações</a>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a class="btn btn-danger" role="button" href="{{route('admin.logout')}}">Sair</a></li>
        </ul>
    </div>
</nav>
@if(Session::has('mensagem-sucesso'))
    <div class="alert alert-success" role="alert">
        <strong class="text-center">{{Session::get('mensagem-sucesso')}}</strong>
    </div>
@endif
<main>
    <div class="container mb-3 mt-3">
        <section>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.locarLivro')}}" type="button" class="btn btn-success">Lista de solicitações de locações</a>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.LocacaoLivro')}}" type="button" class="btn btn-success">Nova Locação</a>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.CirculacaoLivro')}}"  type="button" class="btn btn-success">Em circulação</a>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.HistoricoCirculacao')}}" type="button" class="btn btn-success">Históricos de Locação</a>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.ValorMulta')}}" type="button" class="btn btn-success">Definir Valor das Multas</a>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.CarrinhoCompra')}}" type="button" class="btn btn-success">Concluir locação</a>
            </div>
        </section>
        <div class="container">
            <section class="mt-3">
                <a href="{{route('admin.LocacaoLivro')}}">
                    <button class="btn btn-success">Voltar</button>
                </a>
            </section>
            <h2 class="mt-3">Locação</h2>
            </br>
            @forelse($pedidos as $pedido)
                <h5>Nº do emprestimo: {{$pedido->id}}</h5>
                @foreach($pedido->emprestimo_livro as $pedido_emprestimo)
                    <ul class="list-group mb-3">
                        <li class="list-group-item py-3">
                            <div class="row g-3">
                                <div class="col-4 col-md-3 col-lg-2">
                                    <a href="#">
                                        <img src="{{ asset('/storage/'.$pedido_emprestimo->Emprestimo->image) }}" style="max-width:150px" class="img-thumbnail">
                                    </a>
                                </div>
                                <div class="col-8 col-md-9 col-lg-7 col-xl-8 text-left align-self-center">
                                    <h4><b><a href="#" class="text-decoration-none text-danger">Título: {{$pedido_emprestimo->Emprestimo->titulo}} </a></b></h4>
                                    <h4><small>ISBN: {{$pedido_emprestimo->Emprestimo->isbn}}</small></h4>
                                </div>
                                <div class="col-6 offset-6 col-sm-6 offset-sm-6 col-md-4 offset-md-8 col-lg-3 offset-lg-0 col-xl-2 align-self-center mt-3">
                                    <form action="{{ route('admin.DeleteCarrinho',['id'=>$pedido_emprestimo->id_livro])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Remover</button>
                                    </form>
                                    <div class="text-right mt-2">
                                        <small class="text-secondary">Data de locação: {{$pedido_emprestimo->data_emprestimo}}</small></br>
                                        <small class="text-dak">Data de devolução: {{$pedido_emprestimo->data_entrega}}</small>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
                <section class="mt-3">
                    <form action="{{ route('admin.ConcluirCompra',['id'=>$pedido->id])}}" method="post">
                        @csrf
                        @method('post')
                        <div class="mb-3 d-flex justify-content-center">
                        <div class="col-md-4 mt-3">
                            <label for="inputState" class="form-label">Escolha o leitor</label>
                            <select name="leitor" id="leitor" class="form-select"required autofocus>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mb-3">
                            <button class="btn btn-success">Concluir locação</button>
                        </div>
                    </form>
                </section>
            @empty
                <h5>Locação vazia</h5>
            @endforelse
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
