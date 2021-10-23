@extends('app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h3 class="text-gray-700 text-3xl font-medium">Produtos</h3>

    <div class="mt-8">

    </div>
    @if (session()->has('success'))
    <div x-data="{ show: true }" x-show="show" @click="show =false" :class="show ? 'block' : 'hidden'" class=" py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">
        {{ session()->get('success') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div x-data="{ show: true }" x-show="show" @click="show =false" :class="show ? 'block' : 'hidden'" class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
        {{ session()->get('error') }}
    </div>
    @endif

    <div class="flex flex-row w-full py-2">
        <a href="{{ route('produtos.create') }}" class="p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-lg focus:border-4 border-green-300">Criar</a>
    </div>
    <div class="flex flex-col mt-8">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Nome</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Categoria</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Valor</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Cadastrado Em</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Ações</th>

                        </tr>
                    </thead>

                    <tbody class="bg-white">

                        @forelse ($produtos as $produto)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900"> {{ $produto->id_produto }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900"> {{ $produto->nome_produto }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900"> {{ $produto->categoria->nome_categoria }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900"> {{ number_format($produto->valor_produto, 2, ',') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900"> {{ date('d/m/Y H:i', strtotime($produto->data_cadastro)) }}</div>
                            </td>


                            <td class="px-2 py-4 whitespace-no-wrap flex   space-x-4  text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{ route('produtos.edit',$produto->id_produto ) }}" class="p-2 pl-5 pr-5 bg-blue-500 text-gray-100 text-lg rounded-lg focus:border-4 border-blue-300">Editar</a>
                                <form onSubmit="if(!confirm('Você deseja mesmo apagar esse registro?')){return false;}" action="{{ route('produtos.destroy', $produto->id_produto) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="p-2 pl-5 pr-5 bg-red-500 text-gray-100 text-lg rounded-lg focus:border-4 border-gray-300">Apagar</button>
                                </form>



                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <span class="p-4">Nenhuma produto encontrado.</span>
                            </td>

                        </tr>
                        @endforelse



                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $produtos->links() }}
</div>

@endsection
