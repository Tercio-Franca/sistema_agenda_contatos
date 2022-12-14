<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(isset($contato))
            <title>SAC - Visualização do Contato</title>

        @else
            <title>SAC - Criação de Contato</title>

        @endif
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        @csrf

        @if (isset($contato))
            {!! Form::open(['route' => ['contatos.update', $contato->id], 'method' => 'PUT', 'name' => 'form']) !!}
        @else
            {!! Form::open(['route' => 'contatos.store', 'method' => 'POST', 'name' => 'form']) !!}
        @endif

        {!!Form::label('nome', 'Nome:', ['class' => 'form-check-label'])!!}
        {!!Form::text('nome', isset($contato) ? $contato->nome : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        {!!Form::label('logradouro', 'Logradouro:', ['class' => 'form-check-label'])!!}
        {!!Form::text('logradouro', isset($contato) ? $contato->endereco->logradouro : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        {!!Form::label('numero', 'Número:', ['class' => 'form-check-label'])!!}
        {!!Form::text('numero', isset($contato) ? $contato->endereco->numero : null, ['class' => 'form-control','placeholder' => 'Somente Números',  $form??null])!!}

        {!!Form::label('cidade', 'Cidade:', ['class' => 'form-check-label'])!!}
        {!!Form::text('cidade', isset($contato) ? $contato->endereco->cidade : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        {{-- {{dd($contato->telefone)}} --}}
        {!!Form::label('telefone[]', 'Telefone 1:', ['class' => 'form-check-label'])!!}
        {!!Form::select('telefone[]', $telefones, isset($contato) && ($contato->telefone->get(0) !== null) ? $contato->telefone->get(0)->id : null, ['class' => 'form-control', 'placeholder' => 'Selecione um Telefone', $form??null])!!}

        {!!Form::label('telefone[]', 'Telefone 2:', ['class' => 'form-check-label'])!!}
        {!!Form::select('telefone[]', $telefones, isset($contato) && ($contato->telefone->get(1) !== null) ? $contato->telefone->get(1)->id : null, ['class' => 'form-control', 'placeholder' => 'Selecione um Telefone', $form??null])!!}

        {{-- {{dd($categorias)}} --}}
        @foreach($categorias as $categoria)
            {!! Form::label("categoria[]", $categoria, ['class' => 'labelmargem']) !!}
            {!! Form::checkbox("categoria[]", $loop->iteration, isset($contato) ? $contato->categoria->find($loop->iteration) !== null: null, ['id' => "categoria$loop->iteration", isset($form) ? $form : null]) !!}
        @endforeach

        {!! Form::submit('Salvar', ['class' => 'btn btn-success', $form??null]) !!}
        {!! Form::close() !!}

        @if (isset($contato))
            {!! Form::open(['route' => ['contatos.destroy', $contato->id], 'method' => 'DELETE', 'name' => 'form'])!!}
            {!! Form::submit('Excluir', ['class' => 'btn btn-danger', $form??null]) !!}
            {!! Form::close() !!}
        @endif
    </body>
</html>
