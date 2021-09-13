@props(['agent' => null])

<div x-data class="block border border-gray-300 clear-both mb-10 px-8 py-10 rounded-2xl shadow-2xl">
	<div class="font-bold mb-5 text-realty">{{ __('Speak to RealtyHive') }}</div>
    @if ($agent)

	<div class="flex mb-5 text-sm">
		<div style="background-image: url({{ $agent->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($agent->first_name.' '.$agent->last_name).'&color=3687FB&background=EBF4FF' }}); background-position: center 0px; background-size: cover; background-repeat: no-repeat; background-color: transparent;" class="h-20 rounded-full w-20">
		</div>
		<ul class="flex-1 leading-5 ml-5 text-xs">
			<li class="text-realty-dark font-bold">{{ $agent->first_name }} {{ $agent->last_name }} </li>

            @if(isset($agent->company))
			<li>{{ $agent->company->name }}</li>
            @endif

            @if($agent->licenses->count() > 0)
			<li>{{ __('License') }} # {{ $agent->licenses->first()->license_number }}</li>
            @endif
		</ul>

	</div>

	<ul class="flex flex-col font-bold justify-between text-realty text-center text-xs">
		<li class="border border-blue-400 mb-3 py-3 rounded-2xl"><a href="tel:{{ $agent->phones->where('main',1)->first()->number }}">{{ $agent->phones->where('main',1)->first()->number }}</a></li>
		<li class="border border-blue-400 mb-3 py-3 rounded-2xl cursor-pointer" @click="$dispatch('open-contact-us')"><a>{{ __('Click to Email') }}</a></li>
		<li class="border border-blue-400 mb-3 py-3 rounded-2xl cursor-pointer" @click="$dispatch('open-schedule-showing')"><a>{{ __('Schedule a Showing') }}</a></li>
	</ul>
    @else
    <ul class="flex flex-col font-bold justify-between text-realty text-center text-xs">
        <li class="border border-blue-400 mb-3 py-3 rounded-2xl"><a href="tel:6053432700">(605) 343-2700</a></li>
        <li class="border border-blue-400 mb-3 py-3 rounded-2xl"><a data-toggle="modal" data-target="#contactModal" href="#" data-email="bohauer@gmail.com" @click="$dispatch('open-contact-us')">{{ __('Click to Email') }}</a></li>
        <li class="border border-blue-400 mb-3 py-3 rounded-2xl"><a data-toggle="modal" data-target="#scheduleShowingModal" href="#" @click="$dispatch('open-schedule-showing')">{{ __('Schedule a Showing') }}</a></li>
    </ul>
    @endif

    <x-frontend.listing.contact-modal />
    <x-frontend.listing.schedule-showing-modal />
</div>
