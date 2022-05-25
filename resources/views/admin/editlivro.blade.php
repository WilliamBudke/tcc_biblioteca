<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Editando livro</title>
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
    <div class="row g-3" style="max-width: 850px;margin: auto">
        <h1 class="mt-5" style="max-width: 850px;margin: auto">Paniel de Alteração do Livro: {{$livro->titulo}}</h1>
        <section>
            <a href="{{route('admin.ListLivroDo')}}">
                <button class="btn btn-success">Voltar</button>
            </a>
        </section>
    </div>
</main>
<form class="row g-3" style="max-width: 850px;margin: auto" method="POST" action="{{ route('admin.alterLivroUpdate',['id'=> $livro->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-6"></div>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{$error}}
            </div>
        @endforeach
    @endif
    <div class="col-md-6">
        <label for="inputText" class="form-label">ISBN</label>
        <input type="text" name="isbn" class="form-control" id="isbn" value="{{$livro->isbn}}" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Autor</label>
        <input type="text" name="autor" class="form-control" id="autor" value="{{$livro->autor}}" required autofocus>
    </div>
    <div class="col-12">
        <label for="inputText" class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" id="titulo" value="{{$livro->titulo}}" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Edição</label>
        <input type="text" name="edicao" class="form-control" id="edicao" value="{{$livro->edicao}}" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Volume</label>
        <input type="text" name="volume" class="form-control" id="volume" value="{{$livro->volume}}" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Editora</label>
        <input type="text" name="editora" class="form-control" id="editora" value="{{$livro->editora}}"required autofocus>
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Gênero</label>
        <select name="genero" id="genero" class="form-select" value="{{$livro->genero}} selected>{{$livro->genero}}"required autofocus>
            <option value="{{$livro->genero}}" selected>{{$livro->genero}}</option>
            <option>Romance</option>
            <option>Novela</option>
            <option>Conto</option>
            <option>Crônica</option>
            <option>Poema</option>
            <option>Canção</option>
            <option>Drama histórico</option>
            <option>Política</option>
            <option>Teatro de vanguarda</option>
            <option>Outros</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="inputText" class="form-label">Quantidade</label>
        <input type="text" name="quantidade" class="form-control" value="{{$livro->quantidade}}" id="quantidade"required autofocus>
    </div>
    <div class="col-md-2">
        <label for="image" class="form-label">Imagem do livro</label>
        <input type="file" name="image" class="form-control-file" value="{{$livro->image}}" id="image"required autofocus>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Editar</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
