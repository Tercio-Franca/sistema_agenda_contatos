<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\TipoTelefone;

class ContatoController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @param  \App\Models\Contato  $contatos
     * @return void
     */
    public function __construct(Contato $contatos)
    {
        $this->contatos = $contatos;
        $this->enderecos =  new Endereco;
        $this->categorias = Categoria::all()->pluck('nome', 'id');
        $this->telefones = Telefone::all()->pluck('numero', 'id');
        $this->tipoTelefones = TipoTelefone::all()->pluck('nome', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = $this->contatos->all();

        return view('contatos.index', compact('contatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->categorias;
        $telefones = $this->telefones;

        return view('contatos.form', compact('categorias', 'telefones'));
    }

    /**
     * Store a new contato.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contato = $this->contatos->create([
            'nome' => $request->nome,
            // Caso a chave estrangeira esteja na tabela principal

            // Caso não exista no banco

            // 'endereco' => $request->endereco,  Campo Texto
            // 'endereco_id' => $request->endereco_id,  Campo Select
            'endereco_id' => $this->enderecos->create([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
            ])->id,
        ]);

        // Caso a chave estrangeira não esteja na tabela principal

        // Caso exista no banco
        $telefone1_novo_id = $request->telefone[0];
        $telefone2_novo_id = $request->telefone[1];


        if(isset($telefone1_novo_id)) {
            Telefone::where('id', $telefone1_novo_id)->first()->update([
                'contato_id' => $contato->id,
            ]);
        }
        //dd($request->telefone);

        if(isset($telefone2_novo_id)) {
            Telefone::where('id',$telefone2_novo_id)->first()->update([
                'contato_id' => $contato->id,
            ]);
        }

        // Muitos para Muitos
        $categorias_id = $request->categoria;

        if(isset($categorias_id)) {
            foreach($categorias_id as $categoria_id) {
                $contato->categoriaRelationship()->attach($categoria_id);
            }
        }

        return redirect()->route('contatos.index');
    }

    /**
     * Show the profile for a given contato.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $form = 'disabled';

        $contato = $this->contatos->find($id);
        $categorias = $this->categorias;
        $telefones = $this->telefones;

        return view('contatos.form', compact('categorias', 'telefones','form','contato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contato = $this->contatos->find($id);
        $categorias = $this->categorias;
        $telefones = $this->telefones;

        return view('contatos.form', compact('categorias', 'telefones','contato'));
    }

    /**
     * Update the given contato.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contato = $this->contatos->find($id);
        $contato->update([
            'nome' => $request->nome,
            // Caso a chave estrangeira esteja na tabela principal

            // Caso não exista no banco

            // 'endereco' => $request->endereco,  Campo Texto
            // 'endereco_id' => $request->endereco_id,  Campo Select
            'endereco_id' => $this->enderecos->find($contato->endereco->id)->update([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
            ])->id,
        ]);

        // Caso a chave estrangeira não esteja na tabela principal

        // Caso exista no banco
        $telefone1_novo_id = $request->telefone1;
        $telefone2_novo_id = $request->telefone2;

        $telefone1_antigo = $contato->telefone->get(0);
        $telefone2_antigo = $contato->telefone->get(1);

        // Se tiver apenas um telefone relacionado
        if ($contato->telefone->count() == 1) {

            // Se telefone1 já existir, cria novo relacionamento e apaga o anterior.
            if (isset($telefone1_novo_id) && ($telefone1_antigo->id != $telefone1_novo_id)) {
                $telefone1_antigo->update([
                    'contato_id' => null,
                ]);

                Telefone::where($telefone1_novo_id,'id')->first()->update([
                    'contato_id' => $contato->id,
                ]);
            }

            if(isset($telefone2_novo_id)) {
                Telefone::where($telefone2_novo_id,'id')->first()->update([
                    'contato_id' => $contato->id,
                ]);
            }


        } else if ($contato->telefone->count() == 2) {

            // Se telefone1 já existir, cria novo relacionamento e apaga o anterior.
            if (isset($telefone1_novo_id) && ($telefone1_antigo->id != $telefone1_novo_id)) {
                $telefone1_antigo->update([
                    'contato_id' => null,
                ]);

                Telefone::where($telefone1_novo_id,'id')->first()->update([
                    'contato_id' => $contato->id,
                ]);
            }

            // Se telefone2 já existir, cria novo relacionamento e apaga o anterior.
            if (isset($telefone2_novo_id) && ($telefone2_antigo->id != $telefone2_novo_id)) {
                $telefone2_antigo->update([
                    'contato_id' => null,
                ]);

                Telefone::where($telefone2_novo_id,'id')->first()->update([
                    'contato_id' => $contato->id,
                ]);
            }
        }

        // Muitos para Muitos
        $categorias_id = $request->categoria;

        $contato->categoria()->sync(null);

        if(isset($categorias_id)) {
            foreach($categorias_id as $categoria_id) {
                //$categoria_id = Categoria::where($categoria,'nome')->first()->id;
                $contato->categoria()->attach($categoria_id);
            }
        }

        return redirect()->route('contatos.show', $contato->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contatos = $this->contatos->find($id)->delete();
        return redirect()->route('contatos.index');
    }

}
