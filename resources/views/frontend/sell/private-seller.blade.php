<x-landing-layout>

<div class="bg-center bg-rh-image-private-seller -mt-32">
    <div class="h-full bg-blue-500 bg-opacity-75">
        <div class="md:w-3/5 pt-5 pb-5 text-center mx-auto pt-40">
            <h1 class="text-white text-5xl md:text-7xl pb-2 mb-12">Private seller<span style="color:#FFD226">.</span></h1>   
            <h2 class="text-white text-2xl text-center mb-12 md:mb-36">Solving the biggest problems for properties on the market 60+ days!</h2>      
        </div>
    </div>
</div>

<div class="container max-w-7xl my-12 mx-auto justify-center">
    <h2 class="text-blue-400 text-4xl text-center font-bold">The Power To Speed Up Your Sale...<br/>Let's Go!</h2>

    <div class="flex container bg-rh-image-private-seller-house bg-no-repeat bg-left max-w-5xl my-12 justify-end mx-auto shadow-xl rounded-lg">
	
		<form method="POST" action="{{ route('register') }}" class="my-16">
	    @csrf

	        <!-- First Name -->
	        <div class="mt-4 mx-4">
	            <x-input class="rounded-lg px-4 py-2 border-2 border-gray-400 bg-gray-200 shadow-inner w-full" id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus placeholder="{{ __('First Name *') }}" />
	        </div>

	        <!-- Last Name -->
	        <div class="mt-4 mx-4">
	            <x-input class="rounded-lg px-4 py-2 border-2 border-gray-400 bg-gray-200 shadow-inner w-full" id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus placeholder="{{ __('Last Name *') }}" />
	        </div>

	        <!-- Email Address -->
	        <div class="mt-4 mx-4">
	            <x-input class="rounded-lg px-4 py-2 border-2 border-gray-400 bg-gray-200 shadow-inner w-full" id="email" type="email" name="email" :value="old('email *')" required placeholder="{{ __('Email') }}" />
	        </div>

	        <!-- Phone Number -->
	        <div class="mt-4 mx-4">
	            <x-input class="rounded-lg px-4 py-2 border-2 border-gray-400 bg-gray-200 shadow-inner w-full" id="phone_number" type="number" name="phone_number" required placeholder="{{ __('Phone Number *') }}"/>
	        </div>

	        <!-- Message -->
	        <div class="mt-4 mx-4">
	            <x-input class="rounded-lg px-4 py-2 border-2 border-gray-400 bg-gray-200 shadow-inner w-full" id="message" type="text" name="message" rows="6" required placeholder="{{ __('Tell us about your property *') }}"/>
	        </div>
	        <div class="mt-4 mx-4">
		        <select name="select" class="rounded-lg bg-white text-gray-500 px-4 py-2 border-2 border-gray-400 bg-gray-200 shadow-inner w-full" >
		            <option value="">Working with or referred By an RH rep?</option> 
		            <option>Alex Ryczek</option>
		            <option>Chad Micoley</option>
		            <option>David Linger</option>
		            <option>Debbie Sustman</option>
		            <option>Gabe Gondeck</option>
		            <option>Jaimie Perkins</option>
		            <option>Katrina McDermid</option>
		            <option>Kim Micoley</option>
		            <option>Peter Palermiti</option>
		            <option>Wade Micoley</option> 
		        </select> 
		    </div>
	        <x-button class="flex mt-4 mx-auto justify-center w-2/4 mx-auto bg-yellow-400">
	            {{ __('Yes I am ready') }}  
	        </x-button>
	        <div class="text-center my-4">
	        <p>Want to speak to us now?<br/>Give us a call at <a href="tel:8886621020">(888) 662-1020</a></p>
	        </div>
	    </form>  
	</div>                
</div>
<div class="mb-16">
    <p class="text-center">- this is not a solicitation to list your property -</p>
</div>







<div class="flex flex-col md:flex-row bg-blue-400 text-white flex text-center"> 
	<div class="md:flex md:flex-row md:w-1/4">
		<div class="mt-8 md:-mt-8 mb-8 ml-4 md:ml-8 mr-4">
		    <a class="flex" href="#">
		        <img class="mx-auto" src="/img/private-seller/tablet-with-img.png" title="Ready, Set, Go!" /> 
		    </a>
		</div>
		<div>
			<p class="flex bg-yellow-300 text-white md:text-black md:text-right p-2 md:-mt-2 md:-ml-6 md:-mr-16 mx-8 justify-center font-bold rounded-xl">See how my property<br/>would look on RealtyHive</p>
		</div>
	</div>
    <div class="md:flex md:flex-col my-8 mx-4 md:w-1/4">
        <div class="my-4">
            <img class="mx-auto" src="/img/homepage/icons/Ready_icon.svg" />
        </div>
        <div class="my-2">
            <h2 class="text-3xl my-2">READY</h2>
            <p>We will schedule a quick overview of RealtyHive with your agent to discuss your listing and the benefits of Time-Limited Event Marketing.</p> 
        </div>
    </div>
    <div class="md:flex md:flex-col my-8 mx-4 md:w-1/4">
        <div class="my-4">
            <img class="mx-auto" src="/img/homepage/icons/Set_icon.svg" />
        </div>
        <div class="my-2">
            <h2 class="text-3xl my-2">SET</h2>
            <p>Once the agreements are signed, your property will be live and marketed on RealtyHive within 72 hours.</p>
        </div>
    </div>
    <div class="md:flex md:flex-col my-8 ml-4 mr-8 md:w-1/4">
        <div class="my-4">
            <img class="mx-auto" src="/img/homepage/icons/Sell_icon.svg" />
        </div>
        <div class="my-2">
            <h2 class="text-3xl my-2">SELL</h2>
            <p>The Time-Limited Event Marketing process will expose your property to a unique set of buyers, creating your Best Chance to Sell!</p>
        </div>
    </div>
</div>





<div class="bg-white">
    <h2 class="text-blue-500 text-5xl text-center max-w-7xl font-bold uppercase mx-auto my-16">See How the RealtyHive Process Works</h2>
    <div class="md:flex md:flex-row max-w-7xl justify-center mx-auto mb-16">
    	<div class="flex text-left mx-8 md:w-1/2">
        <p>By creating an additional marketplace outside of the traditional “for sale and reduce” method, we are able to bring sellers more exposure and more offers, which equals the best chance to sell. We would never be so bold to guarantee every event property will sell, but we can absolutely guarantee that we will get every property more exposure and create the best market presence available. Already working with a broker/agent? No problem! We work with thousands of agents across the United States.</p>
    </div>
    <div class="md:flex md:w-1/2 justify-center mx-auto my-16 md:my-0"> 
        <iframe src="https://player.vimeo.com/video/286009863"  frameborder="0" allowfullscreen></iframe>
    </div>
    </div>
</div>

<div class="flex flex-col bg-blue-400">
    <div class="flex text-white font-bold text-center py-16 justify-center mx-auto"> 
        Know your property's time-limited event marketing value with a free RealtyHive Equity Check.<br/>All it takes is a quick 15-minute phone call and you'll be on your way to Creating Your Best Chance to Sell!
    </div>
    <div class="flex justify-center mx-auto">
    	<a class="bg-yellow-300 text-center text-black rounded-xl p-4 -mb-4" href="#"><button class="font-bold uppercase">Get Started</button></a>
    </div>
</div>  

</x-landing-layout>