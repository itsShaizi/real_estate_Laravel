<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-role-update', $role->id) }}">

            <input type="hidden" name="id" value="{{$role->id}}">
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Update Role</h1>
                </div>
                <div>
                    <x-button>Save Role</x-button>
                </div>
            </header>

            <x-backend.section title="General Info">
                <div>
                    <div class="md:flex md:justify-start text-sm">
                        <div class="p-2">
                            <x-label>
                                Title <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-input name="title" value="{{ $role->title ?? old('title') }}"/>
                        </div>
                        <div class="p-2 md:w-1/3">
                            <x-label>Permissions</x-label>
                            <x-multi-select placeholder="Select Groups" name="permissions" :selected="$selectedGroups" :unselected="$unselectedGroups"/>
                        </div>
                        <div class="p-2 md:w-1/6">
                            <x-label>Admin</x-label>
                            <x-select name="admin">
                                <option value="0">No</option>
                                <option value="1" {{ $role->admin ? 'selected' : '' }}>Yes</option>
                            </x-select>
                        </div>
                    </div>
                </div>
            </x-backend.section>

        </x-form>

    </div>

</x-backend.layout>

