<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                <a class="nav-link" href="{{route('user.listlivroReserva')}}">Reserva</a>
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
<h2 class="mt-3 d-flex justify-content-center">Finalização da reserva</h2>
<form class="row g-3" style="max-width: 850px;margin: auto" method="POST" action="{{route('user.FinalizaReservaDo')}}">
    @csrf
    @foreach($livros as $l)
        <div>
            <label for="inputText" class="form-label" disabled="disabled">Livro reservado</label>
            <input class="form-control" id="titulo" name="titulo" disabled="disabled"  value="{{$l->titulo}}">
            <input class="form-control" id="id" name="id" type="hidden" value="{{$l->id}}">
        </div>
    @endforeach
    <div>
        <label for="inputText" class="form-label" disabled="disabled">Data para retirada</label>
        <br>
        <input id="date" name="date" type="date" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Reservar</button>
    </div>
</form>
</div>
</body>
</html>
