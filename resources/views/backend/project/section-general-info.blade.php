<x-backend.section title="Project Info">
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-2">
                <x-label>Project name *</x-label>
                <x-input name="name" value="{{ old('name', $project->name ?? '') }}" required/>
                <x-input-error for="name" />
            </div>
            <div class="p-2">
            <x-label>Company</x-label>
            <x-select name="business_id">
                <option value="">Select company...</option>
                @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ old('business_id', $project->business_id) == $company->id ? 'selected' : '' }}>
                    {{ $company->name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="business_id" />
           </div>

        </div>
         <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-2">
                <x-label>Location</x-label>
                <x-input name="location" value="{{ old('location', $project->location ?? '') }}"/>
                <x-input-error for="location" />
            </div>
            <div>
                <x-label>Block number</x-label>
                <x-input name="number_block" value="{{ old('number_block', $project->number_block ?? '') }}" />
                <x-input-error for="number_block" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-label>Floor number</x-label>
                <x-input name="number_floor" value="{{ old('number_floor', $project->number_floor ?? '') }}" />
                <x-input-error for="number_floor" />
            </div>
            <div>
                <x-label>Flat number</x-label>
                <x-input name="number_flat" value="{{ old('number_flat', $project->number_flat ?? '') }}" />
                <x-input-error for="number_flat" />
            </div>
        </div> 
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-2">
                <x-label>
                    Finish Date <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <x-date-picker name="date_finish" value="{{ $project->date_finish ?? old('date_finish') }}"></x-date-picker>
            </div>
            <div class="p-2">
                <x-label>
                    Sell Date <span class="fas fa-exclamation-circle"></span>
                </x-label>
                <x-date-picker name="date_sell" value="{{ $project->date_sell ?? old('date_sell') }}"></x-date-picker>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
             <div>
                <x-label> Price From</x-label>
                <x-input icon="dollar" name="price_from" value="{{ old('price_from', $project->price_from ?? '') }}" />
                <x-input-error for="price_from" />
            </div>
             <div>
                <x-label> Price To</x-label>
                <x-input icon="dollar" name="price_to" value="{{ old('price_to', $project->price_to ?? '') }}" />
                <x-input-error for="price_to" />
            </div>
        </div>
        <hr class="my-4"/> 
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-label>Description *</x-label>
            <textarea id="editor1" name="description">{{ old('description', $project->description ?? '') }}</textarea>
            <x-input-error for="description" />
        </div>
        <div>
            <x-label>Content *</x-label>
            <textarea id="editor2" name="content">{{ old('content', $project->content ?? '') }}</textarea>
            <x-input-error for="content" />
        </div>
       </div>

       <hr class="my-4"/> 
       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-2">
                <x-label>
                    <x-input-checkbox name="featured" value="{{ $project->featured ?? old('featured') }}" label="Featured" />
                </x-label>
            </div>
       </div>
       <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="p-2">
            <x-label>Status</x-label>
            <x-select name="status">
                @foreach ( __('global.project.status') as $val => $name )
                    <option value="{{ $val }}" {{ old('status', $project->status) == $val ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="status" />
           </div>    
       </div>

    </div>
</x-backend.section>