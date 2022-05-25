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
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-success">Nova Locação</button>
            </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-success">Históricos de Locação</button>
            </div>
        </section>
        <div>
            <h2 class="mt-3">Solicitação de locações</h2>
        </div>
        <section class="section">
            <form style="max-width: 350px;margin: auto" class="d-flex" role="search" action="" method="get">
                @csrf
                <input class="form-control me-2" type="search" name="pesquisa" id="pesquisa" placeholder="Pesquisar por usuário" aria-label="Pesquisar">
                <button class="btn btn-outline-success" type="submit">Pesquisar</button>
            </form>
        </section>
        <table class="table mb-3 mt-3"  style="max-width: 1200px;margin: auto">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Livro</th>
                <th scope="col">ISBN</th>
                <th scope="col">Email</th>
                <th scope="col">Leitor</th>
                <th scope="col">Data de locação</th>
                <th scope="col">Data de devolução</th>
            </tr>
            </thead>

        </table>
    </div>
</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
