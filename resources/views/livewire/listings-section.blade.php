<div>
    <x-backend.dynamic-table :headers="['Address','City','State','Country','Price','Acting as','Action']">
        @forelse($listings as $listing)
        <tr class="text-sm hover:bg-blue-200">
            <td class="px-2 py-2 whitespace-nowrap">{{ $listing->address }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $listing->city }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $listing->state->iso2 }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ $listing->country->iso2 }}</td>
            <td class="px-2 py-2 whitespace-nowrap">{{ number_format($listing->list_price) }}</td>

            <td class="px-2 py-2 whitespace-nowrap">
                {{$user->getUserListingGroups($user,$listing)}}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                <a href="/listing/{{ $listing->slug }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">View</a> /
                <a href="/agent-room/listing/{{ $listing->id }}/edit" class="text-indigo-600 hover:text-indigo-900">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-base text-center py-4">No Listings added.</td>
        </tr>
        @endforelse
    </x-backend.dynamic-table>
</div>
