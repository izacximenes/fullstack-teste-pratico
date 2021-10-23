@extends('app')

@section('content')

<div>

    <div class=" p-4 px-4 md:p-8 mb-6">
        <h2 class="font-bold text-xl py-2">Editar Categoria</h2>

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


            <form action="{{ route('categorias.update',$categoria->id_categoria_planejamento) }}" class="lg:col-span-2" method="POST">
                @method('PUT')
                @csrf
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-5">
                        <label for="nome_categoria">Nome</label>
                        <input type="text" required name="nome_categoria" maxlength="150" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $categoria->nome_categoria }}" />
                    </div>



                    <div class="md:col-span-5 text-right">
                        <div class="inline-flex items-end ">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Salvar</button>
                            <a href="{{ route('categorias.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
