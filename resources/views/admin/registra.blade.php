<!doctype html>
<html lang="en">
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

    <title>Register</title>
</head>
<body>

<main>
    <div class="row g-3 mt-3" style="max-width: 850px;margin: auto">
        <h1 class="mt-5" style="max-width: 850px;margin: auto">Paniel de Cadastro</h1>
        <section>
            <a href="{{route('admin')}}">
                <button class="btn btn-success">Voltar</button>
            </a>
        </section>
    </div>
</main>
<form class="row g-3" style="max-width: 850px;margin: auto" method="POST" action="{{ route('admin.registrar.do')}}">
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
        <label for="inputText" class="form-label">Razão Social</label>
        <input type="text" name="razao" class="form-control" id="razao"  required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputText" class="form-label">CPNJ</label>
        <input type="text" name="CNPJ" class="form-control" id="CNPJ" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" required autofocus>
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" id="senha" required autofocus>
    </div>
    <div class="col-md-2">
        <label for="inputZip" class="form-label">CEP</label>
        <input type="text" name="cep" class="form-control" id="cep" required autofocus>
    </div>
    <div class="col-4">
        <label for="inputAddress" class="form-label">Endereço</label>
        <input type="text" name="endereco" class="form-control" id="endereco" required autofocus>
    </div>
    <div class="col-4">
        <label for="inputAddress" class="form-label">Bairro</label>
        <input type="text" name="bairro" class="form-control" id="bairro" required autofocus>
    </div>
    <div class="col-md-2">
        <label for="inputCity" class="form-label">Nº</label>
        <input type="text" name="numero" class="form-control" id="numero" required autofocus>
    </div>
    <div class="col-md-4">
        <label for="inputCity" class="form-label">Complemento</label>
        <input type="text" name="complemento" class="form-control" id="complemento">
    </div>
    <div class="col-md-6">
        <label for="inputCity" class="form-label">Cidade</label>
        <input type="text" name="cidade" class="form-control" id="cidade" required autofocus>
    </div>
    <div class="col-md-2">
        <label for="inputState" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-select" required autofocus>
            <option>AC</option>
            <option>AL</option>
            <option>AP</option>
            <option>AM</option>
            <option>BA</option>
            <option>CE</option>
            <option>DF</option>
            <option>ES</option>
            <option>GO</option>
            <option>MA</option>
            <option>MT</option>
            <option>MS</option>
            <option>MG</option>
            <option>PA</option>
            <option>PB</option>
            <option>PR</option>
            <option>PE</option>
            <option>PI</option>
            <option>RJ</option>
            <option>RN</option>
            <option>RS</option>
            <option>RO</option>
            <option>RR</option>
            <option>SC</option>
            <option>SP</option>
            <option>TO</option>
        </select>
    </div>
    <div class="col-12">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
//CEP
        $("#cep").mask("99999-999");

//CNPJ
        $("#CNPJ").mask("99.999.999/9999-99");
    });

    $(document).on('blur', '#cep',function (){
        const cep = $(this).val();

        $.ajax({
           url: 'https://viacep.com.br/ws/'+cep+'/json/',
            method: 'GET',
            datatype: 'json',
            success: function (data){
                console.log(data);
                $('#endereco').val(data.logradouro);
                $('#bairro').val(data.bairro);
                $('#cidade').val(data.localidade);
                $('#estado').val(data.uf);
            }
        });
    });
</script>

</body>
</html>
