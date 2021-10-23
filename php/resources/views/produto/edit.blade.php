@extends('app')

@section('content')

<div>

    <div class=" p-4 px-4 md:p-8 mb-6">
        <h2 class="font-bold text-xl py-2">Criar Produto</h2>
        @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" @click="show =false" :class="show ? 'block' : 'hidden'" class=" py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div x-data="{ show: true }" x-show="show" @click="show =false" :class="show ? 'block' : 'hidden'" class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
            {{ $error }}
        </div>
        @endforeach
        @endif
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">


            <form action="{{ route('produtos.update', $produto->id_produto) }}" class="lg:col-span-2" method="POST">
                @method('PUT')
                @csrf
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-5">
                        <label for="nome_categoria">Nome</label>
                        <input type="text" name="nome_produto" value="{{ $produto->nome_produto }}" required maxlength="150" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" />
                    </div>

                    <div class="md:col-span-5">
                        <label for="id_categoria_planejamento">Categoria</label>
                        <select required type="text" name="id_categoria_planejamento" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                            <option disabled value></option>
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id_categoria_planejamento }}" {{ $categoria->id_categoria_planejamento == $produto->id_categoria_planejamento ? 'selected' : '' }}>{{$categoria->nome_categoria}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="md:col-span-5">
                        <label for="valor_produto">Valor</label>
                        <input name="valor_produto" value="{{ $produto->valor_produto }}" pattern="(0\.((0[1-9]{1})|([1-9]{1}([0-9]{1})?)))|(([1-9]+[0-9]*)(\.([0-9]{1,2}))?)" required class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="" />
                    </div>



                    <div class="md:col-span-5 text-right">
                        <div class="inline-flex items-end">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Salvar</button>
                            <a href="{{ route('produtos.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
