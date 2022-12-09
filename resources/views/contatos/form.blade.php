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
        <label for="nome" class="form-check-label">Nome:</label>
        <input placeholder="Somente Letras" name="nome" type="text" id="nome" value="{{isset($contato) ? $contato->nome : null}}">

        {!!Form::label('nome', 'Nome:', ['class' => 'form-check-label'])!!}
        {!!Form::text('nome',   isset($contato) ? $contato->nome : null, ['class' => 'form-control','placeholder' => 'Somente Letras',  $form??null])!!}

        @if(isset($contato))
            {{$contato->nome}}
        @else
            {{null}}
        @endif

        {{-- {{$categorias}}
        {{$telefones}} --}}

    </body>
</html>
