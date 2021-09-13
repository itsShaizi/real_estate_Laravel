@component('mail::message')
# Hello!

Congratulations {{ $offer->user->first_name }}, a Traditional offer was received from you for the amount of {{ number_format($offer->offer_amount) }} USD.

{{ $offer->listing->address }}

@component('mail::button', ['url' => route('listing', $offer->listing)])
View Property
@endcomponent

An agent will contact you soon.

Thanks,<br>
{{ config('app.name') }}
@endcomponent