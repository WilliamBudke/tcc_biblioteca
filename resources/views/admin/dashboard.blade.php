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

<main>
    <div class="container mb-3 mt-3">
        <section>
            <a href="{{route('admin.insertlivro')}}">
                <button class="btn btn-success">Novo livro</button>
            </a>
        </section>
    </div>
    <section class="section">
        <form style="max-width: 350px;margin: auto" class="d-flex" role="search" action="{{route('admin.ListLivroDo')}}" method="get">
            @csrf
            <input class="form-control me-2" type="search" name="pesquisa" id="pesquisa" placeholder="Pesquisar" aria-label="Pesquisar">
            <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
    </section>
</main>
<table class="table mb-3 mt-3"  style="max-width: 1200px;margin: auto">
    <thead>
    <tr>
        <th scope="col">ISBN</th>
        <th scope="col">Título</th>
        <th scope="col">Autor</th>
        <th scope="col">Editora</th>
        <th scope="col">Gênero</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Editar</th>
        <th scope="col">Deletar</th>

    </tr>
    </thead>
@foreach($livros as $l)
    <tbody>
    <tr>
        <td>{{$l->isbn}}</td>
        <td>{{$l->titulo}}</td>
        <td>{{$l->autor}}</td>
        <td>{{$l->editora}}</td>
        <td>{{$l->genero}}</td>
        <td>{{$l->quantidade}}</td>
        <td><a href="{{route('admin.alterLivro',['id'=> $l->id])}}" class="btn btn-info">Editar</a></td>
        <td>
            <form action="{{ route('admin.alterLivroDelete',['id'=> $l->id])}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Remover</button>
            </form>
        </td>
    </tr>
    @endforeach
    @if(count($livros) == 0 && $pesquisa)
        <p style="max-width: 250px;margin: auto">Nada encontrado:( <a href="{{route('admin.ListLivroDo')}}">Ver todos!</a></p>
    @else
        @if(count($livros) >= 1 && $pesquisa)
            <p style="max-width: 250px;margin: auto"><a href="{{route('admin.ListLivroDo')}}">Ver todos!</a></p>
        @endif
    @endif
    </tbody>
</table>
<div id="div_paginacao" class="span12" style="width: 200px; margin: 0 auto; float: none;">
    {{$livros->links('pagination::bootstrap-4')}}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
