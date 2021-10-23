<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = CategoriaProduto::paginate(10);

        return view('categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
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
            'nome_categoria' => 'required|max:150'
        ]);

        CategoriaProduto::create($all);

        return Redirect::route('categorias.index')->with('success', 'Categoria criada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriaProduto  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaProduto $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriaProduto  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaProduto $categoria)
    {

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriaProduto  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaProduto $categoria)
    {
        $all =  $request->validate([
            'nome_categoria' => 'required|max:150'
        ]);

        $categoria->fill($all);
        $categoria->save();

        return Redirect::route('categorias.edit', $categoria->id_categoria_planejamento)->with('success', 'Categoria atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaProduto  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaProduto $categoria)
    {
        $count = Produto::where('id_categoria_planejamento', $categoria->id_categoria_planejamento)->count();
        if ($count > 0) {
            return Redirect::route('categorias.index')->with('error', 'Existem produtos atrelados a essa categoria!');
        }
        $categoria->delete();

        return Redirect::route('categorias.index')->with('success', 'Categoria Apagada!');
    }
}
