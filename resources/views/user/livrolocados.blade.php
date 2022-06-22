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
                <a class="nav-link" href="{{route('user.listLivros')}}">Acervo</a>
                <a class="nav-link" href="#">Reserva</a>
                <a class="nav-link" href="{{route('user.ListLocados')}}">Locados</a>
                <a class="nav-link" href="{{route('user.ListSugestoes')}}">Enviar sugestão</a>
            </div>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{route('user.Notificacao')}}" type="button" class="btn btn-primary position-relative">
                    Notificação
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{$var}}
                    <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
            </li>
            <li><a class="nav-link" href="{{route('user.CarrinhoCompra')}}">Locação</a></li>
            <li><a class="btn btn-danger" role="button" href="{{route('admin.logout')}}">Sair</a></li>
        </ul>
    </div>
</nav>
<main>
    <div class="row g-3" style="max-width: 1250px;margin: auto">
        <section>
            <a href="{{route('user.ListLocados')}}">
                <button class="btn btn-success">Voltar</button>
            </a>
        </section>
    </div>
</main>
<table class="table mb-3 mt-3"  style="max-width: 1200px;margin: auto">
    <thead>
    <tr>
        <th scope="col">ISBN</th>
        <th scope="col">Título</th>
        <th scope="col">Autor</th>
        <th scope="col">Editora</th>
        <th scope="col">Volume</th>
    </tr>
    </thead>
    @foreach($pedidos as $pedido)
        @foreach($pedido->emprestimo_livro as $p)
            <tbody>
            <tr>
                <td>{{$p->Emprestimo->isbn}}</td>
                <td>{{$p->Emprestimo->titulo}}</td>
                <td>{{$p->Emprestimo->autor}}</td>
                <td>{{$p->Emprestimo->editora}}</td>
                <td>{{$p->Emprestimo->volume}}</td>
            </tr>
            @endforeach
            @endforeach

            </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<div id="div_paginacao" class="span12 mt-3 d-flex justify-content-center" style="width: 200px; margin: 0 auto; float: none;">
    {{$pedidos->links('pagination::bootstrap-4')}}
</div>
</body>
</html>
