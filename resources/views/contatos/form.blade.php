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
    </head>
    <body>
        @csrf

        {!!Form::label('nome', 'Nome:', ['class' => 'form-check-label'])!!}
        {!!Form::text('nome', isset($contato) ? $contato->nome : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        {!!Form::label('logradouro', 'Logradouro:', ['class' => 'form-check-label'])!!}
        {!!Form::text('logradouro', isset($contato) ? $contato->endereco->logradouro : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        {!!Form::label('numero', 'Número:', ['class' => 'form-check-label'])!!}
        {!!Form::text('numero', isset($contato) ? $contato->endereco->numero : null, ['class' => 'form-control','placeholder' => 'Somente Números',  $form??null])!!}

        {!!Form::label('cidade', 'Cidade:', ['class' => 'form-check-label'])!!}
        {!!Form::text('cidade', isset($contato) ? $contato->endereco->cidade : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        {{-- {{dd($contato->telefone)}} --}}
        {!!Form::label('telefone1', 'Telefone 1:', ['class' => 'form-check-label'])!!}
        {!!Form::select('telefone1', $telefones, isset($contato) && ($contato->telefone->get(0) !== null) ? $contato->telefone->get(0)->id : null, ['class' => 'form-control', 'placeholder' => 'Selecione um Telefone', $form??null])!!}

        {!!Form::label('telefone2', 'Telefone 2:', ['class' => 'form-check-label'])!!}
        {!!Form::select('telefone2', $telefones, isset($contato) && ($contato->telefone->get(1) !== null) ? $contato->telefone->get(1)->id : null, ['class' => 'form-control', 'placeholder' => 'Selecione um Telefone', $form??null])!!}

        {{-- {{dd($categorias)}} --}}
        @foreach($categorias as $categoria)
            {!! Form::label("categoria$loop->iteration", $categoria, ['class' => 'labelmargem']) !!}
            {!! Form::checkbox("categoria$loop->iteration", $loop->iteration, false, ['id' => "categoria$loop->iteration", isset($form) ? $form : null]) !!}

            {{-- {!!Form::checkbox('categoria', 'value')!!} --}}
        @endforeach
        {{-- @if(isset($contato))
            {{$contato->nome}}
        @else
            {{null}}
        @endif --}}

        {{-- {{$categorias}}
        {{$telefones}} --}}

    </body>
</html>
