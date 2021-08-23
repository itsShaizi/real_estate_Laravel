<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-user-update', $user->id) }}" method="PUT">

            <input type="hidden" name="id" value="{{$user->id}}">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Update User</h1>
                </div>
                <div>
                    <x-button>Save User</x-button>
                </div>
            </header>
            <hr />

            <x-backend.section title="User Info">
                <div>
                    <div class="p-2">
                        <x-label>First Name</x-label>
                        <x-input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                            required />
                        <x-input-error for="first_name" message="{{ $errors->first('first_name') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Last Name</x-label>
                        <x-input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                            required />
                        <x-input-error for="last_name" message="{{ $errors->first('last_name') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Email</x-label>
                        <x-input type="text" name="email" value="{{ old('email', $user->email) }}" required />
                        <x-input-error for="email" message="{{ $errors->first('email') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Role</x-label>
                        <x-select name="role_id">
                            @php
                            if(old('role_id')){
                            $selectedOption = old('role_id');
                            }else{
                            $selectedOption = $user->role_id;
                            }
                            @endphp
                            <option value=""></option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $selectedOption === $role->id ? 'selected' : '' }}>
                                {{ $role->title }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="role_id" message="{{ $errors->first('role_id') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Primary Company</x-label>
                        <x-select name="primary_company">
                            @php
                            if(old('primary_company')){
                            $selectedOption = old('primary_company');
                            }else{
                            $selectedOption = $user->primary_company;
                            }
                            @endphp
                            <option value=""></option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{ $selectedOption === $company->id ? 'selected' : '' }}>
                                {{ $company->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error for="primary_company" message="{{ $errors->first('primary_company') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Groups</x-label>
                        <x-multi-select placeholder="Select Groups" name="groups" :selected="$selectedGroups"
                            :unselected="$unselectedGroups" />
                    </div>

                    <div class="p-2">
                        <x-label>
                            <x-input-checkbox name="active" value="{{ $user->active ?? old('active') }}"
                                label="Active" />
                        </x-label>
                    </div>

                    <div class="p-2">
                        <x-label>
                            <x-input-checkbox name="is_contact" value="{{ $user->is_contact ?? old('is_contact') }}"
                                label="Is Contact" />
                        </x-label>
                    </div>

                </div>

                <div 
                    x-data="{edit: false}" 
                    x-init="() => {
                        @if (!$user->avatar)
                            edit = true
                        @endif
                    }"
                    class="p-2 space-x-5 flex items-center"
                >
                    <div class="space-y-2">
                        <x-label>Avatar</x-label>
                    </div>
                    @if ($user->avatar)
                        <div class="relative">
                            <x-button-warning
                                type="button"
                                x-on:click="edit = true"
                                class="absolute cursor-pointer right-0 bottom-0 opacity-50 hover:opacity-100"
                            >
                                <x-icons.pencil />
                            </x-button-warning>
                            <img 
                                src="{{ $user->avatar }}"
                                class="w-40 h-40 rounded-full object-cover"
                            >
                        </div>
                    @endif
                    <div x-show="edit">
                        <x-filepond
                            class="w-40 h-40 -mt-4"
                            name="avatar"
                            avatar-style
                            uploadUrl="{{ url('api/temp-avatar-uploader') }}"
                            file-size-validation="2MB"
                            file-type-validation="image/*"
                            correct-image-orientation
                            crop-aspect-ratio="1:1"
                        />
                    </div>
                </div>
            </x-backend.section>

            <x-backend.section title="Change Password">

                <div class="p-2">
                    <x-label>New Password</x-label>
                    <x-input type="password" name="password" value="{{ old('password') }}" />
                    <x-input-error for="password" message="{{ $errors->first('password') }}" />
                </div>

                <div class="p-2">
                    <x-label>Confirm Password</x-label>
                    <x-input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" />
                    <x-input-error for="password_confirmation"
                        message="{{ $errors->first('password_confirmation') }}" />
                </div>

            </x-backend.section>
        </x-form>

        <x-backend.section title="Danger Zone">

            <div class="p-2">
                <x-label>Delete User</x-label>
                <div class="flex justify-between items-center">
                    <p>Once you delete a user, there is no going back. Please be certain.</p>
                    <div x-data="{ on : false }">
                        <form action="{{ route('bk-user-delete', $user) }}" method="POST"
                            id="delete-user-{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <x-confirm submitLabel="Delete User" form="delete-user-{{ $user->id }}">
                                <x-slot name="trigger">
                                    <x-button-red x-on:click.prevent="on = ! on" class="whitespace-nowrap ml-4">Delete User</x-button-red>
                                </x-slot>
                                <x-slot name="title">Delete User</x-slot>

                                <p>This action cannot be undone. This will permanently delete the user.</p>
                            </x-confirm>
                        </form>
                    </div>
                </div>
            </div>

        </x-backend.section>
    </div>
</x-backend.layout>
