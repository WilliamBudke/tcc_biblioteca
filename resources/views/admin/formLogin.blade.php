<!doctype html>
<html lang="">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sign In</title>
</head>
<body>
<div class="text-center mt-5 ">
    <form style="max-width: 350px;margin: auto" method="POST" action="{{ route('admin.login.do')}}">
        @csrf
        <img class="mt-4 mb-4" src="data:image/png;base64,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"
             height="102" alt="Livro logo">

        <h1 class="h3 mb-3 font-weight-normal">Login</h1>

        @if($errors->all())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{$error}}
                </div>
            @endforeach
        @endif
        <div class="mt-3">
            <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Endereço de email" required autofocus/>
            <input type="password" name="password" id="password" class="form-control mb-2" placeholder="Sua senha" required autofocus/>
        </div>

        <div class="d-grid gap-2">
            <button  type="submit" class="btn btn-primary">Logar</button>
        </div>

        <div class="text-center mt-3">
            <p>É uma biblioteca e ainda não tem acesso?<a href="{{route('admin.registrar')}}">Registra-se</a></p>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
