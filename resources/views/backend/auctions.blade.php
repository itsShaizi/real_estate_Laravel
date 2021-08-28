<x-backend.layout>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Auctions</h1>
        </div>
        <div>
            <x-button-href href="{{route('bk-auction-create')}}">New Auction</x-button-href>
        </div>
    </header>

    <hr />

    <x-backend.dynamic-table :headers="['Name', 'Start Date', 'Start Time', 'End Date', 'End Time', 'Description', 'Created', 'Updated', 'Edit']">
        @foreach($auctions as $i => $auction)
        <tr class="text-sm hover:bg-blue-100">
            <td class="text-base px-2 py-2">
                {{ $auction->name }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $auction->start_date }}
            </td>
            <td class="auction-2 py-2 whitespace-nowrap">
                {{ $auction->start_time }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $auction->end_date }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $auction->end_time }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $auction->description }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $auction->created_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap">
                {{ $auction->updated_at }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                <a href="auction/{{ $auction->id }}/edit" class="text-realty hover:text-realty-dark"><i class="fas fa-edit"></i></a>
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $auctions->links() !!}
    </div>

</x-backend.layout>