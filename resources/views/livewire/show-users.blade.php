<div>
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
        <div class="flex justify-between">
            <div class="w-full md:w-4/5">
                <x-input type="text" wire:model.debounce.1000ms="filters.last_name" placeholder="Search by Last Name..."></x-input>
            </div>
            <div class="mt-2 w-full md:w-auto">
                <x-button-div-sec-chevron click="filters = ! filters" chevron="filters">Add Filters</x-button-div-sec-chevron>
            </div>
        </div>
        <div x-show.transition="filters" x-cloak>
            <x-backend.filters title="Companies filters">
                <x-slot name="content">
                    <div>
                        <x-label>First Name</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.first_name" placeholder="First Name..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>E-mail</x-label>
                        <div class="flex space-x-4">
                            <x-input type="text" wire:model.debounce.1000ms="filters.email" placeholder="E-mail..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Created At (From/To)</x-label>
                        <div class="flex space-x-4">
                            <x-input type="date" wire:model.debounce.1000ms="filters.created_from" placeholder="From..."></x-input>
                            <x-input type="date" wire:model.debounce.1000ms="filters.created_to" placeholder="To..."></x-input>
                        </div>
                    </div>
                    <div>
                        <x-label>Select Role...</x-label>
                        <x-select wire:model="filters.role_id">
                            <option value="">Select a Role...</option>
                            @foreach ( $roles as $role )
                            <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-label>Order By...</x-label>
                        <x-select wire:model="orderBy">
                            <option value="first_name">First Name</option>
                            <option value="last_name">Last Name</option>
                            <option value="email">Email</option>
                            <option value="created_at">Created At</option>
                            <option value="role_id">Role</option>
                        </x-select>
                    </div>
                    <div>
                        <x-label>Order By Direction...</x-label>
                        <x-select wire:model="orderByDirection">
                            <option value="asc">Ascendant</option>
                            <option value="desc">Descendant</option>
                        </x-select>
                    </div>
                </x-slot>
            </x-backend.filters>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <x-message :message="$message"/>
    @endif

    <!-- Listings Table -->
    <x-backend.dynamic-table :headers="['First Name', 'Last Name', 'Email', 'Created', 'Role', 'Edit']">
        @foreach($users as $i => $user)
        <tr class="text-sm hover:bg-blue-200">
            <td class="text-base px-2 py-2">
                <x-backend.avatar-name :path="$user->avatar" :name="$user->first_name . ' ' . $user->last_name" :altName="$user->first_name" />
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

    <div class="flex flex-col justify-center mt-4">
        {!! $users->links() !!}
    </div>
</div>
