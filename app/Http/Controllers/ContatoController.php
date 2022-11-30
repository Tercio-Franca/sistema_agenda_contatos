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
        $this->categorias = Categoria::all()->pluck('nome', 'id');
        $this->enderecos = Endereco::all()->pluck('nome', 'id');
        $this->telefones = Telefone::all()->pluck('nome', 'id');;
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
        $enderecos = $this->enderecos;
        $telefones = $this->telefones;
        $tipoTelefones = $this->tipoTelefones;

        return view('contatos.form', compact('categorias', 'enderecos', 'telefones', 'tipoTelefones'));
    }

    /**
     * Store a new contato.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
