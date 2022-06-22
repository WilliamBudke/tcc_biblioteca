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
    <div class="row g-3" style="max-width: 850px;margin: auto">
        <h1 class="mt-5" style="max-width: 850px;margin: auto">Paniel de Cadastro de Novos Livros</h1>
        <section>
            <a href="{{route('admin')}}">
                <button class="btn btn-success">Voltar</button>
            </a>
        </section>
    </div>
</main>
<form class="row g-3" style="max-width: 850px;margin: auto" method="POST" action="{{ route('admin.insertlivro.do')}}" enctype="multipart/form-data">
    @csrf
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
        <input type="text" name="ISBN" class="form-control" id="ISBN" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Autor</label>
        <input type="text" name="Autor" class="form-control" id="Autor"  required autofocus>
    </div>
    <div class="col-12">
        <label for="inputText" class="form-label">Título</label>
        <input type="text" name="TituloLivro" class="form-control" id="TituloLivro" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Edição</label>
        <input type="text" name="Edicao" class="form-control" id="Edicao"  required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Volume</label>
        <input type="text" name="Volume" class="form-control" id="Volume"required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">Editora</label>
        <input type="text" name="Editora" class="form-control" id="Editora"required autofocus>
    </div>
    <div class="col-md-4">
        <label for="inputState" class="form-label">Gênero</label>
        <select id="inputState" name="Genero" id="Genero" class="form-select" required autofocus>
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
        <input type="text" name="quantidade" class="form-control" id="quantidade"required autofocus>
    </div>
    <div class="col-md-2">
        <label for="image" class="form-label">Imagem do livro</label>
        <input type="file" name="image" class="form-control-file" id="image"required autofocus>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
//CEP
        $("#cep").mask("99999-999");

//CNPJ
        $("#CNPJ").mask("99.999.999/9999-99");
    });

    $(document).on('blur', '#ISBN',function (){
        const isbn = $(this).val();

        $.ajax({
            url: 'https://www.googleapis.com/books/v1/volumes?q='+isbn+'+isbn&maxResults=1',
            method: 'GET',
            datatype: 'json',
            success: function (data){
                //console.log(data.items[0].volumeInfo.publisher);
                $('#TituloLivro').val(data.items[0].volumeInfo.title);
                $('#Autor').val(data.items[0].volumeInfo.authors);
                $('#Editora').val(data.items[0].volumeInfo.publisher);
            }
        });
    });
</script>
</body>
</html>
