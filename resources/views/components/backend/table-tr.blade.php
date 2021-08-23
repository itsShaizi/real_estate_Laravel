<tr {{ $attributes->merge(['class' => 'text-sm hover:bg-blue-200']) }}>
    <td class="text-base px-2 py-2">
        <div class="flex items-center">
            <div class="w-20 h-20 bg-cover bg-center" style="background-image: url({{  !empty($images->first()) ? '/storage/listings/images/' . $listing->id . '/thumb/' .$images->first()->title : '/images/resources/no-image-yellow.jpg' }})"></div>
            <div class="pl-2 w-40 break-words">{{ $listing->address }}</div>
        </div>
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $listing->city }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $listing->state->iso2 }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $listing->country->iso2 }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            {{ $listing->status }}
        </span>
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $listing->listing_type }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap">
        {{ $listing->property_type }}
    </td>
    <td class="text-base font-bold px-2 py-2 whitespace-nowrap">
        {{ number_format($listing->list_price) }} {{ $listing->list_price_unit }}
    </td>
    <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
        <a href="/listing/{{ $listing->slug }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">View</a> /
        <a href="listing/{{ $listing->id }}/edit" class="text-indigo-600 hover:text-indigo-900">Edit</a>
    </td>
</tr>
