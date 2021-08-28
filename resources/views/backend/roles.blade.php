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
        <tr class="text-sm hover:bg-blue-100">
            <td class="text-base px-2 py-2">
                {{ $role->id }}
            </td>
            <td class="text-base px-2 py-2">
                {{ $role->title }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                @foreach($role->permissions as $permission)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $permission->permission }}</span>
                @endforeach
            </td>
            <td class="text-base px-2 py-2">
                {{ $role->admin ? 'Yes': 'No' }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-left text-sm font-medium">
                <div class="flex justify-left">
                    <div class="mt-2.5">
                        <x-button-href href="role/{{ $role->id }}/edit" class="whitespace-nowrap">Edit</x-button-href>
                    </div>
                    <div x-data="{ on : false }">
                        <form action="role/{{ $role->id }}/delete" method="POST"
                              id="delete-role-{{ $role->id }}">
                            @csrf
                            @method('DELETE')
                            <x-confirm submitLabel="Delete Permission" form="delete-role-{{ $role->id }}">
                                <x-slot name="trigger">
                                    <x-button-red x-on:click.prevent="on = ! on" class="whitespace-nowrap">Delete
                                    </x-button-red>
                                </x-slot>
                                <x-slot name="title">Delete Role</x-slot>

                                <p>This will permanently delete the role.</p>
                            </x-confirm>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $roles->links() !!}
    </div>

</x-backend.layout>
