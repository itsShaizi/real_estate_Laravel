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
<div>
    <p class="text-center">- this is not a solicitation to list your property -</p>
</div>

</x-landing-layout>