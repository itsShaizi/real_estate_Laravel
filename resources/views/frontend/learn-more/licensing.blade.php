<x-landing-layout>

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


<div class="bg-center bg-rh-image-duediligence -mt-32">
    <div class="h-full bg-blue-500 bg-opacity-75">
        <div class="md:w-3/5 pt-5 pb-5 text-center mx-auto pt-40">
            <h1 class="text-white text-7xl pb-2 mb-12">Learn More<span style="color:#FFD226">.</span></h1>        
        </div>
    </div>
</div>

<div class="container max-w-7xl mx-auto">

    <x-frontend.learn-more.learn-more-menu>
    </x-frontend.learn-more.learn-more-menu>

    <div class="container md:mx-6 mb-8">
        <div class="max-w-7xl lg:w-4/5 md:w-4/5 m-auto">
            <h2 class="font-bold text-2xl text-center md:text-left md:text-5xl text-blue-400 mb-8 uppercase">Licencing</h2>

            <div class="w-64 md:mx-0 mx-auto">  
                <select name="LicenseState" class="w-64 rounded-2xl py-2 pl-1"  ng-model="LicenseState" ng-change="getResults()"> 
                    <option value="">View All</option> 
                    <!--?php foreach(get_states() as $country => $ary){
                        if (is_array($ary)){
                            foreach($ary as $key => $val){
                                echo '<option value="'.$key.'">'.$val.'</option>';
                            }
                        } 
                    } ?>-->
                </select> 
            </div>

            <div class="m-auto md:flex md:flex-wrap text-center md:-mx-4 pt-4 justify-items-center">
                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">FL Auctioneer</x-slot>
                    <x-slot name="agent_title">Katrina McDermid</x-slot>
                    <x-slot name="licence_code">License: 4070</x-slot>
                </x-frontend.learn-more.licencing-card> 

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">GA Auctioner 2</x-slot>
                    <x-slot name="agent_title">Wade Micoley</x-slot>
                    <x-slot name="licence_code">License: AU003815</x-slot>
                </x-frontend.learn-more.licencing-card>         

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">WI Auctioneer</x-slot>
                    <x-slot name="agent_title">Wade Micoley</x-slot>
                    <x-slot name="licence_code">License: 2597-052</x-slot>
                </x-frontend.learn-more.licencing-card>         

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">TN Auctioneer</x-slot>
                    <x-slot name="agent_title">Rick Roundy</x-slot>
                    <x-slot name="licence_code">License: 6642</x-slot>
                </x-frontend.learn-more.licencing-card> 

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">AZ Auctioneer</x-slot>
                    <x-slot name="agent_title">Nico Mengual</x-slot>
                    <x-slot name="licence_code">License: 101001</x-slot>
                </x-frontend.learn-more.licencing-card> 

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">MO Broker</x-slot>
                    <x-slot name="agent_title">Wade Micoley</x-slot>
                    <x-slot name="licence_code">License: AU003815</x-slot>
                </x-frontend.learn-more.licencing-card>         

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">AR Auctioner</x-slot>
                    <x-slot name="agent_title">Wade Micoley</x-slot>
                    <x-slot name="licence_code">License: PB0074362</x-slot>
                </x-frontend.learn-more.licencing-card>         

                <x-frontend.learn-more.licencing-card>              
                    <x-slot name="state_name">SC Broker</x-slot>
                    <x-slot name="agent_title">Wade Micoley</x-slot>
                    <x-slot name="licence_code">License: 0995688583</x-slot>
                </x-frontend.learn-more.licencing-card> 

            </div>

            <!-- this is just a test modal -->
            <div id="modal" class="bg-gray-200 bg-opacity-75 overlay text-center h-screen">
                <a href="#" class="absolute h-screen w-screen"></a>
                <div class="box bg-white shadow-lg modal w-48 h-24 bg-white p-4 relative rounded-2xl mx-4 my-8 relative hover:shadow-2xl h-60 w-80 fixed">
                    <h2 class="font-bold text-realty mt-6">Wade Micoley</h2>
                    <h3>Founder & CEO</h3>
                    <h3 class="mt-7 text-realty">920-617-9182</h3>
                    <button class="text-realty">Click to email</button>
                    <h3 class="text-realty mb-7 pb-4"><img class="mx-auto p-2" src="/img/social-media-icons/linkedin.png"/></h3>
                    <a href="#" class="absolute top-2.5 right-4">x</a>
                </div>
            </div>
            
        </div>
    </div>
</div>

</x-landing-layout>