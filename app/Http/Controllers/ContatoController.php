<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\Endereco;

class ContatoController extends Controller
{
    public function index(Request $request)
    {
        $busca = strtolower($request->input('busca'));

        $contatos = Contato::with('endereco')
            ->when($busca, function ($query) use ($busca) {
                $query->whereRaw('LOWER(nome) LIKE ?', ["%{$busca}%"]);
            })
            ->paginate(10);

        return view('contatos.index', compact('contatos'));
    }

    public function create()
    {
        return view('contatos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'idade' => 'required|integer',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'complemento' => 'nullable',
            'cidade' => 'required',
            'estado' => 'required',
        ]);

        $contato = Contato::create($dados);
        $contato->endereco()->create($request->only(['cep', 'rua', 'numero', 'complemento', 'cidade', 'estado']));

        return redirect()->route('contatos.index')->with('success', 'Contato cadastrado com sucesso!');
    }

    public function edit(Contato $contato)
    {
        return view('contatos.create', compact('contato'));
    }

    public function update(Request $request, Contato $contato)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'telefone' => 'required',
            'idade' => 'required|integer',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'complemento' => 'nullable',
            'cidade' => 'required',
            'estado' => 'required',
        ]);

        $contato->update($dados);
        $contato->endereco()->update($request->only(['cep', 'rua', 'numero', 'complemento', 'cidade', 'estado']));

        return redirect()->route('contatos.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy(Contato $contato)
    {
        $contato->delete();
        return back()->with('success', 'Contato deletado com sucesso!');
    }

}