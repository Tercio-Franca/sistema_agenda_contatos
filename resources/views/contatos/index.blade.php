<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <title>SAC - Listagem de Contatos</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body>
        <h1>Listagem de Contatos</h1>

        <a type="button" class="btn btn-outline-primary" href="{{route('contatos.create')}}">+ Novo Contato</a>
        <br><br/>
        <table class="table">
            <thead>
                <tr>
                    <th id="coluna_nome" scope="col">Nome</th>
                    <th scope="col">Categorias</th>
                    <th scope="col">Telefones</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contatos as $contato)
                <tr>
                    <td>{{$contato->nome}}</td>
                    <td>
                        @foreach ($contato->categoria as $categoria)
                            {{$categoria->nome}};
                        @endforeach
                    </td>
                    <td>
                        @foreach ($contato->telefone as $telefone)
                            {{$telefone->numero}} ({{$telefone->tipoTelefone->nome}});
                        @endforeach
                    </td>
                    <td>
                        <a type="button" class="btn btn-primary" href="{{route('contatos.show', $contato->id)}}">Visualizar</a>
                        <a type="button" class="btn btn-warning" href="{{route('contatos.edit', $contato->id)}}">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>
