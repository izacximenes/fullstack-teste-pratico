<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::query()->with(['categoria'])->paginate(10);


        return view('produto.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = CategoriaProduto::all();
        return view('produto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all =  $request->validate([
            'nome_produto' => 'required|max:150',
            'valor_produto' => 'required|numeric|min:0|max:9999999999.99',
            'id_categoria_planejamento' => 'required|exists:tb_categoria_produto,id_categoria_planejamento'
        ]);

        Produto::create($all);

        return Redirect::route('produtos.index')->with('success', 'Produto criada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $categorias = CategoriaProduto::all();
        return view('produto.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $all =  $request->validate([
            'nome_produto' => 'required|max:150',
            'valor_produto' => 'required|numeric|min:0|max:9999999999.99',
            'id_categoria_planejamento' => 'required|exists:tb_categoria_produto,id_categoria_planejamento'
        ]);

        $produto->fill($all);
        $produto->save();

        return Redirect::route('produtos.edit', $produto->id_produto)->with('success', 'Produto atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return Redirect::route('produtos.index')->with('success', 'Produto Apagado!');
    }
}
