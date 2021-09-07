<x-backend.layout>

    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Agent-Room</h1>
        </div>
    </header>

    <hr />

    <livewire:agent-room-aggregate/>

    <h1 class="mt-4 text-xl font-bold">Top 20 Viewed Pages in the last 7 days</h1>
    <x-backend.dynamic-table :headers="['Page title', 'URL', 'PageViews']">
        @foreach($analyticsData['most_visited'] as $data)
        <tr class="text-sm hover:bg-blue-100">
            <td class="px-2 py-1">
                {{ $data['pageTitle'] }}
            </td>
            <td class="px-2 py-1">
                {{ $data['url'] }}
            </td>
            <td class="auction-2 py-1">
                {{ number_format($data['pageViews']) }}
            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex justify-around">
        <div>
            <h1 class="mt-4 text-xl font-bold">Top 20 Referrers in the last 7 days</h1>

            <x-backend.dynamic-table :headers="['URL', 'PageViews']">
                @foreach($analyticsData['top_referrers'] as $data)
                <tr class="text-sm hover:bg-blue-100">
                    <td class="px-2 py-1">
                        {{ $data['url'] }}
                    </td>
                    <td class="px-2 py-1">
                        {{ number_format($data['pageViews']) }}
                    </td>
                </tr>
                @endforeach
            </x-backend.dynamic-table>
        </div>
        <div>
            <h1 class="mt-4 text-xl font-bold">Top 20 Countries in the last 7 days</h1>
            <x-backend.dynamic-table :headers="['Country', 'Sessions', 'PageViews']">
                @foreach($analyticsData['top_countries']->rows as $k => $data)
                <tr class="text-sm hover:bg-blue-100">
                    <td class="px-2 py-1">
                        {{ $data['0'] }}
                    </td>
                    <td class="px-2 py-1">
                        {{ number_format($data['1']) }}
                    </td>
                    <td class="px-2 py-1">
                        {{ number_format($data['2']) }}
                    </td>

                </tr>
                @endforeach
            </x-backend.dynamic-table>
        </div>
        <div>
            <h1 class="mt-4 text-xl font-bold">Top 20 Keywords in the last 7 days</h1>
            <x-backend.dynamic-table :headers="['Keyword', 'Sessions']">
                @foreach($analyticsData['top_keywords']->rows as $k => $data)
                <tr class="text-sm hover:bg-blue-100">
                    <td class="px-2 py-1">
                        {{ $data['0'] }}
                    </td>
                    <td class="px-2 py-1">
                        {{ number_format($data['1']) }}
                    </td>
                </tr>
                @endforeach
            </x-backend.dynamic-table>
        </div>
    </div>

</x-backend.layout>