<x-backend.layout>
    <div>
        <x-form action="{{ route('bk-permission-store') }}">

            <header class="flex justify-between mb-5">
                <div>
                    <h1 class="text-3xl font-bold">Create Permission</h1>
                </div>
                <div>
                    <x-button>Save Permission</x-button>
                </div>
            </header>

            <x-backend.section title="General Info">
                <div>
                    <div class="md:flex md:justify-start text-sm">
                        <div class="p-2">
                            <x-label>
                                Permission <span class="fas fa-exclamation-circle"></span>
                            </x-label>
                            <x-input name="permission" value="{{ old('permission') ?? '' }}"/>
                        </div>
                        <div class="p-2 md:w-1/2">
                            <x-label>
                                Description
                            </x-label>
                            <x-textarea name="description" placeholder="Describe the Permission" value="{{ old('description') ?? '' }}"></x-textarea>
                        </div>
                    </div>
                    <hr class="my-4"/>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>

                        </div>
                    </div>
                </div>
            </x-backend.section>

        </x-form>
    </div>

</x-backend.layout>
