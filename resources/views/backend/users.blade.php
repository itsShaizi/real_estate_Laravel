<x-backend.layout>

    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Users</h1>
        </div>
        <div>
            <x-button-href href="{{ route('bk-user-create') }}">Create User</x-button-href>
        </div>
    </header>

    <hr />

    <div x-data="{filters: false}">
        <x-form action="{{ route('bk-user-search') }}">
            <div class="flex justify-between">
                <div class="w-full md:w-4/5">
                    <x-input type="text" name="s_query" placeholder="Search User..."></x-input>
                </div>
                <div class="mt-2 w-full md:w-auto">
                    <x-button><span class="fa fa-search"></span></x-button>
                </div>
            </div>
        </x-form>
    </div>

    @if ($message = Session::get('success'))
    <x-message :message="$message"/>
    @endif

    <!-- Listings Table -->
    <x-backend.dynamic-table :headers="['First Name', 'Last Name', 'Email', 'Created', 'Role', 'Edit']">
        @foreach($users as $i => $user)
        <tr class="text-sm hover:bg-blue-200">
            <td class="text-base px-2 py-2">
                {{ $user->first_name }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $user->last_name }}
            </td>
            <td class="auction-2 py-2 whitespace-nowrap">
                {{ $user->email }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $user->created_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $user->role->title ?? 'Null' }}</span>
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-center text-sm font-medium">
                <a href="user/{{ $user->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $users->links() !!}
    </div>

</x-backend.layout>
