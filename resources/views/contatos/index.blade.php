<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

        <title>SAC - Listagem de Contatos</title>
    </head>
    <body>
        <h1 style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: grey">Listagem de Contatos</h1>

        <a href="{{route('contatos.create')}}">+ Novo Contato</a>
        <br><br/>
        <table class="table">
            <thead>
                <tr>
                    <th style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" scope="col">Nome</th>
                    <th style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" scope="col">Categorias</th>
                    <th style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" scope="col">Telefones</th>
                    <th style = "font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" scope="col">Ações</th>
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
                        <a href="{{route('contatos.show', $contato->id)}}">Visualizar</a>
                        <a href="{{route('contatos.edit', $contato->id)}}">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </body>
</html>
