<div class="flex">
    <input type="checkbox" name="{{ $name }}" value="1" {{ $attributes }} class="form-checkbox h-5 w-5 text-gray-600" {{ $value == 1 ? 'checked' : '' }}><span class="ml-2 text-gray-700">{{ $label }}</span>
</div>
