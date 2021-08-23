<script type="text/x-template" id="step6d">
	<div class="step6d flex flex-col h-full">

        <div class="step6-paragraph mb-5 sm:flex sm:h-1/4 sm:items-center sm:justify-center">
            <h2 class="text-white text-center font-bold">Let's talk numbers</h2>
        </div>

        <div class="flex-1 p-10 sm:flex sm:flex-col sm:mx-auto sm:w-2/3">

            <div class="sm:flex sm:justify-between">
                <div class="text-white py-5 sm:py-0">
                    <h3 class="text-white font-bold sm:mb-10">List price ($USD)</h3>
                    <p>The price you'd like to get for your property</p>
                </div>
                <div class="flex">
                    <div class="text-2xl text-white mr-5">$</div>
                    <div class="">
                        <input type="text"
                            class="bg-transparent text-2xl text-white pl-2 placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 pac-target-input" 
                            :value="listPriceLocal" 
                            v-on:input="updateListPrice($event.target.value)"
                            placeholder="x,xxx,xxx">
                    </div>
                </div>
            </div>
            
            <div class="sm:flex sm:flex-1 sm:justify-between sm:mt-28">
                <div class="suggested-price text-white py-5 sm:flex sm:flex-col sm:h-2/3 sm:justify-between sm:py-0" v-if="suggestedPriceLocal">
                    <h3 class="text-white font-bold text-xl sm:text-3xl">Your Suggested Opening Bid</h3>
                    <!-- <div class="info-white"></div> -->
                    <p>Your suggested opening bid is a range in which you will engage a buyer (creates a sense of urgency and increases the likelihood of offers).</p>
                    <p>Our suggested pricing is based on 30+ years analyzing 1,000s of properties. A rep will be in touch to discuss this pricing and you can change the range if you'd prefer.</p>
                    <p>You are in total control of the final sales price and all properties can sell prior to the event.</p>
                </div>
                <div class="flex" v-if="suggestedPriceLocal">
                    <div class="text-2xl text-white mr-5">$</div>
                    <div class="">
                        <input type="text" 
                            class="bg-transparent text-2xl text-white pl-2 placeholder-white placeholder-opacity-80 focus:placeholder-opacity-40 pac-target-input" 
                            :value="suggestedPriceLocal" 
                            v-on:input="updateSuggestedPrice($event.target.value)"
                            placeholder="x,xxx,xxx"
                            readonly>
                    </div>
                </div>
            </div>

        </div>

    </div><!--/.step6d -->  
</script>