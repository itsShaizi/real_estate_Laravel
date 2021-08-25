<x-backend.layout>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Roles</h1>
        </div>
        <div>
            <x-button-href href="{{route('bk-role-create')}}">New Role</x-button-href>
        </div>
    </header>

    <hr />

    <x-backend.dynamic-table :headers="['ID', 'Title', 'Permissions', 'Admin','Action']">
        @foreach($roles as $i => $role)
        <tr class="text-sm hover:bg-blue-200">
            <td class="text-base px-2 py-2">
                {{ $role->id }}
            </td>
            <td class="text-base px-2 py-2">
                {{ $role->title }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                @foreach($role->permissions as $permission)
                    <span class="shadow-inner bg-purple-200  text-purple-500 rounded-md p-1">{{ $permission->permission }}</span>&nbsp;
                @endforeach
            </td>
            <td class="text-base px-2 py-2">
                {{ $role->admin ? 'Yes': 'No' }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-left text-sm font-medium">
                <a href="role/{{ $role->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
                <form method="POST" action="role/{{ $role->id }}/delete" class="inline">
                    {{ csrf_field() }}
                    <button type="submit" onclick="return confirm('Are you sure?');" class="text-realty hover:text-realty-dark"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $roles->links() !!}
    </div>

</x-backend.layout>
