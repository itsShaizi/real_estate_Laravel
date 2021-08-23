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
                    <h1 class="text-white text-7xl pb-2">Team<span style="color:#FFD226">.</span></h1>
                </div>
            </div>
        </div>

        <div class="max-w-7xl lg:w-4/5 md:w-4/5 m-auto">
            <div class="m-5"> 
                <h1>
                    At RealtyHive we're proud of our elite team, which is comprised of a highly experienced management team as well as some of the top-producing agents in the real estate industry. As a firm, we average more than twelve years of experience in the industry per agent which allows us to best serve clients and agents. To build upon our comprehensive market knowledge, we participate in extensive continuing education opportunities in marketing, negotiations, real estate events, and management that help us understand current opportunities and challenges within the industry. But mostly, we listen to our clients' needs and desires. We are Reinventing Real Estate, and we look forward to demonstrating the RealtyHive difference.
                </h1>
            </div>
        

            <div>
                <button class="bg-realty text-white font-bold ml-4 my-4 p-2">Sort Alphabetically</button>
                <button class="bg-realty text-white font-bold ml-2 my-4 p-2">Sort by Job Title</button>
            </div>

            

            <div class="m-auto md:flex md:flex-wrap text-center px-4 pt-4 justify-items-center">

                <x-frontend.about.team-card>                
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Alex Ryczek</x-slot>
                    <x-slot name="agent_title">Business Develpment Executive</x-slot>
                    <x-slot name="agent_phone">920-617-9155</x-slot>
                </x-frontend.about.team-card>   

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Aleisha Fulfer</x-slot>
                    <x-slot name="agent_title">Real State Salesperson</x-slot>
                    <x-slot name="agent_phone">920-617-9168</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Amanda Syrjamaki</x-slot>
                    <x-slot name="agent_title">Marketing Manager</x-slot>
                    <x-slot name="agent_phone">920-617-9117</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>                
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Amy Badenik</x-slot>
                    <x-slot name="agent_title">Real State Consultant</x-slot>
                    <x-slot name="agent_phone">920-617-9181</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Chad Micoley</x-slot>
                    <x-slot name="agent_title">Real State Consultant</x-slot>
                    <x-slot name="agent_phone">920-617-9110</x-slot>
                </x-frontend.about.team-card>   

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Deana Ryczek</x-slot>
                    <x-slot name="agent_title">Senior Associate</x-slot>
                    <x-slot name="agent_phone">920-617-9159</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Gabe Gondek</x-slot>
                    <x-slot name="agent_title">Business Development Executive</x-slot>
                    <x-slot name="agent_phone">920-617-9146</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Jaimie Perkins</x-slot>
                    <x-slot name="agent_title">Executive Customer Relations</x-slot>
                    <x-slot name="agent_phone">920-617-9161</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Jeff Harrill</x-slot>
                    <x-slot name="agent_title">Realtor - CRS, GRI</x-slot>
                    <x-slot name="agent_phone">920-617-9145</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Julie Voakes</x-slot>
                    <x-slot name="agent_title">Closing Departament Manager</x-slot>
                    <x-slot name="agent_phone">920-617-9137</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Katrina McDermid</x-slot>
                    <x-slot name="agent_title">Business Development Executive</x-slot>
                    <x-slot name="agent_phone">920-617-9118</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Kim Micoley</x-slot>
                    <x-slot name="agent_title">Senior Real State Consultant</x-slot>
                    <x-slot name="agent_phone">920-617-9152</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Laura Lutzke</x-slot>
                    <x-slot name="agent_title">Social Media Specialist</x-slot>
                    <x-slot name="agent_phone">920-617-9191</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Mark Herman</x-slot>
                    <x-slot name="agent_title">President</x-slot>
                    <x-slot name="agent_phone">(507)964-2256</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Marla Micoley</x-slot>
                    <x-slot name="agent_title">Vice President - Director</x-slot>
                    <x-slot name="agent_phone">920-617-9142</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Nico Mengual</x-slot>
                    <x-slot name="agent_title">Web Development Manager</x-slot>
                    <x-slot name="agent_phone">920-617-9117</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Julie Voakes</x-slot>
                    <x-slot name="agent_title">Closing Departament Manager</x-slot>
                    <x-slot name="agent_phone">920-617-9137</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Peter Palermiti</x-slot>
                    <x-slot name="agent_title">Director of Strategic Accounts</x-slot>
                    <x-slot name="agent_phone">414-339-1776</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Samantha VanZeeland</x-slot>
                    <x-slot name="agent_title">Listing Specialist</x-slot>
                    <x-slot name="agent_phone">920-617-9149</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Steve Fulfer</x-slot>
                    <x-slot name="agent_title">Senior V.P. of Commercial Sales</x-slot>
                    <x-slot name="agent_phone">920-366-0826</x-slot>
                </x-frontend.about.team-card>           

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Tracy Hogan-Albers</x-slot>
                    <x-slot name="agent_title">Ofice Manager</x-slot>
                    <x-slot name="agent_phone">920-617-9122</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Tristin Zeman</x-slot>
                    <x-slot name="agent_title">SEO & Digital Advertising Sprcialist</x-slot>
                    <x-slot name="agent_phone">920-617-9180</x-slot>
                </x-frontend.about.team-card>

                <x-frontend.about.team-card>
                    <x-slot name="agent_image"><img class="rounded-full" src="/img/sell/policy2.png"/></x-slot>
                    <x-slot name="agent_name">Wade Micoley</x-slot>
                    <x-slot name="agent_title">Founder & CEO</x-slot>
                    <x-slot name="agent_phone">920-617-9182</x-slot>
                </x-frontend.about.team-card>

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
</x-landing-layout>