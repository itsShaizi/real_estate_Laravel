<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-user-store') }}" method="POST">

            <input type="hidden" name="id" value="{{$user->id}}">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create User</h1>
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
                        <x-input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required/>
                        <x-input-error for="first_name" message="{{ $errors->first('first_name') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Last Name</x-label>
                        <x-input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required/>
                        <x-input-error for="last_name" message="{{ $errors->first('last_name') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Email</x-label>
                        <x-input type="text" name="email" value="{{ old('email', $user->email) }}" required/>
                        <x-input-error for="email" message="{{ $errors->first('email') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>New Password</x-label>
                        <x-input type="password" name="password" value="{{ old('password') }}" required/>
                        <x-input-error for="password" message="{{ $errors->first('password') }}" />
                    </div>

                    <div class="p-2">
                        <x-label>Confirm Password</x-label>
                        <x-input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required/>
                        <x-input-error for="password_confirmation" message="{{ $errors->first('password_confirmation') }}" />
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
                        <x-multi-select placeholder="Select Groups" name="groups" :selected="$selectedGroups" :unselected="$unselectedGroups"/>
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

                    <div class="p-2 space-x-5 flex items-center">
                        <x-label>Avatar</x-label>
                        <x-filepond
                            class="w-40"
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

    </x-form>
    </div>
</x-backend.layout>
