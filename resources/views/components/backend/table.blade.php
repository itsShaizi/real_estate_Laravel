<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-700 text-white text-left text-xs font-medium tracking-wider">
                        <tr>
                            <th scope="col" class="px-2 py-3">
                                Address/Title
                            </th>
                            <th scope="col" class="px-2 py-3">
                                City
                            </th>
                            <th scope="col" class="px-2 py-3">
                                State
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Country
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Listing Type
                            </th>
                            <th scope="col" class="px-2 py-3">
                                Property Type
                            </th>
                            <th scope="col" class="px-2 py-3">
                                List Price
                            </th>
                            <th scope="col" class="relative px-2 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>