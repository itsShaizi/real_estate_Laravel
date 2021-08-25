<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-permission-update', $permission->id) }}">

            <input type="hidden" name="id" value="{{$permission->id}}">
            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Update Permission</h1>
                </div>
                <div>
                    <x-button>Save Permission</x-button>
                </div>
            </header>

            <x-backend.section title="General Info">
                <div>
                    <div class="md:flex md:justify-between text-sm">
                        <div class="p-2">
                            <x-label>
                                Permission <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-input name="permission" value="{{ $permission->permission ?? old('permission') }}"/>
                        </div>
                        <div class="p-2 md:w-1/2">
                            <x-label>
                                Description
                            </x-label>
                            <x-textarea name="description" placeholder="Describe the Permission" value="{{ $permission->description ?? old('description') }}"></x-textarea>
                        </div>
                    </div>
                </div>
            </x-backend.section>

        </x-form>

    </div>

</x-backend.layout>

