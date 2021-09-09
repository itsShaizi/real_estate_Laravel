<x-landing-layout>

<div class="bg-white -mt-32">
    <style type="text/css">
        .overlay {
            visibility: hidden;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .overlay:target {
            visibility: visible;
        }
    </style>

    <div class="bg-center bg-rh-image-team">
        <div class="h-96 bg-blue-500 bg-opacity-75">
            <div class="w-4/5 pt-5 pb-5 text-center mx-auto pt-40">
                <h1 class="text-white text-7xl pb-2">Projects<span style="color:#FFD226">.</span></h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl lg:w-4/5 md:w-4/5 m-auto">
        <div class="m-5"> 
            <h1>At RealtyHive we're proud of our elite team, which is comprised of a highly experienced management team as well as some of the top-producing agents in the real estate industry. As a firm, we average more than twelve years of experience in the industry per agent which allows us to best serve clients and agents. To build upon our comprehensive market knowledge, we participate in extensive continuing education opportunities in marketing, negotiations, real estate events, and management that help us understand current opportunities and challenges within the industry. But mostly, we listen to our clients' needs and desires. We are Reinventing Real Estate, and we look forward to demonstrating the RealtyHive difference.</h1>
        </div>

        <div class="m-auto md:flex md:flex-wrap text-center px-1 pt-1" id="projects-list">

            @foreach($projects as $i => $project)
            <div class="border-l border-r border-t flex flex-col md:flex-row mx-auto my-10 rounded-2xl shadow-xl w-11/12">
    
            <div class="bg-cover bg-no-repeat flex flex-col-reverse rounded-t-2xl md:rounded-tr-none md:rounded-l-2xl w-full md:w-1/3 h-56 md:h-auto" style="background-image: url({{  !empty($project->images->first()) ? '/storage/projects/images/' . $project->id . '/thumb/' .$project->images->first()->title : '/images/resources/no-image-yellow.jpg' }})">
            </div>

            <div class="flex-cols w-full md:w-2/3">

                <div class="flex justify-between pl-4 py-5">
                    <div class="flex-1">   
                        <div>
                            <a href="/corporate/projects/project/{{$project->id}}">
                                <h2 class="font-bold text-md md:text-3xl">
                                    {{$project->name}}
                                </h2>
                            </a>
                        </div>
                    </div>

                    <div>
                    <div class="font-bold text-sm">
                        <div>
                            <div class="bg-realty mb-2 py-1 px-2 text-white text-center uppercase">
                                Total Listings
                            </div>
                            <div class="bg-gray-100 py-1 px-2 text-realty text-center uppercase">{{ $project->projectListingCount($project->id) }}</div>
                        </div>
                    </div>
                    </div>

                </div>

                <div class="flex-cols">
                    <div class="flex flex-col md:flex-row">
                        <div class="flex-1 justify-between mt-2">
                            <div class="flex flex-wrap md:pl-4 flex md:block justify-between border-t-2 border-b-2 border-bottom-2 border-gray-100 pt-2 pb-2 md:border-0">

                                <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                                    {!! Str::limit($project->description, 250) !!}
                                </div>

                                <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                                 
                                </div>
                                
                                <div class="h-8 pl-2 md:pl-0 md:h-12 w-1/2 md:w-auto">
                                  
                                </div>
                                
                                <div class="h-8 pl-2 md:pl-0 md:h-1 w-1/2 md:w-auto">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="md:border-gray-400 md:border-l pl-6 pt-2 pr-2">
                            <div class="flex-cols">
                                <div class="text-sm font-bold">Min listing price</div>
                                <div class="flex justify-center md:justify-left">
                                    <div class="font-bold text-3xl md:text-2xl text-realty"> {{ $project->projectListingMinPrice($project->id) }}</div>
                                    
                                </div>

                                <div class="text-sm font-bold">Max listing price</div>
                                <div class="flex justify-center md:justify-left">
                                    <div class="font-bold text-3xl md:text-2xl text-realty"> {{ $project->projectListingMaxPrice($project->id) }}</div>
                                   
                                </div>

                            </div> 
                        </div>
                    </div>

                    <div class="flex flex-row-reverse">
                        <div class="bg-yellow-300 font-bold py-2 px-8 text-center text-xs md:text-sm text-white mb-3">
                            <a href="/corporate/projects/project/{{$project->id}}">VIEW DETAILS</a>
                        </div> 
                    </div>
                </div>

            </div>

        </div>
        @endforeach

        <div id="pagination" class="flex justify-center"> {!! $projects->links() !!} </div>

        </div> 
 
    </div>
</div>

</x-landing-layout>