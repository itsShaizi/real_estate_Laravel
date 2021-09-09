<!-- It has a modal as a test -->

<div class="md:w-1/2 lg:w-1/4" x-data="{ open: false }">
    <div class="box bg-white shadow-lg rounded-2xl mx-16 md:mx-4 my-8 p-8 relative hover:shadow-2xl h-min" @click="open = true">
        <h2 class="font-bold text-realty">
            {{ $state_name }}
        </h2>
        <h3>{{ $agent_title }}</h3>
        <h3>{{ $licence_code }}</h3>
    </div> 

    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full" style="background-color: rgba(0,0,0,.5);" x-show="open"  >
        <div class="h-80 p-4 mx-2 text-center rounded shadow-xl w-full md:w-1/3" @click.away="open = false">
            <div class="mt-3 text-center">
                <div class="box bg-white shadow-lg rounded-2xl mx-16 md:mx-4 my-8 relative hover:shadow-2xl h-min py-4">
                    <h2 class="font-bold text-realty">
                        {{ $state_name }}
                    </h2>
                    <h3>{{ $agent_title }}</h3>
                    <h3>{{ $licence_code }}</h3>
                </div> 
            </div>
        </div>
    </div>

</div>