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
        <h2 class="mt-3 d-flex justify-content-center">Locação de livros</h2>
        <div class=" mt-3">
            <main>
                <section class="section">
                    <form style="max-width: 350px;margin: auto" class="d-flex" role="search" action="" method="get">
                        @csrf
                        <input class="form-control me-2" type="search" name="pesquisa" id="pesquisa" placeholder="Pesquisar" aria-label="Pesquisar">
                        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                    </form>
                </section>
            </main>
        </div>
        @if(count($livros) == 0 && $pesquisa)
            <p class="d-flex justify-content-center" style="max-width: 250px;margin: auto">Nada encontrado:( <a href="{{route('admin.LocacaoLivro')}}">Ver todos!</a></p>
        @else
            @if(count($livros) >= 1 && $pesquisa)
                <p class="d-flex justify-content-center" style="max-width: 250px;margin: auto"><a href="{{route('admin.LocacaoLivro')}}">Ver todos!</a></p>
            @endif
        @endif
        @foreach($livros->chunk(3) as $lchunk)
            <div class="container">
                <div class="row mt-3 d-flex justify-content-center">
                    @foreach($lchunk as  $l)
                        <div class="card" style="width: 18rem;">
                            <img class="mt-1 ms-3"src="{{ asset('/storage/'.$l->image) }}" style="max-width:150px" class="card-img-top img-responsive" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$l->titulo}}</h5>
                                <p class="card-text">Autor: {{$l->autor}}</p>
                                <p class="card-text">Gênero: {{$l->genero}}</p>
                                <p class="card-text">ISBN: {{$l->isbn}}</p>
                            </div>
                            <form action="{{ route('admin.AdicionaLocacao',['id'=> $l->id])}}" method="post">
                                @csrf
                                @method('post')
                                <div class="mb-2">
                                    <button class="btn btn-primary">Adicionar a Locação</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
    @endforeach
    <div id="div_paginacao" class="span12 mt-3 d-flex justify-content-center" style="width: 200px; margin: 0 auto; float: none;">
        {{$livros->links('pagination::bootstrap-4')}}
    </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
