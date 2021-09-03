<x-landing-layout>

    <div class="bg-center bg-rh-image-contact -mt-32">
        <div class="h-full bg-blue-500 bg-opacity-75">
            <div class="md:w-4/5 p-20 text-center mx-auto pt-40">
            <h1 class="text-white text-4xl md:text-7xl pb-2">Contact Us<span style="color:#FFD226">.</span></h1>    
            </div>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto justify-center">
        <div class="flex mb-32 mt-8">
            <div class="md:w-1/2">
                <x-get-in-touch-form></x-get-in-touch-form>

            <div class="md:w-1/2 h-auto">
                <x-map :lat="44.552986548830084" :long="-88.08576687983488" class="h-full w-auto rounded-2xl"></x-map>
            </div>
        </div>

        <div class="container md:flex text-center max-w-7xl mx-auto">
            <div class="md:w-1/2 box bg-white shadow-lg rounded-2xl mx-4 my-16 relative shadow-2xl h-40">
                <h3 class="text-lg text-blue-400">General Inquiries</h3><br>
                <a href="tel:Phone: 888-239-1896">Phone: 888-662-1020</a><br>
                <a>Fax: 920-662-7500</a><br>
                <a href="mailto:email@realtyhive.com">email@realtyhive.com</a><br>
            </div>
            <div class="md:w-1/2 box bg-white shadow-lg rounded-2xl mx-4 my-16 relative shadow-2xl h-40">
                <h3 class="text-lg text-blue-400">Corporate Office </h3><br>
                 <h3>RealtyHive, LLC<br/>445 Cardinal Lane, Suite 102<br/>Green Bay, WI 54313<br/><br/>
                 </h3>
            </div>
        </div>
    </div>
    
</x-landing-layout>