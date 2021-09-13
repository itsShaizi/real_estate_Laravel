<x-backend.layout>
    <header class="flex justify-between mb-5">
        <div>
            <h1 class="text-3xl font-bold">Form Submissions</h1>
        </div>
    </header>

    <hr />

    <x-backend.dynamic-table :headers="['Name & Email', 'Message', 'Phone Numbe', 'Form Type', 'Listing', 'Created', 'Actions']">
        @foreach($forms as $i => $form)
        <tr class="text-sm hover:bg-blue-100">
            <td class="text-base px-2 py-2">
                <span class="font-semibold">{{ $form->first_name }} {{ $form->last_name }}</span><br>
                {{ $form->email }}
            </td>
            <td class="text-base px-2 py-2">
                {{ $form->message }}
            </td>
            <td class="text-base px-2 py-2">
                {{ $form->phone_number }}
            </td>
            <td class="text-base px-2 py-2">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 whitespace-nowrap">
                    {{ __('global.form-submissions')[$form->form_submission_type] }}
                </span>
            </td>
            <td class="text-base px-2 py-2">
                @if($form->listing)
                <div class="flex items-center">
                    <div class="w-20 h-20 bg-cover bg-center" style="background-image: url({{  !empty($form->listing->images->first()) ? '/storage/listings/images/' . $form->listing->id . '/thumb/' . $form->listing->images->first()->title : '/images/resources/no-image-yellow.jpg' }})"></div>
                    <div class="pl-2 w-40 break-words">{{ $form->listing->address }}</div>
                </div>
                @endif
            </td>
            <td class="text-base px-2 py-2">
                {{ $form->created_at->format('d M Y H:i') }}
            </td>
            <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">

            </td>
        </tr>
        @endforeach
    </x-backend.dynamic-table>

    <div class="flex flex-col justify-center">
        {!! $forms->links() !!}
    </div>

</x-backend.layout>
