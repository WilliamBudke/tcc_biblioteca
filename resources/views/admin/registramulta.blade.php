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
        <a class="d-flex justify-content-center">Cliente está com o livro atrasado!!</a>
        </br>
        <a class="d-flex justify-content-center">A multa que o cliente deve pagar é de R$:{{$multa}}</a>
        <div class="d-flex justify-content-center mt-3">
        <a href="{{route('admin.CirculacaoLivro')}}" type="submit" class="btn btn-success">Voltar ao inicio</a>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
