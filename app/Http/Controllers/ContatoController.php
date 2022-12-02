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
    public function __construct(Contato $contatos, Endereco $enderecos)
    {
        $this->contatos = $contatos;
        $this->enderecos = $enderecos;
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
        $tipoTelefones = $this->tipoTelefones;

        return view('contatos.form', compact('categorias', 'telefones', 'tipoTelefones'));
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
            'endereco_id' => $this->enderecos->create([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
            ])->id,
        ]);

        $categorias = $request->categoria;

        if(isset($categorias)) {
            foreach($campanhas as $campanha) {
                $contato->categorias()->attach($campanha);
            }
        }

        
        'telefone_id' => $request->telefone_id,
    }

    /**
     * Show the profile for a given contato.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
