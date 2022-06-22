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
        </section>
        <div>
            <h2 class="mt-3">Denifição do valor da multa</h2>
            <a>Favor informar somente números e utilize "." para separar</a>
        </div>
        <section class="section  mt-5">
            <form style="max-width: 350px;margin: auto" class="d-flex" role="search" action="{{route('admin.ValorMultaDo')}}" method="post">
                @csrf
                <input class="form-control me-2" name="valor" id="valor" placeholder="Informe o valor: 1.80">
                <button class="btn btn-outline-success" type="submit">Confirmar</button>
            </form>
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
