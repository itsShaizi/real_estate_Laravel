<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col mt-4">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-600 via-gray-400 to-blue-400 text-white text-left text-md font-medium tracking-wider">
                        <tr>
                            <th scope="col" class="px-2 py-1">
                               Cover Photo
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Title
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Content
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Author
                            </th>
                            <th scope="col" class="px-2 py-1">
                                Tags
                            </th>
                            <th scope="col" class="relative px-2 py-1">
                                Actions
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