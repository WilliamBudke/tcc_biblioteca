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
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="{{route('admin.CirculacaoLivro')}}" type="button" class="btn btn-success">Voltar</a>
            </div>
        </section>
        <div>
            <h2 class="mt-3">Lista de livros locados</h2>
        </div>
        <table class="table mb-3 mt-3"  style="max-width: 1200px;margin: auto">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ISBN</th>
                <th scope="col">Título do livro</th>
            </tr>
            </thead>
            @foreach($var as $v)
                <tbody>
                <tr>
                    <th scope="col">{{$v->Emprestimo->id}}</th>
                    <th scope="col">{{$v->Emprestimo->isbn}}</th>
                    <th scope="col">{{$v->Emprestimo->titulo}}</th>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div id="div_paginacao" class="span12 mt-3 d-flex justify-content-center" style="width: 200px; margin: 0 auto; float: none;">
    {{$var->links('pagination::bootstrap-4')}}
</div>
</body>
</html>
