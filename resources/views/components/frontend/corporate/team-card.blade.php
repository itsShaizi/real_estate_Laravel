<div class="md:w-1/2 lg:w-1/4" x-data="{ open: false }">
    <div class="box bg-white shadow-lg rounded-2xl mx-4 my-8 relative hover:shadow-2xl h-80" @click="open = true">
        <div class="absolute -top-10 left-0 right-0 w-32 rounded-full object-none object-top mx-auto shadow-lg">
            {{ $agent_image }}
        </div>
        <h2 class="font-bold text-realty mt-12 pt-32">
            {{ $agent_name }}
        </h2>
        <h3>{{ $agent_title }}</h3>
        <h3 class="mt-7 text-realty">
            {{ $agent_phone }}</h3>
        <button class="text-realty">Click to email</button>
        <h3 class="text-realty mb-7 pb-4"><img class="mx-auto p-2" src="/img/social-media-icons/linkedin.png"/></h3>
    </div> 

    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open"  >
        <div class="h-80 p-4 mx-2 text-center bg-white rounded shadow-xl w-full md:w-1/3" @click.away="open = false">
            <div class="mt-3 text-center">
                <div class="absolute left-0 right-0 w-32 rounded-full object-none object-top mx-auto shadow-lg -mt-32">
                    {{ $agent_image }}
                </div>
                <h2 class="font-bold text-realty mt-16 pt-8">
                    {{ $agent_name }}
                </h2>
                <h3>{{ $agent_title }}</h3>
                <h3 class="mt-4 text-realty">
                    {{ $agent_phone }}</h3>
                <button class="text-realty">Click to email</button>
                <h3 class="text-realty mb-4 pb-4"><img class="mx-auto p-2" src="/img/social-media-icons/linkedin.png"/></h3>
            </div> 
        </div>
    </div>
</div>
