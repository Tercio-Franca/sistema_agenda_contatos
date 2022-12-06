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
        $telefones_id = $request->telefone;
        if(isset($telefones_id)) {
            foreach($telefones_id as $telefone_id) {
                Telefone::where($telefone_id,'id')->first()->update([
                    'contato_id' => $contato->id,
                ]);
            }
        }

        // Muitos para Muitos
        $categorias_id = $request->categoria;

        if(isset($categorias_id)) {
            foreach($categorias_id as $categoria_id) {
                $contato->categoria()->attach($categoria_id);
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
        $telefones_id = $request->telefone;
        if(isset($telefones_id)) {
            foreach($telefones_id as $telefone_id) {
                Telefone::where($telefone_id,'id')->first()->update([
                    'contato_id' => $contato->id,
                ]);
            }
        }

        // Muitos para Muitos
        $categorias_id = $request->categoria;

        if(isset($categorias_id)) {
            foreach($categorias_id as $categoria_id) {
                $contato->categoria()->attach($categoria_id);
            }
        }

        return redirect()->route('contatos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
