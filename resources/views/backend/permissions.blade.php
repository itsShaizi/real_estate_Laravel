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
                <div class="flex justify-left">
                    <div class="div">
                        <x-button-href href="permission/{{ $permission->id }}/edit">Edit Permission</x-button-href>
                    </div>
                    <div x-data="{ on : false }">
                        <form action="permission/{{ $permission->id }}/delete" method="POST"
                              id="delete-permission-{{ $permission->id }}">
                            @csrf
                            @method('DELETE')
                            <x-confirm submitLabel="Delete Permission" form="delete-permission-{{ $permission->id }}">
                                <x-slot name="trigger">
                                    <x-button x-on:click.prevent="on = ! on" class="whitespace-nowrap ml-4">Delete
                                        Permission
                                    </x-button>
                                </x-slot>
                                <x-slot name="title">Delete Permission</x-slot>

                                <p>This will permanently delete the permission.</p>
                            </x-confirm>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $permissions->links() !!}
    </div>

</x-backend.layout>
