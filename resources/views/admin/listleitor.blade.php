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
                <a class="nav-link" href="">Devolver Livro</a>
                <a class="nav-link" href="">Reservas</a>
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
            <a href="{{route('admin.inserteLeitor')}}">
                <button class="btn btn-success">Novo leitor</button>
            </a>
        </section>
    </div>
    <section class="section">
        <form style="max-width: 350px;margin: auto" class="d-flex" role="search" action="{{route('admin.ListLeitor')}}" method="get">
            @csrf
            <input class="form-control me-2" type="search" name="pesquisa" id="pesquisa" placeholder="Pesquisar" aria-label="Pesquisar">
            <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
    </section>
</main>
<table class="table mb-3 mt-3"  style="max-width: 1200px;margin: auto">
    <thead>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">CPF</th>
        <th scope="col">Endereço</th>
        <th scope="col">Nº</th>
        <th scope="col">Complemento</th>
        <th scope="col">Bairro</th>
        <th scope="col">Cidade</th>
        <th scope="col">Estado</th>
        <th scope="col">CEP</th>
        <th scope="col">Editar</th>
        <th scope="col">Excluir</th>
    </tr>
    </thead>
    @foreach($users as $u)
        <tbody>
        <tr>
            <td>{{$u->name}}</td>
            <td>{{$u->email}}</td>
            <td>{{$u->cpf}}</td>
            <td>{{$u->endereco }}</td>
            <td>{{$u->numero}}</td>
            <td>{{$u->complemento}}</td>
            <td>{{$u->bairro}}</td>
            <td>{{$u->cidade}}</td>
            <td>{{$u->estado}}</td>
            <td>{{$u->zip}}</td>

            <td><a href="{{route('admin.alterleitor',['id'=> $u->id])}}" class="btn btn-info">Editar</a></td>
            <td>
                <form action="{{ route('admin.leitorDelete',['id'=> $u->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Remover</button>
                </form>
            </td>
        </tr>
        @endforeach
        @if(count($users) == 0 && $pesquisa)
            <p style="max-width: 250px;margin: auto">Nada encontrado:( <a href="{{route('admin.ListLeitor')}}">Ver todos!</a></p>
        @else
            @if(count($users) >= 1 && $pesquisa)
                <p style="max-width: 250px;margin: auto"><a href="{{route('admin.ListLeitor')}}">Ver todos!</a></p>
            @endif
        @endif
        </tbody>
</table>
<div id="div_paginacao" class="span12" style="width: 200px; margin: 0 auto; float: none;">
    {{$users->links('pagination::bootstrap-4')}}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
