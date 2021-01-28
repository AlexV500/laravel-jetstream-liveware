<div class="max-w-7xl mx-auto py-15 px-4">

    <x-slot name="header">
        Meus Registros
    </x-slot>

    <span class="flex my-5 flex-row-reverse">
      <a href="{{route('expenses.create')}}"
         class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Criar Registro
      </a>
    </span>

    @include('elements.message')

    <table class="table-auto w-full mx-auto">
        <thead>
        <tr class="text-left">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Descrição</th>
            <th class="px-4 py-2">Valor</th>
            <th class="px-4 py-2">Data Registro</th>
            <th class="px-4 py-2">Ações</th>
        </tr>
        </thead>

        <tbody>
        @foreach($expenses as $exp)
            <tr>
                <td class="px-4 py-2 border">{{$exp->id}}</td>
                <td class="px-4 py-2 border">{{$exp->description}}</td>
                <td class="px-4 py-2 border">
                    <span class="{{$exp->type == 1 ? 'text-green-500' : 'text-red-500'}}">
                        R$ {{number_format($exp->amount,2,',','.')}}
                    </span>
                </td>
                <td class="px-4 py-2 border">{{$exp->created_at->format('d/m/Y H:i:s')}}</td>
                <td class="px-4 py-4 border">
                    <a href="{{route('expenses.edit', $exp->id)}}"
                       class="px-4 py-2 border rounded bg-blue-500 text-white">Editar</a>
                    <a href="#" wire:click.prevent="remove({{$exp->id}})"
                       class="px-4 py-2 border rounded bg-red-500 text-white">Remover</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="w-full mx-auto mt-10">
        @if(count($expenses))
            {{$expenses->links()}}
        @endif
    </div>
</div>
