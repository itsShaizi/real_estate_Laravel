<x-backend.layout>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Permissions</h1>
        </div>
        <div>
            <x-button-href href="{{route('bk-permission-create')}}">New Permission</x-button-href>
        </div>
    </header>

    <hr />

    <x-backend.dynamic-table :headers="['Permission', 'Description', 'Created', 'Updated', 'Action']">
        @foreach($permissions as $i => $permission)
        <tr class="text-sm hover:bg-blue-200">
            <td class="text-base px-2 py-2">
                {{ $permission->permission }}
            </td>
            <td class="text-base px-2 py-2">
                {{ $permission->description }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $permission->created_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $permission->updated_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-left text-sm font-medium">
                <a href="permission/{{ $permission->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
                <form method="POST" action="permission/{{ $permission->id }}/delete" class="inline">
                    {{ csrf_field() }}
                    <button type="submit" onclick="return confirm('Are you sure?');" class="text-realty hover:text-realty-dark"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $permissions->links() !!}
    </div>

</x-backend.layout>
