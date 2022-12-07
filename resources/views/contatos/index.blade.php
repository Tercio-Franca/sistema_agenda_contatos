<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>SAC - Listagem de Contatos</title>
    </head>
    <body>
        <h1>Listagem de Contatos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contatos as $contato)
                <tr>
                    <td>{{$contato->nome}}</td>
                    <td>{{$contato->categoria}}</td>
                    <td>{{$contato->telefone}}</td>
                </tr>
                @endforeach
            </tbody>
    </body>
</html>
